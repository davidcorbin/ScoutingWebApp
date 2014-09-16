<?php

$form = '

<div class="row">
	<div class="col-lg-6">
		<div class="well">
			<form class="form-horizontal" method="post" action="matchscout.php" autocomplete="off" onsubmit="return validate();">
				<fieldset>
					<legend>Match Scout</legend>
					
					' . $teamselect . '
					
					<div class="form-group">
						<label class="col-lg-2 control-label">Match Number</label>
						<div class="col-lg-10">
							<input type="number" name="match" class="form-control" value="'.$matchnum.'">
						</div>
					</div>
					
					<br><legend>Autonomous</legend>
					
					<div class="form-group">
						<label class="col-lg-2 control-label">Points</label>
						<div class="col-lg-10">
							<input type="checkbox" name="highgoal">&nbsp;High Goal<br>
							<input type="checkbox" name="lowgoal">&nbsp;Low Goal<br>
							<input type="checkbox" name="twoball">&nbsp;Two Ball<br>
							<input type="checkbox" name="driveforward">&nbsp;Drive Forward<br>
							<input type="checkbox" name="defense">&nbsp;Defended<br>
						</div>
					</div>
					
					<br><legend>Teleoperated</legend>
					
					<p><strong>High Goals</strong></p>
					<div class="btn-group btn-group-justified">
						<div class="btn btn-default" id="highdec">-</div>
						<div class="btn btn-default" id="highgoals">0</div>
						<input type="hidden" value="0" name="highgoals" id="highgoals">
						<div class="btn btn-default" id="highinc">+</div>
					</div>
					<br>
					<p><strong>Low Goals</strong></p>
					<div class="btn-group btn-group-justified">
						<div class="btn btn-default" id="lowdec">-</div>
						<div class="btn btn-default" id="lowgoals">0</div>
						<input type="hidden" value="0" name="lowgoals" id="lowgoals">
						<div class="btn btn-default" id="lowinc">+</div>
					</div>
					<br>
					<p><strong>Truss</strong></p>
					<div class="btn-group btn-group-justified">
						<div class="btn btn-default" id="trussdec">-</div>
						<div class="btn btn-default" id="trusss">0</div>
						<input type="hidden" value="0" name="trusss" id="trusss">
						<div class="btn btn-default" id="trussinc">+</div>
					</div>
					
					<div class="form-group">
						<label for="textArea" class="col-lg-2 control-label">Comments</label>
						<div class="col-lg-10">
							<textarea class="form-control" rows="3" id="textArea" name="comments"></textarea>
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

<script>

function validate() {
	if (parseInt(document.getElementById("highgoals").innerHTML) < 0 || parseInt(document.getElementById("lowgoals").innerHTML) < 0 || parseInt(document.getElementById("trusss").innerHTML) < 0) {
		return false;
	}
	
	return true;
}

function dec(elem) {
	document.getElementById(elem).innerHTML = parseInt(document.getElementById(elem).innerHTML) - 1;
	document.getElementsByName(elem)[0].value = parseInt(document.getElementById(elem).innerHTML);
}

function increm(elem) {
	document.getElementById(elem).innerHTML = parseInt(document.getElementById(elem).innerHTML) + 1;
	document.getElementsByName(elem)[0].value = parseInt(document.getElementById(elem).innerHTML);
}

window.onload = function() {
	var clicktest = "ontouchstart" in window ? "touchend" : "click";
	document.getElementById("highdec").addEventListener(clicktest, function(){dec("highgoals");}, false);
	
	document.getElementById("highinc").addEventListener(clicktest, function(){increm("highgoals");}, false);
	
	document.getElementById("lowdec").addEventListener(clicktest, function(){dec("lowgoals");}, false);
	
	document.getElementById("lowinc").addEventListener(clicktest, function(){increm("lowgoals");}, false);
	
	document.getElementById("trussdec").addEventListener(clicktest, function(){dec("trusss");}, false);
	
	document.getElementById("trussinc").addEventListener(clicktest, function(){increm("trusss");}, false);
}
</script>
';