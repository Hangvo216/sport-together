var app = angular.module('myApp');

app.controller('PlayerController', PlayerController);

function PlayerController($scope, $rootScope, $http) {
	console.log("AAAAA");
//	alert(a);
	$scope.player = "B";
	$scope.teamInfo = {};
	$scope.playerInfo = {};
//	
	$scope.getTeamForPlayer = function () {
		$http({
	        method : "GET",
	        url : "api.php/getTeamForPlayer"
	    }).then(function mySucces(response) {
	    	 var team = response.data;
	    	 $scope.teamInfo = team[0];
	    }, function myError(response) {
	        $scope.myWelcome = response.statusText;
	        var a = response.statusText;
	        console.log(a);
	    });
	}
	
	$scope.getTeamForPlayer();
	
	$scope.getPlayerInfo = function () {
		$http({
	        method : "GET",
	        url : "api.php/getPlayerInfo"
	    }).then(function mySucces(response) {
	    	 var player = response.data;
	    	 $scope.playerInfo = player[0];
	    	 console.log(response.data);
	    }, function myError(response) {
	        console.log(response.data);
	    });
	}
	$scope.getPlayerInfo();

//	$scope.teamInfo.name = "Asdasdsad";
	//	$scope.teamInfo.description = teamInfo.description;
//	$scope.teamInfo.id = teamInfo.id;
//	$scope.teamInfo.numPlayer = teamInfo.number_of_player;
//	$scope.teamInfo.win = teamInfo.win;
//	$scope.teamInfo.loss = teamInfo.loss;
//	$scope.teamInfo.draw = teamInfo.draw;
//	$scope.teamInfo.rating = teamInfo.rating;
//	$scope.teamInfo.ranking = teamInfo.ranking;
//	$scope.teamInfo.fairPlay = teamInfo.fair_play;
//	$scope.teamInfo.id = teamInfo.id;
	
	$scope.hasTeam = function () {
//		return $scope.teamInfo.name != undefined && $scope.teamInfo.name != "";
		return true;
	}


	
}