<?php
	//Force redirect to login
	header("Location: login.php");
	
	//Kill the process (forcing immediate redirect)
	die();
?>