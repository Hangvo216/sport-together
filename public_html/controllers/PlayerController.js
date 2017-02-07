var app = angular.module('myApp');

app.controller('PlayerController', PlayerController);
function PlayerController($scope, $rootScope, $http, playerService, $routeParams, loginService, teamService) {
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
	
	$scope.createTeam = function() {	
		var data = {team_name: $scope.playerInfo.teamName};
		
		console.log($scope.playerInfo.teamName);
		playerService.createTeam(data)		
		.success (function(response) {
			alert('Bạn tạo được team ');
            $window.location.href = '/#/team-info';
		})
	    .error(function(error) {
	    	console.log(error.message);
	    });
	}

	$scope.getPlayerInfo = function() {	
	  playerService.getPlayerInfo()	
	  .success (function(response) {
		 var player = response;
		 $scope.playerInfo = player;	    	
		 $scope.playerInfo.player_name = player.player_name;
		 $scope.playerInfo.position = player.position;
		 $scope.playerInfo.teamId = player.position;
	
		})
	  .error(function(error) {
    	console.log(error.message);
	  });
	}
	
	$scope.getTeamByPlayerId = function() {	
	  teamService.getTeamByPlayerId($routeParams.playerId)	
	  .success (function(response) {	
		 var team = response[0]; 
		 $scope.teamInfo = team;	    	
		 $scope.teamInfo.name = team.team_name;
		 $scope.teamInfo.description = team.description;
	
		})
	  .error(function(error) {
    	console.log(error.message);
	  });
	}

	loginService.getIsLogin()
	.success (function(response) {
		if (response.login === 'true') {
		  $scope.getPlayerInfo();
		  $scope.getTeamByPlayerId();
		}
	})
    .error(function(error) {
    	console.log(error.message);
    });


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