<?php
include("config.php");

session_start();

if ($_SESSION['log'] != "") {
    $uid = $_SESSION['log'];

    $sql = "SELECT *, user_mast_tbl.USER_ID FROM user_complaint LEFT JOIN user_mast_tbl ON user_complaint.user_mast_id=user_mast_tbl.uid LEFT JOIN dealer_mast_tbl ON user_complaint.dealer_id=dealer_mast_tbl.did WHERE user_complaint.user_mast_id='$uid'";
$stmt = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        form {
            border: 3px solid #f1f1f1;
        }

        .left {
            float: left;
            width: 15%;
            background-color: gray;
        }

        .right {
            float: left;
            width: 75%;
            padding-left: 10px;
        }

        ul {
            text-align: center;
        }

        ul li {
            list-style-type: none;
            line-height: 31px;
        }

        .container {
            padding: 16px;
        }

        .main {
            text-align: center;
            width: 80%;
        }
    </style>
</head>
<body>
<center>
    <div class="main">
        <h2>Complaint Status</h2>

        <div class="container">
            <div class="left">
                <ul>
                    <li><a href="change_password.php">Change Password</a></li>
                    <li><a href="registerComplaint.php">Complaint</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
            <div class="right">
                <table border="1px" style="color:white;background-color:gray;">
                    <tr>
                        <th style="width:15%">SGID</th>
                        <th style="width:85%">Complaint</th>
                        <th style="width:15%">Status</th>
                    </tr>
                    <?php
                    while ($res = mysqli_fetch_assoc($stmt)) {
                        ?>
                        <tr>
                            <td><?php echo $res['unique_id']; ?></td>
                            <td><?php echo $res['complaint']; ?></td>
                            <td><?php
                                if ($res['status'] == 0) {
                                    echo "<p style='color:#1e10eb;'>Pending in admin</p>";
                                } elseif ($res['status'] == 3) {
                                    echo "<p style='color:#ff0000;'>Resolved</p>";
                                } else {
                                    echo "<p style='color:#0fdd0f;'>Approved</p>";
                                }
                                ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</center>
</body>
</html>
<?php } else {
    header('Location: user_login.php');
} ?>
