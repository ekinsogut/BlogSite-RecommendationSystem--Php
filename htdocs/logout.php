<?php
session_start();
$_SESSION["logControl"] = 0;

session_unset();

header("Location: index.php?logout");
session_destroy();
?>
