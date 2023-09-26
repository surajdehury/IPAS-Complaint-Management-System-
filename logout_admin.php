<?php
session_start();
$_SESSION['log_admin']="";
session_destroy();
header('Location: admin_login.php'); 

?>