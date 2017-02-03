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
    	$http.get(aprUrl +'getIsLogin')
    	.success (function(response) {
    		return response.login;
    	})
        .error(function(error) {
        	console.log(error.message);
        });
    	
    };        
    return loginServiceFunc;    
    
});