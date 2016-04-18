<?php
session_start();
if(isset($_SESSION['clearence'])){
	if($_SESSION['clearence']>1){
		//after clearence check, start checkout table process
		require_once("../includes/inc.header.php");
		require_once("../includes/inc.db.php");
		$con = connect();
		try {
			$sql = $con->prepare("UPDATE litlookup SET checkedOut=false where id = :id");
			$sql->bindParam(':id', $_GET['id']);
			$sql->execute();
			$sql = $con->prepare("UPDATE customerborrows SET checkinDATE = '" .  date("Y/m/d") . "' where custID = :custid AND litlookupID = :litid");
			$sql->bindParam(':custid', $_GET['customerid']);
			$sql->bindParam(':litid', $_GET['id']);
			$sql->execute();
			echo '
			<h2>Hold deleted successfully!</h2>
			';
		}catch(PDOException $e){
		echo $e->getMessage();
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
