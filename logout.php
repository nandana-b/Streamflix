<?php
// Destroy the current session
session_destroy();

// Redirect the user to the index page
header("Location: index.php");
exit();
?>
