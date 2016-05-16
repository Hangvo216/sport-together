var app = angular.module('myApp');

app.controller('GameController', GameController);

function GameController($scope, $rootScope, $http) {
	
	$scope.allGames = {};
	$scope.findGames = {};
	$scope.scheduledGames = {};
	$scope.doneGames = {};
	
	$scope.getGameInfo = function () {
		$http({
	        method : "GET",
	        url : "api.php/getAllGames"
	    }).then(function mySucces(response) {
	    	 var team = response.data;
	    	 $scope.allGames = team;
		     console.log(team);

	    }, function myError(response) {
	        $scope.myWelcome = response.statusText;
	        var a = response.statusText;
	        console.log(a);
	    });
	}
	
	$scope.getGameInfo();
	
	$scope.getFindGames = function () {
		$http({
	        method : "GET",
	        url : "api.php/getFindGames"
	    }).then(function mySucces(response) {
	    	 var findGame = response.data;
	    	 $scope.findGames = findGame;
	    	 console.log("finds game");
		     console.log(findGame);

	    }, function myError(response) {
	        var a = response.statusText;
	        console.log(a);
	    });
	}
	
	$scope.getFindGames();

	$scope.getScheduledGames = function () {
		$http({
	        method : "GET",
	        url : "api.php/getScheduledGames"
	    }).then(function mySucces(response) {
	    	 var scheudledGame = response.data;
	    	 $scope.scheduledGames = scheudledGame;
	    	 console.log("schedule game");
		     console.log(scheudledGame);

	    }, function myError(response) {
	        var a = response.statusText;
	        console.log(a);
	    });
	}
	
	$scope.getScheduledGames();
	
	$scope.getDoneGames = function () {
		$http({
	        method : "GET",
	        url : "api.php/getDoneGames"
	    }).then(function mySucces(response) {
	    	 var doneGame = response.data;
	    	 $scope.doneGames = doneGame;
	    	 console.log("done game");
		     console.log(doneGame);

	    }, function myError(response) {
	        var a = response.statusText;
	        console.log(a);
	    });
	}
	
	$scope.getDoneGames();
	
}