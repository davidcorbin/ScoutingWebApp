<?php
$lifetime=86400; //24 hours
session_start(); //Start session
setcookie(session_name(), session_id(), time() + $lifetime); //CORRECT  SESSION TIMING! The session will always reset the timing every time the page is refreshed or changes. 

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

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
	$database->query("INSERT INTO `chat`(`data`, `user`, `date`) VALUES ('" . $_POST['sendbutton'] . "','" . $_SESSION['un'] . "','" . time() . "')");
}


elseif (!empty($_GET)) {
function timeconvert($ptime) { 
    $etime = time() - $ptime;

    if ($etime < 1) {
        return '0 seconds';
    }

    $a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
                );

    foreach ($a as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
        }
    }
}

	$chat = $database->fetch("SELECT * FROM `chat` ORDER BY date DESC LIMIT 15");
	
	for ($i = 0; $i < count($chat); $i++) {

		if ($chat[$i]['user'] == $_SESSION['un']) {
			echo '<li class="right clearfix"><span class="chat-img pull-right"><img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" /></span><div class="chat-body clearfix"><div class="header"><strong class="primary-font">';
			echo $chat[$i]['user'];
			echo '</strong><small class="pull-right text-muted"> <span class="glyphicon glyphicon-time"></span>';
			echo timeconvert($chat[$i]['date']);
			echo '</small></div><p>';
			echo $chat[$i]['data'];
			echo '</p></div></li>';
		}
		
		
		else {
			echo '<li class="left clearfix"><span class="chat-img pull-left"><img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" /></span><div class="chat-body clearfix"><div class="header"><small class=" text-muted"><span class="glyphicon glyphicon-time"></span>';
			echo timeconvert($chat[$i]['date']);
			echo '</small><strong class="pull-right primary-font">';
			echo $chat[$i]['user'];
			echo '</strong></div><p>';
			echo $chat[$i]['data'];
			echo '</p></div></li>';
		}		
	}
}

else {

$info = '
   <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Chat
                </div>
                <div class="panel-body">
                    <ul class="chat">





                    </ul>
                </div>
                <div class="panel-footer">
<form method="post" action="chat.php" onsubmit="return send(this);">
                    <div class="input-group">
                        <input name="sendbutton" id="sendbutton" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                        <span class="input-group-btn">
                            <button class="btn btn-warning btn-sm" id="btn-chat">Send</button>
                        </span>
                    </div>
</form>
                </div>
            </div>
        </div>
    </div>

        <script type="text/javascript">
        	
            var send = function(formEl) {
            	if (document.getElementById("sendbutton").value == "") {
            		return false;
            	}

                var url = $(formEl).attr("action");

                var data = $("#sendbutton").serializeArray();

                $.ajax({
                    url: url,
                    data: data,
                    type: "post",
                    success: function() {
                        document.getElementById("sendbutton").value = "";
                    }
                });

                return false;
            }

            var get = function() {

                $.ajax({
                    url: "chat.php",
                    data: "Update",
                    type: "get",
                    cache: "false",
                    success: function(data) {
                        $(".chat").html(data);
                    }
                });

                return false;
            }

setInterval(function(){get();},3000);
window.onload = function(){get();}
        </script>
    
    <style>
    .chat 
{
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat li
{
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
}

.chat li.left .chat-body
{
    margin-left: 60px;
}

.chat li.right .chat-body
{
    margin-right: 60px;
}


.chat li .chat-body p
{
    margin: 0;
    color: #777777;
}

.panel .slidedown .glyphicon, .chat .glyphicon
{
    margin-right: 5px;
}

.panel-body
{
    overflow-y: scroll;
    height: 250px;
}

::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}
    </style>'; 


$html->chat($info);
}


?>