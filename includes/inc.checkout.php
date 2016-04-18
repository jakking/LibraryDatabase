<?php

require_once("../includes/inc.db.php");

function checkout(){
	$con = connect();
	try {
		//insert into customer borrows with current dat
		$sql = $con->prepare("INSERT INTO customerborrows (custID, lenderLName, lenderLAddressKey, checkoutdate, litlookupID) VALUES(:custID, :libname, :libaddress, '" . date("Y/m/d") . "', :litID)");
		$sql->bindParam(':custID', $_GET['customerid']);
		$sql->bindParam(':libname', $_SESSION['libraryName']);
		$sql->bindParam(':libaddress', $_SESSION['libAddressKey']);
		$sql->bindParam(':litID', $_GET['id']);
		$sql->execute();
		//remove from holds
		$sql = $con->prepare("DELETE FROM holds where litLookUpID = :bookid");
		$sql->bindParam(':bookid', $_GET['id']);
		$sql->execute();
		echo '
		<h2>Book checked out successfully!</h2>
		';
	}catch(PDOException $e){
       echo $e->getMessage();
	}
	
}

?>
