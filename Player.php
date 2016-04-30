<?php
require_once (__DIR__ . '/../foresight/BootstrapDB.php');
use Monolog\Logger;

class Users {
  public static function createPlayer($playerName, $position, $intTeamId, $fbId, $userName) {
    global $log;
    $log->info ( 
        "Call create Player , int page id: $intPageId, facebook user id: $facebookUserId, model facebook user id: $modelUserId" );
    
    
    $db = BootstrapDB::getMYSQLI ();
    $statement = $db->prepare ( 
        "INSERT INTO players 
            (player_name, 
             position, 
             int_team_id, 
             day_joined, 
             facebook_id,
    		username) 
            VALUES (
    		?,?,?,now(),?,?)" );
    
    $statement->bind_param ( 'sssss', $playerName, $position, $intTeamId, $fbId, $userName );
    
    if($statement->execute()) {
      $log->debug(__FUNCTION__, array($facebookUserId));
      return $statement->insert_id;
    } else {
      $log->err($db->error, array($facebookUserId));
      return false;
    }
  }
  
  public static function deleteAccount($accountId) {
//     global $log;
//     $log->info ( "Call deleteAccount , account id: $accountId" );
    
//     $db = BootstrapDB::getMYSQLI ();
//     $statement = $db->prepare ( "DELETE from app_accounts where id = ?" );
    
//     $statement->bind_param ( 's', $accountId );
    
//     if($statement->execute()) {
//       $log->debug(__FUNCTION__, array($accountId));
//       return true;
//     } else {
//       $log->err($db->error, array($accountId));
//       return false;
//     }
  } 
}
?>
