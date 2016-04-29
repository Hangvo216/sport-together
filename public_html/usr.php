<?php
	require_once(__DIR__ . '/../config.php');
    global  $fizzyInit;
    require_once ($fizzyInit ['libDir'] . 'global_funcs.php');
	
	
    $_SESSION["fb-app-id"] = $Fizzy->fbAppid;
    $_SESSION["fb-secret"] = $Fizzy->fbSecret;
    $_SESSION["fb-state"] = randomPassword();
    
	// If the User's session has expired, or if a non-logged-in user attempts to access the page, kick them to the homepage.
	if(!$Fizzy->loggedIn || !isset($Fizzy) || !isset($_SESSION['user'])){
		session_destroy();
		header("Location: ".$Fizzy->address."#error?c=641");
		exit();
	}
	
?>
<!doctype html>
<!--[if lt IE 7]>      <html lang="en" ng-app="myApp" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" ng-app="myApp" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" ng-app="myApp" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en" ng-app="myApp" class="no-js">
<!--<![endif]-->


<script type="text/javascript">	
var facebookPageId = <?php echo $_SESSION['user']['accounts']['current']; ?>;

var intPageId = <?php $sessionPageId = $_SESSION['user']['accounts']['current'];
                      if (!isset($_SESSION['user']['accounts'][$sessionPageId])) {
                        echo -1;
                      }
                      $sessionAccount = $_SESSION['user']['accounts'][$sessionPageId];
                      if (!isset($sessionAccount['int_page_id'])) {
                        echo -1;
                      }  
                      $sessionIntPageId = $sessionAccount['int_page_id'];
                      echo $sessionIntPageId; ?>;

var intTwitterPageId = <?php
                        $c_id = $_SESSION['user']['accounts']['current'];
                        if (isset($_SESSION ['user'] ['accounts'] [$c_id] ['int_twitter_page_id'])) {
                          echo $_SESSION ['user'] ['accounts'] [$c_id] ['int_twitter_page_id'];
                        } else {
                          echo -1;
                        }
                        ?>;
var intInstagramPageId = <?php 
						$c_id = $_SESSION['user']['accounts']['current'];
                        if (isset($_SESSION ['user'] ['accounts'] [$c_id] ['int_instagram_page_id'])) {
                          echo $_SESSION ['user'] ['accounts'] [$c_id] ['int_instagram_page_id'];
                        } else {
                          echo -1;
                        } 
                         ?>;
            			   
var intPinterestPageId =  <?php 
						$c_id = $_SESSION['user']['accounts']['current'];
						if (isset($_SESSION ['user'] ['accounts'] [$c_id] ['int_pinterest_page_id'])) {
						  echo $_SESSION ['user'] ['accounts'] [$c_id] ['int_pinterest_page_id'];
						} else {
						  echo -1;
						} 
						 ?>;                    
                                                          
var comp = <?php global $comp;
if(isset($comp)){
	$comp = $_SESSION['ctrlr']['comp'];
}else {	$comp = 0;	} echo $comp; ?>;

var applicationMode = '<?php echo $Fizzy->mode; ?>';

var userId = '<?php echo $_SESSION ['user']['id']; ?>';

var c_id = '<?php global $c_id; echo $c_id;?>';
var c_id2 = '<?php global $c_id2; echo $c_id2;?>';

var g_id = '<?php global $g_id; echo $g_id;?>';
var g_id2 = '<?php global $g_id2; echo $g_id2;?>';

</script>

<head>
<base href="/usr.php">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">


<link rel="apple-touch-icon" sizes="57x57" href="/img/favicon/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/img/favicon/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/img/favicon/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/img/favicon/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/img/favicon/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/img/favicon/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/img/favicon/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/img/favicon/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-touch-icon-180x180.png">
<link rel="icon" type="image/png" href="/img/favicon/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="/img/favicon/android-chrome-192x192.png" sizes="192x192">
<link rel="icon" type="image/png" href="/img/favicon/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="/img/favicon/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="/img/favicon/manifest.json">
<link rel="shortcut icon" href="/img/favicon/favicon.ico">
<meta name="msapplication-TileColor" content="#144795">
<meta name="msapplication-TileImage" content="/img/favicon/mstile-144x144.png">
<meta name="msapplication-config" content="/img/favicon/browserconfig.xml">
<meta name="theme-color" content="#ffffff">

<title>Cortex | Social Media Autonomics</title>
<meta name="description" content="">
<meta name="author" content="">

<meta name="viewport" content="width=device-width">

<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="social-buttons/bootstrap-social.css">
<link rel="stylesheet" type="text/css" href="bootstrap-tagsinput/bootstrap-tagsinput.css">
<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/angular-flash/1.1.1/angular-flash.min.css" />

<link rel="stylesheet" type="text/css" href="css/normalize.css" />
<link rel="stylesheet" type="text/css" href="css/base.css" />
<link rel="stylesheet" type="text/css" href="css/header.css" />
<link rel="stylesheet" type="text/css" href="css/sidebar.css" />
<link rel="stylesheet" type="text/css" href="css/static.css" />
<link rel="stylesheet" type="text/css" href="css/foresight.css" />
<link rel="stylesheet" type="text/css" href="css/dashboard.css" />
<link rel="stylesheet" type="text/css" href="css/date.css" />
<link rel="stylesheet" type="text/css" href="css/google-viz.css" />

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script type="text/javascript" src="angularjs/1.4.8/angular.js"></script>
<script type="text/javascript" src="angularjs/1.4.8/angular-route.js"></script>

<script type="text/javascript" src="js/modernizr-2.5.3.min.js"></script>
<script type="text/javascript" src="js/jquery.number.min.js"></script>

<script type="text/javascript" src="js/angulartics/0.17.2/angulartics.js"></script>
<script type="text/javascript" src="js/angulartics/0.17.2/angulartics-ga.js"></script>
<script type="text/javascript" src="js/angular-flash/1.1.1/angular-flash.min.js"></script>
<script type="text/javascript" src="js/ng-file-upload/10.1.9/ng-file-upload-shim.min.js"></script> 
<script type="text/javascript" src="js/ng-file-upload/10.1.9/ng-file-upload.min.js"></script>
<script type="text/javascript" src="js/ui-bootstrap/1.0.3/ui-bootstrap-tpls-1.0.3.min.js"></script>

<script type="text/javascript" src="js/moment.js"></script>
<script type="text/javascript" src="js/moment-timezone-with-data.js"></script>

<script type="text/javascript" src="app.js"></script>

<script type="text/javascript" src="js/header.js"></script>

</head>
<body class="graph">
  

   <?php include(__DIR__ .'/templates/partials/header.php'); ?>	
	
	<div id="null"></div>
	<div class="loading" ng-show="isLoading()" ng-controller="LoadingController"><div class="loadingGif"></div></div>
    <div id="main-view" ng-view="">
    </div> 
</body>
