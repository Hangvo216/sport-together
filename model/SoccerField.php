<?php
require_once (__DIR__ . '/../public_html/BootstrapDB.php');

class SoccerField {
  public function createSoccerField($address, $district, $city, $street, $number,$numBooked, $numCanceled) {
    global $log;
    $log->info ( 
        "Call create createSoccerField , $$address, $district, $city, $street, $number,$numBooked, $numCanceled");
    
    $db = BootstrapDB::getMYSQLI ();
    $statement = $db->prepare ( 
        "INSERT INTO games 
            (address, 
             district, 
             city, 
             street, 
             number,
    		 num_booked,
    		num_canceled,
    		day_joined
    		) 
            VALUES (
    		?,?,?,?,?,?,?)" );
    
    $statement->bind_param ( 'sssssss',$address, $district, $city, $street, $number,$numBooked, $numCanceled );
    
    if($statement->execute()) {
      $log->debug(__FUNCTION__, array($address, $district, $city, $street, $number,$numBooked, $numCanceled));
      return $statement->insert_id;
    } else {
      $log->err($db->error, array($address, $district, $city, $street, $number,$numBooked, $numCanceled));
      return false;
    }
  }
  
  public function updateFieldOwner($intFieldOwner, $facebookId, $username, $intFieldId, $ownerName) {
    global $log;
    $log->info ( "Call updateFieldOwner , $facebookId, $username, $intFieldId, $ownerName, $intFieldOwner" );
    
    $db = BootstrapDB::getMYSQLI ();
    $statement = $db->prepare ( "UPDATE field_owner set facebook_id = ?, username = ?, int_field_id = ?,
    		owner_name = ? where id = ?" );
    
    $statement->bind_param ( 'sssss', $facebookId, $username, $intFieldId, $ownerName,$intFieldOwner);
    
    if($statement->execute()) {
      $log->debug(__FUNCTION__, array($facebookId, $username, $intFieldId, $ownerName,$intFieldOwner));
      return true;
    } else {
      $log->err($db->error, array($facebookId, $username, $intFieldId, $ownerName,$intFieldOwner));
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
