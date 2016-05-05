var app = angular.module('myApp');

app.controller('TeamController', TeamController);

function TeamController($scope, $rootScope, $http) {

	$scope.teamName = "";
	$scope.description ="";
	
	
	$scope.createTeam = function() {

		var data = { teamName: $scope.teamName, description: $scope.description }
	    
        var config = {
            headers : {
                'Content-Type': 'application/json',
                'withCredentials':true
            }
        }

		$http.post("/team.php", data, config).
		then(function successCallback(response) {
			console.log(response)
		  }, function errorCallback(response) {	
			  console.log(response)
		  });
	

    }
	
	
}