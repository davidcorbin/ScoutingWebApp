<?php

$form = '
<div class="row">
<div class="col-lg-6">
<div class="well">
<form class="form-horizontal" method="post" action="login.php">
<fieldset>
<legend>Login</legend>
<div class="form-group">
<label for="inputEmail" class="col-lg-2 control-label">Username</label>
<div class="col-lg-10"> 
<input type="text" class="form-control" id="inputEmail" placeholder="Username" name="un">
</div>
</div>
<div class="form-group">
<label for="inputPassword" class="col-lg-2 control-label">Password</label>
<div class="col-lg-10">
<input type="password" class="form-control" id="inputPassword" placeholder="Password" name="pw">
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

$errorincorrect = '
<div class="alert alert-dismissable alert-danger">
<button type="button" class="close" data-dismiss="alert">&times;</button>
Incorrect username and/or password!
</div>
';