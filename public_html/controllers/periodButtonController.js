var app = angular.module('myApp');

app.controller('PeriodButtonController', function($scope, $rootScope, PeriodButtonService) {
	$scope.period = PeriodButtonService.period;
	$scope.calendarOpened = false;
	$scope.dateSelected = null;
	$scope.firstSelection = true;
	$scope.minDate = new Date(2010,01,01);
	var dateInvisible = true;

	
	$scope.periodClicked = function() {
		PeriodButtonService.setStartAndEnd()
		$rootScope.$broadcast('periodButtonsChange');
	}
	
	$scope.open1 = function() {
	    $scope.popup1.opened = true;
	  };

	$scope.calendarClicked = function() {
		$scope.calendarOpened = !$scope.calendarOpened;
		$scope.firstSelection = true;
	}

	$scope.$watch('dateSelected', function(newValue, oldValue) {
		if (!$scope.dateSelected) {
			return;
		}
		if ($scope.firstSelection) {
			$scope.period.startDate = $scope.dateSelected;
			$scope.minDate = $scope.period.startDate;
			
		} else {
			$scope.period.endDate = $scope.dateSelected;
			$scope.minDate = new Date(2010,01,01);
		}
		$scope.dateSelected = null;
		if(!$scope.firstSelection) {
			$scope.calendarOpened = false;
			$rootScope.$broadcast('periodButtonsChange');
		}
		$scope.firstSelection = !$scope.firstSelection;
		
	});

	$scope.getCustomClass = function(date, mode) {
		if (mode === 'day') { 
			var dayToCheck = new Date(date).setHours(0,0,0,0);
			var startDate = $scope.period.startDate;
			startDate = startDate.setHours(0,0,0,0);
			
			var endDate = $scope.period.endDate;
			endDate = endDate.setHours(0,0,0,0);
			
			if(date.getDate() == 1) {
				dateInvisible = !dateInvisible;
			}
			if(dateInvisible) {
			   return 'invisible';
			}
			if(startDate === dayToCheck) {
				return 'startDate';
			} 
			if(endDate === dayToCheck) {
				return 'endDate';
			}
			if(dayToCheck > startDate &&  dayToCheck < endDate){
				return 'betweenDate';
			}
			return '';	
		}
	   
		
	};
});