var app = angular.module('myApp');

app.factory('loginService', function($http) {
	
	var loginServiceFunc = {};
	var aprUrl = 'api.php/';
	var config = {
		      headers : {
			    'Content-Type': 'application/json',
			    'withCredentials':true
			  }
			}
	
    loginServiceFunc.getIsLogin = function() {
    	return $http.get(aprUrl +'getIsLogin');
    };        
    return loginServiceFunc;    
    
});