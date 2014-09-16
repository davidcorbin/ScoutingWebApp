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

$table = "<div style='overflow:auto;' class='table-responsive'><table class='table table-striped'>
<thead>
<tr>
<th>Match</th>
<th>Team</th>
<th>Auto. High</th>
<th>Auto. Low</th>
<th>Two Ball Auto</th>
<th>Auto. Forward</th>
<th>Defended</th>
<th>High Goals</th>
<th>Low Goals</th>
<th>Truss</th>
<th>Comments</th>
</tr>
</thead><tbody>";

$result = $database->fetch("SELECT * FROM match_data");

for ($i = 0; $i < count($result); $i++) {

	foreach ($result[$i] as $key => $value) {
		if ($key === "autohigh" || $key === "autolow" || $key === "twoball" || $key === "forward" || $key === "defended") {
			if ($value === "0") {
				$result[$i][$key] = "No";
			}
		
			if ($value === "1") {
				$result[$i][$key] = "Yes";
			}
		}
	}

	$table  .= "<tr>
<td>".$result[$i]['match']."</td>
<td>".$result[$i]['number']."</td>
<td>".$result[$i]['autohigh']."</td>
<td>".$result[$i]['autolow']."</td>
<td>".$result[$i]['twoball']."</td>
<td>".$result[$i]['forward']."</td>
<td>".$result[$i]['defended']."</td>
<td>".$result[$i]['highgoals']."</td>
<td>".$result[$i]['lowgoals']."</td>
<td>".$result[$i]['truss']."</td>
<td>".$result[$i]['comments']."</td>
</tr>";
}

$table .= "</tbody></table></div>";

$html->viewteams($table);

?>