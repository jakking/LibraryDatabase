<?php
require_once("../includes/inc.header.php");
require_once("../includes/inc.login.php");
?>
<link href="../css/signin.css" rel="stylesheet">

<div class="container" >
	<form class="form-signin" action="login.php" method="POST">
		<h2 class="form-signin-heading">Sign In Below</h2>
        <label for="inputUser" class="sr-only">Username: </label>
        <input type="text" id="inputUser" class="form-control" name="username" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password: </label>
        <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
        <input type="submit" class="btn btn-lg btn-primary btn-block" name="login" value="Login">
	</form>
</div>

