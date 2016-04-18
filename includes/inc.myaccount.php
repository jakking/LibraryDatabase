<?php
require_once("../includes/inc.db.php");
//builds the table that has all of the holds in int
function buildHolds(){
	echo '<h1>Current Holds:</h1>';
	$con = connect();
	try {
		//get customer id
		$sql = $con->prepare("SELECT id FROM `customer` WHERE username = :username");
		$sql->bindParam(':username', $_SESSION['username']);
		$sql->execute();
		$result = $sql->fetch();
		//get all holds
		$sql = $con->prepare("SELECT * FROM `holds` WHERE customerID = " . $result[0]);
		$sql->execute();
		$results = $sql->fetchAll();
		//start building table
		echo '
		<table class="table">
 		<tr>
			<th align="left">Book Name</th>
			<th align="left">Library Rented From</th>
			<th align="left">Hold Date</th>
		</tr>
		';
		foreach($results as $result){
			//get book names
			$sql = $con->prepare("SELECT litID FROM `litlookup` WHERE id = " . $result[2]);
			$sql->execute();
			$litID = $sql->fetch();
			$sql = $con->prepare("SELECT name FROM `literature` WHERE id = " . $litID[0]);
			$sql->execute();
			$name = $sql->fetch();
			echo'
			<tr>
				<td>' . $name[0] . '</td>
				<td> ' . $result[3] . '</td>
				<td> ' . $result[5] . '</td>
             </tr>
                    ';
		}
		echo'
		</table>';
	} catch(PDOException $e){
		echo $e->getMessage();
	}

}

function buildCheckedOut(){
	echo '<h1>Checkouts:</h1>';
	$con = connect();
	try {
		//get checkout according to customer id
		$sql = $con->prepare("SELECT id FROM `customer` WHERE username = :username");
		$sql->bindParam(':username', $_SESSION['username']);
		$sql->execute();
		$result = $sql->fetch();
		//get all borrows
		$sql = $con->prepare("SELECT * FROM `customerborrows` WHERE custID = " . $result[0] . " ORDER BY checkoutDate");
		$sql->execute();
		$results = $sql->fetchAll();
		//start builing table
		echo '
		<table class="table">
 		<tr>
			<th align="left">Book Name</th>
			<th align="left">Library Rented From</th>
			<th align="left">Rent Date</th>
			<th align="left">Checkin Date</th>
		</tr>
		';
		foreach($results as $result){
			//get book names
			$sql = $con->prepare("SELECT litID FROM `litlookup` WHERE id = " . $result[6]);
			$sql->execute();
			$litID = $sql->fetch();
			$sql = $con->prepare("SELECT name FROM `literature` WHERE id = " . $litID[0]);
			$sql->execute();
			$name = $sql->fetch();
			echo'
			<tr>
				<td>' . $name[0] . '</td>
				<td> ' . $result[2] . '</td>
				<td> ' . $result[4] . '</td>
				';
			if($result[5]=="0000-00-00"){
				echo '<td> Not checked in yet.</td>
					 ';
			}
			else{
				echo '
				<td> ' . $result[5] . '</td>
				</tr>
                    ';
				}
		}
		echo '
		</table>';
		} catch(PDOException $e){
		echo $e->getMessage();
		}
}
?>
