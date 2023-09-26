<?php
session_start();
$_SESSION['log']="";
session_destroy();
header('Location: user_login.php'); 

?>