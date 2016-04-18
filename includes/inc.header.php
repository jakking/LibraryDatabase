<?php
require_once("../includes/inc.db.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Creative Name for Library System</title>
		<link href="/cs434Project/css/bootstrap.min.css" rel="stylesheet">
	</head>
		<body>
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							 <span class="sr-only">Toggle navigation</span>
							 <span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
							<a class="navbar-brand" href="/cs434Project/">HOME<br>PAGE</a>
						</div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li><a href="/cs434Project/pages/search.php">SEARCH<br>LITERATURE</a></li>
								<?php
								if(isset($_SESSION['username'])){if ($_SESSION['clearence']==1){
										echo '<li><a href="myaccount.php">MY<br>ACCOUNT</a></li>';
									}
									else if($_SESSION['clearence']>1){
										$con = connect();
										try {
											$sql = $con->prepare("SELECT COUNT(*) FROM `holds` WHERE `libraryName` = :libname");
											$sql->bindParam(':libname', $_SESSION['libraryName']);
											$sql->execute();
											$result = $sql->fetch();
											} catch(PDOException $e){
											echo $e->getMessage();
											}
										echo '<li><a href="/pages/viewholds.php">VIEW<br>HOLDS(' . $result[0] . ')</a></li>
											  <li><a href="#">SEARCH<br>CUSTOMERS</a></li>
											  <li><a href="#">INSERT<br>INTO</a></li>';
									}
								}
								?>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<?php 
								if (isset( $_SESSION['clearence'])){
									echo '<li><a href="/cs434Project/pages/logout.php">LOGOUT</a></li>';
								}
								else{
									echo '<li><a href="/cs434Project/pages/login.php">LOGIN</a></li';
								}
								?>
						</div>
					</div>
				</div>
			</nav>
	
		
