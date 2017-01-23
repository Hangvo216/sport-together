'use strict';

// Declare app level module which depends on views, and components
angular.module('myApp', [ 'ngRoute','ngAnimate', 'ui.bootstrap']).config(
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
			.when('/test', {
				templateUrl : '/templates/partials/test.php'				
			})			
			.when('/data/dashboard', {
					templateUrl : function(params){
						 var tar = "?";
						 if(params.date != undefined) {
							 tar = tar + "date=" + params.date;
						 }
						 if(params.slice != undefined) {
							 tar = tar + "&slice=" + params.slice;
						 }
						 if(params.startDate != undefined) {
							 tar = tar + "&startDate=" + params.startDate;
						 }
						 if(params.endDate != undefined) {
							 tar = tar + "&endDate=" + params.endDate;
						 }
						 return '/templates/partials/dashboard.php' + tar;

				    },
				    resolve : {
				    	"URLConstructionService" : function($route, URLConstructionService ) {
				    		URLConstructionService.initDashboard($route);
				    	},
				    	"NetworkButtonService" : function(NetworkButtonService ) {
				    		return NetworkButtonService;
				    	}
				    }  
			})
			.when('/test1', {
				templateUrl : function(params){
					 var tar = "?";
					 if(params.date != undefined) {
						 tar = tar + "date=" + params.date;
					 }
					 if(params.slice != undefined) {
						 tar = tar + "&slice=" + params.slice;
					 }
					 if(params.startDate != undefined) {
						 tar = tar + "&startDate=" + params.startDate;
					 }
					 if(params.endDate != undefined) {
						 tar = tar + "&endDate=" + params.endDate;
					 }
			    return '/templates/partials/test1.php';
				}
			})
			.when('/team-profile/:teamId', {
				templateUrl :  function(params){			 
					 return '/templates/partials/team-profile.php';
				}
			})
			.when('/team-profile1', {
				templateUrl : '/templates/partials/team-profile.php'
			})
			.when('/other-team-profile', {
				templateUrl : '/templates/partials/other-team-profile.php'
			})
			.when('/create-profile', {
				templateUrl : '/templates/partials/create-profile.php'
			})
			.when('/', {
				templateUrl : '/templates/partials/main-view.php',
				controller: "PlayerController"
			}).otherwise('/error');
			$locationProvider.html5Mode({
				enabled : false
			});
			
		});