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
	
    gameServiceFunc.getDoneGames = function (teamId) {
		if (!teamId) {
    		teamId = 0;
    	}
    	return $http.get(aprUrl +'getDoneGames/'+ teamId);
    };
    
    gameServiceFunc.getFindGames = function (teamId) {
    	return $http.get(aprUrl +'getFindGames/'+ teamId);
    };
    
    gameServiceFunc.getScheduledGames = function (teamId) {
    	return $http.get(aprUrl +'getScheduledGames/'+ teamId);
    };
    
    gameServiceFunc.getAllFindGames = function () {
    	return $http.get(aprUrl +'getAllFindGames');
    }; 
    return gameServiceFunc;    
    
});