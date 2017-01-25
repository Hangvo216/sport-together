var app = angular.module('myApp');

app.controller('GameController', GameController);

function GameController($scope, $rootScope, $http, $routeParams, gameService) {
	
	$scope.allGames = {};
	$scope.findGames = {};
	$scope.scheduledGames = {};
	$scope.doneGames = {};
	
	$scope.getGameInfo = function () {
		gameService.getGameInfo()
		.success (function(response) {
//		  var allGames = response.data;
//	      $scope.allGames = allGames;
	      console.log(response);
		})
		.error(function(error) {
	      console.log(error.message);
		})
		
	}
	
	// game request
	$scope.getFindGames = function () {
		gameService.getFindGames()
		.success (function(response) {
	    	 var findGame = response.data;
	    	 $scope.findGames = findGame;
		})
	    .error(function(error) {
	    	console.log(error.message);
	    });
	}
	
	$scope.getScheduledGames = function () {
		gameService.getScheduledGames()
		.success (function(response) {
	    	 var findGame = response.data;
	    	 $scope.findGames = findGame;
		})
	    .error(function(error) {
	    	console.log(error.message);
	    });
	}

	//game info about game will play in the future
	$scope.getScheduledGames = function () {
		gameService.getScheduledGames()
		.success (function(response) {
			console.log(response);
	    	 var scheudledGame = response.data;
	    	 $scope.scheduledGames = scheudledGame;
		})
	    .error(function(error) {
	    	console.log(error.message);
	    });	    
	}
	
	// get info about all the game already played
	$scope.getDoneGames = function () {
		$scope.getDoneGames = function () {
			gameService.getDoneGames()
			.success (function(response) {
				var doneGame = response.data;
		    	 $scope.doneGames = doneGame;
			})
		    .error(function(error) {
		    	console.log(error.message);
		    });	    
		}
	}
	
//	$scope.getGameInfo();
//	$scope.getFindGames();
//	$scope.getScheduledGames();
//	$scope.getDoneGames();
	
}