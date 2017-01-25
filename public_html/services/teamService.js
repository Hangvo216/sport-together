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
	
    teamServiceFunc.getGameInfo = function () {
    	return $http.get(aprUrl +'getAllGames');
    };
    
    teamServiceFunc.getFindGames = function () {
    	return $http.get(aprUrl +'getFindGames');
    };
    
    teamServiceFunc.getScheduledGames = function () {
    	return $http.get(aprUrl +'getScheduledGames');
    };
    
    teamServiceFunc.getDoneGames = function () {
    	return $http.get(aprUrl +'getDoneGames');
    };
    
    return teamServiceFunc;    
    
});