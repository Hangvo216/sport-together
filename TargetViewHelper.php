<?php

 require_once (__DIR__ . '/config.php');
 require_once (__DIR__ . '/model/Player.php');
 require_once (__DIR__ . '/model/Team.php');
 require_once (__DIR__ . '/model/SoccerField.php');
 require_once (__DIR__ . '/model/Game.php');
 require_once (__DIR__ . '/model/FieldOwner.php');
 require_once (__DIR__ . '/util/Util.php');
 
 
class TargetViewHelper {

	public function insertPlayer($playerName, $position, $intTeamId, $fbId, $userName) {
  		global $log;
		$log->addInfo("Call TVH insertPlayer: name: $playerName, position $position, intTeamId: $intTeamId,fbId: $fbId, userName: $userName");

		$player = new Players();
		$player->insertPlayer($playerName, $position, $intTeamId, $fbId, $userName);
	}
	
	public function createPlayer($playerId, $position) {
	 global $log;
	 $log->addInfo("Call TVH createPlayer: $playerId position $position");
	
	 $player = new Players();
	 $player->createPlayer($playerId, $position);
	}
	
	public function createTeam($teamName, $desc) {
		global $log;
		$log->addInfo("Call TVH createTeam: name: $teamName, desc $desc");
	
		$team = new Team();
		return $team->createTeam($teamName, $desc);	
	}
	
	public function updateTeamForPlayer($intUserId, $teamId) {
		global $log;
		$log->addInfo("Call TVH updateTeamForPlayer: user id: $intUserId, team id $teamId");
		$player = new Players();
		$player->updateTeamForPlayer($intUserId, $teamId);
	}
	
	public function getTeamFromPlayer($playerId, $teamId) {
		global $log;
		$log->addInfo("Call TVH TVH getTeamFromPlayer: player id: $playerId, $teamId");
		$player = new Players();
		$team = $player->getTeam( $playerId, $teamId);
		$team = Util::toArray($team);
		return $team;
	}
	
	public function getPlayerInfo($playerId) {
	  global $log;
    	$log->addInfo("Call TVH  getPlayerInfo: player id: $playerId");
    	$player = new Players();
    	$playerInfo = $player->getPlayerInfo( $playerId);
//     	$playerInfo = Util::toArray($playerInfo);		
    	return $playerInfo;
	}
	
	public function createGame ($teamId, $type,  $datePlayed,  $timePlayed, $message){
		global $log;
		$log->addInfo("Call TVH createGame: $teamId, $type, $datePlayed, $timePlayed, $message");
		$game = new Game();
		$team = $game->createGame( $teamId, $type, $datePlayed, $timePlayed, $message);
	}
	
	public function getGames($teamId) {
		global $log;
		$log->addInfo("Call TVH getGames: team id: $teamId");
		$gameD = new Game();
		$game = $gameD->getGameFromTeamId( $teamId);
		$game = Util::toArray($game);
		return $game;
	}
	
	public function getFindGames($teamId) {
		global $log;
		$log->addInfo("Call TVH getFindGames: team id: $teamId");
		$gameD = new Game();
		$game = $gameD->getFindGameFromTeamId( $teamId);
		$game = Util::toArray($game);
		return $game;
	}
	
	public function getScheduledGames($teamId) {
		global $log;
		$log->addInfo("Call TVH getScheduledGames: team id: $teamId");
		$gameD = new Game();
		$game = $gameD->getScheduledGameFromTeamId( $teamId);
		$game = Util::toArray($game);
		return $game;
	}
	
	public function getDoneGames($teamId) {
		global $log;
		$log->addInfo("Call TVH getDoneGames: team id: $teamId");
		$gameD = new Game();
		$game = $gameD->getDoneGameFromTeamId( $teamId);
		$game = Util::toArray($game);
		return $game;
	}
	
	public function getTeamStatistic($teamId) {
	 global $log;
	 $log->addInfo("Call TVH getTeamStatistic: team id: $teamId");
	 $teamModel = new Team();
	 $team = $teamModel->getTeamStatFromTeamId( $teamId);
// 	 $game = Util::toArray($game);
	 return $team;
	}
	
	public function getAllTeams() {
	 global $log;
	 $team = new Team();
	 $allTeams = $team->getAllTeams();
	 $allTeams = Util::toArray($allTeams);
	 return $allTeams;
	}
	
	public function joinTeamRequest($teamId, $playerId) {
	 global $log;
	 $team = new Team();
	 $allTeams = $team->joinTeamRequest($teamId, $playerId);
// 	 $allTeams = Util::toArray($allTeams);
// 	 return $allTeams;
	}
	
	public function createTeam1($playerId, $teamName) {
	 global $log;
	 $player = new Player();
	 $allTeams = $player->createTeam($playerId, $teamName);
	}
}
?>