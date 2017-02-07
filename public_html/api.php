<?php
session_start();
/** 
 * APILogWriter: Custom log writer for our application
 *
 * We must implement write(mixed $message, int $level)
*/
class APILogWriter {
  public function write($message, $level = SlimLog::DEBUG) {
    global $log;
    $log->info($message);
  }
}
require_once __DIR__ ."/../TargetViewHelper.php";
require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/../model/Player.php');
require_once(__DIR__ . '/../lib/global_funcs.php');

require '../vendor/autoload.php';

// Fire up an app
$app = new Slim\Slim ( array (
    'mode' => 'development',
    'log.enabled' => true,
    'log.level' => Slim\Log::DEBUG,
    'log.writer' => new APILogWriter () 
) );

function getTeamByTeamId($teamId) {
 if ($teamId == 0) {
  $teamId = isset($_SESSION["user"]["team_id"]) ? $_SESSION["user"]["team_id"] : $teamId;
 }
 return $teamId;
}


function getTeamByPlayerId($playerId) {
 if ($playerId == 0) {
  $playerId = isset($_SESSION["user"]["int_user_id"]) ? $_SESSION["user"]["team_id"] : $teamId;
 }
 return $playerId;
}


function login($userId, $token) {
	global $log;
	global $app;
	global $Fizzy;
	
	$log->addInfo("Call login with $userId");

	$now = time();

	Players::setLastLoginToNow($now, $userId);

// 	session_start();
	

	$_SESSION["user"]["id"] = $userId;
	
	$Fizzy->pullUserDetails($userId);

// 	if(empty($_SESSION['user']['email'])){
// 		Players::setUserEmail($email, $userId);
// 		$_SESSION['user']['email'] = $email;
// 	}

	$_SESSION['data'] = array();
// 	$Fizzy->loadAccountData($key[0],$key[0],$start,$end);
	
	$Fizzy->loggedIn = true;
	if (Players::firstTimeLogin($userId)[0]['first_time']) {				
	 $app->redirect ($Fizzy->address . "#/create-profile" );
	} else {
	 $app->redirect ($Fizzy->address . "#/main-view" );
	}
	$log->addInfo(" **** End Login");		
}

$app->get ( '/logout',
		function () {
			global $app;
			global $log;
			global $Fizzy;
			$log->addInfo("Call logout");
			session_destroy();
			$app->redirect ( $Fizzy->address);
		});


$app->get ( '/fbcallback',
		function () {
			global $log;
			global $app;
			global $Fizzy;

			$log->addInfo("Facebook login");

// 			if (isLogin (false)) {
// 				$userId = $_SESSION ['user']['id'];
// 				$token =  $_SESSION['log-in']['token'];
// 				$email = $_SESSION['log-in']['email'];
// 				login($userId,$token, $email);
// 				exit();
// 			}

// 			if (! isset ( $_GET ["state"] ) || ! isset ( $_GET ["code"] ) || ! isset ( $_SESSION ["fb-state"] )) {
// 				$log->addError ( "Bad session data, facebook state or code is not set." );
// 				session_destroy ();
// 				$app->redirect ( $Fizzy->address . "#/error?c=641" );
// 			}

			$state = $_GET["state"];
			$code = $_GET["code"];
			$address = 'http://localhost/';
// 			$fbState = $_SESSION ["fb-state"];

// 			if ($state !== $fbState) {
// 				$log->addError ( "Bad session data, state from Facebook didn't match session state." );
// 				session_destroy ();
// 				$app->redirect ( $Fizzy->address . "#/error?c=650" );
// 			}
			try {
				//Get the access token
				$appId = "1598023593791688";
				$appSecret = "4a418b355d4e553a4c7e0eb24938298b";
				
				$token = explode('&',file_get_contents("https://graph.facebook.com/oauth/access_token?client_id=".$appId."&redirect_uri=".$address."api.php/fbcallback&client_secret=".$appSecret."&code=$code&permissions=email,manage_pages,read_insights,publish_actions"));
				$token = explode('=',$token[0]);
				$token = $token[1];
				

				// Get and decode the initial user information, if the response matches a record in our DB. Otherwise kick to an error.
				$response = file_get_contents("https://graph.facebook.com/me?access_token=".$token);
				$response = json_decode($response);
				$log->info("User Facebook Info:" . json_encode($response));
				$userId = $response->id;
// 				$email = $response->email;
				$fullName = $response->name;			

			} catch (Exception $e) {
				$log->addInfo ( "Failed to log-in via Facebook, message: " .  $e->getMessage ());
				session_destroy ();
				$app->redirect ( $Fizzy->address . "#/error?c=643" );
			}
			//Set the session information
			$_SESSION['log-in'] = array();
			$_SESSION['log-in']['response'] = $response;
			$_SESSION['log-in']['state'] = $state;
			$_SESSION['log-in']['code'] = $code;
			$_SESSION['log-in']['token'] = $token;
// 			$_SESSION['log-in']['email'] = $email;

			// Check if user exists
				
			if (!Players::hasFacebookUserId ( $userId )) {// 				
				 Players::insertNewUser($userId, $fullName); 
				 Players::setAccessToken($token, $userId);
				 	
			} else {
	 			$log->info ( "User already exists, user id: $userId" );
	 			login($userId,$token);
			}

		});



