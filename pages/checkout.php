<?php
session_start();
if(isset($_SESSION['clearence'])){
	if($_SESSION['clearence']>1){
		//after clearence check, start checkout process
		require_once("../includes/inc.checkout.php");
		require_once("../includes/inc.header.php");
		checkout();
	}
	else{
		echo '<h1>ACCESS DENIED</h1>';
	}
}
else{
	echo '<h1>ACCESS DENIED</h1>';
}


?>
