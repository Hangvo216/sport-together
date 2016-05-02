var app = angular.module('myApp');

app.controller('PlayerController', PlayerController);

function PlayerController($scope, $rootScope) {

	$scope.player = "Phuong"
	
}