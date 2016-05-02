<?php
require_once (__DIR__ . '/../public_html/BootstrapDB.php');

class Game {
  public function createGame($intHomeGame, $intGuestTeam, $intTeamWin, $intTeamLose,
  		$result, $numCancel, $intFieldId, $dayPlayed,$timePlayed, $homeTeamRating, $guestTeamRating) {
    global $log;
    $log->info ( 
        "Call create Player , $intHomeGame, $intGuestTeam, $intTeamWin, $intTeamLose,
  		$result, $numCancel, $intFieldId, $dayPlayed,$timePlayed, $homeTeamRating, $guestTeamRating");
    
    $db = BootstrapDB::getMYSQLI ();
    $statement = $db->prepare ( 
        "INSERT INTO games 
            (int_home_team, 
             int_guest_team, 
             int_team_win, 
             int_team_lose, 
             result,
    		 int_field_id,
    		day_played,
    		time_played,
    		home_team_rating,
    		guest_team_rating
    		) 
            VALUES (
    		?,?,?,?,?,?,?,?,?,?)" );
    
    $statement->bind_param ( 'ssssssssss',$intHomeGame, $intGuestTeam, $intTeamWin, $intTeamLose,
  		$result, $numCancel, $intFieldId, $dayPlayed,$timePlayed, $homeTeamRating, $guestTeamRating );
    
    if($statement->execute()) {
      $log->debug(__FUNCTION__, array($intHomeGame, $intGuestTeam));
      return $statement->insert_id;
    } else {
      $log->err($db->error, array($intHomeGame, $intGuestTeam));
      return false;
    }
  }
  
  public function updateResult($res, $intGameId) {
    global $log;
    $log->info ( "Call updateResult , result: $res, game id: $intGameId" );
    
    $db = BootstrapDB::getMYSQLI ();
    $statement = $db->prepare ( "UPDATE games set result = ? where id = ?" );
    
    $statement->bind_param ( 'ss', $desc, $intTeamId);
    
    if($statement->execute()) {
      $log->debug(__FUNCTION__, array($res, $intTeamId));
      return true;
    } else {
      $log->err($db->error, array($res, $intTeamId));
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
