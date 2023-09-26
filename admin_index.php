<?php
include("config.php");

session_start();

if($_SESSION['log_admin'] !=""){
	
	$sql = "SELECT *,user_mast_tbl.USER_ID  FROM user_complaint left join user_mast_tbl ON user_complaint.user_mast_id=user_mast_tbl.uid ";
         $stmt = $conn -> query($sql);
		 
		 $sql_delaer = "SELECT *,user_mast_tbl.USER_ID  FROM user_complaint left join user_mast_tbl ON user_complaint.user_mast_id=user_mast_tbl.uid where status='2' ";
         $stmt_delaer = $conn -> query($sql_delaer);
		 
		 


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
      <h1>ADMIN PAGE</h1>
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

  <button onclick="showTable1()">Received From User</button>
    <button onclick="showTable2()">Returned From Dealer</button>
    <button><a href="logout_admin.php">Logout</a></button>
	  <button><a href="changep_admin.php">Change Password</a></button>
    <div id="Received From User" class="table-containers">
        <h2>Table 1</h2>
        <table class="table table-hover">
          <tr>
            <th>IPAS ID</th>
            <th>SJID</th>
            <th>Complaint</th>
            <th>Status</th>
          </tr>
		  <?php  		  
while($res = mysqli_fetch_assoc($stmt)){
		  ?>
          <tr>
            <td><?php echo $res['USER_ID']; ?></td>
            <td><a href="forward_to_dealer.php?fdel=<?php echo $res['cid'];   ?>"><?php echo $res['unique_id']; ?></a></td>
            <td><?php echo $res['complaint']; ?></td>
<td><?php if($res['status']==0){echo "<p style='color:#1e10eb;'>Pending in Admin</p>";}else if($res['status']==1){echo "<p style='color:#0fdd0f;'>Forwarded to Dealer</p>";}else if($res['status']==2){ echo "<p style='color:#0fdd0f;'>Returned from Dealer</p>" ;}else{ echo "Resolved"; }  ?></td>          </tr>
<?php } ?>
        </table>
    </div>
	
	
    <div id="Received From Dealer" class="table-container">
        <h2>Table 2</h2>
        <table class="table table-hover">
          <tr>
            <th>IPAS ID</th>
            <th>SJID</th>
            <th>Complaint</th>
          </tr>
          <?php  		  
while($res_del = mysqli_fetch_assoc($stmt_delaer)){
		  ?>
          <tr>
            <td><?php echo $res_del['USER_ID']; ?></td>
            <td><a href="forward_to_resolve.php?fdel=<?php echo $res_del['cid'];   ?>"><?php echo $res_del['unique_id']; ?></a></td>
            <td><?php echo $res_del['complaint']; ?></td>
          </tr>
<?php } ?>
        </table>
    </div>
</div>
    <script src="admin.js"></script>

</body>
</html>
  <?php  }else{ header('Location: admin_login.php'); } ?>