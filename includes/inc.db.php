<?php
/* Define the four constants that can be used with either PDO or mysqli */
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', '434');
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PWD', '');

/* Define the constant for PDO use. */
$_conString = 'mysql:host=' . DB_HOST .";dbname=" . DB_NAME;

DEFINE ('DB_CONNECTION_STRING', $_conString);
?>