<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Insurer;
use AppBundle\Entity\InsurancePolicy;
use AppBundle\Entity\InsurancePolicyFile;
use AppBundle\Form\InsurancePolicyType;
use AppBundle\Form\ContractCalculatorType;
use Symfony\Component\HttpFoundation\Session;
use AppBundle\Utils\InsuranceCalculator\Tariff\Calculator;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * InsurancePolicy controller.
 *
 */
class InsurancePolicyController extends Controller
{

    private $session;
    private $insuranceCalculator;
    private $insurer;
    private $categories;
    private $baseTariff;

    public function calculatorAction(Request $request)
    {
     
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);    
        
        $calculations = [];
        $form = $this->createForm(new ContractCalculatorType(),null,array(
            'action' => $this->generateUrl('app_index')
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $insuranceCalculator = $this->container->get('insurance_calculator');

            $calculations = $insuranceCalculator
                    ->prepare($form->getData())
                    ->getCalculatedInsurances();
        }

        return $this->render('AppBundle:InsurancePolicy:calculator.html.twig', array(
                    'contract_form' => $form->createView(),
                    'calculators' => $calculations
        ));
    }

    /**
     * Creates a new InsurancePolicy entity.
     *
     */
    public function newAction(Request $request)
    {

        $this->prepare($request);

        $totalAmount = $this->baseTariff->getAmount();
        $totalAmount += $this->insuranceCalculator->getBasicTariffsTotal($this->baseTariff, $this->categories);

        $insurancePolicy = new InsurancePolicy();
        $insurancePolicy->setInsurer($this->getInsurer())
            ->setAmountBase($this->baseTariff->getAmount())
            ->setAmountTotal($totalAmount);

        $form = $this->createForm('AppBundle\Form\InsurancePolicyType', $insurancePolicy);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->persistInsurance($insurancePolicy);

            return $this->redirectToRoute('insurance-policies_show', array("id" => $insurancePolicy->getId()));
        }


        return $this->render('AppBundle:InsurancePolicy:new.html.twig', array(
                    'insurancePolicy' => $insurancePolicy,
                    'form' => $form->createView(),
                    'insurer' => $this->getInsurer(),
                    'tariffs' => $this->getTariffs(),
                    'baseTariff' => $this->baseTariff,
                    'ageTariff' => null,
                    'totalAmount' => $totalAmount
        ));
    }

    public function showAction(InsurancePolicy $insurancePolicy)
    {

        return $this->render('AppBundle:InsurancePolicy:show.html.twig', array(
                    'insurancePolicy' => $insurancePolicy
        ));
    }

    /**
     * 
     * Check if the request has 'insurer_id','category_options' and 'driver_age' and
     * if it does, store them in the current session. If not, redirect back so the
     * user selects them and they are sent together with the request.
     * 
     * @param Request $request
     * @return type
     */
    private function prepare(Request $request)
    {

        $this->session = $request->getSession();
        $this->insuranceCalculator = $this->container->get('insurance_calculator');

        if ($request->get('insurer_id') && $request->get('category_options') && $request->get('driver_age')) {

            $this->session->set('insurer_id', $request->get('insurer_id'));
            $this->session->set('category_options', $request->get('category_options'));
            $this->session->set('driver_age', $request->get('driver_age'));
            
        } elseif (!$this->session->get('insurer_id') &&
                !$this->session->get('category_options') &&
                !$this->session->get('driver_age')) {

            return $this->redirectToRoute('app_calculator');
        }
        
        $this->setInsurer($this->session->get('insurer_id'));
        $this->baseTariff = $this->insuranceCalculator->getBaseTariff($this->getInsurer(), $this->session->get('category_options'));

        $categories = $this->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:CategoryAbstract')
                ->findCategoriesByIds($this->session->get('category_options'));

        $this->categories = $this->insuranceCalculator->filterCategories(
                $categories, $this->baseTariff->getTariffCategories());
        $this->insuranceCalculator->setCalculator(new Calculator());
        $this->insuranceCalculator->setDriverAge($this->session->get('driver_age'));
    }

    /**
     * 
     * @param type Insurer
     */
    private function setInsurer($insurer)
    {
        $result = $this->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:Insurer')
                ->find($insurer);

        if ($result) {
            $this->insurer = $result;
        }
    }

    /**
     * 
     * @return Insurer
     */
    private function getInsurer()
    {

        return $this->insurer;
    }

    /**
     * 
     * Get list of all tariffs for the current session, combined with
     * the DriverAge tariff.
     * 
     * @return array
     */
    private function getTariffs()
    {

        $tariffs = [];

        $tariffs = $this->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:TariffAbstract')
                ->findCategoyTariffsByCategoryOptionIds(array_values($this->categories), $this->getInsurer());

        $ageTariff = $this->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:Driver\AgeTariff')
                ->getTariffByInsurerAndAge(
                $this->getInsurer(), $this->insuranceCalculator->getCalculator()->getDriverAge()
        );

        if ($ageTariff) {
            $tariffs[] = $ageTariff;
        }

        return $tariffs;
    }

    /**
     * Persist all insurance options
     *
     * @param InsurancePolicy $insurancePolicy
     */
    private function persistInsurance(InsurancePolicy $insurancePolicy)
    {
        $this->persistInsuranceFiles($insurancePolicy);
        $this->persistCategoryOptions($insurancePolicy);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($insurancePolicy->getClient());
        $em->persist($insurancePolicy);
        $em->flush();
    }

    private function persistCategoryOptions(InsurancePolicy $insurancePolicy)
    {

        $insurer = $this->getInsurer();
        $tariffs = $this->getTariffs();

        foreach ($tariffs as $tariff) {

            $tariffAmount = $this->insuranceCalculator->getCalculator()->evaluateAmount($this->baseTariff->getAmount(), $tariff);

            $categoryOption = $tariff->getCategoryOption();
            $insurancePolicyOption = new \AppBundle\Entity\InsurancePolicyOption();
            $insurancePolicyOption->setCategoryOption($categoryOption);
            $insurancePolicyOption->setInsurancePolicy($insurancePolicy);
            $insurancePolicyOption->setAmount($tariffAmount);

            $insurancePolicy->addInsuranceOption($insurancePolicyOption);
            $em = $this->getDoctrine()->getManager();
            $em->persist($insurancePolicyOption);
        }
    }

    private function persistInsuranceFiles(InsurancePolicy $insurancePolicy)
    {

        foreach ($insurancePolicy->getInsuranceFiles() as $file) {
            
            if($file->getFile()){
                $file->setInsurancePolicy($insurancePolicy);
                $em = $this->getDoctrine()->getManager();
                $em->persist($file);
            } else {
                $insurancePolicy->removeInsuranceFile($file);
            }
        }
        
    }

}
