<?php
/*	
	SUMMARY
	
	Elegant handling of a user's account context.
	
	----------------------------------------  */
	
	global $Fizzy;
	
	// Gets the new account-id.
	$id = $_GET['i'];
	
	// Set-up the default starting time-frame (30-days).	
	$now = time();
	$end = $now;
	$start = $now-7776000;
	
	$Fizzy->loadAccountData($id,$id,$start,$end);
	
	// Reset the controller.
	$Fizzy->ctrlrInit();
	
	// Tell the system that we are still logged-in.
	$Fizzy->loggedIn = true;
?>
