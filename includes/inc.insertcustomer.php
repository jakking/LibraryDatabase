<?php
function printForm(){
	echo'
	<link href="../css/insert.form.css" rel="stylesheet">

	<div class="container" >
		<form class="form-signin" action="insertcustomer.php" method="POST">
			<h2 class="form-signin-heading">Insert information about customer below.</h2>
			<label for="inputName" class="sr-only">Name: </label>
			<input type="text" id="inputName" class="form-control" name="Name" placeholder="First Name Last Name" required autofocus>
			<label for="address" class="sr-only">Address: </label>
			<input type="text" id="address" class="form-control" name="Address" placeholder="Address" required autofocus>
			<label for="email" class="sr-only">Email: </label>
			<input type="text" id="email" class="form-control" name="Email" placeholder="Email" required autofocus>
			<label for="inputUser" class="sr-only">Username: </label>
            <input type="text" id="inputUser" class="form-control" name="username" placeholder="Username" required autofocus>
			<label for="inputPassword" class="sr-only">Password: </label>
			<input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
			<input type="submit" class="btn btn-lg btn-primary btn-block" name="login" value="Login">
		</form>
	</div>
		';
	
}


?>
