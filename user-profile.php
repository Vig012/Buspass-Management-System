<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
    $userid=$_SESSION['bpmsaid'];
    $name=$_POST['fullname'];
    $mobile=$_POST['mobilenumber'];
    $email=$_POST['email'];
    $sql="update tbluser set Name=:fullname, MobileNumber=:mobilenumber ,Email=:email where ID=:userid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':fullname',$name,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':mobilenumber',$mobile,PDO::PARAM_STR);
    $query->bindParam(':userid',$userid,PDO::PARAM_STR);
    $query->execute();
    echo '<script>alert("Profile has been updated.")</script>';
    echo "<script>window.location.href ='dashboard.php'</script>";
    
  }
  ?>
<!DOCTYPE html>
<html>

<head>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <title>Bus Pass Management System | User Profile</title>
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
            <div class="row">
                <h1 style="text-align: center; color: #FF5722;" class="page-header">User Profile</h1>
            </div>
            <div class="row" style="margin-right: 455px; margin-left: 455px;">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post"> 
                                    <?php
                                    $userid=$_SESSION['bpmsaid'];

                                    $sql="SELECT * from  tbluser where ID=:userid";
                                    $query = $dbh -> prepare($sql);
                                    $query->bindParam(':userid',$userid,PDO::PARAM_STR);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $row)
                                    { ?>
                                    <div class="form-group"> <label for="exampleInputEmail1">Full Name</label> <input type="text" name="fullname" value="<?php  echo $row->Name;?>" class="form-control" required='true'> </div>
                                    <div class="form-group"> <label for="exampleInputEmail1">User Name</label> <input type="text" name="username" value="<?php  echo $row->UserName;?>" class="form-control" readonly=""> </div>
                                    <div class="form-group"> <label for="exampleInputEmail1">Contact Number</label><input type="text" name="mobilenumber" value="<?php  echo $row->MobileNumber;?>"  class="form-control" maxlength='10' required='true' pattern="[0-9]+"> </div>
                                    <div class="form-group"> <label for="exampleInputEmail1">Email address</label> <input type="email" name="email" value="<?php  echo $row->Email;?>" class="form-control" required='true'> </div> 
                                    <div class="form-group"> <label for="exampleInputPassword1">User Registration Date</label> <input type="text" name="" value="<?php  echo $row->UserRegDate;?>" readonly="" class="form-control"> </div><?php $cnt=$cnt+1;}} ?> 
                                    <p style="padding-left: 450px"><button type="submit" class="btn btn-primary" name="submit" id="submit">Update</button></p> </form>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once('includes/footer.php');?>
        </div>
    </div>


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
<?php }  ?>