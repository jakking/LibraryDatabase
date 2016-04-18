<?php
session_start();
if(isset($_SESSION['clearence'])){
	if($_SESSION['clearence']>1){
		//after clearence check, start checkout table process
		require_once("../includes/inc.checkintable.php");
		require_once("../includes/inc.header.php");
		checkinTable();
	}
	else{
		echo '<h1>ACCESS DENIED</h1>';
	}
}
else{
	echo '<h1>ACCESS DENIED</h1>';
}


?>