// login functions
$app->get ( '/getIsLogin',
  function () use($app) {
   global $app;
   global $log;
   $log->addInfo("Call api getIsLogin");
   $a = 'true';
   if (!isset($_SESSION["user"]["int_user_id"])) {
    $a = 'false';
   }
   
   echo json_encode(['login' => $a]);
   
});

// team functions
$app->post ( '/createTeam',
  function () use($app) {
    global $app;
    global $log;
    $log->addInfo("Call api saveTeam");
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $teamName = $request->team_name;
    	
    $playerId = $_SESSION["user"]["int_user_id"];
    $targetViewHelper = new TargetViewHelper();
    $teamInfo = $targetViewHelper->createTeam($playerId, $teamName);
//     $jsonTeamInfo = json_encode($teamInfo);
//     echo $jsonTeamInfo;
  });

$app->get ( '/getPlayerInfo',
		function () use($app) {
			global $app;
			global $log;
			$playerId = $_SESSION["user"]["int_user_id"];
			$log->addInfo("Call api getPlayerInfo, playerId $playerId");
			
			$targetViewHelper = new TargetViewHelper();
			$playerInfo = $targetViewHelper->getPlayerInfo($playerId);
				
			$jsonPlayerInfo = json_encode($playerInfo);
			echo $jsonPlayerInfo;
		});

$app->post ( '/createPlayer',
  function () use($app) {
   global $app;
   global $log;
   $playerId = $_SESSION["user"]["int_user_id"];
   $postdata = file_get_contents("php://input");
   $request = json_decode($postdata);
   $position = $request->position;
    
   $log->addInfo("Call api create player, playerId $playerId $position");
   	   
   $targetViewHelper = new TargetViewHelper();
   $playerInfo = $targetViewHelper->createPlayer($playerId, $position);
   $jsonPlayerInfo = json_encode($playerInfo);
  });

// game controller 
$app->get ( '/getAllGames/:teamId',
  function ($teamId) use($app) {
  	global $app;
  	global $log;
  	$teamId = getTeamByTeamId($teamId);
  	$log->addInfo("Call api getAllGames, teamId $teamId");
  
  	$targetViewHelper = new TargetViewHelper();
  	$gameInfo = $targetViewHelper->getGames($teamId);
  	$jsonGameInfo = json_encode($gameInfo);
  	echo $jsonGameInfo;
  });
  
 $app->get ( '/getAllFindGames',
   function () use($app) {
   	global $app;
   	global $log;
   	$log->addInfo("Call api getAllFindGames");
 
   	$targetViewHelper = new TargetViewHelper();
   	$gameInfo = $targetViewHelper->getAllFindGames();
   	$jsonGameInfo = json_encode($gameInfo);
   	echo $jsonGameInfo;
   });

