<?php
require_once("../includes/inc.db.php");
function checkinTable(){
	$con = connect();
	try {
		//get holds associated with the libary of the user logged in
		$sql = $con->prepare("SELECT * FROM `customerborrows` WHERE `lenderLName` = :libname AND checkinDate = 0000-00-00");
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
			$sql = $con->prepare("SELECT litID FROM `litlookup` WHERE id = " . $result[6]);
			$sql->execute();
			$litID = $sql->fetch();
			$sql = $con->prepare("SELECT name FROM `literature` WHERE id = " . $litID[0]);
			$sql->execute();
			$name = $sql->fetch();
			echo'
			<tr>
				<td>' . $result[1] . '</td>
				<td>' . $custResults[0] . '</td>
				<td>' . $result[2] . '</td>
				<td>' . $name[0] . '</td>
				<td>' . $result[4] . '</td>
				<td><a href="checkin.php?id=' . $result[6] . '&customerid='. $result[1] . '">Checkin</a></td>
             </tr>
                    ';
		}
		echo'
		</table>';
	} catch(PDOException $e){
		echo $e->getMessage();
	}
	
}


?>
