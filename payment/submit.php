<?php
session_start();
    include('/Xampp/htdocs/buspassms/payment/config.php');
    include '/Xampp/htdocs/buspassms/includes/dbconnection.php';
     $amount = $_SESSION['amt'];
     $passid = $_SESSION['passid'];
   
    

    $token = $_POST["stripeToken"];
    $token_card_type = $_POST["stripeTokenType"];
    $charge = \Stripe\PaymentIntent::create([
      "amount" => str_replace(",","",$amount) * 100,
      "currency" => 'inr',
      "description"=>"Online payment",
      "card"=> [ 'token' => $request -> $token,]

    ]);

    if($charge){
      header("Location:success.php?passid=$passid");
    }
?>