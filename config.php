<?php
function getRealFile($path) {
  return is_link ( $path ) ? readlink ( $path ) : $path;
}

error_reporting ( E_ALL );
ini_set ( 'error_reporting', E_ALL );
ini_set ( 'log_errors', true );
ini_set ( 'error_log',  __DIR__ . '/log/php_errors.log' );


require 'vendor/autoload.php';

$log = new Monolog\Logger ( 'sport-together' );
$log->pushHandler ( 
    new Monolog\Handler\StreamHandler ( __DIR__ . '/log/sport-together.log', 
        Monolog\Logger::INFO ) );

$log->pushProcessor(new \Monolog\Processor\MemoryUsageProcessor);
$fizzyInit = Array ();

$fizzyInit["fb-app-id"] = "1598023593791688";
$fizzyInit["fb-app-secret"] = "4a418b355d4e553a4c7e0eb24938298b";


$fizzyInit["fb-state"] = "AAAA";
$fizzyInit ['address'] = 'http://localhost/';
// $fizzyInit ['address'] = 'https://sport-together.herokuapp.com/';
$fizzyInit ['baseDir'] ="/var/www/sport-together.com/";
$fizzyInit ['sessionsDir'] = $fizzyInit ['baseDir'] . 'sessions/';

  $fizzyInit ['mysqlAddress'] = 'localhost';
  $fizzyInit ['mysqlUser'] = 'root';
  $fizzyInit ['mysqlPass'] = 'root';
  $fizzyInit ['mysqlDb'] = 'sportTogether';
  $fizzyInit ['mysqlPort'] = '3306';
?>