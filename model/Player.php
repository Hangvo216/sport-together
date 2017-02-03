<?php
require_once (BOOSTSRAPDB);
require_once (UTIL);
class Players {
 
  public function insertPlayer($playerName, $position, $intTeamId, $fbId, $userName) {
    global $log;
    $log->info ( 
        "Call Player create Player , int page id: $intPageId, facebook user id: $facebookUserId, model facebook user id: $modelUserId" );
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
  
  public static function firstTimeLogin($facebookUserId) {
   global $log;
   $log->info ("Call Player firstTimeLogin $facebookUserId" );
  
   $db = BootstrapDB::getMYSQLI ();
   $statement = $db->prepare (
     "SELECT  first_time FROM 
             players WHERE
            facebook_id = ?" );
  
   $statement->bind_param ( 's', $facebookUserId);
  
   if($statement->execute()) {
    $log->debug(__FUNCTION__, array($facebookUserId));
    return Util::toArray($statement->get_result());
   } else {
    $log->err($db->error, array($facebookUserId));
    return false;
   }
  }
  
  public function createPlayer($userId, $position) {
   global $log;
   $log->info (
     "Call Player create Player $position, $userId" );
    
   $db = BootstrapDB::getMYSQLI ();
   $statement = $db->prepare (
     "UPDATE players SET             
             position = ?, first_time = 0       
            WHERE id = ?" );
  
   $statement->bind_param ( 'ss', $position, $userId);
  
   if($statement->execute()) {
    $log->debug(__FUNCTION__, array($userId));
    return true;
   } else {
    $log->err($db->error, array($userId));
    return false;
   }
  }
  
  public function updateTeamForPlayer($userId, $teamId) {
  	global $log;
  	$log->info ( "Call Player updateTeamForPlayer , user id: $userId team id $teamId" );
  	
  	$db = BootstrapDB::getMYSQLI ();
  	$statement = $db->prepare ( "update players set int_team_id = ? where id = ?" );
  	$statement->bind_param ( 'ss', $teamId, $userId );
  	
  	if($statement->execute()) {
  		$log->debug(__FUNCTION__, array($teamId, $userId));
  		return $statement->get_result();
  	} else {
  		$log->err($db->error, array($teamId, $userId));
  		return false;
  	}
  }
  
  public function getTeam($playerId){
 
    global $log;
    $log->info ( "Call player getTeam , player id: $playerId);
      " );
    
    $db = BootstrapDB::getMYSQLI ();
    $statement = $db->prepare ( 'SELECT * FROM teams WHERE
      id = (SELECT int_team_id FROM players where id = ?)');
    
    $statement->bind_param ( 's', $playerId );
    
    if($statement->execute()) {
      $log->debug(__FUNCTION__, array($playerId));
    	return $statement->get_result();
    } else {
      $log->err($db->error, array($playerId));
      return false;
    }
  } 
  
  // return all information about player
  public function getPlayerInfo($playerId) {
  	global $log;
  	$log->info ( "Call Player  getPlayer , player id: $playerId" );
  	$db = BootstrapDB::getMYSQLI ();
  	$statement = $db->prepare ( "SELECT player_name, position, role, int_team_id, first_time FROM players where id = ?" );
  
  	$statement->bind_param ( 's', $playerId);
  
  	if($statement->execute()) {
  	 $log->info(__FUNCTION__, array($playerId));
  	 $result = $statement->get_result();
  	return $result->fetch_assoc();
  	} else {
  		$log->err($db->error, array($playerId));
  		return false;
  	}
  }
  
  public static function hasFacebookUserId($extFacebookUserId) {
  	global $log;
  	$log->info("Call Player hasFacebookUserId, ext Facebook user id: $extFacebookUserId");
  	$db = BootstrapDB::getMYSQLI ();
  	$statement = $db->prepare (
  			"SELECT facebook_id FROM players WHERE facebook_id = ?" );
  	$statement->bind_param ( 's', $extFacebookUserId );
  
  	if($statement->execute()) {
  		$log->debug(__FUNCTION__, array($extFacebookUserId));
  		$statement->store_result();
  		if($statement->num_rows() == 1) {
  			return true;
  		}
  		return false;
  	} else {
  		$log->err($db->error, array($extFacebookUserId));
  		return false;
  	}
  }
  
  public static function insertNewUser($extFacebookUserId, $name) {
  	global $log;
  	$log->info ( "Call Player insertUser, ext Facebook user id: $extFacebookUserId, name: $name" );
  	$db = BootstrapDB::getMYSQLI ();
  	$statement = $db->prepare ( "INSERT INTO players(facebook_id,player_name, first_time) values(?,?,false)" );
  	$statement->bind_param ( 'ss', $extFacebookUserId, $name);
  
  	if($statement->execute()) {
  		$log->debug(__FUNCTION__, array($extFacebookUserId));
  		return true;
  	} else {
  		$log->err($db->error, array($extFacebookUserId));
  		return false;
  	}
  }
  
  public static function setLastLoginToNow($now, $userId) {
  	global $log;
  	$mysqli = BootstrapDB::getMYSQLI();
  	$sql = "UPDATE players SET last_login = ? WHERE facebook_id = ?";
  	 
  	$statement = $mysqli->prepare($sql);
  	$statement->bind_param('ss', $now, $userId);
  	 
  	if($statement->execute()) {
  		$log->debug(__FUNCTION__, array($now, $userId));
  	} else {
  		$log->err($mysqli->error, array($now, $userId));
  		return false;
  	}
  }
  
  public static function setAccessToken($token, $userId) {
  	global $log;
  	$mysqli = BootstrapDB::getMYSQLI();
  	$sql = "UPDATE players SET access_token = ? WHERE facebook_id = ?";
  	 
  	$statement = $mysqli->prepare($sql);
  	$statement->bind_param('ss', $token, $userId);
  	 
  	if($statement->execute()) {
  		$log->debug(__FUNCTION__, array($token, $userId));
  	} else {
  		$log->err($mysqli->error, array($token, $userId));
  		return false;
  	}
  }
  
  public static function setUserEmail($email, $userId) {
  	global $log;
  	$mysqli = BootstrapDB::getMYSQLI();
  	$sql = "UPDATE players SET email = ? WHERE facebook_id = ?";
  	 
  	$statement = $mysqli->prepare($sql);
  	$statement->bind_param('ss', $email, $userId);
  	 
  	if($statement->execute()) {
  		$log->debug(__FUNCTION__, array($email, $userId));
  	} else {
  		$log->err($mysqli->error, array($email, $userId));
  		return false;
  	}
  }
  
  public function createTeam($playerId, $teamName) {
    global $log;
    $mysqli = BootstrapDB::getMYSQLI();
    
    $sql = "INSERT INTO teams (team_name) VALUES (?);";
    
    $statement = $mysqli->prepare($sql);
    $statement->bind_param('s', $teamName);
    
    $teamId = 0;
    if($statement->execute()) {
      $log->debug(__FUNCTION__, array($playerId, $teamName));
      $log->info('new team id is ' + $teamId);
      $teamId = $statement->insert_id;
    } else {
      $log->err($mysqli->error, array($playerId, $teamName));
    }
    
    $sql = "UPDATE players SET int_team_id = ? WHERE id = ?";
    $statement = $mysqli->prepare($sql);
    $statement->bind_param('ss', $teamId, $playerId);    
       
    if($statement->execute()) {
      $log->debug(__FUNCTION__, array($playerId, $teamName));
      $log->info('Done update ****');
      return true;
    } else {
      $log->err($mysqli->error, array($playerId, $teamName));
      return false;
    }
  }
}
?>
