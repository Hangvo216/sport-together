var app = angular.module('myApp');

app.controller('TeamController', TeamController);

function TeamController($scope, $rootScope, $http) {

	$scope.teamName = "";
	$scope.description ="";
	
	$scope.gameType = [{id:1, type:"5 vs 5"}, {id:2, type: "7 vs 7"}];
	$scope.gameFields = [{id:1, name:"Field one"}, {id:2, name: "Field two"}];
	$scope.getPlayer = function () {
		$http({
	        method : "GET",
	        url : "api.php/getPlayer"
	    }).then(function mySucces(response) {
	    	 var player = response.data;
	    	 $scope.player = player[0];
	    }, function myError(response) {
	        $scope.myWelcome = response.statusText;
	        var a = response.statusText;
	        console.log(a);
	    });
	}
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
	
	$scope.isCaptain = function () {
		return $scope.player.role == 'captain';
	}
	
	$scope.createGame = function() {
		var field = $scope.selected.field;
		var type = $scope.selected.type;
		$scope.teamId = 1;
		var data = { gameType:type.id , gameDate: $scope.gameDate, 
				gameField:field.id , gameTime: $scope.gameTime,
				message: $scope.message, teamId: $scope.teamId}
	    
        var config = {
            headers : {
                'Content-Type': 'application/json',
                'withCredentials':true
            }
        }

		$http.post("api.php/createGame", data, config).
		then(function successCallback(response) {
			console.log(response);
			location.reload();
		  }, function errorCallback(response) {	
			  console.log(response)
		  });
    }
	
	
}