<?php
include("config.php");

session_start();

$uid= $_SESSION['log'] ;

 
		  
if($_SESSION['log'] !=""){

if($_SERVER["REQUEST_METHOD"]=="POST")
{
$cpass= addslashes($_POST['cpass']);

$cpass=str_replace(" ", "", $cpass);

$pass= $_POST['pass'];

     $sql = "SELECT * FROM user_mast_tbl WHERE uid='$uid' AND pass='$cpass'";
         $stmt = $conn -> query($sql);
		  $count = mysqli_num_rows($stmt);
if($count==1){
$sql_c = "UPDATE user_mast_tbl SET pass='$pass' WHERE uid='$uid'";
 $r_comp = $conn -> query($sql_c);
 echo "<script>alert('Changepassword Update successfully');</script>";

}else{	
	echo "<script>alert('Wrong Current Password');</script>";
}

header("Refresh:0");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>IPAS MANAGEMENT SYSTEM</title>
    <link rel="icon" href="Indian_Railway_Logo_2.png"/>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">


</head>
<body>
    <header class="site-header">
        <div class="site-identity">
          <a href="#"><img src="6a724b9501764fd83a4abcd37b58144d.png"/></a>
          <h1>Change Password</h1>
        </div>  
        <nav class="site-navigation">
          <ul class="nav">
            <li><a href="https://en.wikipedia.org/wiki/Indian_Railways">About</a></li> 
            <li><a href="https://indiarailinfo.com/news">News</a></li> 
            <li><a href="https://indianrailways.gov.in/railwayboard/view_section.jsp?lang=0&id=0,5,384,831">Contact</a></li> 
          </ul>
        </nav>
    </header>
					<a href="change_password.php"><button>Change Password</button></a>
<a href="registerComplaint.php"><button>complaint</button></a>
<a href="logout.php"><button>Logout</button></a>
<a href="user_index.php"><button>Details</button></a>

<div class="form">
			
		
    <form id="myForm" style="height: 483px;" method="post" >
	
		<div>
       
		
		<div>
        <label for="User-id">Current Password</label>
        <input type="text" id="cpass" name="cpass" value="" class="form-control" >
				</div>

		<div>
        <label for="Name">New Password</label>
        <input type="text" name="pass" id="pass" value="" class="form-control">
				</div>
<br><br>
        <input type="submit" value="Submit" class="btn btn-success">
            </div>

    </form> 
   

</body>

</html>
<?php  }else{ header('Location: user_login.php'); } ?>