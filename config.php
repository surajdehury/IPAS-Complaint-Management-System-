<?php
 $conn = new mysqli("localhost", "root", "","ipas");
if($conn -> connect_errno)
      {
         echo "Database connection failed!<BR>";
         echo "Reason: ", $conn -> connect_error;
         exit();
      }

?>