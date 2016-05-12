<?php
require __DIR__ . "/../TargetViewHelper.php";

$teamInfo = getTeamForPlayer(5);
$jsonTeamInfo = json_encode($temaInfo);
function getTeamForPlayer($playerId) {
	$playerId = 5;
	global $log;
	global $targetViewHelper;
	$teamInfo = $targetViewHelper->getTeamFromPlayer($playerId);
	
	return $teamInfo;
}
?>
<script type="text/javascript">

var Team = new Object();

<?php
global $log;

echo 'Team = ' . $jsonTeamInfo . ';';

?>

</script>

