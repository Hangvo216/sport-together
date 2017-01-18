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

function login($userId, $token) {
	global $log;
	global $app;
	global $Fizzy;
	
	$log->addInfo("Call login with $userId and $token");

	$now = time();

	Players::setLastLoginToNow($now, $userId);

	Players::setAccessToken($token, $userId);
// 	session_start();
	

	$_SESSION["user"]["id"] = $userId;
	
// 	//check for TOS
// 	if(!Users::tosCompleted( $userId )){
// 		$log->info("Redirect to TOS");
// 		$app->redirect ( $Fizzy->address . "#/tos" );
// 	}

	$Fizzy->pullUserDetails($userId);

// 	if(empty($_SESSION['user']['email'])){
// 		Players::setUserEmail($email, $userId);
// 		$_SESSION['user']['email'] = $email;
// 	}

	$_SESSION['data'] = array();
// 	$Fizzy->loadAccountData($key[0],$key[0],$start,$end);
// 	$Fizzy->ctrlrInit();
	$Fizzy->loggedIn = true;
	$log->addInfo(" **** End Login");
	$app->redirect ($Fizzy->address . "#/" );
	
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
			$log->addInfo("state: $state,  code: $code , address: $address");
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
				$log->addInfo("token: $token");
				

				// Get and decode the initial user information, if the response matches a record in our DB. Otherwise kick to an error.
				$response = file_get_contents("https://graph.facebook.com/me?access_token=".$token);
				$response = json_decode($response);
				var_dump($response);
				$log->info("User Facebook Info:" . json_encode($response));
				$userId = $response->id;
// 				$email = $response->email;
				$fullName = $response->name;
				$log->info("User Info: $userId, $fullName");
				

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
			if (! Players::hasFacebookUserId ( $userId )) {
				// This is where new user should be created
// 				$dbUser = Users::getUserByName ( $fullName );
// 				if ($dbUser && isset($dbUser->tos) && !$dbUser->tos) {
// 					Users::updateExtFacebookUserId ( $userId, $dbUser->id );
// 				} else {
// 					session_destroy ();
// 					$app->redirect ( $Fizzy->address . "#/error?c=601" );
// 				}
				 Players::insertNewUser($userId, $fullName); 
			}

			$log->info ( "User already exists, user id: $userId" );
			login($userId,$token);
		});

$app->get ( '/getTeamForPlayer',
		function () use($app) {
						global $app;
			global $log;
			$log->addInfo("Call api getTeamForPlayer");
				
			$playerId = 2;
			$targetViewHelper = new TargetViewHelper();
			$teamInfo = $targetViewHelper->getTeamFromPlayer($playerId);
			$jsonTeamInfo = json_encode($teamInfo);
			$log->addInfo($jsonTeamInfo);
			echo $jsonTeamInfo;
		});

$app->get ( '/getPlayerInfo',
		function () use($app) {
			global $app;
			global $log;
			$playerId = $_SESSION["user"]["int_user_id"];
			$log->addInfo("Call api getPlayerInfo, playerId $playerId");

			
			$targetViewHelper = new TargetViewHelper();
			$playerInfo = $targetViewHelper->getPlayer($playerId);
			$jsonPlayerInfo = json_encode($playerInfo);
			$log->addInfo($jsonPlayerInfo);
			echo $jsonPlayerInfo;
		});

// game controller 
$app->get ( '/getAllGames',
		function () use($app) {
			global $app;
			global $log;
			$teamId = 1;
			$log->addInfo("Call api getAllGames, teamId $teamId");

				
			$targetViewHelper = new TargetViewHelper();
			$gameInfo = $targetViewHelper->getGames($teamId);
			$jsonGameInfo = json_encode($gameInfo);
			$log->addInfo($jsonGameInfo);
			echo $jsonGameInfo;
		});

$app->get ( '/getFindGames',
		function () use($app) {
			global $app;
			global $log;
			$teamId = 1;
			$log->addInfo("Call api getFindGames, teamId $teamId");


			$targetViewHelper = new TargetViewHelper();
			$gameInfo = $targetViewHelper->getFindGames($teamId);
			$jsonGameInfo = json_encode($gameInfo);
			$log->addInfo($jsonGameInfo);
			echo $jsonGameInfo;
		});

$app->get ( '/getScheduledGames',
		function () use($app) {
			global $app;
			global $log;
			$teamId = 1;
			$log->addInfo("Call api getScheduledGames, teamId $teamId");


			$targetViewHelper = new TargetViewHelper();
			$gameInfo = $targetViewHelper->getScheduledGames($teamId);
			$jsonGameInfo = json_encode($gameInfo);
			$log->addInfo($jsonGameInfo);
			echo $jsonGameInfo;
		});

$app->get ( '/getDoneGames',
 function () use($app) {
   global $app;
   global $log;
   $teamId = 1;
   $log->addInfo("Call api getDoneGames, teamId $teamId");
   
   $targetViewHelper = new TargetViewHelper();
   $gameInfo = $targetViewHelper->getDoneGames($teamId);
   $jsonGameInfo = json_encode($gameInfo);
   $log->addInfo($jsonGameInfo);
   echo $jsonGameInfo;
 });

$app->get ( '/getTeamStatistic',
 function () use($app) {
   global $app;
   global $log;
   $teamId = 1;
   $log->addInfo("Call api get team stat, teamId $teamId");
   
   $targetViewHelper = new TargetViewHelper();
   $teamStat = $targetViewHelper->getTeamStatistic($teamId);
   $jsonTeamStat = json_encode($teamStat);
   $log->addInfo($jsonTeamStat);
   echo $jsonTeamStat;
 });

// done game controller function
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

$app->post ( '/createTeam',
		function () use($app) {
			global $app;
			global $log;
			global $Fizzy;
				
			$postdata = file_get_contents("php://input");
			$request = json_decode($postdata);
			$teamName = $request->teamName;
			$intUserId = $_SESSION["user"]["int_user_id"];
			$desc = $request->desc;
			$log->addInfo("Call api create team, team name $teamName
					desc: $desc, int user id: $intUserId ");

			$targetViewHelper = new TargetViewHelper();
			$teamId = $targetViewHelper->createTeam($teamName, $desc);
			$targetViewHelper->updateTeamForPlayer($intUserId, $teamId);
			$_SESSION["user"]["team_id"] = $teamId;
			$app->redirect ($Fizzy->address . "#/team-profile" );
		});

// Run the Slim application
$app->run ();
?>
