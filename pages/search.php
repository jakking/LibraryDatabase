<?php
require_once("../includes/inc.search.php");
if (isset($_GET['submitted']))
	$query = queryTitle();
?>
<form class="form-group" role="search" action="search.php">
	<div style="padding: 5px;">
    	<input type="text" name="title" value = <?php textInput() ?>>
	</div> 
	<input type="submit" class="btn btn-lg btn-block" name="submitted" value="SEARCH">
</form>
<table>
<?php 
	if (isset($_GET['submitted']))
		buildTable($query)
?>
</table>
