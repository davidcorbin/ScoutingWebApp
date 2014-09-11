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

//If there is form data being sent
if (!empty($_POST)) {
	$rows = $database->rows("SELECT * FROM `teams` WHERE number = '" . $_POST['teamnumber'] . "'");
	
	//If there is no team number
	if ($_POST['teamnumber'] == "") {
		$html->addteam('<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><span class="glyphicon glyphicon-floppy-remove"></span>&nbsp;&nbsp; Please add a team number.</div>');
	}
	
	elseif ($rows == 1) {
		$html->addteam('<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><span class="glyphicon glyphicon-floppy-remove"></span>&nbsp;&nbsp; Team already added.</div>');
	}
	
	//Then do the database query
	else {
		$a = isset($_POST["highgoal"]) ? 1 : 0;
		$b = isset($_POST["lowgoal"]) ? 1 : 0;
		$c = isset($_POST["passing"]) ? 1 : 0;
		$d = isset($_POST["receiving"]) ? 1 : 0;
		$e = isset($_POST["truss"]) ? 1 : 0;
		$f = isset($_POST["autohigh"]) ? 1 : 0;
		$g = isset($_POST["autolow"]) ? 1 : 0;
		$h = isset($_POST["tbauto"]) ? 1 : 0;
		
		// Make sure there is a string using a space
		if ($_POST["link"] == "") 
			$_POST["link"] = " ";
		if ($_POST["comments"] == "") 
			$_POST["comments"] = " ";
		
		$database->query("INSERT INTO teams(number, name, status, highgoal, lowgoal, passing, receiving, truss, autohigh, autolow, twoballauto, image, comments) VALUES (" . $_POST["teamnumber"] . ",'" . $_POST["teamname"] . "','" .  $_POST["status"] . "'," . $a . "," . $b . "," . $c . "," . $d . "," . $e . "," . $f . "," . $g . "," . $h . ",'" . $_POST["link"] . "','" . addslashes($_POST["comments"]) . "')");
		$html->choose("<span class='glyphicon glyphicon-floppy-saved'></span>&nbsp;&nbsp; Successfully added team");
	}
}
else {
	$html->addteam("");
}

?>