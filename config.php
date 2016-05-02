<?php
// function getRealFile($path) {
//   return is_link ( $path ) ? readlink ( $path ) : $path;
// }

// error_reporting ( E_ALL );
// ini_set ( 'error_reporting', E_ALL );
// ini_set ( 'log_errors', true );
// ini_set ( 'error_log',  __DIR__ . '/log/php_errors.log' );

require 'vendor/autoload.php';

$log = new Monolog\Logger ( 'sport-together' );
$log->pushHandler ( 
    new Monolog\Handler\StreamHandler ( __DIR__ . '/log/sport-together.log', 
        Monolog\Logger::INFO ) );

$log->pushProcessor(new \Monolog\Processor\MemoryUsageProcessor);
$log->addInfo("A");
$fizzyInit = Array ();

  
  $fizzyInit ['mysqlAddress'] = 'localhost';
  $fizzyInit ['mysqlUser'] = 'root';
  $fizzyInit ['mysqlPass'] = 'root';
  $fizzyInit ['mysqlDb'] = 'sport_together';
  $fizzyInit ['mysqlPort'] = '8889';
?>