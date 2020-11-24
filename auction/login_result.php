<?php

// TODO: Extract $_POST variables, check they're OK, and attempt to login.
// Notify user of success/failure and redirect/give navigation options.

// For now, I will just set session variables and redirect.

session_start();

$input_email = $_POST['email'];
$input_password = $_POST['password'];                           // Retreive the form input from header.php

include_once 'opendb.php'; 
$check_query = "SELECT * FROM users WHERE email='$input_email' AND password=SHA('$input_password');";
$check_result = mysqli_query($connection,$check_query);
$check = mysqli_fetch_array($check_result);                     // Make query to the database and fetch stored user information

if (!$check)
{ 
    echo('<div class="text-center">Login Failed. Email does not exist or Password Incorrect.</div>'); 
    mysqli_close($connection);
    header("refresh:2;url=index.php");
}                                                              // Invalid input, Login Failed, Return to browse page

else 
{  
    $_SESSION['logged_in'] = true;                             // Login success, next, check seller and buyer id

    $userid = $check['id'];
    $_SESSION['user_id'] = $check['id'];                       // Define the logged in user's user_id as SESSION variable for other uses

    $seller_query = " SELECT seller_id FROM sellers WHERE user_id=$userid; ";
    $seller_result = mysqli_query($connection,$seller_query);
    $seller = mysqli_fetch_array($seller_result);
    if($seller) {$_SESSION['account_type'] = 'seller';
    $_SESSION['seller_id']=$seller['seller_id'];}              // Check if the logged in user was registered as a seller, if so, get its seller_id for other uses

    $buyer_query = " SELECT * FROM buyers WHERE user_id = $userid ";
    $buyer_result = mysqli_query($connection,$buyer_query);
    $buyer = mysqli_fetch_array($buyer_result);
    if($buyer) {$_SESSION['account_type'] = 'buyer';
    $_SESSION['buyer_id']=$buyer['buyer_id'];}                 // Check if the logged in user was registered as a buyer, if so, get its buyer_id for other uses

    if(!isset($_SESSION['account_type'])) {$_SESSION['account_type']= 'visitor';}  
                                                               // If the user was not registered as buyer or seller, mark him/her as a visitor


    echo('<div class="text-center">You are now logged in as: '. $_SESSION['account_type'] . ', You will be redirected shortly.</div>');
    mysqli_close($connection);
    header("refresh:2;url=index.php");                         // Tell user of login success and give redirection
}

?>