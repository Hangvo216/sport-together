<?php
require_once (__DIR__ . '/../lib/BootstrapDB.php');

class FieldOwner {
  public function createFieldOwner($facebookId, $username, $intFieldId, $ownerName) {
    global $log;
    $log->info ( 
        "Call create createFieldOwner $facebookId, $username, $intFieldId, $ownerName");
    
    $db = BootstrapDB::getMYSQLI ();
    $statement = $db->prepare ( 
        "INSERT INTO field_owners 
            (facebook_id, 
             username, 
             int_field_id, 
             owner_name, 
             day_joined
    		) 
            VALUES (
    		?,?,?,?,?)" );
    
    $statement->bind_param ( 'ssss', $facebookId, $username, $intFieldId, $ownerName );
    
    if($statement->execute()) {
      $log->debug(__FUNCTION__, array( $facebookId, $username, $intFieldId, $ownerName));
      return $statement->insert_id;
    } else {
      $log->err($db->error, array($facebookId, $username, $intFieldId, $ownerName));
      return false;
    }
  }
  
  public function updateSoccerField($intFieldId, $address, $district, $city, $street, $number,$numBooked, $numCanceled) {
    global $log;
    $log->info ( "Call updateGame , $address, $district, $city, $street, $number,$numBooked, $numCanceled" );
    
    $db = BootstrapDB::getMYSQLI ();
    $statement = $db->prepare ( "UPDATE games set address = ?, district = ?, city = ?,street = ?,
    		number = ?,num_booked, num_canceled = ? where id = ?" );
    
    $statement->bind_param ( 'ssssssss', $address, $district, $city, $street, $number,$numBooked, $numCanceled, $intGameId);
    
    if($statement->execute()) {
      $log->debug(__FUNCTION__, array($intFieldId));
      return true;
    } else {
      $log->err($db->error, array($intFieldId));
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
