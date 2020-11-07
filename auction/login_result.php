<?php

// TODO: Extract $_POST variables, check they're OK, and attempt to login.
// Notify user of success/failure and redirect/give navigation options.

// For now, I will just set session variables and redirect.

session_start();

$input_email = $_POST['email'];
$input_password = $_POST['password'];


$connection =
mysqli_connect('localhost','root','Ll1029453257','testdb')
or die('Error connecting to MySQL server.'.mysql_error());
if ($connection){echo "DB connected</div>";}
$query = "SELECT * FROM users WHERE email='$input_email' AND passwd='$input_password'";
$result = mysqli_query($connection,$query);
$row = mysqli_fetch_array($result);

if (!$result){ echo('<div class="text-center">Login Failed. Email does not exist or Password Incorrect.</div>'); }

else {
$_SESSION['logged_in'] = true;
$_SESSION['username'] = $input_email;
if ($row['account_type']==0) {$_SESSION['account_type'] = 'buyer';}
if ($row['account_type']==1) {$_SESSION['account_type'] = 'seller';}
echo $_SESSION['account_type'];
echo('<div class="text-center">You are now logged in! You will be redirected shortly.</div>');
// Redirect to index after 5 seconds
header("refresh:5;url=index.php");
}

mysqli_close($connection);
?>