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

// Query database
$result = $database->fetch("SELECT number FROM teams");

// Create team select element from database values
$teamselect = '
<div class="form-group">
	<label for="status" class="col-lg-2 control-label">Teams</label>
	<div class="col-lg-10">
		<select name="status">
';
for ($i = 0; $i < count($result); $i++) {
	$teamselect .= '<option name="'.$result[$i]['number'].'">'.$result[$i]['number'].'</option>';
}
$teamselect .= '
		</select>
	</div>
</div>
';

$html->matchscout($teamselect);
?>