<?php
session_start();

require_once("../includes/inc.cancelhold.php");
if(isset($_SESSION['clearence'])){
	if($_SESSION['clearence']>1){
		require_once("../includes/inc.header.php");
		cancelHold();
	}
	else{
		echo '<h1>ACCESS DENIED</h1>';
	}
}
else{
	echo '<h1>ACCESS DENIED</h1>';
}

?>
