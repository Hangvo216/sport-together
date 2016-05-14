var app = angular.module('myApp');

app.service('PeriodButtonService', function($rootScope) {
	var pbs = this;
	
	pbs.offSet = function(date, days) {
		var msInDay = 86400 * 1000;
		offSetDate = new Date(date. getTime() - ((days-1) * msInDay));
		return offSetDate
	}
	
    pbs.getNumDay = function(periodType) {
		var numDays = 30;

		if (periodType == 'sixtyDays') {
			numDays = 60;
		}
		if (periodType == 'ninetyDays') {
			numDays = 90;
		}
		return numDays;
	}

	pbs.period = {
		periodType : 'thirtyDays',
		startDate : pbs.offSet(new Date(), pbs.getNumDay('thirtyDays')),
		endDate : new Date()
	};

    
	pbs.setStartAndEnd = function() {
		pbs.period.startDate = pbs.offSet(new Date(), pbs.getNumDay(pbs.period.periodType));
		pbs.period.endDate = new Date();
	}
	
	pbs.startDateToString = function() {
		return pbs.dateToString(pbs.period.startDate);
		
	};
	
	pbs.endDateToString = function() {
		return pbs.dateToString(pbs.period.endDate);
		
	};
	
	pbs.dateToString = function(date) {
		return date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
	}
	
	pbs.initFromRoute = function(route) {
		//if route has params, copy them to controller
		if(route.current.params.date == undefined) {
			route.current.params.date = pbs.period.periodType;
		} else {
			pbs.period.periodType = route.current.params.date;
		}
		
		if(route.current.params.startDate == undefined) {
			route.current.params.startDate = pbs.startDateToString();
		} else {
			//pbs.period.startDate = $route.current.params.startDate;
		}
		if(route.current.params.endDate == undefined) {
			route.current.params.endDate = pbs.endDateToString();
		} else {
			//pbs.period.endDate = $route.current.params.endDate;
		}
	}
	
	pbs.asParams = function(params) {		
		if(pbs.period.periodType != undefined) {
	        params.date = pbs.period.periodType;
		} else {
			params.date = 'thirtyDays';
			pbs.period.periodType = params.date;
			pbs.setStartAndEnd();
		}
		if(pbs.period.startDate != undefined) {
	        params.startDate = pbs.startDateToString();
		} 
		if(pbs.period.endDate != undefined) {
	        params.endDate = pbs.endDateToString();
		} 
		return params;
	}
	
	pbs.setStartAndEnd();
	
});