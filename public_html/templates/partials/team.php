<?php
require __DIR__ . "/../TargetViewHelper.php";

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$teamName = $request->teamName;
$teamDesc = $request->description;



$targetViewHelper = new TargetViewHelper();
$a = $targetViewHelper->createTeam($teamName, $teamDesc);
global $log;
$log->addInfo($teamName);
$log->addInfo($teamDesc);


function getTeamForPlayer($playerId) {
	
	global $log;
	global $targetViewHelper;
	
	
	
	
}

?>