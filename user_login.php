<?php
include("config.php");
session_start();

 if($_SERVER["REQUEST_METHOD"] == "POST")
   {
	   $uname = $_POST["uname"];
         $pass = $_POST["psw"];
         
         $sql = "SELECT * FROM user_mast_tbl WHERE USER_ID='$uname' and pass='$pass'";
         $stmt = $conn ->query($sql);
		  $count = mysqli_num_rows($stmt);
		  $res = mysqli_fetch_array($stmt);
         
         if($count == 1)
         {
            $_SESSION['log'] = $res['uid'];
            header('Location: user_index.php');
            exit();
         }
         else

         {
            echo "Something went wrong!<BR>";
            echo "Error Description: ", $conn -> error;
      }
   }
   
      $conn -> close();


?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f1f1f1;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}

.main{text-align:center;width:50%;}
</style>
</head>
<body>
<center>
<div class="main">
<h2>User Login Form</h2>

<form  method="post">
  <div class="imgcontainer">
    IPAS
  </div>

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
        
    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn"><a href="index.php">Home</button>
  </div>
</form>
</div>
</center>
</body>
</html>
