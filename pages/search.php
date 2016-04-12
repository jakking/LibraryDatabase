<?php
require_once("../includes/inc.search.php");
?>
<form class="form-group" role="search" action="search.php">
	<div style="padding: 5px;">
    	<input type="text" name="title" value = <?php textInput() ?>>
	</div> 
	<div style="padding: 5px;">
    	<select name="genre">
    		<option value="all" selected="selected">ALL</option>
    	<?php buildGenres(); ?>
    	</select>
	</div> 
	<input type="submit" name="submitted" value="SEARCH">
</form>
<table>
<?php 
	if (isset($_GET['submitted'])){
		if ($_GET['title'] != ""){
			$query = queryTitle();
			buildTable($query);
		}
		else{
			echo 'You have to search for something, do I have to do everything for you?';
		}
	}
?>
</table>
