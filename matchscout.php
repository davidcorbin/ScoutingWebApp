<?php
$lifetime=86400; //24 hours
session_start(); //Start session
setcookie(session_name(), session_id(), time() + $lifetime); //CORRECT  SESSION TIMING! The session will always reset the timing every time the page is refreshed or changes. 

//Check for session vars
if (!isset($_SESSION['un']) || !isset($_SESSION['pw'])) {
	header("Location: login.php");
	die();
}

require_once('class.db.php');
$database = new db;

require_once('class.html.php');
$html = new html;

//Authorize session credentials
$check = $database->auth($_SESSION["un"], $_SESSION["pw"]);
if (!isset($check)) {
	header("Location: login.php");
	die();
}

if (!empty($_POST)) {
	print_r($_POST);
	
	$autohigh = isset($_POST["highgoal"])?1:0;
	$autolow = isset($_POST["lowgoal"])?1:0;
	$twoball = isset($_POST["twoball"])?1:0;
	$forward = isset($_POST["driveforward"])?1:0;
	$defended = isset($_POST["defense"])?1:0;
	
	//echo "INSERT INTO match ('number', 'autohigh', 'autolow', 'twoball', 'forward', 'defended', 'highgoals', 'lowgoals', 'truss', 'comments') VALUES (".$_POST["team"].",".$autohigh.",".$autolow.",".$twoball.",".$forward.",".$defended.",".$_POST["highgoals"].",".$_POST["lowgoals"].",".$_POST["trusss"].",'".$_POST["comments"]."')";
	
	$database->query("INSERT INTO match_data (number, autohigh, autolow, twoball, forward, defended, highgoals, lowgoals, truss, comments) VALUES (".$_POST["team"].",".$autohigh.",".$autolow.",".$twoball.",".$forward.",".$defended.",".$_POST["highgoals"].",".$_POST["lowgoals"].",".$_POST["trusss"].",'".$_POST["comments"]."')");
}

// Query database
$result = $database->fetch("SELECT number, name FROM teams ORDER BY number");

// Create team select element from database values
$teamselect = '
<div class="form-group">
	<label for="team" class="col-lg-2 control-label">Team</label>
	<div class="col-lg-10">
		<select name="team">
';
for ($i = 0; $i < count($result); $i++) {
	$teamselect .= '<option name="'.$result[$i]['number'].'">'.$result[$i]['number']/*.' - '.$result[$i]['name']*/.'</option>';
}
$teamselect .= '
		</select>
	</div>
</div>
';

$html->matchscout($teamselect);
?>