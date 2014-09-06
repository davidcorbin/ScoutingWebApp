<?php
class html {
	//Default HTML template for content
	private function main($content) {
		echo '<!DOCTYPE html><html lang="en"><head><style>body {padding-top:70px !important;}</style><meta charset="utf-8"><title>Titanium Titans Scouting</title><meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"><link rel="stylesheet" href="css/bootstrap.css" media="screen"><link rel="stylesheet" href="css/bootswatch.min.css"><!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries --><!--[if lt IE 9]><script src="js/html5shiv.js"></script><script src="js/respond.min.js"></script><script src="http://cdnjs.cloudflare.com/ajax/libs/fastclick/0.6.7/fastclick.min.js"></script><![endif]--></head><body><div class="navbar navbar-default navbar-fixed-top"><div class="container"><div class="navbar-header"><a href="choose.php" class="navbar-brand">Titanium Titans Scouting</a>



</div></div></div><div class="container" id="maincontainer">' . $content . '</div><script src="https://code.jquery.com/jquery-1.10.2.min.js"></script><script src="js/bootstrap.min.js"></script><script src="js/bootswatch.js"></script></body></html>';
	}
	
	
	
	public function login($options) {
		$form = '<div class="row"><div class="col-lg-6"><div class="well"><form class="form-horizontal" method="post" action="login.php"><fieldset><legend>Login</legend><div class="form-group"><label for="inputEmail" class="col-lg-2 control-label">Username</label><div class="col-lg-10"> <input type="text" class="form-control" id="inputEmail" placeholder="Username" name="un"></div></div><div class="form-group"><label for="inputPassword" class="col-lg-2 control-label">Password</label><div class="col-lg-10"><input type="password" class="form-control" id="inputPassword" placeholder="Password" name="pw"></div></div><div class="form-group"><div class="col-lg-10 col-lg-offset-2"><button type="submit" class="btn btn-primary">Submit</button></div></div></fieldset></form></div></div></div>';

$errorincorrect = '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Incorrect username and/or password!</div>';

		if (empty($options)) {
			$this->main($form);
		}
		
		elseif (isset($options['incorrect'])) {
			$this->main($errorincorrect . $form);
		}
	}
	
	
	
	public function choose($data) {
		if ($data != "") {
			$alert = '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . $data . '</div>';
		}
		
		$listgroup = '<div class="list-group"> 
		<a href="chat.php" class="list-group-item"> <h4 class="list-group-item-heading">Chat</h4> <p class="list-group-item-text">Just a group chat</p></a>
		<a href="addteam.php" class="list-group-item"> <h4 class="list-group-item-heading">Add Team</h4> <p class="list-group-item-text">Fill in information and upload an image about a team</p> </a> 
		<a href="viewteams.php" class="list-group-item"> <h4 class="list-group-item-heading">View Teams</h4> <p class="list-group-item-text">See a list of the added teams</p> </a>
		<a href="matchscout.php" class="list-group-item"> <h4 class="list-group-item-heading">Match Scout</h4> <p class="list-group-item-text">Keep statistics about teams</p> </a>
		<a href="adduser.php" class="list-group-item"> <h4 class="list-group-item-heading">Add User</h4> <p class="list-group-item-text">Add user to database</p> </a>
		<a href="sql.php" class="list-group-item"> <h4 class="list-group-item-heading">SQL Terminal</h4> <p class="list-group-item-text">Control the database</p> </a>
		</div>';
		$this->main($alert . $listgroup);
	}



	public function addteam($error) {
		$form = '<div class="row"><div class="col-lg-6"><div class="well"><form class="form-horizontal" method="post" action="addteam.php" autocomplete="off" onsubmit="return validate();"><fieldset><legend>Add Team</legend><div class="form-group"><label for="inputEmail" class="col-lg-2 control-label">Team Number</label> <div class="col-lg-10"><input type="number" class="form-control" id="teamnumber" placeholder="" name="teamnumber" autocorrect="off"></div></div><div class="form-group"><label for="inputEmail" class="col-lg-2 control-label">Status</label><div class="col-lg-10"><select name="status"><option value="working" name="working">Working</option><option value="fixing">Fixing</option><option value="building">Building</option></select> </div></div><div class="form-group"><label for="inputEmail" class="col-lg-2 control-label">Functions</label><div class="col-lg-10"><input type="checkbox" name="highgoal">&nbsp;High Goal<br><input type="checkbox" name="lowgoal">&nbsp;Low Goal<br><input type="checkbox" name="passing">&nbsp;Passing<br><input type="checkbox" name="receiving">&nbsp;Receiving<br><input type="checkbox" name="truss">&nbsp;Truss<br><input type="checkbox" name="autohigh">&nbsp;Auto High<br><input type="checkbox" name="autolow">&nbsp;Auto Low<br><input type="checkbox" name="tbauto">&nbsp;Two Ball Auto<br></div></div><div class="form-group"><label for="upload" class="col-lg-2 control-label">Upload Image</label> <div class="col-lg-10"><div class="fileUpload"><input type="file" class="upload btn btn-default" onchange="upload(this.files[0])" style="width:100%; display:none;"><button class="btn btn-default" type="button" onclick="clickup(); return false;">Upload</button><input type="hidden" name="link" id="hiddenlink"></div></div></div><div class="alert alert-dismissable alert-success" style="display:none;" id="imageuploadsuccess"><button type="button" class="close" data-dismiss="alert">×</button><strong>Successfully</strong> uploaded image!</div><div class="form-group"><label for="textArea" class="col-lg-2 control-label">Comments</label><div class="col-lg-10"><textarea class="form-control" rows="3" id="textArea" name="comments"></textarea></div></div><div class="form-group"><div class="col-lg-10 col-lg-offset-2"><input type="submit" class="btn btn-primary"></div></div></fieldset></form></div></div></div><script>
		function upload(file) {
			if (!file || !file.type.match(/image.*/)) return;
			var fd = new FormData();
			fd.append("image", file);
			fd.append("key", "6528448c258cff474ca9701c5bab6927");
			var xhr = new XMLHttpRequest();
			xhr.open("POST", "http://api.imgur.com/2/upload.json");
			xhr.onload = function() {
				document.getElementById("hiddenlink").value = JSON.parse(xhr.responseText).upload.links.original;
				document.getElementById("imageuploadsuccess").style.display = "block";
			}
			xhr.send(fd);
		}
		
		function validate(){
			if (document.getElementById("teamnumber").value == "") {
				document.getElementById("maincontainer").innerHTML = \'<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><span class="glyphicon glyphicon-floppy-remove"></span>&nbsp;&nbsp; Please add a team number.</div>\' + document.getElementById("maincontainer").innerHTML ;
				window.scrollTo(0,0);
				return false;
			}
			
			if (isNaN(document.getElementById("teamnumber").value)) {
				document.getElementById("maincontainer").innerHTML = \'<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><span class="glyphicon glyphicon-floppy-remove"></span>&nbsp;&nbsp; The team number needs to be a number.</div>\' + document.getElementById("maincontainer").innerHTML ;
				window.scrollTo(0,0);
				return false;
			}			
			return true;
		}
		
		function clickup() {
			document.getElementsByClassName("upload")[0].click();
		}
		
		</script>';
		$this->main($error . $form);
	}
	
	

