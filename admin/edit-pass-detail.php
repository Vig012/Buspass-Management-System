<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
    $fname=$_POST['fullname'];
    $cnum=$_POST['cnumber'];
    $email=$_POST['email'];
    $itype=$_POST['identitytype'];
    $status=$_POST['status'];
    $icnum=$_POST['icnum'];
    $cat=$_POST['category'];
    $source=$_POST['source'];
    $des=$_POST['destination'];
    $fdate=$_POST['fromdate'];
    $tdate=$_POST['todate'];
    $cost=$_POST['cost'];
    $eid=$_GET['editid'];
    $sql="update tblpass set FullName=:fname,ContactNumber=:cnum,Email=:email,IdentityType=:itype,IdentityCardno=:icnum,Category=:cat,Source=:source,Destination=:des,FromDate=:fdate,ToDate=:tdate, Cost=:cost, Status=:status where ID=:eid";
    $query=$dbh->prepare($sql);
    
    $query->bindParam(':fname',$fname,PDO::PARAM_STR);
    $query->bindParam(':cnum',$cnum,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':itype',$itype,PDO::PARAM_STR);
    $query->bindParam(':icnum',$icnum,PDO::PARAM_STR);
    $query->bindParam(':cat',$cat,PDO::PARAM_STR);
    $query->bindParam(':source',$source,PDO::PARAM_STR);
    $query->bindParam(':des',$des,PDO::PARAM_STR);
    $query->bindParam(':fdate',$fdate,PDO::PARAM_STR);
    $query->bindParam(':tdate',$tdate,PDO::PARAM_STR);
    $query->bindParam(':cost',$cost,PDO::PARAM_STR);
    $query->bindParam(':status',$status,PDO::PARAM_STR);
    $query->bindParam(':eid',$eid,PDO::PARAM_STR);
     $query->execute();
    
      
             echo '<script>alert("Pass Detail has been updated")</script>';
             echo '<script>window.location.href="manage-pass.php"</script>';
    
  }
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Bus Pass Management System | edit pass details</title>
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
                            <h3 class="mb-4">Update Pass</h3>
                            <form method="post">
                            <?php
$eid=$_GET['editid'];
$sql="SELECT * from  tblpass where ID=$eid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?> 
  <p colspan="6" style="font-size:20px;color:red;text-align: center;">Pass ID: <?php  echo ($row->PassNumber);?></p>
  <div class="mb-3"><label for="exampleInputfullname" class="form-label">Full Name</label>
  <input type="text" name="fullname" value="<?php  echo $row->FullName;?>" class="form-control" required='true'></div>
  <div class="mb-3"><label for="exampleInputphoto" class="form-label">Photo</label>
  <img src="images/<?php echo $row->ProfileImage;?>" width="50" height="50" value="<?php  echo $row->ProfileImage;?>">
  <a href="changeimage1.php?editid=<?php echo $row->ID;?>"> &nbsp; Edit Image</a> </div>
  <div class="mb-3"><label for="exampleInputcontact" class="form-label">Contact Number</label>
  <input type="text" name="cnumber" value="<?php  echo $row->ContactNumber;?>" class="form-control" required='true'></div>
  <div class="mb-3"><label for="exampleInputemail" class="form-label">Email</label>
  <input type="email" name="email" value="<?php  echo $row->Email;?>"  class="form-control" required='true'></div>
  <div class="mb-3"><label for="exampleInputIdentity" class="form-label">Identity Type</label>
  <select type="text" name="identitytype" value="" class="form-control" required='true'>
    <option value="<?php  echo $row->IdentityType;?>"><?php  echo $row->IdentityType;?></option>
    <option value="Voter Card">Voter Card</option>
    <option value="PAN Card">PAN Card</option>
    <option value="Adhar Card">Adhar Card</option>
    <option value="Student Card">Student Card</option>
    <option value="Driving License">Driving License</option>
    <option value="Passport">Passport</option>
    <option value="Any Official Card">Any Official Card</option>
    <option value="Any Other Govt Issued Doc">Any Other Govt Issued Doc</option>
  </select></div>
  <div class="mb-3"><label for="exampleInputIdentitynumber" class="form-label">Identity Card Number</label>
  <input type="text" name="icnum" value="<?php  echo $row->IdentityCardno;?>" class="form-control" required='true'></div>
  <div class="mb-3"><label for="exampleInputcategory" class="form-label">Category Name</label>
  <select type="text" name="category" value="" class="form-control" required='true'>
     <option value="<?php  echo $row->Category;?>"><?php  echo $row->Category;?></option>
     <?php 

        $sql2 = "SELECT * from   tblcategory";
        $query2 = $dbh -> prepare($sql2);
        $query2->execute();
        $result2=$query2->fetchAll(PDO::FETCH_OBJ);

        foreach($result2 as $row2)
        {          
            ?>  
        <option value="<?php echo htmlentities($row2->CategoryName);?>"><?php echo htmlentities($row2->CategoryName);?></option>
        <?php } ?>
   </select></div>
   <div class="mb-3"><label for="exampleInputsource" class="form-label">Source</label>
   <input type="text" name="source" value="<?php  echo $row->Source;?>" class="form-control" required='true'> </div>
   <div class="mb-3"><label for="exampleInputdest" class="form-label">Destination</label>
   <input type="text" name="destination" value="<?php  echo $row->Destination;?>" class="form-control" required='true'> </div>
   <div class="mb-3"><label for="exampleInputfdate" class="form-label">From Date</label>
   <input type="date" name="fromdate" value="<?php  echo $row->FromDate;?>" class="form-control" required='true'> </div>
   <div class="mb-3"><label for="exampleInputtdate" class="form-label">To Date</label>
   <input type="date" name="todate" value="<?php  echo $row->ToDate;?>" class="form-control" required='true'> </div>
   <div class="mb-3"><label for="exampleInputcost" class="form-label">Cost</label>
   <input type="text" name="cost" value="<?php  echo $row->Cost;?>" class="form-control" required='true' readonly="true"> </div>
   <div class="mb-3"><label for="exampleInputcost" class="form-label">Status</label>
   <select type="text" name="status" value="<?php  echo $row->Status;?>" class="form-control" required='true' readonly="true">
   <option value="Verified" readonly="true">Verified</option>
        </select></div>
   <div class="mb-3"><label for="exampleInputcreationdate" class="form-label">Creation Date</label>
   <input type="text" value="<?php  echo $row->PasscreationDate;?>" class="form-control" readonly='true'> </div>
   <?php $cnt=$cnt+1;}} ?> 
   <p style="text-align:left;"><button type="submit"  class="btn btn-outline-success" name="submit" id="submit">Update</button>
   <a  style="float: right" class="btn btn-outline-primary" href="manage-pass.php" onclick="return confirm('Do you want to close ?');">Cancel</a></p>
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