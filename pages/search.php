<?php
require_once("../includes/inc.header.php");
require_once("../includes/inc.search.php");
?>
<form class="form-group" role="search" action="search.php">
	<div style="padding: 5px;">
    	<input type="text" name="text" value = <?php textInput() ?>>
	</div>
	<div style="padding: 5px;">
		<?php buildRadioButtons() ?>
    </div>
	<div style="padding: 5px;">
    	<select name="genre">
    	<?php buildGenres(); ?>
    	</select>
	</div> 
	<input type="submit" name="submitted" value="SEARCH">
</form>
<table>
<?php 
	if (isset($_GET['submitted'])){
		if ($_GET['text'] != ""){
			if ($_GET['searchType'] == "title"){
				$query = queryTitle();
			}
			else if ($_GET['searchType'] == "author"){
				$query = queryAuthor();
			}
			else{
				$query = querySummary();
			}
			buildTable($query);
		}
		else{
			echo 'You have to search for something, do I have to do everything for you?';
		}
	}
?>
</table>
