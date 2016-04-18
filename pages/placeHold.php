<?php
session_start();
	if(isset($_SESSION['clearence'])){
		require_once("../includes/inc.header.php");
		require_once("../includes/inc.placeHold.php");
		if(isset($_GET['id'])){
			processHold();
		}else{
			echo '<h1>No book selected.</h1>';
		}
	}else{
		echo '<h1>ACCESS DENIED</h1>';
	}

?>
