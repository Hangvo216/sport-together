<?php session_start();
?>
<!doctype html>
<!--[if lt IE 7]>      <html lang="en" ng-app="myApp" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" ng-app="myApp" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" ng-app="myApp" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en" ng-app="myApp" class="no-js">
<!--<![endif]-->

<head>
	<base href="/usr.php">
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sport Together</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-animate.js"></script>
    <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-1.3.2.js"></script>
	
	<script type="text/javascript" src="angularjs/1.4.8/angular-route.js"></script>
	<script type="text/javascript" src="app.js"></script>
	<script type="text/javascript" src="jquery/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
		
	<script type="text/javascript" src="/controllers/PlayerController.js"></script>
	<script type="text/javascript" src="/controllers/TeamController.js"></script>
	<script type="text/javascript" src="/controllers/dateController.js"></script>
	<script type="text/javascript" src="/controllers/timeController.js"></script>
	<script type="text/javascript" src="/controllers/gameController.js"></script>
	
	<!-- service -->
	<script type="text/javascript" src="services/periodButtonService.js"></script>
	<script type="text/javascript" src="services/gameService.js"></script>
	<script type="text/javascript" src="services/teamService.js"></script>
	<script type="text/javascript" src="services/playerService.js"></script>
	<script type="text/javascript" src="services/loginService.js"></script>
	
		
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/heroic-features.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    
    <?php include(__DIR__ .'/templates/partials/header.php'); ?>
</head>
<body>
 <div id="main-view" ng-view=""></div> 
    
</body>
    