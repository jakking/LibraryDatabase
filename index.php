<?php
session_start();
if(isset($_GET['close'])){
    session_destroy();
}
require_once("includes/inc.header.php");
?>
<h1>Home Page</h1>
