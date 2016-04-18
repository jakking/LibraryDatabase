<?php
session_start();
if($_SESSION['clearence']==1){
	require_once("../includes/inc.header.php");
	require_once("../includes/inc.myaccount.php");
	buildHolds();
	buildCheckedOut();
}
else{
echo '<h1>Access Denied</h1>';
}
?> 
