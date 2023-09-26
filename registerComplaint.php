<?php
include("config.php");

session_start();

$uid = $_SESSION['log'];

$sql = "SELECT * FROM user_mast_tbl 
        LEFT JOIN div_master ON user_mast_tbl.DIVISION = div_master.UNIT
        WHERE uid = '$uid'";
$stmt = $conn->query($sql);
$res = mysqli_fetch_array($stmt);

$sqldelaer = "SELECT * FROM dealer_mast_tbl";
$stmt_dealer = $conn->query($sqldelaer);

if ($_SESSION['log'] != "") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $division = $_POST['division'];
        $section = $_POST['section'];
        $namee = $_POST['namee'];
        $mob = $_POST['mobile'];
        $complaint = $_POST['complaint'];
        $unique_id = uniqid();

        $sql_c = "INSERT INTO user_complaint (division, section, user_mast_id, name, mobile, complaint, unique_id)
                  VALUES ('$division', '$section', '$uid', '$namee', '$mob', '$complaint', '$unique_id')";
        $r_comp = $conn->query($sql_c);

        echo "<script>alert('Complaint registered successfully');</script>";
        header("Location: user_index.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPAS MANAGEMENT SYSTEM</title>
    <link rel="icon" href="Indian_Railway_Logo_2.png"/>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="site-header">
        <div class="site-identity">
            <a href="#"><img src="6a724b9501764fd83a4abcd37b58144d.png"/></a>
            <h1>Register Complaint</h1>
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
    <a href="registerComplaint.php"><button>Complaint</button></a>
    <a href="logout.php"><button>Logout</button></a>
    <a href="user_index.php"><button>Details</button></a>

    <div class="form">
        <form id="myForm" style="height: 483px;" method="post">
            <div>
                <label for="division">Division/HQ</label>
                <input type="text" id="hq" name="division" value="<?php echo $res['UNIT_DESC']; ?>" class="form-control" readonly>
            </div>

            <div>
                <label for="section">Section</label><br>
                <input type="text" id="sec" name="section" value="<?php echo $res['SECTIONCODE']; ?>" class="form-control" readonly>
            </div>

            <div>
                <label for="User-ID">User-ID</label>
                <input type="text" id="user" name="User-ID" value="<?php echo $res['USER_ID']; ?>" class="form-control" readonly>
            </div>

            <div>
                <label for="Name">Name</label>
                <input type="text" name="namee" id="name" class="form-control">
            </div>

            <div>
                <label for="Mobile-no">Mobile</label>
                <input type="text" name="mobile" pattern="[789][0-9]{9}" minlength="10" maxlength="10"   class="form-control">
            </div>

            <div>
                <label for="complaint">Complaint</label>
                <textarea rows="6" name="complaint" id="complaint" placeholder="" required="" class="form-control"></textarea>
            </div><br>
            <input type="submit" value="Submit" class="btn btn-success">
        </form>
    </div>
</body>
</html>
<?php
} else {
    header('Location: user_login.php');
}
?>
