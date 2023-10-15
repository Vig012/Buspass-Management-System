<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
    exit();
} else {
    if (isset($_POST['submit'])) {
        $eid = $_GET['editid'];
        $propic = $_FILES["propic"]["name"];
        $extension = substr($propic, strlen($propic) - 4, strlen($propic));
        $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");
        
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Profile Pics has an invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        } else {
            $propic = md5($propic) . time() . $extension;
            move_uploaded_file($_FILES["propic"]["tmp_name"], "images/" . $propic);

            $query = "UPDATE tblpass SET ProfileImage=:propic WHERE ID=:eid";
            $query = $dbh->prepare($query);
            $query->bindParam(':propic', $propic, PDO::PARAM_STR);
            $query->bindParam(':eid', $eid, PDO::PARAM_STR);
            $query->execute();

            echo '<script>alert("Profile pic has been updated")</script>';
            echo "<script>window.location.href='edit-pending-pass-detail.php?editid=$eid'</script>";
        }
    }
}
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Bus Pass Management System | Change Image</title>
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
    <?php include('includes/sidebar2.php');?>
    
    <div class="content">
        <?php include_once('includes/header.php');?>
        <div class="container-fluid position-relative d-flex p-0">
            <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            <div class="container-fluid pt-4 px-4">
                <div class="col-12">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h3 class="mb-4">Update Image</h3>
                            <form method="post" enctype="multipart/form-data">
                                <?php
                                $eid = $_GET['editid'];
                                $sql = "SELECT * FROM tblpass WHERE ID = :eid";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $row) {
                                        ?>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1">Full Name</label>
                                            <input type="text" name="fullname" value="<?php echo $row->FullName; ?>" class="form-control" readonly="true">
                                        </div>                 
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1">Old Photo</label>
                                            <img src="images/<?php echo $row->ProfileImage; ?>" width="50" height="50" alt="Old Photo">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1">New Photo</label>
                                            <input type="file" name="propic" accept="images/*">
                                        </div>
                                <?php
                                        $cnt = $cnt + 1;
                                    }
                                }
                                ?> 
                                <p style="text-align:center">
                                    <button type="submit" class="btn btn-primary" name="submit" id="submit">Update</button>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
