<?php
require_once("../includes/inc.db.php");

function getHolds(){
	$con = connect();
	try {
		//get holds associated with the libary of the user logged in
		$sql = $con->prepare("SELECT * FROM `holds` WHERE `libraryName` = :libname");
		$sql->bindParam(':libname', $_SESSION['libraryName']);
		$sql->execute();
		$results = $sql->fetchAll();
		//start building table
		echo '
		<table class="table">
 		<tr>
			<th align="left">Customer iD</th>
			<th align="left">Customer Name</th>
			<th align="left">Book ID</th>
			<th align="left">Book Name</th>
			<th align="left">Hold Start Date</th>
		</tr>
		';
		
		//populate with holds
		foreach($results as $result){
			//get customer info
			$sql = $con->prepare("SELECT name FROM `customer` WHERE id = " . $result[1]);
			$sql->execute();
			$custResults = $sql->fetch();
			//get book info
			$sql = $con->prepare("SELECT litID FROM `litlookup` WHERE id = " . $result[2]);
			$sql->execute();
			$litID = $sql->fetch();
			$sql = $con->prepare("SELECT name FROM `literature` WHERE id = " . $litID[0]);
			$sql->execute();
			$name = $sql->fetch();
			//build rows
			echo'
			<tr>
				<td>' . $result[1] . '</td>
				<td>' . $custResults[0] . '</td>
				<td>' . $result[2] . '</td>
				<td>' . $name[0] . '</td>
				<td>' . $result[5] . '</td>
				<td><a href="checkout.php?id=' . $result[2] . '&customerid='. $result[1] . '">Checkout</a></td>
				<td><a href="cancelhold.php?id=' . $result[2] . '">Cancel Hold</a></td>
             </tr>
                    ';
		}
	} catch(PDOException $e){
		echo $e->getMessage();
	}
}

?>
