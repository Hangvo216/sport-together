var app = angular.module('myApp');

app.controller('TeamController', TeamController);

function ThemeController($scope, $rootScope) {

	$scope.teamName = "Angular team"
//	$scope.tableData = new google.visualization.DataTable({
//		cols : ThemeData.tableCols,
//		rows : ThemeData.tableRows
//	});
//	
//	$scope.graphData =  new google.visualization.DataTable({
//		cols : ThemeData.graphCols,
//		rows : ThemeData.graphRows
//	});
//	
//	$scope.tableView = new google.visualization.DataView($scope.tableData);
//	
//	$scope.graphView = new google.visualization.DataView($scope.graphData);
//
//
//	$scope.$on('networkButtonsChange', function(event) {
//		$scope.draw();
//	});
//	
//	$scope.draw = function() {
//		if(GraphTypeButtonService.graph.type == "table") {
//			$scope.tableView = new google.visualization.DataView($scope.tableData);
//			var updatedTableView = UtilService.drawSliceTable($scope.tableView, $scope.tableData);
//			ExportService.updateExportTable(updatedTableView);
//		} else {
//			$scope.graphView = new google.visualization.DataView($scope.graphData);
//			GraphService.drawGraph($scope.graphView,  $scope.graphData);
//		}
//	}
//	
}