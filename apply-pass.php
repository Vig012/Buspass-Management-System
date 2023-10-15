<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');


if(isset($_POST['close-pass']))
{
    header('location:dashboard.php');
}

if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {


$fname=$_POST['fullname'];
$cnum=$_POST['cnumber'];
$email=$_POST['email'];
$itype=$_POST['identitytype'];
$icnum=$_POST['icnum'];
$cat=$_POST['category'];
$source=$_POST['source'];
$des=$_POST['destination'];
$fdate=$_POST['fromdate'];
$tdate=$_POST['todate'];
$passnum=mt_rand(100000000, 999999999);
$propic=$_FILES["propic"]["name"];
$extension = substr($propic,strlen($propic)-4,strlen($propic));
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Profile Pics has Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{

$propic=md5($propic).time().$extension;
 move_uploaded_file($_FILES["propic"]["tmp_name"],"admin/images/".$propic);
$sql="insert into tblpass(PassNumber,FullName,ProfileImage,ContactNumber,Email,IdentityType,IdentityCardno,Category,Source,Destination,FromDate,ToDate)values(:passnum,:fname,:propic,:cnum,:email,:itype,:icnum,:cat,:source,:des,:fdate,:tdate)";
$query=$dbh->prepare($sql);
$query->bindParam(':passnum',$passnum,PDO::PARAM_STR);
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
$query->bindParam(':propic',$propic,PDO::PARAM_STR);

 $query->execute();

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Pass Applied sucessfully. Wait for a Confirmation")</script>';
echo "<script>window.location.href ='dashboard.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

}
}
?>

<!DOCTYPE html>
<html>

<head>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <title>Bus Pass Management System | Appy For a Pass</title>
    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="all"> 
    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />  <!-- flexslider-CSS --> 
    <link href="css/font-awesome.css" rel="stylesheet">		<!-- font-awesome icons -->  
    <!-- //Custom Theme files -->  
    <!-- web-fonts -->   
    <link href="//fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet"> 
</head>

<body>

    <div class="agileits-banner">
        <div class="bnr-agileinfo"> 
            <?php include_once('includes/header1.php');?>
                 <!-- page header -->
                    <div class="row" >
                    <h1 style="text-align: center; color: #FF5722;" class="page-header">Apply Pass</h1>
                    </div>
                <!--end page header -->
                <div class="row" style="margin-right: 355px; margin-left: 355px;">
                    <div class="col-lg-12">
                        <!-- Form Elements -->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" enctype="multipart/form-data"> 
                                    
                                    <div class="form-group"> <label for="exampleInputEmail1">Full Name</label> <input type="text" name="fullname" value="" class="form-control" required='true'> </div>
                                    <div class="form-group"> <label for="exampleInputEmail1">Profile Image</label> <input type="file" name="propic" value="" class="form-control" required='true'> </div>
                                    <div class="form-group"> <label for="exampleInputEmail1">Contact Number</label> <input type="text" name="cnumber" value="" class="form-control" required='true' maxlength="10" pattern="[0-9]+"> </div>
                                    <div class="form-group"> <label for="exampleInputEmail1">Email Address</label> <input type="email" name="email" value="" class="form-control" required='true'> </div>
                                    <div class="form-group"> <label for="exampleInputEmail1">Identity Type</label><select type="text" name="identitytype" value="" class="form-control" required='true'>
                                    <option value="">Choose Identity Type</option>
                                    <option value="Voter Card">Voter Card</option>
                                    <option value="PAN Card">PAN Card</option>
                                    <option value="Adhar Card">Adhar Card</option>
                                    <option value="Student Card">Student Card</option>
                                    <option value="Driving License">Driving License</option>
                                    <option value="Passport">Passport</option>
                                    <option value="Any Official Card">Any Official Card</option>
                                    <option value="Any Other Govt Issued Doc">Any Other Govt Issued Doc</option>
                                    </select></div>
                                    <div class="form-group"> <label for="exampleInputEmail1">Identity Card No.</label> <input type="text" name="icnum" value="" class="form-control" required='true'> </div>
                                    <div class="form-group"> <label for="exampleInputEmail1">Category</label><select type="text" name="category" value="" class="form-control" required='true'>
                                    <?php 

                                    $sql2 = "SELECT * from   tblcategory";
                                    $query2 = $dbh -> prepare($sql2);
                                    $query2->execute();
                                    $result2=$query2->fetchAll(PDO::FETCH_OBJ);

                                    foreach($result2 as $row)
                                    {          
                                    ?>  
                                    <option value="<?php echo htmlentities($row->CategoryName);?>"><?php echo htmlentities($row->CategoryName);?></option>
                                    <?php } ?>
                                    </select></div>
                                    <div class="form-group"> <label for="exampleInputEmail1">Source</label> <input type="text" name="source" value="" class="form-control" required='true'> </div>
                                    <div class="form-group"> <label for="exampleInputEmail1">Destination</label> <input type="text" name="destination" value="" class="form-control" required='true'> </div>
                                    <div class="form-group"> <label for="exampleInputEmail1">From Date</label> <input type="date" name="fromdate" value="" class="form-control" required='true'> </div>
                                    <div class="form-group"> <label for="exampleInputEmail1">To Date</label> <input type="date" name="todate" value="" class="form-control" required='true'> </div>
                                    <a style="padding-left: 550px"><button type="submit" class="btn btn-primary" name="submit" id="submit">Apply</button></a> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                    <a class="btn btn-primary" href="dashboard.php" onclick="return confirm('Do you want to close ?');">cancel</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
            <?php include_once('includes/footer.php');?>
        </div>
    </div>
    <!-- end wrapper -->

    <!-- js --> 
	<script src="js/jquery-2.2.3.min.js"></script> 
	<script src="js/SmoothScroll.min.js"></script>
	<script src="js/jarallax.js"></script> 
	<script type="text/javascript">
		/* init Jarallax */
		$('.jarallax').jarallax({
			speed: 0.5,
			imgWidth: 1366,
			imgHeight: 768
		})
	</script>  	
	<!-- //js --> 
	<!-- Progressive-Effects-Animation-JavaScript -->  
	<script type="text/javascript" src="js/numscroller-1.0.js"></script>
	<!-- //Progressive-Effects-Animation-JavaScript -->
	<!-- start-smooth-scrolling --> 
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>	
	<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
			
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
	</script>
	<!-- //end-smooth-scrolling -->	 
	<!-- smooth-scrolling-of-move-up -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
			};
			*/
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
	<!-- //smooth-scrolling-of-move-up -->  
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.js"></script>
</body>
</html>
<?php } ?>