<?php
session_start();

require_once("../includes/inc.viewholds.php");
if(isset($_SESSION['clearence'])){
	//if librarian or manager
	if($_SESSION['clearence']>1){
		require_once("../includes/inc.header.php");
		getHolds();
	}
	else{
		echo '<h1>ACCESS DENIED</h1>';
	}
}
else{
	echo '<h1>ACCESS DENIED</h1>';
}

?>
