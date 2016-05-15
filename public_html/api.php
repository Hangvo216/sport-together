<?php
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
require '../vendor/autoload.php';

// Fire up an app
$app = new Slim\Slim ( array (
    'mode' => 'development',
    'log.enabled' => true,
    'log.level' => Slim\Log::DEBUG,
    'log.writer' => new APILogWriter () 
) );

$app->get ( '/getTeamForPlayer',
		function () use($app) {
						global $app;
			global $log;
			$log->addInfo("Call api, getTeamForPlayer");
				
			$playerId = 1;
			$targetViewHelper = new TargetViewHelper();
			$teamInfo = $targetViewHelper->getTeamFromPlayer($playerId);
			$jsonTeamInfo = json_encode($teamInfo);
			$log->addInfo($jsonTeamInfo);
			echo $jsonTeamInfo;
		});

$app->get ( '/getPlayer',
		function () use($app) {
			global $app;
			global $log;
			$log->addInfo("Call api, playerId $playerId");

			$playerId = 1;
			$targetViewHelper = new TargetViewHelper();
			$playerInfo = $targetViewHelper->getPlayer($playerId);
			$jsonPlayerInfo = json_encode($playerInfo);
			$log->addInfo($jsonPlayerInfo);
			echo $jsonPlayerInfo;
		});

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

// Run the Slim application
$app->run ();
?>
