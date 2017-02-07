var app = angular.module('myApp');

app.controller('TeamController', TeamController);

function TeamController($scope, $rootScope, $http, $filter, $log, $routeParams, teamService, playerService, loginService) {
	var config = {
			headers : {
				'Content-Type' : 'application/json',
				'withCredentials' : true
			}
		}
	
	// attributes	
	
	$scope.teamSelected ="";
	$scope.message = "";
	$scope.selected = {};
	
	$scope.allTeams = {};

	$scope.player = {};	

	$scope.gameType = [ {
		id : 1,
		type : "5 vs 5"
	}, {
		id : 2,
		type : "7 vs 7"
	} ];
	$scope.selected.type = $scope.gameType[0];
	$scope.gameFields = [ {
		id : 1,
		name : "Field one"
	}, {
		id : 2,
		name : "Field two"
	} ];
	$scope.selected.field = $scope.gameFields[0];
	$scope.intMainUserTeamID = true;

	$scope.getPlayer = function() {
		playerService.getPlayerInfo($routeParams.teamId)
		.success (function(response) {
			console.log(' getPlayerInf');
			console.log(response)
			var player = response.data;
			$scope.same_team = player[0].same_team;
			console.log($scope.same_team)
			$scope.player = player[0];
		})
	    .error(function(error) {
	    	console.log(error.message);
	    });
	}

	 
	 $scope.createTeam = function() {
		 var data = {
					teamName : $scope.teamName,
					desc : $scope.description
				}
		teamService.createTeam(data)
		.success (function(response) {
			console.log(response)
		})
	    .error(function(error) {
	    	console.log(error.message);
	    });
	}
	
	$scope.joinTeamRequest = function() {
		var data = {
			teamId : $scope.teamSelected.id,
		}
		console.log($scope.teamSelected.id);
		teamService.joinTeamRequest(data)		
		.success (function(response) {
			console.log(response)
		})
	    .error(function(error) {
	    	console.log(error.message);
	    });
	}
	
	$scope.getAllTeams = function() {		
		teamService.getAllTeams()		
		.success (function(response) {
		})
	    .error(function(error) {
	    	console.log(error.message);
	    });
	}
	
	$scope.isCaptain = function() {
		return $scope.player.role == 'captain';
	}

	$scope.createGame = function(changeTime) {
		var field = $scope.selected.field;
		var type = $scope.selected.type;
		$scope.gameDate = $filter('date')($scope.dt, 'yyyy-MM-dd');
		$scope.gt = $filter('date')(changeTime, 'HH:mm:00');

		$scope.teamId = 1;
		var data = {
			gameType : type.type,
			gameDate : $scope.gameDate,
			gameField : field.id,
			gameTime : $scope.gt,
			message : $scope.message,
			teamId : $scope.teamId
		}
		$http.post("api.php/createGame", data, config).then(
			function successCallback(response) {
				location.reload();
			}, function errorCallback(response) {
				console.log(response)
			});
	}
	
	// number: play, loss, canceled
	$scope.getTeamStatistic = function () {		
		teamService.getTeamStatistic($routeParams.teamId)
		.success (function(statistic) {
	    	$scope.statistic = statistic;	    
		})
	    .error(function(error) {
	    	console.log(error.message);
	    });	
	}
	$scope.checkTeam = function () {
		return true;
	};
	
	$scope.getTeamByTeamId = function() {	
	  teamService.getTeamByTeamId($routeParams.teamId)	
	  .success (function(response) {	
		 var team = response[0]; 
		 $scope.teamInfo = team;	   
		 $scope.teamInfo.id = team.id;
		 $scope.teamInfo.name = team.team_name;
		 $scope.teamInfo.description = team.description;
		 $scope.teamInfo.otherTeam = team.other_team;
		 
	
		})
	  .error(function(error) {
    	console.log(error.message);
	  });
	}
	
	$scope.getAllTeams();	

	loginService.getIsLogin()
	.success (function(response) {
		if (response.login === 'true') {
		  $scope.getTeamStatistic();
		  $scope.getTeamByTeamId();
		}
		
	})
    .error(function(error) {
    	console.log(error.message);
    });
//	console.log(loginService.getIsLogin());
//	$scope.getPlayer();	


	// time controller
	$scope.gameTime = {
		mytime : new Date("October 13, 2014 12:00:00")
	};

	$scope.hstep = 1;
	$scope.mstep = 15;

	$scope.changed = function() {
		console.log('Time changed to: ' + $scope.gameTime.mytime);
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
		customClass : getDayClass,
		minDate : new Date(),
		showWeeks : true
	};

	$scope.dateOptions = {
		formatYear : 'yy',
		maxDate : new Date(2020, 5, 22),
		minDate : new Date(),
		startingDay : 1
	};

	$scope.open1 = function() {
		$scope.popup1.opened = true;
	};

	$scope.setDate = function(year, month, day) {
		$scope.dt = new Date(year, month, day);
		$scope.gameDate = $filter('date')($scope.dt, 'fullDate');
		console.log($scope.gameDate);
	};

	$scope.formats = [ 'dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate' ];
	$scope.format = $scope.formats[2];
	$scope.altInputFormats = [ 'M!/d!/yyyy' ];

	$scope.popup1 = {
		opened : false
	};

	function getDayClass(data) {
		var date = data.date, mode = data.mode;
		if (mode === 'day') {
			var dayToCheck = new Date(date).setHours(0, 0, 0, 0);

			for (var i = 0; i < $scope.events.length; i++) {
				var currentDay = new Date($scope.events[i].date).setHours(0, 0,
						0, 0);

				if (dayToCheck === currentDay) {
					return $scope.events[i].status;
				}
			}
		}

		return '';
	}
}