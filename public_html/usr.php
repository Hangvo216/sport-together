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
	<base href="/index.php">
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sport Together</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
<!-- 	<script type="text/javascript" src="angularjs/1.4.8/angular.js"></script> -->
<!-- 	<script type="text/javascript" src="angularjs/1.4.8/angular-route.js"></script> -->
<!-- 	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.js"></script> -->
<!-- 	<script type="text/javascript" src="ui-boostrap/ui-bootstrap-tpls-2.4.0.min"></script> -->
<!-- 	  <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-1.3.3.js"></script> -->
	  
	  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-animate.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-touch.js"></script>
  <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-1.3.3.js"></script>
	<script type="text/javascript" src="angularjs/1.4.8/angular-route.js"></script>
	
	<script type="text/javascript" src="app.js"></script>
	
	<script type="text/javascript" src="/controllers/PlayerController.js"></script>
	<script type="text/javascript" src="/controllers/TeamController.js"></script>
<!-- 	<script type="text/javascript" src="/controllers/periodButtonController.js"></script> -->
	 

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/heroic-features.css" rel="stylesheet">
    
      <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php // require("header.php");?>
</head>
<body>
 <div id="main-view" ng-view="">
    </div> 
    
</body>
    