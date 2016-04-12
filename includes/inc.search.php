<?php
require_once("../includes/inc.db.php");
function queryTitle(){
	try {
			global $con;
		    $con = new PDO(DB_CONNECTION_STRING, DB_USER, DB_PWD);
		    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
		    echo $e->getMessage();
		}

	try {
	    // input not being sanitized
    	$sql = $con->prepare("SELECT * FROM `search` WHERE `name` REGEXP (:title)");
	    $sql->bindParam(':title', $_GET['title']);
	    $sql->execute();
	    return $sql->fetchAll();            
	} catch(PDOException $e) {
	    echo  $e->getMessage();
	}
}
 function buildTable($results){
 	echo '
 		<tr>
			<th align="left">Title</th>
			<th align="left">Release Date</th>
			<th align="left">Genre</th>
			<th align="left">Author</th>
		</tr>
	';

 	foreach($results as $result){
        echo        '
    	<tr>
   		     <td> ' . $result[1] . '</td>
             <td> ' . $result[2] . '</td>
             <td> ' . $result[3] . '</td>
             <td> ' . $result[4] . '</td>
             </tr>
                    ';
    }
 }

 function textInput(){
 		if (isset($_GET['submitted']))
 			echo $_GET['title'];
 		else
 			echo "";
 }


?>