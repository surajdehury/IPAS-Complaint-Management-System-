<?php
include("config.php");

session_start();

if ($_SESSION['log_admin'] != "") {
    $cid = $_GET['fdel'];

    $sql = "SELECT *, user_mast_tbl.USER_ID FROM user_complaint LEFT JOIN user_mast_tbl ON user_complaint.user_mast_id=user_mast_tbl.uid WHERE user_complaint.cid='$cid'";
    $stmt = $conn->query($sql);
    $res = mysqli_fetch_assoc($stmt);
    $did = $res['dealer_id'];
    $dname = "SELECT username FROM dealer_mast_tbl WHERE did='$did'";
    $dstmt = $conn->query($dname);
    $dres = mysqli_fetch_assoc($dstmt);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sql = "UPDATE user_complaint SET status='3' WHERE cid='$cid'";
        $stmt = $conn->query($sql);
        echo "Successfully Resolved";
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
            <h1>Forward Complaint to Dealer</h1>
        </div>  
        <nav class="site-navigation">
            <ul class="nav">
                <li><a href="https://en.wikipedia.org/wiki/Indian_Railways">About</a></li> 
                <li><a href="https://indiarailinfo.com/news">News</a></li> 
                <li><a href="https://indianrailways.gov.in/railwayboard/view_section.jsp?lang=0&id=0,5,384,831">Contact</a></li> 
            </ul>
        </nav>
    </header>

    <button style="float:top;"><a href="logout_dealer.php">Logout</a></button>

    <div class="form" style="height:790px">
        <form id="myForm" style="height: 483px;" method="post">
            <div>
                <label for="User-id">System Generated ID</label>
                <input type="text" id="user" name="User-ID" value="<?php echo $res['USER_ID'] ?> " class="form-control" readonly>
            </div>

            <div>
                <label for="complaint">Complaint Description</label>
                <textarea rows="6" name="complaint" id="complaint" placeholder=" " required="" class="form-control" disabled><?php echo $res['complaint']; ?></textarea>
            </div>

            <div>
                <label for="complaint">Remarks By admin</label>
                <textarea rows="6" placeholder=" " class="form-control" readonly><?php echo $res['remark_by_admin']; ?></textarea>
            </div>

            <div>
                <label for="complaint">Dealer Name</label>
                <input type="text" class="form-control" readonly value="<?php echo $dres['username']; ?>">
            </div>

            <div>
                <label for="complaint">Remarks By Dealer</label>
                <textarea rows="6" name="remark" id="remark" placeholder=" " class="form-control" readonly><?php echo $res['remark_by_dealer']; ?></textarea>
            </div>
            <br>
            <input type="submit" value="Resolved" class="btn btn-success">
        </form> 
    </div>

</body>
</html>

<?php  
} else {
    header('Location: admin_login.php');
}
?>
