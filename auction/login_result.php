<?php

// TODO: Extract $_POST variables, check they're OK, and attempt to login.
// Notify user of success/failure and redirect/give navigation options.

// For now, I will just set session variables and redirect.

session_start();

$input_email = $_POST['email'];
$input_password = $_POST['password']; // Retreive the form input from header.php

include_once 'opendb.php'; 
$check_query = "SELECT * FROM users WHERE email='$input_email' AND password='$input_password';";
$check_result = mysqli_query($connection,$check_query);
$check = mysqli_fetch_array($check_result);                     // Make query to the database and fetch stored user information

if (!$check){ echo('<div class="text-center">Login Failed. Email does not exist or Password Incorrect.</div>'); } // Invalid input, Login Failed
else {  

    $_SESSION['logged_in'] = true;
    $userid = $check['id'];
    $_SESSION['user_id'] = $check['id'];

    $seller_query = " SELECT seller_id FROM sellers WHERE user_id=$userid; ";
    $seller_result = mysqli_query($connection,$seller_query);
    $seller = mysqli_fetch_array($seller_result);
    if($seller) {$_SESSION['account_type'] = 'seller';
    $_SESSION['seller_id']=$seller['seller_id'];}  // Seller ID in session

    $buyer_query = " SELECT * FROM buyers WHERE user_id = $userid ";
    $buyer_result = mysqli_query($connection,$buyer_query);
    $buyer = mysqli_fetch_array($buyer_result);
    if($buyer) {$_SESSION['account_type'] = 'buyer';
    $_SESSION['buyer_id']=$buyer['buyer_id'];}  // Buyer ID in session

    if(!isset($_SESSION['account_type'])) {$_SESSION['account_type']= 'visitor';}  
// To Andrew: Defined session's account types and IDs for your usage.

// Set session name and account type.
    echo('<div class="text-center">You are now logged in as: '. $_SESSION['account_type'] . ', You will be redirected shortly.</div>');
// Redirect to index after 5 seconds
    header("refresh:5;url=index.php");
}

mysqli_close($connection);
?>