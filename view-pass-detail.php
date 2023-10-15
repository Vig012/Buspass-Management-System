<?php
include('includes/dbconnection.php');
session_start();
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Bus Pass Management System || View Pass Page</title>
	<!-- Custom Theme files -->
	<link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
	<link href="css/style.css" type="text/css" rel="stylesheet" media="all">
	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- //Custom Theme files -->
	<!-- web-fonts -->
	<link href="//fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
	<!-- //web-fonts -->
	<script type="text/javascript">
		function PrintDiv() {
			var divToPrint = document.getElementById('divToPrint');
			var popupWin = window.open('', '_blank', 'width=1000,height=1000');
			popupWin.document.open();
			popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
			popupWin.document.close();
		}
	</script>
</head>

<body>
	<!-- banner -->
	<div class="agileits-banner">
		<div class="bnr-agileinfo">
			<!-- navigation -->
			<?php include_once('includes/header1.php'); ?>
			<!-- //navigation -->
			<!-- banner-text -->
			<div class="banner-text agileinfo about-bnrtext">
				<div class="container">
					<h2><a href="index.php">Home</a> / View Pass</h2>
				</div>
			</div>
			<!-- //banner-text -->
		</div>
	</div>
	<!-- //banner -->
	<!-- contact -->
	<div class="contact agileits">
		<div class="container">
			<div class="agileits-title">
				<h3>View Pass</h3>
			</div>
			<div class="contact-agileinfo">
				<div class="clearfix"></div>
				<div class="table-responsive" id="divToPrint">
					<?php
					$vid = $_GET['viewid'];
					$sql = "SELECT * FROM tblpass WHERE ID = :vid";
					$query = $dbh->prepare($sql);
					$query->bindParam(':vid', $vid, PDO::PARAM_INT);
					$query->execute();
					$results = $query->fetchAll(PDO::FETCH_OBJ);
					$cnt = 1;
					if ($query->rowCount() > 0) {
						foreach ($results as $row) {
							// Generate QR code using an API
								$qrCodeData = "Pass ID: " . $row->PassNumber . "    Category: " . $row->Category . "\n"
								. "Full Name: " . $row->FullName . "      Email: " . $row->Email . "\n"
								. "Source: " . $row->Source . "      Destination: " . $row->Destination . "\n"
								. "From Date: " . $row->FromDate . "    To Date: " . $row->ToDate;

							$qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' . urlencode($qrCodeData) . '&size=200x200';

							?>

							<table border="2" class="table table-bordered" style="font-size: 18px;">
								<tr text-align="center">
									<td colspan="3" style="font-size: 20px; color: red;">Pass ID: <?php echo $row->PassNumber; ?></td>
									<td rowspan="4"><img src="<?php echo $qrCodeUrl; ?>" alt="QR Code"></td>
								</tr>
								<tr>
									<th scope="row">Category</th>
									<td colspan="2"><?php echo $row->Category; ?></td>
								</tr>
								<tr>
									<th scope="row">Full Name</th>
									<td colspan="2"><?php echo $row->FullName; ?></td>
								</tr>
								<tr>
                                    <th scope="row">Photo</th>
                                    <td colspan="3"><img src="admin/images/<?php echo ($row->ProfileImage);?>" width="50" height="50"></td>
                                </tr>
                                <tr>
                                    <th scope="row">Mobile Number</th>
                                    <td><?php echo ($row->ContactNumber);?></td>
                                    <th scope="row">Email</th>
                                    <td><?php echo ($row->Email);?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Identity Type</th>
                                    <td><?php echo ($row->IdentityType);?></td>
                                    <th scope="row">Identity Card Number</th>
                                    <td><?php echo ($row->IdentityCardno);?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Source</th>
                                    <td><?php echo ($row->Source);?></td>
                                    <th scope="row">Destination</th>
                                    <td><?php echo ($row->Destination);?></td>
                                </tr>
                                <tr>
                                    <th scope="row">From Date</th>
                                    <td><?php echo ($row->FromDate);?></td>
                                    <th scope="row">To Date</th>
                                    <td><?php echo ($row->ToDate);?></td>
                                </tr>
                                <tr>  
                                    <th scope="row">Cost</th>
                                    <td><?php echo ($row->Cost);?></td>
                                    <th scope="row">Pass Creation Date</th>
                                    <td><?php echo ($row->PasscreationDate);?></td>
                                </tr>         
								<!-- Add other rows as needed -->
							</table>

					<?php
							$cnt++;
						}
					} ?>
				</div>
				<input type="button" style="padding-right: 20px;" class="btn btn-primary" value="Print" onclick="PrintDiv();" />
			</div>
		</div>
	</div>
	<!-- //contact -->

	<?php include_once('includes/footer.php'); ?>

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
	<!-- start-smooth-scrolling -->
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event) {
				event.preventDefault();
				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function() {


			$().UItoTop({
				easingType: 'easeOutQuart'
			});

		});
	</script>
	<script src="js/bootstrap.js"></script>
</body>

</html>
