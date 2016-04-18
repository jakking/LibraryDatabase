<?php
session_start();
if(isset($_SESSION['clearence'])){
	if($_SESSION['clearence']>1){
		//after clearence check, if post is set, insert them into the db
		require_once("../includes/inc.header.php");
		require_once("../includes/inc.insertcustomer.php");
		if(isset($_GET['Name'])){
			require_once("../includes/inc.db.php");
			try {
				$sql = $con->prepare("SELECT id FROM `customer` WHERE `username` = :username");
				$sql->bindParam(':username', $_GET['username']);
				$sql->execute();
				if($sql->rowCount() == 0){
					
				}
				else{
					echo '<h2> Failed. Username taken already.</h2>';
				}
			} catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		else{
			printForm();
		}
	}
	else{
		echo '<h1>ACCESS DENIED</h1>';
	}
}
else{
	echo '<h1>ACCESS DENIED</h1>';
}


?>
