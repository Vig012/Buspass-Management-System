<?php
    require_once "/Xampp/htdocs/buspassms/stripe-php-master/init.php";

    
    $secretKey ="sk_test_51NBcXJSEyGVXkiTH4PFqSm1k7uqSYTKeTI9y5A09w7kKEl4Z7v5eDsSX9o75rtVQoGbKhp5A4mFlRMZqUPgKxnXo00LHfiROqW";
    $publishableKey ="pk_test_51NBcXJSEyGVXkiTHTKDSt5xJ8qmTB58hzS6Q8oJGpWXXJNy3sKP5hNPMIeQ8lscQjY9w2Ert8u142xoAG07Nh03f00BcVMNWzI";
    

    \Stripe\Stripe::setApiKey($secretKey);
?>