<?php
include("config.php");

session_start();

if ($_SESSION['log_admin'] != "") {
    $cid = $_GET['fdel'];

    $sql = "SELECT *, user_mast_tbl.USER_ID FROM user_complaint LEFT JOIN user_mast_tbl ON user_complaint.user_mast_id = user_mast_tbl.uid WHERE user_complaint.cid = '$cid'";
    $stmt = $conn->query($sql);
    $res = mysqli_fetch_assoc($stmt);
    $did = $res['dealer_id'];
    $dname = "SELECT username FROM dealer_mast_tbl WHERE did = '$did'";
    $dstmt = $conn->query($dname);
    $dres = null;
    if ($dstmt !== false && $dstmt->num_rows > 0) {
        $dres = $dstmt->fetch_assoc();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $remark = $_POST['remark'];
        $dealer = $_POST['dealer'];
        $cid = $_POST['cid'];

        $sql = "UPDATE user_complaint SET remark_by_admin = '$remark', status = '1', dealer_id = '$dealer' WHERE cid = '$cid'";
        $stmt = $conn->query($sql);

        echo "<script>alert('Forwarded to Dealer Successfully');</script>";
        header("Location: admin_index.php");
        die();
    }

    $sqldelaer = "SELECT * FROM dealer_mast_tbl";
    $stmt_dealer = $conn->query($sqldelaer);

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

    <input action="action" onclick="window.history.go(-1); return false;" type="submit" value="Back" />

    <div class="form">
        <form id="myForm" style="height: 650px;" method="post" >
            <div>
                <input type="hidden" name="cid" value="<?php echo $cid ?>">
                <label for="User-id">System Generated ID</label>
                <input type="text" id="user" name="User-ID" value="<?php echo $res['USER_ID'] ?> " class="form-control" readonly>
            </div>

            <div>
                <label for="complaint">Complaint Description</label>
                <textarea rows="6" name="complaint" id="complaint" placeholder=" " required="" class="form-control" disabled><?php echo $res['complaint']; ?></textarea>
            </div>

            <div>
                <label for="dealer">Dealer</label>
                <select name="dealer" id="dealer" class="form-control" required>
                    <?php
                    while ($row = $stmt_dealer->fetch_assoc()) {
                        echo '<option value="' . $row['did'] . '"';
                        if ($row['did'] == $did) {
                            echo ' selected';
                        }
                        echo '>' . $row['username'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div>
                <label for="remark">Remarks</label>
                <textarea rows="6" name="remark" id="remark" placeholder=" " class="form-control"></textarea>
            </div>
            <br>

            <?php if ($res['status'] == 0) { ?>
            <input type="submit" value="Forward to Dealer" class="btn btn-success">
            <input type="submit" value="Resolved" class="btn ">
            <?php } ?>
        </form>
    </div>

    <div>
        <label for="status">Status</label>
        <input type="text" id="status" name="status" value="<?php echo ($res['status'] == 0) ? 'Pending' : 'Resolved'; ?>" class="form-control" readonly>
    </div>

</body>
</html>
<?php } else { 
    header('Location: admin_login.php'); 
} ?>
