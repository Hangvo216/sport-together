<?php

 require_once (__DIR__ . '/config.php');
 require_once (__DIR__ . '/Player.php');
 
 

class TargetViewHelper {

	function insertPlayer($playerName, $position, $intTeamId, $fbId, $userName) {
  		global $log;
		$log->addInfo("Call insertPlayer: name: $playerName, position $position, intTeamId: $intTeamId,fbId: $fbId, userName: $userName");

		$player = new Player();
		$player->createPlayer($playerName, $position, $intTeamId, $fbId, $userName);
	}
}
?>