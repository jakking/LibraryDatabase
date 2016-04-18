<?php
# Destroyss the session and redirects user back to homepage.
session_start();
session_destroy();
header("Location: /cs434Project/");
?>
