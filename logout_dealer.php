<?php
session_start();
$_SESSION['log_d']="";
session_destroy();
header('Location: dealer_login.php'); 

?>