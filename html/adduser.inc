<?php

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