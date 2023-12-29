<?php 
require_once "database.php";
session_start();
unset($_SESSION['aemail']);
session_destroy();
header("Location: index.php");
?>