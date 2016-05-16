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
			$playerId = 2;
			$log->addInfo("Call api getPlayerInfo, playerId $playerId");

			
			$targetViewHelper = new TargetViewHelper();
			$playerInfo = $targetViewHelper->getPlayer($playerId);
			$jsonPlayerInfo = json_encode($playerInfo);
			$log->addInfo($jsonPlayerInfo);
			echo $jsonPlayerInfo;
		});

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
