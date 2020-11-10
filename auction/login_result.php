<?php

// TODO: Extract $_POST variables, check they're OK, and attempt to login.
// Notify user of success/failure and redirect/give navigation options.

// For now, I will just set session variables and redirect.

session_start();

$input_email = $_POST['email'];
$input_password = $_POST['password']; // Retreive the form input from header.php

include_once 'opendb.php'; // Make connection to the database 'testdb'
$query = "SELECT * FROM users WHERE email='$input_email' AND password='$input_password';";
$result = mysqli_query($connection,$query);
$row = mysqli_fetch_array($result); // Make query to the database and fetch user information

if (!$row){ echo('<div class="text-center">Login Failed. Email does not exist or Password Incorrect.</div>'); } // Login Failed

else {  
$_SESSION['logged_in'] = true;
$_SESSION['username'] = $row['user_id'];
if ($row['account_type']==0) {$_SESSION['account_type'] = 'buyer';}
if ($row['account_type']==1) {$_SESSION['account_type'] = 'seller';}         // Set session name and account type.
echo('<div class="text-center">You are now logged in as: '. $_SESSION['account_type'] . ', You will be redirected shortly.</div>');
// Redirect to index after 5 seconds
header("refresh:5;url=index.php");
}

mysqli_close($connection);
?>