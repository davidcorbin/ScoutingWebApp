<?php

$form = '
<div class="row">
<div class="col-lg-6">
<div class="well">
<form class="form-horizontal" method="post" action="addteam.php" autocomplete="off" onsubmit="return validate();">
<fieldset>
<legend>Add Team</legend>
<div class="form-group">
<label for="inputEmail" class="col-lg-2 control-label">Team Number</label> 
<div class="col-lg-10">
<input type="number" class="form-control" id="teamnumber" placeholder="" name="teamnumber" autocorrect="off">
</div>
</div>
<div class="form-group">
<label for="inputEmail" class="col-lg-2 control-label">Status</label>
<div class="col-lg-10">
<select name="status">
<option value="working" name="working">Working</option>
<option value="fixing">Fixing</option>
<option value="building">Building</option>
</select> 
</div>
</div>
<div class="form-group">
<label for="inputEmail" class="col-lg-2 control-label">Functions</label>
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
<div class="form-group">
<label for="upload" class="col-lg-2 control-label">Upload Image</label> 
<div class="col-lg-10">
<div class="fileUpload">
<input type="file" class="upload btn btn-default" onchange="upload(this.files[0])" style="width:100%; display:none;">
<button class="btn btn-default" type="button" onclick="clickup(); return false;">Upload</button>
<input type="hidden" name="link" id="hiddenlink">
</div>
</div>
</div>
<div class="alert alert-dismissable alert-success" style="display:none;" id="imageuploadsuccess">
<button type="button" class="close" data-dismiss="alert">×</button>
<strong>Successfully</strong> 
uploaded image!
</div>
<div class="form-group">
<label for="textArea" class="col-lg-2 control-label">Comments</label>
<div class="col-lg-10">
<textarea class="form-control" rows="3" id="textArea" name="comments"></textarea>
</div>
</div>
<div class="form-group">
<div class="col-lg-10 col-lg-offset-2">
<input type="submit" class="btn btn-primary">
</div>
</div>
</fieldset>
</form>
</div>
</div>
</div>
<script>
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
		
		</script>
';