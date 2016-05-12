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
			
			return json_encode("1");
		});

// Run the Slim application
$app->run ();
?>
