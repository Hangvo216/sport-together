<?php
require_once (__DIR__ . 'config.php');

class BootstrapDB {
  
  private static $instance;
  
  private static $mysqli;
  
  public static function getMYSQLI() {
    global $log;
    BootstrapDB::getInstance();
    return self::$mysqli;
  }
  
  public static function getInstance() {
    if (! isset ( self::$instance )) {
      self::$instance = new BootstrapDB();
    }
    return self::$instance;
  }
 
  private function __construct() {
    global $fizzyInit;
//     self::$mysqli = new mysqli($fizzyInit['mysqlAddress'], $fizzyInit['mysqlUser'], $fizzyInit['mysqlPass'], $fizzyInit['mysqlDb'], $fizzyInit['mysqlPort']);
   
  }  
}
?>