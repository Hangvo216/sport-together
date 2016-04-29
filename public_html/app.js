'use strict';

// Declare app level module which depends on views, and components
angular.module('myApp', [ 'ngRoute','angulartics', 'angulartics.google.analytics', 'flash', 'ngFileUpload' , 'ui.bootstrap']).config(
		function($routeProvider, $locationProvider, $httpProvider) {
			$httpProvider.interceptors.push(function($q, $location) {
			    return {
			        'responseError': function(response) {
			            if ([401, 403].indexOf(response.status) >= 0) {
			                location.reload();
			            }
			            if (404 == response.status ) {
			            	$location.path('/error');
			            }
			            if (500 == response.status ) {
			            	$location.path('/error');
			            }
			            return $q.reject(response);
			        }
			    };
			});
			
			$routeProvider
			.when('/team-profile', {
				templateUrl : '/templates/team-profile.php',
				reloadOnSearch : true
			})
			.when('/', {
				templateUrl : '/templates/index.php'
			}).otherwise('/error');
			$locationProvider.html5Mode({
				enabled : false
			});
		});

angular.module('myApp').controller('AccountManagementController',['$scope','$http','$location','Flash', function($scope, $http, $location, Flash) {
			$scope.accounts = [];
			$scope.addUser;
			
			$http.get('api.php/pages/accounts/' + intPageId).
			then(function successCallback(response) {
		    	  $scope.accounts = response.data;			    	  
			  }, function errorCallback(response) {		
				  var errorMessage = response.headers() ["x-status-reason"];
				  if(errorMessage == undefined){
					  errorMessage = "Failed to get account info for this page.";
				  }					  
		    	  Flash.create('danger', errorMessage);
		    	  $scope.addUser.facebookId = '';
			  });
		    
			$scope.isCurrentAccount = function(account) {
				return account.facebookid == userId;
			};
			
			$scope.isValidFacebookUserId = function() {
				return false;
			};
			
			
		}]
);

angular.module('myApp').run(['$log', '$rootScope', '$route','$location','$templateCache','$window', 'LoadingService', 
                             function ($log, $rootScope, $route, $location, $templateCache, $window, LoadingService) { 
	
	//google.charts.load('41', {packages: ['corechart','table']});
	google.charts.load('44', {packages: ['corechart','table']});
	
	
	$rootScope.$on('$routeChangeStart', function(event, next, current) {
    	console.log("routeChangeStart");
        if (typeof(current) !== 'undefined'){
            $templateCache.remove(current.loadedTemplateUrl);
        }
        LoadingService.isLoading = true;
    });
    
	$rootScope.$on('$routeChangeSuccess', function(event, current, previous) {
    	console.log("routeChangeSuccess");
    	LoadingService.isLoading = false;
    });
    
	$rootScope.$on('$routeChangeError', function(event, next, current) {
    	console.log("routeChangeError");
    	LoadingService.isLoading = false;
    });
}]);

