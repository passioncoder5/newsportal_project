<?php 
require_once "database.php";
session_start();
unset($_SESSION['userid']);
unset($_SESSION['email']);
session_destroy();
header("Location: index.php");
?>