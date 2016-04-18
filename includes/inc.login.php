<?php
session_start();
require_once("../includes/inc.db.php");

if(isset($_POST['login']))
	login();
    
function login(){
	$con = connect();
	try {
		//checked loing based on username
		$sql = $con->prepare("SELECT * FROM `login` WHERE `username` = :username");
        $sql->bindParam(':username', $_POST['username']);
        $sql->execute();
        $result = $sql->fetch();
        //checked a password compared to its hash
       if(password_verify($_POST['password'], $result[1])){
            session_start();
            //set session vairables
            $_SESSION['username'] = $result[0];
            $_SESSION['libraryName'] = $result[2];
            $_SESSION['libAddressKey'] = $result[3];
            $_SESSION['clearence'] = $result[4];
            header("Location: /cs434Project/");
            exit();
		}
		else{
			echo '<script type="text/javascript">
        	      alert ("Wrong username/password combination")
        	     </script>';
	     }
	 } catch(PDOException $e){
       echo $e->getMessage();
  }
	
}


?>
