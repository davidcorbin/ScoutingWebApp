<?php 

class html {
	// Default HTML template for content
	private function main($content) {
		// Add the html universal template
		include 'html/main.inc';
		
		// Exit, guaranteeing page immediate load
		exit();
	}
	
	// Login page
	public function login($options) {
		include 'html/login.inc';

		if (empty($options)) {
			$this->main($form);
		}
		
		elseif (isset($options['incorrect'])) {
			$this->main($errorincorrect . $form);
		}
	}
	
	// Main page for choosing next page	
	public function choose($data) {
		include 'html/choose.inc';
		if ($data != "") {
			$alert = '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . $data . '</div>';
		}
		
		$this->main($alert . $listgroup);
	}


	// Add team page
	public function addteam($error) {
		include 'html/addteam.inc';
		$this->main($error . $form);
	}
	
	
	// Match scouting page
	public function matchscout($teamselect, $matchnum) {
		include 'html/matchscout.inc';
		$this->main($form);
	}
	
	
	// View teams page
	public function viewteams($data) {
		$this->main($data);
	}
	
	
	// Group chat room page
	public function chat($info) {		
		$this->main($info);
	}
	
	
	// Add user to database page
	public function adduser($error) {
		include 'html/adduser.inc';
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