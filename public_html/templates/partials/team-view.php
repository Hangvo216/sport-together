<?php
session_start();
$teamId = $_SESSION["user"]["team_id"];

if(isset($teamId)) {
	include(__DIR__ .'/team-profile.php');
}else {
	include(__DIR__ .'/new-team.php');
}
?>