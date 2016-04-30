<?php
class TargetViewHelper {

	function insertPlayer($playerName, $position, $intTeamId, $fbId, $userName) {

		$log->addInfo("Call insertPlayer: name: $playerName, position $position, intTeamId: $intTeamId,fbId: $fbId, userName: $userName");

		$player = new Player();

		$fbHistoryPosts = $player::mergeFanToPostsGeneric($graph, $return, $fanCountDataMap, $startDateTime, $endDateTime, $slice, 'fb');
		$log->addInfo("Call getPageData END");
	}
}
?>