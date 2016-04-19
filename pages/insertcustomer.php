<?php
session_start();
if(isset($_SESSION['clearence'])){
	if($_SESSION['clearence']>1){
		//after clearence check, if post is set, insert them into the db
		require_once("../includes/inc.header.php");
		require_once("../includes/inc.insertcustomer.php");
		if(isset($_POST['Name'])){
			require_once("../includes/inc.db.php");
			try {
				$sql = $con->prepare("SELECT id FROM `customer` WHERE `username` = :username");
				$sql->bindParam(':username', $_POST['username']);
				$sql->execute();
				if($sql->rowCount() == 0){
					$sql = $con->prepare("INSERT INTO address (streetAddress) VALUES(:address)");
					$sql->bindParam(':address', $_POST['Address']);
					$sql->execute();
					$sql = $con->prepare("SELECT id FROM address WHERE streetAddress=:address");
					$sql->bindParam(':address', $_POST['Address']);
					$sql->execute();
					$result = $sql->fetch();
					$sql = $con->prepare("INSERT INTO customer (name, addressKey, email, username) VALUES(:name, :addressKey, :email, :username)");
					$sql->bindParam(':name', $_POST['Name']);
					$sql->bindParam(':addressKey', $result[0]);
					$sql->bindParam(':email', $_POST['Email']);
					$sql->bindParam(':username', $_POST['username']);
					$sql->execute();
					$sql = $con->prepare("INSERT INTO login (username, password, libraryName, libAddressKey, clearence) VALUES(:username, :password, :libraryname, :libraryAddressKey, 1)");
					$sql->bindParam(':username', $_POST['username']);
					$sql->bindParam(':password', password_hash($_POST['password'], PASSWORD_DEFAULT));
					$sql->bindParam(':libraryname', $_SESSION['libraryName']);
					$sql->bindParam(':libraryAddressKey', $_SESSION['libAddressKey']);
					$sql->execute();
					echo '
					<h2>Addition Success!</h2>
					';
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
