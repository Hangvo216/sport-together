<?php
require_once (__DIR__ . '/../lib/BootstrapDB.php');

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
  
  public function getGameFromTeamId($teamId) {
  	global $log;
  	$log->info ( "Call getGameFromTeamId , $teamId" );
  
  	$db = BootstrapDB::getMYSQLI ();
  	$statement = $db->prepare ( "SELECT 
  			g.game_type, g.date_played, g.time_played,t.team_name,f.field_name,g.message
  			FROM games g
  			inner join teams t on 
  				g.int_home_team = t.id
  			inner join soccer_fields f on
  				g.int_field_id = f.id
  			WHERE g.int_home_team != ? and g.int_guest_team is null" );
  
  	$statement->bind_param ( 's', $teamId);
  
  	if($statement->execute()) {
  		$log->debug(__FUNCTION__, array( $teamId));
  		return $statement->get_result();
  	} else {
  		$log->err($db->error, array( $teamId));
  		return false;
  	}
  }
  
  public function getFindGameFromTeamId($teamId) {
  	global $log;
  	$log->info ( "Call getFindGameFromTeamId , $teamId" );
  
  	$db = BootstrapDB::getMYSQLI ();
  	$statement = $db->prepare ( "SELECT
  			g.game_type, g.date_played, g.time_played,t.team_name,f.field_name,g.message
  			FROM games g
  			inner join teams t on
  				g.int_home_team = t.id
  			inner join soccer_fields f on
  				g.int_field_id = f.id
  			WHERE g.int_home_team = ? and g.int_guest_team is null and
  			g.date_played > now()" );
  
  	$statement->bind_param ( 's', $teamId);
  
  	if($statement->execute()) {
  		$log->debug(__FUNCTION__, array( $teamId));
  		return $statement->get_result();
  	} else {
  		$log->err($db->error, array( $teamId));
  		return false;
  	}
  }
  
  public function getScheduledGameFromTeamId($teamId) {
  	global $log;
  	$log->info ( "Call getGameFromTeamId , $teamId" );
  
  	$db = BootstrapDB::getMYSQLI ();
  	$statement = $db->prepare ( "SELECT
  			g.game_type, g.date_played, g.time_played,t.team_name home_team_name,
  			te.team_name guest_team_name,f.field_name,g.message
  			FROM games g
  			inner join teams t on
  				g.int_home_team = t.id
  			inner join teams te on
  				g.int_guest_team = te.id
  			inner join soccer_fields f on
  				g.int_field_id = f.id
  			WHERE g.int_home_team = ? and g.int_guest_team is not null
  			and g.date_played > now()" );
  
  	$statement->bind_param ( 's', $teamId);
  
  	if($statement->execute()) {
  		$log->debug(__FUNCTION__, array( $teamId));
  		return $statement->get_result();
  	} else {
  		$log->err($db->error, array( $teamId));
  		return false;
  	}
  }
  
  public function getDoneGameFromTeamId($teamId) {
  	global $log;
  	$log->info ( "Call getGameFromTeamId , $teamId" );
  
  	$db = BootstrapDB::getMYSQLI ();
  	$statement = $db->prepare ( "SELECT
  			g.game_type, g.date_played, g.time_played,t.team_name home_team_name,
  			te.team_name guest_team_name,f.field_name,g.message, g.result
  			FROM games g
  			inner join teams t on
  				g.int_home_team = t.id
  			inner join teams te on
  				g.int_guest_team = te.id
  			inner join soccer_fields f on
  				g.int_field_id = f.id
  			WHERE g.int_home_team = ? and g.int_guest_team is not null 
  			and g.date_played < now()" );
  
  	$statement->bind_param ( 's', $teamId);
  
  	if($statement->execute()) {
  		$log->debug(__FUNCTION__, array( $teamId));
  		return $statement->get_result();
  	} else {
  		$log->err($db->error, array( $teamId));
  		return false;
  	}
  }
}
?>
