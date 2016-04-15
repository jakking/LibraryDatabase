<?php
require_once("../includes/inc.db.php");

//gets the literature by the GET id
function getLiterature(){
	$con = connect();

	try {
		//base case to select titles
	    $query = "SELECT * FROM `infoPage` WHERE id=" . $_GET['id'];
	    $sql = $con->prepare($query);
	    $sql->execute();
	    //return array of books
	    return $sql->fetch();            
	} catch(PDOException $e) {
	    echo  $e->getMessage();
	}
}

//build info from the get return of getLiterature
function buildInfo(){
	$bookInfo = getLiterature();
	echo ' <h1>' . $bookInfo[1] . '</h1>
		   <h2> Written by: ' . $bookInfo[7] . ' ' . $bookInfo[2] . '</h2>
		   <p>Genre: ' . $bookInfo[6] . '<br></p>
		   <p>Number of pages: ' . $bookInfo[4] . '<br></p>
		   <p>Rating: ' . $bookInfo[5] . '/5<br></p>
		   <p>Summary: <br>' . $bookInfo[3] . '<br></p>
		   <p>Availibility: <br>
		   ';
	availibilityTable();
}

//get availibilty of books
function availibilityTable(){
	echo '<table>
			  <tr>
				  <th align="left">Library Name</th>
				  <th align="center">Books Available</th>
				  <th align="center">Total Books</th>
			   </tr>';
			   
    $con = connect();
	try {
		//get all libraries
	    $query = "SELECT * FROM `library`";
	    $sql = $con->prepare($query);
	    $sql->execute();
	    $libraryArray = $sql->fetchAll();
	    foreach($libraryArray as $library){
			//find sum all the ones related to the library
			$query = "SELECT COUNT(id) from litlookup WHERE libraryName='" . $library[0] . "' AND libAdID = " . $library[1];
			//add for the certain book
			$query = $query . " AND litID=" . $_GET['id'] . " AND checkedOut=false";
			$sql = $con->prepare($query);
			$sql->execute();
			$totalAvailable = $sql->fetch();

			//find all the books available
			$query = "SELECT COUNT(id) from litlookup WHERE libraryName='" . $library[0] . "' AND libAdID = " . $library[1];
			//add for the certain book
			$query = $query . " AND litID=" . $_GET['id'];
			$sql = $con->prepare($query);
			$sql->execute();
			$total = $sql->fetch();
			
			echo '<tr>
					  <td>' . $library[0] . '</td>
					  <td align="center">' . $totalAvailable[0] . '</td>
					  <td align="center">' . $total[0] . '</td>
			      </tr>';
		}
	} catch(PDOException $e) {
	    echo  $e->getMessage();
	}
	
}

?>
