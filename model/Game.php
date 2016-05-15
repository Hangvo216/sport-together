<?php
require_once (__DIR__ . '/../public_html/BootstrapDB.php');

class Game {
  public function createGame1($intHomeGame, $intGuestTeam, $intTeamWin, $intTeamLose,
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
  
  public function createGame($teamId, $type, $datePlayed, $timePlayed, $message) {
  	global $log;
  	$log->info ( "Call createGame , $teamId, $type, $datePlayed, $timePlayed, $message" );
  
  	$db = BootstrapDB::getMYSQLI ();
  	$statement = $db->prepare ( "Insert into
  			games (int_home_team, game_type, date_played, time_played, message) 
  			VALUES (?,?,?,?,?)" );
  
  	$statement->bind_param ( 'sssss', $teamId, $type, $datePlayed, $timePlayed, $message);
  
  	if($statement->execute()) {
  		$log->debug(__FUNCTION__, array( $teamId, $type, $datePlayed, $timePlayed, $message));
  		return true;
  	} else {
  		$log->err($db->error, array( $teamId, $type, $datePlayed, $timePlayed, $message));
  		return false;
  	}
  }
}
?>
