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
    
    teamServiceFunc.getScheduledGames = function () {
    	return $http.get(aprUrl +'getScheduledGames');
    };
    
    teamServiceFunc.getDoneGames = function () {
    	return $http.get(aprUrl +'getDoneGames');
    };
    
    return teamServiceFunc;    
    
});