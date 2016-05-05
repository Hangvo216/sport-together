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

require_once(__DIR__ . '/../config.php');
require '../vendor/autoload.php';


// Fire up an app
$app = new Slim\Slim ( array (
    'mode' => 'development',
    'log.enabled' => true,
    'log.level' => Slim\Log::DEBUG,
    'log.writer' => new APILogWriter () 
) );

// Run the Slim application
$app->run ();
?>
