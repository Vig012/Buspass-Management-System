<?php
session_start();
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid']) == 0 || !isset($_SESSION['bpmsaid'])) {
    header('location: logout.php');
    exit();
} elseif (isset($_POST['submit'])) {
    $userid = $_SESSION['bpmsaid'];
    $cpassword = md5($_POST['currentpassword']);
    $newpassword = md5($_POST['newpassword']);

    $sql = "SELECT ID FROM tbluser WHERE ID=:userid AND Password=:cpassword";
    $query = $dbh->prepare($sql);
    $query->bindParam(':userid', $userid, PDO::PARAM_STR);
    $query->bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        $con = "UPDATE tbluser SET Password=:newpassword WHERE ID=:userid";
        $chngpwd1 = $dbh->prepare($con);
        $chngpwd1->bindParam(':userid', $userid, PDO::PARAM_STR);
        $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
        $chngpwd1->execute();

        echo '<script>alert("Your password has been successfully changed")</script>';
        echo "<script>window.location.href ='logout.php'</script>";
        exit();
    } else {
        echo '<script>alert("Your current password is wrong")</script>';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Bus Pass Management System | Change Password</title>
    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
    <!-- flexslider-CSS -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- font-awesome icons -->
    <!-- //Custom Theme files -->
    <!-- web-fonts -->
    <link href="//fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <script type="text/javascript">
        function checkpass() {
            if (document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
                alert('New Password and Confirm Password fields do not match');
                document.changepassword.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
</head>

<body>
    <div class="agileits-banner">
        <div class="bnr-agileinfo">
            <?php include_once('includes/header1.php'); ?>
            <div class="row">
                <h1 style="text-align: center; color: #FF5722;" class="page-header">Change Password</h1>
            </div>
            <div class="row" style="margin-right: 500px; margin-left: 500px;">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form name="changepassword" method="post" onsubmit="return checkpass();" action="">
                                        <div class="form-group">
                                            <label for="currentpassword">Current Password</label>
                                            <input type="password" name="currentpassword" id="currentpassword" class="form-control" required="true">
                                        </div>
                                        <div class="form-group">
                                            <label for="newpassword">New Password</label>
                                            <input type="password" name="newpassword" class="form-control" required="true">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirmpassword">Confirm Password</label>
                                            <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" required="true">
                                        </div>
                                        <p style="padding-left: 400px">
                                            <button type="submit" class="btn btn-primary" name="submit" id="submit">Change</button>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once('includes/footer.php'); ?>
        </div>
    </div>

    <!-- Core Scripts - Include with every page -->
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>

</body>

</html>
