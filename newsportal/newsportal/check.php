<?php
if(!isset($_SESSION['email']) && !isset($_SESSION['userid']))
        {header("location: index.php");}
?>        