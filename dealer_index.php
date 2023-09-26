<?php
include("config.php");

session_start();

if($_SESSION['log_d'] !=""){
	$uid=$_SESSION['log_d'];
	$sql = "SELECT *,user_mast_tbl.USER_ID  FROM user_complaint left join user_mast_tbl ON user_complaint.user_mast_id=user_mast_tbl.uid where user_complaint.status='1' and user_complaint.dealer_id=$uid  ";
         $stmt = $conn -> query($sql);
		 
		 


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

    <link rel="stylesheet" href="admin.css">


</head>
<body>
  <header class="site-header">
    <div class="site-identity">
      <a href="#"><img src="6a724b9501764fd83a4abcd37b58144d.png"/></a>
      <h1>Dealer PAGE</h1>
    </div>  
    <nav class="site-navigation">
      <ul class="nav">
        <li><a href="https://en.wikipedia.org/wiki/Indian_Railways">About</a></li> 
        <li><a href="https://indiarailinfo.com/news">News</a></li> 
        <li><a href="https://indianrailways.gov.in/railwayboard/view_section.jsp?lang=0&id=0,5,384,831">Contact</a></li> 
      </ul>
    </nav>
</header>

<div class="center">
  <button onclick="showTable1()">Received From Admin</button>
  <button><a href="changep_dealer.php">Change Password</a></button>
  <button><a href="logout_dealer.php">Logout</a></button>
    <!--<button onclick="showTable2()">Returned From Dealer</button>-->
    <div id="table1" class="table-container">
        <h2>Table 1</h2>
        <table class="table table-hover">
          <tr>
            <th>IPAS ID</th>
            <th>SJID</th>
            <th>Complaint</th>
          </tr>
		  <?php  		  
while($res = mysqli_fetch_assoc($stmt)){
		  ?>
          <tr>
            <td><?php echo $res['USER_ID']; ?></td>
            <td><a href="forward_to_admin.php?fdel=<?php echo $res['cid'];   ?>"><?php echo $res['unique_id']; ?></a></td>
            <td><?php echo $res['complaint']; ?></td>
          </tr>
<?php } ?>
        </table>
    </div>
	
	
    
</div>
    <script src="admin.js"></script>

</body>
</html>
  <?php  }else{ header('Location: admin_login.php'); } ?>