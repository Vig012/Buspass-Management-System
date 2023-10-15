<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {


 $catname=$_POST['catname'];

$eid=$_GET['editid'];
$ret="select CategoryName from tblcategory where CategoryName=:catname";
 $query= $dbh -> prepare($ret);
$query->bindParam(':catname',$catname,PDO::PARAM_STR);

$query-> execute();
     $results = $query -> fetchAll(PDO::FETCH_OBJ);
     if($query -> rowCount() == 0)
{
$sql="update tblcategory set CategoryName=:catname where ID=:eid";
$query=$dbh->prepare($sql);
$query->bindParam(':catname',$catname,PDO::PARAM_STR);

$query->bindParam(':eid',$eid,PDO::PARAM_STR);

 $query->execute();

   echo '<script>alert("Category name has been updated")</script>';
   echo '<script>window.location.href="manage-category.php"</script>';
  
}
else
{

echo "<script>alert('Category Name Already Exist. Please try again');</script>";
}
}
?>
<html>>
<head>
    <meta charset="utf-8">
    <title>Bus Pass Management System | Update Category </title>
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
    <?php include('includes/sidebar1.php');?>
    
    <div class="content">
    <?php include_once('includes/header.php');?>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="container-fluid pt-4 px-4">
        <div class="col-12">
        <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h3 class="mb-4">Update Category</h3>
                            <form method="post">
                            <?php
$eid=$_GET['editid'];
$sql="SELECT * from  tblcategory where ID=$eid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
<div class="mb-3">
                                    <label for="exampleInputcategory" class="form-label">Category Name</label>
                                    <input type="text" name="catname" value="<?php  echo $row->CategoryName;?>" class="form-control" required='true'>
                                    </div>
                                    <?php $cnt=$cnt+1;}} ?> 
                                <p><button type="submit" class="btn btn-outline-success" name="submit" id="submit">Update</button>
                                <a  style="float: right" class="btn btn-outline-primary" href="manage-category.php" onclick="return confirm('Do you want to close ?');">Cancel</a></p>
                             </form>
                          </div>
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
<?php }  ?>