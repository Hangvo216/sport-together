var app = angular.module('myApp');

app.controller('TeamController', TeamController);

function TeamController($scope, $rootScope, $http, $filter) {

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
	
	// time controller
	$scope.mytime = new Date();

	  $scope.hstep = 1;
	  $scope.mstep = 15;

	  $scope.options = {
	    hstep: [1, 2, 3],
	    mstep: [1, 5, 10, 15, 25, 30]
	  };

	  $scope.ismeridian = true;
	  $scope.toggleMode = function() {
	    $scope.ismeridian = ! $scope.ismeridian;
	  };

	  $scope.update = function() {
	    var d = new Date();
	    d.setHours( 14 );
	    d.setMinutes( 0 );
	    $scope.mytime = d;
	    $scope.gameTime = $filter('date')(d,'shortTime');
	    console.log('Time changed to2222: ' + $scope.gameTime);
	    console.log('Time changed 111: ' + d);
	  };

	 
	  // date controller
	  $scope.today = function() {
		    $scope.dt = new Date();
		  };
		  $scope.today();

		  $scope.clearDate = function() {
		    $scope.dt = null;
		  };

		  $scope.inlineOptions = {
		    customClass: getDayClass,
		    minDate: new Date(),
		    showWeeks: true
		  };

		  $scope.dateOptions = {
		    formatYear: 'yy',
		    maxDate: new Date(2020, 5, 22),
		    minDate: new Date(),
		    startingDay: 1
		  };

		  $scope.open1 = function() {
		    $scope.popup1.opened = true;
		  };

		  $scope.setDate = function(year, month, day) {
		    $scope.dt = new Date(year, month, day);
		    $scope.gameDate = $filter('date')($scope.dt,'fullDate');
		    console.log($scope.gameDate);
		  };

		  $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
		  $scope.format = $scope.formats[0];
		  $scope.altInputFormats = ['M!/d!/yyyy'];

		  $scope.popup1 = {
		    opened: false
		  };


		  function getDayClass(data) {
		    var date = data.date,
		      mode = data.mode;
		    if (mode === 'day') {
		      var dayToCheck = new Date(date).setHours(0,0,0,0);

		      for (var i = 0; i < $scope.events.length; i++) {
		        var currentDay = new Date($scope.events[i].date).setHours(0,0,0,0);

		        if (dayToCheck === currentDay) {
		          return $scope.events[i].status;
		        }
		      }
		    }

		    return '';
		  }
}