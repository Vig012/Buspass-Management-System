<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bus Pass Management System | View-pass-detail</title>
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

    <script type="text/javascript">     
    function PrintDiv() {    
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=500,height=500');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
       popupWin.document.close();
            }
 </script>
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

        <!--Table start-->
        <div class="container-fluid pt-4 px-4">
        <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                        <div class="row" id="divToPrint">
                            <h3 class="mb-4">Pass Details</h3>
                            <?php
$vid=$_GET['viewid'];
$sql="SELECT * from  tblpass where ID=$vid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                    <table border="1" class="table table-bordered" > 
                                    <tr align="center">
<td colspan="6" style="font-size:20px;color:red">
 Pass ID: <?php  echo ($row->PassNumber);?></td></tr>
   <tr>
        <th scope>Category</th>
    <td colspan="3"><?php  echo ($row->Category);?></td>
  </tr>
<tr>
    <th scope>Full Name</th>
    <td colspan="3"><?php  echo ($row->FullName);?></td>
    
  </tr>
  <tr>
    <th scope>Photo</th>
    <td colspan="3"><img src="images/<?php  echo ($row->ProfileImage);?>" width="50" height="50"></td>

  </tr>

  <tr>
    <th scope>Mobile Number</th>
    <td><?php  echo ($row->ContactNumber);?></td>
    <th scope>Email</th>
    <td><?php  echo ($row->Email);?></td>
  </tr>
<tr>
    <th scope>Identity Type</th>
    <td><?php  echo ($row->IdentityType);?></td>
    <th scope>Identity Card Number</th>
    <td><?php  echo ($row->IdentityCardno);?></td>

  </tr>
  <tr>
    <th scope>Source</th>
    <td><?php  echo ($row->Source);?></td>
    <th scope>Destination</th>
    <td><?php  echo ($row->Destination);?></td>
  </tr>
<tr>
    <th scope>From Date</th>
    <td><?php  echo ($row->FromDate);?></td>
    <th scope>To Date</th>
    <td><?php  echo ($row->ToDate);?></td>
  </tr>
  <tr>
    
    <th scope>Cost</th>
    <td><?php  echo ($row->Cost);?></td>
    <th scope>Pass Creation Date</th>
    <td><?php  echo ($row->PasscreationDate);?></td>
  </tr>
                                    
   <?php $cnt=$cnt+1;}} ?>
   </table>
   </div>
   <p style="text-align: center;font-size: 20px; color: red;">
   <input type="button" class="btn btn-outline-primary m-2"  value="print" onclick="PrintDiv();" /></p>

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
                            