<?php
require_once("../includes/inc.db.php");
function queryTitle(){
	$con = connect();

	try {
		//base case to select titles
	    $query = "SELECT * FROM `search` WHERE `name` REGEXP (:title) ";
	    //if they select a category that is not all
	    if ($_GET['genre'] != "ALL"){
			$query = $query . "AND genre =  (:genre)";
			$sql = $con->prepare($query);
			$sql->bindParam(':genre', $_GET['genre']);
		}
		else{
			$sql = $con->prepare($query);
		}
		//replace title
	    $sql->bindParam(':title', $_GET['text']);
	    $sql->execute();
	    //return array of books
	    return $sql->fetchAll();            
	} catch(PDOException $e) {
	    echo  $e->getMessage();
	}
}

function queryAuthor(){
	$con = connect();

	try {
		//base case to select authors
	    $query = "SELECT * FROM `search` WHERE `author` REGEXP (:auth) ";
	    //if they select a category that is not all
	    if ($_GET['genre'] != "ALL"){
			$query = $query . "AND genre =  (:genre)";
			$sql = $con->prepare($query);
			$sql->bindParam(':genre', $_GET['genre']);
		}
		else{
			$sql = $con->prepare($query);
		}
		//replace author
	    $sql->bindParam(':auth', $_GET['text']);
	    $sql->execute();
	    //return array of books
	    return $sql->fetchAll();            
	} catch(PDOException $e) {
	    echo  $e->getMessage();
	}
}

function querySummary(){
	
	$con = connect();

	try {
		//base case to select description added a fluff description to clean up code
	    $query = "SELECT * FROM `search` WHERE id > 0";
	    //put them in an array by word
	    $wordArray = explode(' ', $_GET['text']);
	    foreach($wordArray as $word){
			$query = $query . " AND description LIKE '%" . $word . "%'";
		}
	    $sql = $con->prepare($query);
	    $sql->execute();
	    //return array of books
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
   		     <td> <a href= "info.php?id=' . $result[0] . '">' . $result[1] . '</a></td>
             <td> ' . $result[2] . '</td>
             <td> ' . $result[3] . '</td>
             <td> ' . $result[4] . '</td>
             </tr>
                    ';
    }
 }

 function textInput(){
 		if (isset($_GET['submitted']))
 			echo '"' . $_GET['text'] . '"';
 		else
 			echo "";
 }

function buildGenres(){
	$con = connect();
	$sql = $con->prepare("SELECT name FROM `genre`");
	$sql->execute();
	$results =  $sql->fetchAll();
	if(isset($_GET['genre'])){
		echo '
		    		<option value="ALL">ALL</option>
		    ';
	}
	else{
		echo '
					<option value="ALL" selected="selected">ALL</option>
		';
	}
	foreach($results as $result){
		if (strcasecmp($result[0], $_GET['genre'])==0){
			echo '
			<option selected = "selected" value="' . $result[0] . '">' . $result[0] . '</option>
			';
		}
		else{
			echo '
			<option value="' . $result[0] . '">' . $result[0] . '</option>
			';
		}
	}
	
}

function buildRadioButtons(){
	//default title is checked
	if (!isset($_GET['searchType']) || (strcasecmp($_GET['searchType'], "title")==0)){
		echo'
		<input type="radio" name="searchType" value="title" checked> Title<br>
		<input type="radio" name="searchType" value="author"> Author<br>
		<input type="radio" name="searchType" value="summary"> Summary  
		';
	}
	else if (strcasecmp($_GET['searchType'], "author")==0){
		echo'
		<input type="radio" name="searchType" value="title"> Title<br>
		<input type="radio" name="searchType" value="author" checked> Author<br>
		<input type="radio" name="searchType" value="summary"> Summary
		';
	}
	else{
		echo'
		<input type="radio" name="searchType" value="title"> Title<br>
		<input type="radio" name="searchType" value="author"> Author<br>
		<input type="radio" name="searchType" value="summary" checked> Summary
		';
	}
}

?>
