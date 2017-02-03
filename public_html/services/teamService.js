var app = angular.module('myApp');

app.factory('teamService', function($http) {
	
	var teamServiceFunc = {};
	var aprUrl = 'api.php/';
	var config = {
		      headers : {
			    'Content-Type': 'application/json',
			    'withCredentials':true
			  }
			}
	
    teamServiceFunc.getAllTeams = function () {
    	return $http.get(aprUrl +'getAllTeams');
    };
    
    teamServiceFunc.getTeamStatistic = function (teamId) {
    	if (!teamId) {
    		teamId = 0;
    	}
    	return $http.get(aprUrl +'getTeamStatistic/' + teamId);
    };
    
    teamServiceFunc.getTeamByPlayerId = function (playerId) {
    	if (!playerId) {
    		playerId = 0;
    	}
    	return $http.get(aprUrl +'getTeamByPlayerId/' + playerId);
    };
    
    teamServiceFunc.getTeamByPlayerId = function (teamId) {
    	if (!teamId) {
    		teamId = 0;
    	}
    	return $http.get(aprUrl +'getTeamByTeamId/' + teamId);
    };
    
    return teamServiceFunc;    
    
});