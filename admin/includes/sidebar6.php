<?php
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bus Pass Dashboard</title>
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
 <!-- Sidebar Start -->
 <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="dashboard.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-bus me-2"></i>BUS PASS</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <?php
                            $aid = $_SESSION['bpmsaid'];
                            $sql = "SELECT AdminName FROM tbladmin WHERE ID=:aid";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':aid', $aid, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $row) {
                            ?>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $row->AdminName; ?></h6>
                        <span>Online</span>
                    </div>
                    <?php $cnt = $cnt + 1;
                                }
                            } ?>
                </div>
                <div class="navbar-nav w-100">
                    <a href="dashboard.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-bus me-2"></i>Bus Category</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="add-category.php" class="dropdown-item">Add Category</a>
                            <a href="manage-category.php" class="dropdown-item">Manage category</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-id-card me-2"></i>Pass</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="pending-pass.php" class="dropdown-item">Pending Request</a>
                            <a href="pending-payment.php" class="dropdown-item">Pending payment</a>
                            <a href="manage-pass.php" class="dropdown-item">Manage pass</a>
                        </div>
                    </div>
                    <a href="manage-user.php" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Users</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-check-square me-2"></i>Enquiry</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="readenq.php" class="dropdown-item">Read Enquiry</a>
                            <a href="unreadenq.php" class="dropdown-item">Unread Enquiry</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-file me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="aboutus.php" class="dropdown-item">About US</a>
                            <a href="contactus.php" class="dropdown-item">Contact US</a>
                        </div>
                    </div>
                    <a href="search-pass.php" class="nav-item nav-link active"><i class="fa fa-search me-2"></i>Search</a>
                    <a href="pass-bwdates-report.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Report of Pass</a>
                </div>
            </nav>
        </div>
<!-- Sidebar End -->

</body>
</html>