	public function matchscout() {
		$form = '
	
	      <div class="row">
        <div class="col-lg-6">
          <div class="well">
            <form class="form-horizontal" method="post" action="addteam.php" autocomplete="off">
              <fieldset>
                <legend>Match Scout</legend>
                <div class="form-group">
                  <label for="inputEmail" class="col-lg-2 control-label">Team Number</label>
                  <div class="col-lg-10">
                    <input type="number" class="form-control" id="inputEmail" placeholder="" name="teamnumber" autocorrect="off">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail" class="col-lg-2 control-label">Status</label>
                  <div class="col-lg-10">
                    <select name="status"><option value="working" name="working">Working</option><option value="fixing">Fixing</option><option value="building">Building</option></select>
                  </div>
                </div>
                
                
                
                <div class="form-group">
                  <label for="inputEmail" class="col-lg-2 control-label">Upload Image</label>
                  <div class="col-lg-10">
                <input type="checkbox" name="highgoal">&nbsp;High Goal<br>
                <input type="checkbox" name="lowgoal">&nbsp;Low Goal<br>
                <input type="checkbox" name="passing">&nbsp;Passing<br>
                <input type="checkbox" name="receiving">&nbsp;Receiving<br>
                <input type="checkbox" name="truss">&nbsp;Truss<br>
                <input type="checkbox" name="autohigh">&nbsp;Auto High<br>
                <input type="checkbox" name="autolow">&nbsp;Auto Low<br>
                <input type="checkbox" name="tbauto">&nbsp;Two Ball Auto<br>
                                  </div>
                </div>

         

                <!--<div class="form-group">
                  <label for="upload" class="col-lg-2 control-label">Upload Image</label>
                  <div class="col-lg-10">
                    <div class="fileUpload">
                <input type="file" class="upload" onchange="upload(this.files[0])">
                <input type="hidden" name="link" id="link">
                </div>
                  </div>
                </div>//-->

                <div class="form-group">
			    	<label for="textArea" class="col-lg-2 control-label">Comments</label>
			    	<div class="col-lg-10">
			        	<textarea class="form-control" rows="3" id="textArea"></textarea>
			        </div>
			    </div>
			    
                <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn btn-primary">Submit</button>       
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
	
      	';
		$this->main($form);
	}
	
	
	
	public function viewteams($data) {
		$this->main($data);
	}
	
	
	
	public function chat($info) {		
		$this->main($info);
	}
	
	
	
	public function adduser($error) {
		$form = '
	
	      <div class="row">
        <div class="col-lg-6">
          <div class="well">
            <form class="form-horizontal" method="post" action="adduser.php" autocomplete="off">
              <fieldset>
                <legend>Add User</legend>
                <div class="form-group">
                  <label for="username" class="col-lg-2 control-label">Username</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" placeholder="" name="username" autocorrect="off">
                  </div>
                </div>

                <div class="form-group">
                  <label for="username" class="col-lg-2 control-label">Password</label>
                  <div class="col-lg-10">
                    <input type="password" class="form-control" placeholder="" name="password" autocorrect="off">
                  </div>
                </div>
			    
                <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn btn-primary">Create</button>       
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
	
      	';
		$this->main($error . $form);
	}

	public function sql($response) {
		$form = '
	
	      <div class="row">
        <div class="col-lg-6">
          <div class="well">
            <form class="form-horizontal" method="post" action="sql.php" autocomplete="off">
              <fieldset>
                <legend>SQL Terminal</legend>
                <div class="form-group">
                  <label for="sql" class="col-lg-2 control-label">SQL Script</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" placeholder="" name="sql" autocorrect="off">
                  </div>
                </div>
			    
                <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn btn-primary">Execute</button>       
                  </div>
                </div>
              </fieldset>
            </form>
<hr>' . $response . '

          </div>
        </div>
      </div>
	
      	';
		$this->main($form);
	}

}
?>