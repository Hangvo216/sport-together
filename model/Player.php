<?php
require_once (__DIR__ . '/../public_html/BootstrapDB.php');

class Player {
  public function createPlayer($playerName, $position, $intTeamId, $fbId, $userName) {
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
  
  public function getTeam($playerId) {
    global $log;
    $log->info ( "Call getTeam , player id: $playerId" );
    
    $db = BootstrapDB::getMYSQLI ();
    $statement = $db->prepare ( "select * from teams where id =  (select int_team_id from
    		players where id = ?)" );
    
    $statement->bind_param ( 's', $playerId );
    
    if($statement->execute()) {
      $log->debug(__FUNCTION__, array($playerId));
    	return $statement->get_result();
    } else {
      $log->err($db->error, array($playerId));
      return false;
    }
  } 
}
?>
