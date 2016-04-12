<?php
require_once("../includes/inc.db.php");
function queryTitle(){
	$con = connect();

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

function buildGenres(){
	$con = connect();
	$sql = $con->prepare("SELECT name FROM `genre`");
	$sql->execute();
	$results =  $sql->fetchAll();
	foreach($results as $result){
		echo '
		<option value="' . $result[0] . '">' . $result[0] . '</option>
		';
	}
}

?>