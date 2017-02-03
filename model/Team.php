<?php
require_once (__DIR__ . '/../lib/BootstrapDB.php');

class Team {
  public function createTeam($teamName, $description, $numPlayers=0, $winNum = 0, $lossNum = 0,
  		$drawNum =0,$point=0,$numOnTime=0,$numLate=0,$numCancel=0, $rating=0, $ranking =0,$fairPlay=0,$numShowUp=0) {
    global $log;
    $log->info ( 
        "Call  createTeam , $teamName, $description, $numPlayers, $winNum, $lossNum,
  		$drawNum,$point,$numOnTime,$numLate,$numCancel, $rating, $ranking,$fairPlay,$numShowUp" );
    
    
    $db = BootstrapDB::getMYSQLI ();
    $statement = $db->prepare ( 
//         "INSERT INTO teams 
//             (team_name, 
//              description, 
//              number_of_player, 
//              win, 
//              loss,
//     		 draw,
//     		score,
//     		num_on_time,
//     		num_late,
//     		num_canceled,
//     		rating.
//     		ranking,
//     		fair_play,
//     		num_show_up
//     		) 
//             VALUES (
//     		?,?,?,?,?,?,?,?,?,?,?,?,?,?)" );

    		"INSERT INTO teams
    		  (team_name,
    		   description,
    		created_at) VALUES
    		(?,?, now())");
    
    $statement->bind_param ( 'ss',$teamName, $description);
    
    if($statement->execute()) {
      $log->debug(__FUNCTION__, array($teamName));
      return $statement->insert_id;
    } else {
      $log->err($db->error, array($teamName));
      return false;
    }
  }
  
  public function getTeamStatFromTeamId($teamId) {
   global $log;
   $log->info ( "Call getTeamStatFromTeamId, $teamId" );
  
   $db = BootstrapDB::getMYSQLI ();
   $statement = $db->prepare ( "SELECT (SELECT Count(*) game_win
                                FROM   games g
                                WHERE  int_team_win = ?)  AS win,
                               (SELECT Count(*) game_losed
                                FROM   games g
                                WHERE  int_team_lose = ?) AS loss,
                               (SELECT Count(*) game_losed
                                FROM   games g
                                WHERE  int_team_lose = ?) AS cancelled");
  
   $statement->bind_param ( 'sss', $teamId,$teamId,$teamId);
  
   if($statement->execute()) {
    $log->debug(__FUNCTION__, array( $teamId));
    $result = $statement->get_result();
    return $result->fetch_assoc();
   } else {
    $log->err($db->error, array( $teamId));
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
  
  public function getTeam($teamId) {
    global $log;
    $log->info ( "Call team getTeam , team id: $teamId" );
    
    $db = BootstrapDB::getMYSQLI ();
    $statement = $db->prepare ( 'SELECT * FROM teams where id = ?');
    
    $statement->bind_param ( 's', $teamId );
    
    if($statement->execute()) {
      $log->debug(__FUNCTION__, array($teamId));
      return $statement->get_result();
    } else {
      $log->err($db->error, array($teamId));
      return false;
    }
  }
  
  public function getAllTeams() {
    global $log;
    $log->info ( "Call getAllTeams");
    $db = BootstrapDB::getMYSQLI ();
    $statement = $db->prepare (
      "SELECT * from teams order by team_name;" );  
   
    if($statement->execute()) {
     $log->debug(__FUNCTION__, array());
     return $statement->get_result();
    } else {
     $log->err($db->error, array());
     return false;
    }
  }
  public function joinTeamRequest($teamId, $playerId){
   global $log;
   $log->info ( "Call joinTeamRequest $teamId player id $playerId");
   $db = BootstrapDB::getMYSQLI ();
   $date = date("m-d-Y h:i:sa").toString();
   $statement = $db->prepare (
     "INSERT into team_join_request (team_id, player_id) values ($teamId, $playerId);" );
    
   if($statement->execute()) {
    $log->debug(__FUNCTION__, array());
    return $statement->get_result();
   } else {
    $log->err($db->error, array());
    return false;
   }
  }
}
?>
