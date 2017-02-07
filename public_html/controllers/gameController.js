var app = angular.module('myApp');

app.controller('GameController', GameController);

function GameController($scope, $rootScope, $http, $routeParams, gameService, loginService) {
	
	$scope.allFindGames = {};
	$scope.findGames = {};
	$scope.scheduledGames = {};
	$scope.doneGames = {};
	
//	$scope.getGameInfo = function () {
//		gameService.getGameInfo()
//		.success (function(response) {
////		  var allGames = response.data;
////	      $scope.allGames = allGames;
//	      console.log(response);
//		})
//		.error(function(error) {
//	      console.log(error.message);
//		})
//		
//	}
	
	// gget all find games
	$scope.getAllFindGames = function () {
		gameService.getAllFindGames()
		.success (function(response) {
	    	$scope.allFindGames = response;
		})
	    .error(function(error) {
	    	console.log(error.message);
	    });
	}
	
	$scope.getFindGames = function () {
		gameService.getFindGames($routeParams.teamId)
		.success (function(response) {
	    	 $scope.findGames = response;
		})
	    .error(function(error) {
	    	console.log(error.message);
	    });
	}

	//game info about game will play in the future
	$scope.getScheduledGames = function () {
		gameService.getScheduledGames($routeParams.teamId)
		.success (function(response) {
	      $scope.scheduledGames = response;
		})
	    .error(function(error) {
	    	console.log(error.message);
	    });	    
	}
	
	// get info about all the game already played
	$scope.getDoneGames = function () {
		gameService.getDoneGames($routeParams.teamId)
		.success (function(response) {
	    	 $scope.doneGames = response;
		})
	    .error(function(error) {
	    	console.log(error.message);
	    });	    
	}
	
		loginService.getIsLogin()
		.success (function(response) {
			if (response.login === 'true') {
			  $scope.getFindGames();
			  $scope.getScheduledGames();
			  $scope.getDoneGames();
			} else {
				$scope.getAllFindGames();
			}			
		})
	    .error(function(error) {
	    	console.log(error.message);
	    });
}