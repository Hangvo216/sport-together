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
			.when('/test1', {
				templateUrl : '/templates/partials/test1.php'
			})
			.when('/team', {
				templateUrl : '/templates/partials/team-view.php'
			})
			.when('/team-profile', {
				templateUrl : '/templates/partials/team-profile.php'
			})
			.when('/', {
				templateUrl : '/templates/partials/main-view.php',
				controller: "PlayerController"
			}).otherwise('/error');
			$locationProvider.html5Mode({
				enabled : false
			});
			
		});