<?php
require_once (__DIR__ . '/../config.php');
global $fizzyInit;

$_SESSION ["fb-app-id"] = $Fizzy->fbAppid;
$_SESSION ["fb-secret"] = $Fizzy->fbSecret;
$_SESSION ["fb-state"] = randomPassword ();

// If the user is already logged-in, kick them to the logged-in viewport.
if ($Fizzy->loggedIn) {
 // header ( 'Location: ' . $Fizzy->address . 'usr.php#/main-view.php' );
}
?>

<!doctype html>
<!--[if lt IE 7]>      <html lang="en" ng-app="myApp" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" ng-app="myApp" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" ng-app="myApp" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en" ng-app="myApp" class="no-js">
<!--<![endif]-->

<head>
<base href="/">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="shortcut icon" href="<?php echo $Fizzy->address; ?>favicon.ico" />

<title>Cortex | Social Media Autonomics</title>
<meta name="description" content="">
<meta name="author" content="">

<meta name="viewport" content="width=device-width">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="social-buttons/bootstrap-social.css">
<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/angular-flash/1.1.1/angular-flash.min.css" />

<link rel="stylesheet" type="text/css" href="css/normalize.css" />
<link rel="stylesheet" type="text/css" href="css/base.css" />
<link rel="stylesheet" type="text/css" href="css/helpers.css" />
<link rel="stylesheet" type="text/css" href="css/header.css" />
<link rel="stylesheet" type="text/css" href="css/static.css" />
<link rel="stylesheet" type="text/css" href="css/login-modal.css" />

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="angularjs/1.4.8/angular.js"></script>
<script type="text/javascript" src="angularjs/1.4.8/angular-route.js"></script>

<script type="text/javascript" src="js/angulartics/0.17.2/angulartics.js"></script>
<script type="text/javascript" src="js/angulartics/0.17.2/angulartics-ga.js"></script>
<script type="text/javascript" src="js/angular-flash/1.1.1/angular-flash.min.js"></script>
<script type="text/javascript" src="js/ng-file-upload/10.1.9/ng-file-upload-shim.min.js"></script> 
<script type="text/javascript" src="js/ng-file-upload/10.1.9/ng-file-upload.min.js"></script>
<script type="text/javascript" src="js/ui-bootstrap/1.0.3/ui-bootstrap-tpls-1.0.3.min.js"></script>

<script type="text/javascript" src="js/modernizr-2.5.3.min.js"></script>

<script type="text/javascript" src="js/header.js"></script>
<script type="text/javascript" src="app.js"></script>

</head>
<body>
	<!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->
  
  
    <?php include(__DIR__ .'/templates/partials/header.php'); ?>
	
  <div id="main-view" ng-view=""></div> 


</body>
