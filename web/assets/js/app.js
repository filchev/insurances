'use strict';   

var app = angular.module('app',[])
    .config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
  });

app.controller('TariffController', TariffController); 
app.controller('CalculatorController', CalculatorController);     
app.controller('InsurancePolicyNewController', InsurancePolicyNewController);

TariffController.$inject = ['$scope', '$filter'];
CalculatorController.$inject = ['$scope', '$http', '$filter'];
InsurancePolicyNewController.$inject =  ['$scope' , '$http'];

function TariffController($scope, $filter) {

    var categoryOptions = $scope.categoryOptions;

    $scope.filterOptions = function(paramCategory) {
      $scope.categoryOptions = $filter('filter')($scope.categoryOptions, {category: paramCategory});
      $scope.form.selectedOption = $scope.categoryOptions[0];
    }


};

function CalculatorController($scope, $http, $filter) {
    
    getAllCurrencies();
    
    function getActiveCurrency() {

        $http({
            method: "GET",
            url: 'http://localhost:4567/insurances/web/app_dev.php/api/currency/active',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).success(function(data){
            
            
            var found = $filter('filter')($scope.currencies, JSON.parse(data['currency']) , true);

            if (found.length) {
                $scope.selectedCurrency = found[0];
            } else {
                $scope.selectedCurrency = $scope.currencies[0];
            }
            
            
        });
    }
    
    function getAllCurrencies() {
        
        $http({
            method: "GET",
            url: 'http://localhost:4567/insurances/web/app_dev.php/api/currency',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).success(function(data){
            
            $scope.currencies = JSON.parse(data);3
            
        }).then(function(){
            getActiveCurrency();
        });
    }
    
    $scope.updateCurrency = function(currency) {

        $http({
            method: "POST",
            url: 'http://localhost:4567/insurances/web/app_dev.php/api/currency/active',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            data:  $scope.selectedCurrency 
        });
    }
    
   $scope.getBaseAmount = function(baseAmount) {    
       
        var newBaseAmount = +(baseAmount * $scope.selectedCurrency.reverseRate).toFixed(2);
        
        return newBaseAmount;
   }
   



};

function InsurancePolicyNewController($scope, $http) {
    
    getActiveCurrency();
    
    $scope.activeCurrency = {};
    $scope.activeCurrency.reverseRate = 0;
    
    $scope.getAmountByCurrency = function(amount) {    
       
        var newAmount = +(amount * $scope.activeCurrency.reverseRate).toFixed(2);
        console.log(amount);
        return newAmount;
    } 
    
    $scope.$watch('activeCurrency',function(){
        
    });
    
    function getActiveCurrency() {

        $http({
            method: "GET",
            url: 'http://localhost:4567/insurances/web/app_dev.php/api/currency/active',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).success(function(data){
                      
            $scope.activeCurrency = JSON.parse(data['currency']);

            
        });
    }
    
}