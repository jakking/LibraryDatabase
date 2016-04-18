<?php
require_once("../includes/inc.db.php");
function processHold(){
	$con = connect();
	try {
		$sql = $con->prepare("SELECT * FROM `litlookup` WHERE `litID` = :bookid AND libraryName = :libname AND libAdID = :libaddress AND checkedOut = false");
        $sql->bindParam(':bookid', $_GET['id']);
        $sql->bindParam(':libname', $_SESSION['libraryName']);
        $sql->bindParam(':libaddress', $_SESSION['libAddressKey']);
        $sql->execute();
        if($sql->rowCount() >= 1){
			$result = $sql->fetch();
			$con->beginTransaction();
			$sql = $con->prepare("UPDATE litlookup SET checkedOut = true WHERE id = " . $result[0]);
			$sql->execute();
			if($sql->rowCount()==0){
				echo '<h3>Book taken already. Please try again.</h3>';
			}
			else{
				$con->commit();
				echo '<h3>Book successfully placed on hold</h3>';
				$sql = $con->prepare("SELECT id from customer where username = :username");
				$sql->bindParam(':username', $_SESSION['username']);
				$sql->execute();
				$resultCust = $sql->fetch();
				$sql = $con->prepare("INSERT INTO holds (customerID, litLookUpID, libraryName, libAddKey, holdDate) VALUES(" . $resultCust[0] . ", " . $result[0] . ", :libname , :libaddress, '".  date("Y/m/d") ."')");
				$sql->bindParam(':libname', $_SESSION['libraryName']);
				$sql->bindParam(':libaddress', $_SESSION['libAddressKey']);
				$sql->execute();
				$con = null;
			}
		}	
        else{
			echo '<h2>Your library is currently out of stock of this book.</h2>';
		}
	 } catch(PDOException $e){
       echo $e->getMessage();
  }
}
?>
