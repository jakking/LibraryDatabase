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
             </tr>
                    ';
		}
	} catch(PDOException $e){
		echo $e->getMessage();
	}

}
?>
