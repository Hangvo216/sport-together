var app = angular.module('myApp');

app.factory('gameService', function($http) {
	
	var gameServiceFunc = {};
	var aprUrl = 'api.php/';
	var config = {
		      headers : {
			    'Content-Type': 'application/json',
			    'withCredentials':true
			  }
			}
	
    gameServiceFunc.getPlayer = function (teamId) {
    	return $http.get(aprUrl +'getPlayerInfo/'+ teamId);
    };
    
    gameServiceFunc.createTeam = function (data) {
    	return $http.post(aprUrl +'createTeam', data, config);
    };
    
    gameServiceFunc.joinTeamRequest = function () {
    	return $http.post(aprUrl +'joinTeamRequest', data, config);
    };
    
    gameServiceFunc.getAllTeams = function () {
    	return $http.get(aprUrl +'getAllTeams');
    };
    
    gameServiceFunc.getTeamStatistic = function (teamId) {
    	return $http.get(aprUrl +'getTeamStatistic/' + teamId);
    };
    
    return gameServiceFunc;    
    
});