var app = angular.module('myApp');

app.controller('PlayerController', PlayerController);

function PlayerController($scope, $rootScope) {
	var team = Team;
	$scope.player = "Phuong"
	$scope.teamInfo = {};
	var teamInfo = team[0];
	console.log(teamInfo);
	
	$scope.teamInfo.name = teamInfo.team_name;
	$scope.teamInfo.description = teamInfo.description;
	$scope.teamInfo.id = teamInfo.id;
	$scope.teamInfo.numPlayer = teamInfo.number_of_player;
	$scope.teamInfo.win = teamInfo.win;
	$scope.teamInfo.loss = teamInfo.loss;
	$scope.teamInfo.draw = teamInfo.draw;
	$scope.teamInfo.rating = teamInfo.rating;
	$scope.teamInfo.ranking = teamInfo.ranking;
	$scope.teamInfo.fairPlay = teamInfo.fair_play;
//	$scope.teamInfo.id = teamInfo.id;
	
	$scope.hasTeam = function () {
		return $scope.teamInfo.name != undefined && $scope.teamInfo.name != "";
	}


	
}