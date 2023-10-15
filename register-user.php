<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['register'])) 
  {
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $name=$_POST['fullname'];
    $email=$_POST['email'];
    $phone=$_POST['phonenumber'];
    $sql ="SELECT ID FROM tbluser WHERE UserName=:username or Email=:email";
    $query=$dbh->prepare($sql);
    $query-> bindParam(':username', $username, PDO::PARAM_STR);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
        echo "<script>alert('Username or Email already exist!!!!');</script>";
    }
    else{
        $sql="INSERT INTO tbluser(Name, Email, MobileNumber, Password, UserName)values(:name,:email,:phone,:password,:username)";
        $query=$dbh->prepare($sql);
        $query-> bindParam(':name', $name, PDO::PARAM_STR);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> bindParam(':phone', $phone, PDO::PARAM_STR);
        $query-> bindParam(':password', $password, PDO::PARAM_STR);
        $query-> bindParam(':username', $username, PDO::PARAM_STR);
        $query-> execute();
        $LastInsertId=$dbh->lastInsertId();
    if ($LastInsertId>0) {
    echo "<script>alert('Sign-up Successful');</script>";
    echo "<script>window.location.href ='login-user.php'</script>";
    }
    else
    {
        echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
    }
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bus Pass Management System | User-Register</title>
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
    <link href="admin/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="admin/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                        <form role="form" method="post" name="login">
                                <h3 class="text-primary"><i class="fa fa-bus me-2"></i>Bus Pass System</h3>
                            </a>
                            <h3>Sign-Up</h3>
                        </div>
                            <fieldset>
                            <div class="form-group">
                                    <label for="login-name">Name</label>
                                     <input type="text" class="form-control"  required="true" name="fullname" pattern="[a-zA-Z]{3,20}$" placeholder="Enter Your Name">          
                                </div>

                                <div class="form-group">
                                    <label for="login-email">Email</label>
                                     <input type="email" class="form-control"  required="true" name="email" placeholder="Enter Your Email">          
                                </div>

                                <div class="form-group">
                                    <label for="login-phone">Phone Number</label>
                                     <input type="phone" class="form-control"  required="true" name="phonenumber" pattern="[0-9]{10}" placeholder="Enter the Phone Number">          
                                </div>

                                <div class="form-group">
                                    <label for="login-username">Username</label>
                                     <input type="text" class="form-control"  required="true" name="username" pattern="[a-z0-9]{3,20}$" placeholder="Enter the Username">          
                                </div>

                                <div class="form-group">
                                    <label for="login-password">Password</label>
                                    <input type="password" class="form-control" name="password" required="true" placeholder="Enter the Password">
                                                
                                </div>
                                <div>
                                <p>
                                    <p></p>
                                    <i class="fa fa-sign-in" style="font-size: 20px" aria-hidden="true"></i>
                                    <a href="login-user.php">Already have an Account</a></p>
                                <p>
                                <i class="fa fa-home" style="font-size: 20px" aria-hidden="true"></i>
                                <a href="index.php">Back to Home</a></p>
                                </div>

                                <input type="submit" value="Register" class="btn btn-lg btn-success btn-block" name="register" >
                            </fieldset>
                        </form>
                        
                        </div>
                    
                    </div>
                </div>
            </div>
            <!-- Sign In End -->
        </div>
    
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="admin/lib/chart/chart.min.js"></script>
        <script src="admin/lib/easing/easing.min.js"></script>
        <script src="admin/lib/waypoints/waypoints.min.js"></script>
        <script src="admin/lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="admin/lib/tempusdominus/js/moment.min.js"></script>
        <script src="admin/lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    
        <!-- Template Javascript -->
        <script src="admin/js/main.js"></script>
    </body>
    
    </html>
    