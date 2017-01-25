var app = angular.module('myApp');

app.factory('playerService', function($http) {
	
	var playerServiceFunc = {};
	var aprUrl = 'api.php/';
	var config = {
		      headers : {
			    'Content-Type': 'application/json',
			    'withCredentials':true
			  }
			}
	
    playerServiceFunc.getTeamForPlayer = function (teamId) {
    	return $http.get(aprUrl +'getPlayerInfo/'+ teamId);
    };
    
    playerServiceFunc.createPlayer = function (data) {
    	return $http.post(aprUrl +'createPlayer', data, config);
    };
    
    playerServiceFunc.getPlayerInfo = function (teamId) {
    	return $http.get(aprUrl +'getPlayerInfo/' + teamId);
    };
    
    return playerServiceFunc;    
    
});