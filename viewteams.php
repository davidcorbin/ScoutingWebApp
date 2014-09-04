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

$table = "<div style='overflow:auto;' class='table-responsive'><table class='table table-striped' >
<thead>
<tr>
<th>Image</th>
<th>#</th>
<th>Status</th>
<th>High Goal</th>
<th>Low Goal</th>
<th>Passing</th>
<th>Receiving</th>
<th>Truss</th>
<th>Auto. High</th>
<th>Auto. Low</th>
<th>Two Ball Auto</th>
<th>Comments</th>
</tr>
</thead><tbody>";

$result = $database->fetch("SELECT * FROM teams");

for ($i = 0; $i < count($result); $i++) {

	foreach ($result[$i] as $key => $a) {
		if ($a === "0") {
			$result[$i][$key] = "No";
		}
		
		if ($a === "1") {
			$result[$i][$key] = "Yes";
		}
	}

	$table  .= "<tr>
<td><a href='" . $result[$i]['image'] . "'><img src='".$result[$i]['image']."' style='max-height:100px; max-width:100px;'></a></td>
<td>".$result[$i]['number']."</td>
<td>".$result[$i]['status']."</td>
<td>". $result[$i]['highgoal']."</td>
<td>".$result[$i]['lowgoal']."</td>
<td>".$result[$i]['passing']."</td>
<td>".$result[$i]['receiving']."</td>
<td>".$result[$i]['truss']."</td>
<td>".$result[$i]['autohigh']."</td>
<td>".$result[$i]['autolow']."</td>
<td>".$result[$i]['twoballauto']."</td>
<td>".$result[$i]['comments']."</td>
</tr>";
}

$table .= "</tbody></table></div>

";

$html->viewteams($table);

?>