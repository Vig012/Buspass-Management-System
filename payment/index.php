<?php
session_start();
include('/Xampp/htdocs/buspassms/payment/config.php');
include '/Xampp/htdocs/buspassms/includes/dbconnection.php';

if(isset($_GET['passid'])){
    $passid = $_GET['passid'];
    $sql ="SELECT * FROM tblpass WHERE PassNumber='$passid'";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
    foreach($results as $row)
    $pay = $row->Payment;
    }
    if($pay == 'Done'){
        header('location: succes.php');

    }else{

    $sql = "SELECT Cost FROM tblpass WHERE PassNumber='$passid'";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
    foreach($results as $row)
    $cost = $row->Cost; 
    }
    $_SESSION['amt'] = $cost;
    $_SESSION['passid'] = $passid;
    }
} 


?>
<form action="submit.php" method="POST" class= "form-group">
<center>
<br>
<br>
<div class="card">
                        <div class="card-header">
                        <h2>Please Click On The Below Link</h2>
                        </div>
                           
<script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="<?php echo $publishableKey?>"
                data-amount="<?php echo str_replace(",","",$_SESSION['amt'])* 100?>"
                data-name="Online Bus Pass"
                data-description="Online payment"
                data-image="https://i0.wp.com/www.freestudentprojects.com/wp-content/uploads/2019/09/Bus-Pass-Online-Application.jpg"
                data-currency="inr"
                data-locale="auto">
                                </script>
                
</div>
</center>
</form>
