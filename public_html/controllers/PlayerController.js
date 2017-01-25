var app = angular.module('myApp');

app.controller('PlayerController', PlayerController);
function PlayerController($scope, $rootScope, $http, playerService) {
	$scope.teamInfo = {};
	$scope.playerInfo = {};
	$scope.position = '';		
	
	$scope.getTeamForPlayer = function() {		
		playerService.getTeamForPlayer()		
		.success (function(response) {
			console.log(response)
		})
	    .error(function(error) {
	    	console.log(error.message);
	    });
	}	
	
	$scope.createPlayer = function() {	
		data = {position: $scope.position};
		playerService.createPlayer(data)		
		.success (function(response) {
			console.log('e');
            $window.location.href = '/';
		})
	    .error(function(error) {
	    	console.log(error.message);
	    });
	}

	$scope.getPlayerInfo = function() {	
		playerService.getPlayerInfo()		
		.success (function(response) {
			var player = response.data;
	    	$scope.playerInfo = player[0];	    	
	    	$scope.playerInfo.player_name = player[0].player_name;
	    	$scope.playerInfo.position = player[0].position;
		})
	    .error(function(error) {
	    	console.log(error.message);
	    });
	}
//	$scope.getPlayerInfo();
//	$scope.getTeamForPlayer();	


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