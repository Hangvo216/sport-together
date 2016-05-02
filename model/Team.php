<?php
require_once (__DIR__ . '/../public_html/BootstrapDB.php');

class Team {
  public function createTeam($teamName, $description, $numPlayers, $winNum = 0, $lossNum = 0,
  		$drawNum =0,$point=0,$numOnTime=0,$numLate=0,$numCancel, $rating=0, $ranking =0,$fairPlay=0,$numShowUp=0) {
    global $log;
    $log->info ( 
        "Call create Player , int page id: $intPageId, facebook user id: $facebookUserId, model facebook user id: $modelUserId" );
    
    
    $db = BootstrapDB::getMYSQLI ();
    $statement = $db->prepare ( 
        "INSERT INTO teams 
            (team_name, 
             description, 
             number_of_player, 
             win, 
             loss,
    		 draw,
    		point,
    		num_on_time,
    		num_late,
    		num_canceled,
    		rating.
    		ranking,
    		fair_play,
    		num_show_up,
    		day_joined
    		) 
            VALUES (
    		?,?,?,?,?,?,?,?,?,?,?,?,?,? now())" );
    
    $statement->bind_param ( 'ssssssssssssss',$teamName, $description, $numPlayers, $winNum, $lossNum,
  		$drawNum,$point,$numOnTime,$numLate,$numCancel, $rating, $ranking,$fairPlay,$numShowUp );
    
    if($statement->execute()) {
      $log->debug(__FUNCTION__, array($teamName));
      return $statement->insert_id;
    } else {
      $log->err($db->error, array($teamName));
      return false;
    }
  }
  
  public function updateDes($desc, $intTeamId) {
    global $log;
    $log->info ( "Call updateDes , description: $desc, team id: $intTeamId" );
    
    $db = BootstrapDB::getMYSQLI ();
    $statement = $db->prepare ( "UPDATE teams set description = ? where id = ?" );
    
    $statement->bind_param ( 'ss', $desc, $intTeamId);
    
    if($statement->execute()) {
      $log->debug(__FUNCTION__, array($desc, $intTeamId));
      return true;
    } else {
      $log->err($db->error, array($desc, $intTeamId));
      return false;
    }
  } 
  
  public function updateNumPlayer($numPlayer, $intTeamId) {
  	global $log;
  	$log->info ( "Call updateNumPlayer , num player: $numPlayer, team id: $intTeamId" );
  
  	$db = BootstrapDB::getMYSQLI ();
  	$statement = $db->prepare ( "UPDATE teams set number_of_player = ? where id = ?" );
  
  	$statement->bind_param ( 'ss', $numPlayer, $intTeamId);
  
  	if($statement->execute()) {
  		$log->debug(__FUNCTION__, array($numPlayer, $intTeamId));
  		return true;
  	} else {
  		$log->err($db->error, array($desc, $intTeamId));
  		return false;
  	}
  }
}
?>
