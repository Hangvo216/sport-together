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
    
    playerServiceFunc.getPlayerInfo = function () {
    	return $http.get(aprUrl +'getPlayerInfo' );
    };
    
    playerServiceFunc.createTeam = function (data) {
    	console.log(data);
    	return $http.post(aprUrl +'createTeam', data, config);
    };
    
    return playerServiceFunc;    
    
});