<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Redirect to logout if session is empty
if (empty($_SESSION['bpmsaid'])) {
    header('location:logout.php');
    exit();
}


// Fetch total categories
$sql = "SELECT ID FROM tblcategory";
$query = $dbh->prepare($sql);
$query->execute();
$totalcat = $query->rowCount();

// Fetch total passes
$sql = "SELECT ID FROM tblpass where Payment='Done'";
$query = $dbh->prepare($sql);
$query->execute();
$totalpass = $query->rowCount();

// Fetch total users
$sql = "SELECT ID FROM tbluser";
$query = $dbh->prepare($sql);
$query->execute();
$totaluser = $query->rowCount();

//pending pass
$sql = "SELECT ID FROM tblpass where Status='Pending' ";
$query = $dbh->prepare($sql);
$query->execute();
$totalpendingpass = $query->rowCount();

//unreaded enquiry
$sql = "SELECT ID FROM tblcontact where IsRead='0' ";
$query = $dbh->prepare($sql);
$query->execute();
$totalunread = $query->rowCount();

//payment not done
$sql = "SELECT ID FROM tblpass where Payment='Not Done' ";
$query = $dbh->prepare($sql);
$query->execute();
$totalpendingpay = $query->rowCount();

//Total revenue
$sql = "SELECT SUM(Cost) AS TotalCost FROM tblpass WHERE Payment = 'Done'";
$query = $dbh->prepare($sql);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);
$totalCost = $result['TotalCost'];

// Fetch passes created today
$sql = "SELECT ID FROM tblpass WHERE DATE(PasscreationDate) = CURDATE() and Payment='Done'";
$query = $dbh->prepare($sql);
$query->execute();
$today_pass = $query->rowCount();

// Fetch passes created in the last 7 days
$sql = "SELECT ID FROM tblpass WHERE DATE(PasscreationDate) >= (DATE(NOW()) - INTERVAL 7 DAY)";
$query = $dbh->prepare($sql);
$query->execute();
$seven_pass = $query->rowCount();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bus Pass Management System | Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include_once('includes/sidebar.php'); ?>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Content Start -->
        <div class="content">
        <?php include_once('includes/header.php'); ?>


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-bus fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Bus Category</p>
                                <h6 class="mb-0"><?php echo htmlentities($totalcat); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-id-card fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Pass</p>
                                <h6 class="mb-0"><?php echo htmlentities($totalpass); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-user fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total User</p>
                                <h6 class="mb-0"><?php echo htmlentities($totaluser); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Revenue</p>
                                <h6 class="mb-0"><?php echo htmlentities($totalCost); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-check-square fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Pending pass Requests</p>
                                <h6 class="mb-0"><?php echo htmlentities($totalpendingpass); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-check-square fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Unreaded Enquiry</p>
                                <h6 class="mb-0"><?php echo htmlentities($totalunread); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-check-square fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Pending Payments</p>
                                <h6 class="mb-0"><?php echo htmlentities($totalpendingpay); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-check-square fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Pass Created Toady</p>
                                <h6 class="mb-0"><?php echo htmlentities($today_pass); ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>