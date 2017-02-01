var app = angular.module('myApp');

app.controller('GameController', GameController);

function GameController($scope, $rootScope, $http, $routeParams, gameService, loginService) {
	
	$scope.allGames = {};
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
	
	// game request
	$scope.getFindGames = function () {
		gameService.getFindGames($routeParams.teamId)
		.success (function(response) {
	    	 var findGame = response.data;
	    	 $scope.findGames = findGame;
		})
	    .error(function(error) {
	    	console.log(error.message);
	    });
	}
	
	$scope.getFindGames = function () {
		gameService.getFindGames($routeParams.teamId)
		.success (function(response) {
	    	 var findGame = response;
	    	 $scope.findGames = findGame;
		})
	    .error(function(error) {
	    	console.log(error.message);
	    });
	}

	//game info about game will play in the future
	$scope.getScheduledGames = function () {
		gameService.getScheduledGames($routeParams.teamId)
		.success (function(response) {
			console.log(response);
	    	 var scheudledGame = response;
	    	 $scope.scheduledGames = scheudledGame;
		})
	    .error(function(error) {
	    	console.log(error.message);
	    });	    
	}
	
	// get info about all the game already played
	$scope.getDoneGames = function () {
		gameService.getDoneGames($routeParams.teamId)
		.success (function(response) {
			console.log(response);
			var doneGame = response;
	    	 $scope.doneGames = doneGame;
		})
	    .error(function(error) {
	    	console.log(error.message);
	    });	    
	}
	if (loginService.getIsLogin()) {
//		$scope.getGameInfo();
		$scope.getFindGames();
		$scope.getScheduledGames();
		$scope.getDoneGames();
	}
//	$scope.getGameInfo();
//	$scope.getFindGames();
//	$scope.getScheduledGames();
//	$scope.getDoneGames();
	
}