$app->get ( '/getFindGames/:teamId',
  function ($teamId) use($app) {
  	global $app;
  	global $log;
  	$teamId = getTeamByTeamId($teamId);
  	$log->addInfo("Call api getFindGames, teamId $teamId");
  
  	$targetViewHelper = new TargetViewHelper();
  	$gameInfo = $targetViewHelper->getFindGames($teamId);
  	$jsonGameInfo = json_encode($gameInfo);
  	echo $jsonGameInfo;
  });

$app->get ( '/getScheduledGames/:teamId',
  function ($teamId) use($app) {
 	global $app;
 	global $log;
    $teamId = getTeamByTeamId($teamId);
    $log->addInfo("Call api getScheduledGames, teamId $teamId");
    $targetViewHelper = new TargetViewHelper();
    $gameInfo = $targetViewHelper->getScheduledGames($teamId);
    $jsonGameInfo = json_encode($gameInfo);
    echo $jsonGameInfo;
});

$app->get ( '/getDoneGames/:teamId',
 function ($teamId) use($app) {
   global $app;
   global $log;
   $teamId = getTeamByTeamId($teamId);
   
   $log->addInfo("Call api getDoneGames, teamId $teamId");
    
   $targetViewHelper = new TargetViewHelper();
   $gameInfo = $targetViewHelper->getDoneGames($teamId);
   $jsonGameInfo = json_encode($gameInfo);
   echo $jsonGameInfo;
 });



// create game
$app->post ( '/createGame',
		function () use($app) {
			global $app;
			global $log;
			
			$postdata = file_get_contents("php://input");
			$request = json_decode($postdata);
			$type = $request->gameType;
			$teamId = $request->teamId;
			$datePlayed = $request->gameDate;	
			$timePlayed = $request->gameTime;
			$message = $request->message;
			$log->addInfo("Call api, team id $teamId,$type, $datePlayed, $timePlayed, $message");
				
			$targetViewHelper = new TargetViewHelper();
			$targetViewHelper->createGame($teamId, $type, $datePlayed, $timePlayed, $message);
		});



// team function
$app->get ( '/getTeamStatistic/:teamId',
  function ($teamId) use($app) {
   global $app;
   global $log;
   $teamId = getTeamByTeamId($teamId);
   $log->addInfo("Call api get team stat, teamId $teamId");
    
   $targetViewHelper = new TargetViewHelper();
   $teamStat = $targetViewHelper->getTeamStatistic($teamId);
   $jsonTeamStat = json_encode($teamStat);
   echo $jsonTeamStat;
  });

$app->get ( '/getTeamByPlayerId/:playerId',
  function ($playerId) use($app) {
   global $app;
   global $log;
   $log->addInfo("Call api getTeamByPlayerId");

   $playerId = getTeamByPlayerId($playerId);
   $targetViewHelper = new TargetViewHelper();
   $teamInfo = $targetViewHelper->getTeamByPlayerId($playerId);
   $jsonTeamInfo = json_encode($teamInfo);
   echo $jsonTeamInfo;
  });

$app->get ( '/getTeamByTeamId/:teamId',
  function ($teamId) use($app) {
   global $app;
   global $log;
   $log->addInfo("Call api getTeamByTeamId");

   $teamId = getTeamByTeamId($teamId);
   $targetViewHelper = new TargetViewHelper();
   $currentTeam = $_SESSION["user"]["team_id"];
   $teamInfo = $targetViewHelper->getTeamByTeamId($teamId);
  

   $jsonTeamInfo = json_encode($teamInfo);
   echo $jsonTeamInfo;
  });
$app->post ( '/joinTeamRequest',
  function () use($app) {
   global $log;
   	
   $playerId = $_SESSION["user"]["int_user_id"];
   $postdata = file_get_contents("php://input");
   $request = json_decode($postdata);
   $teamId = $request->teamId;

   $targetViewHelper = new TargetViewHelper();
   $targetViewHelper->joinTeamRequest($teamId, $playerId);
  });

$app->get ( '/getAllTeams',
  function () use($app) {
	global $log;
	
	$targetViewHelper = new TargetViewHelper();
	$allTeams = $targetViewHelper->getAllTeams();
	$jsonAllTeams = json_encode($allTeams);
	echo $jsonAllTeams;
});

// Run the Slim application
$app->run ();
?>
