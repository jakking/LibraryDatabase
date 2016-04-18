<?php
require_once("../includes/inc.db.php");

function cancelHold(){
	$con = connect();
	try {
		$sql = $con->prepare("UPDATE litlookup SET checkedOut=false where id = :id");
		$sql->bindParam(':id', $_GET['id']);
		$sql->execute();
		$sql = $con->prepare("DELETE FROM holds where litLookUpID = :bookid");
		$sql->bindParam(':bookid', $_GET['id']);
		$sql->execute();
		echo '
		<h2>Hold deleted successfully!</h2>
		';
	}catch(PDOException $e){
       echo $e->getMessage();
	}
	
}


?>
