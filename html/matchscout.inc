<?php

$form = '

<div class="row">
	<div class="col-lg-6">
		<div class="well">
			<form class="form-horizontal" method="post" action="matchscout.php" autocomplete="off">
				<fieldset>
					<legend>Autonomous</legend>
					<div class="form-group">
						<label for="teamnumber" class="col-lg-2 control-label">Team Number</label>
						<div class="col-lg-10">
 							<input type="number" class="form-control" placeholder="" name="teamnumber" autocorrect="off">
						</div>
					</div>
					
					' . $teamselect . '
                
					<div class="form-group">
						<label class="col-lg-2 control-label">Upload Image</label>
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