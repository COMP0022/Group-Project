<?php

//connecting to database

$servername = 'localhost';
$username = 'COMP0022';
$password = 'test';
$database_name = 'testdb';
$connect=mysqli_connect($servername, $username, $password, $database_name);
	
//checking connection and printing whether or not it connected	
if($connect){
	echo "Connection success.";
}
else{
	echo "Connection failed";
}

//defining POST variables
$email = $_POST['email'];
$Password = $_POST['password'];
$repeat_password = $_POST['passwordrepeat'];
$accounttype = $_POST['accountType'];







//Creating insert code to insert registration into user table of testdb database

$query = "INSERT INTO users (email, password) VALUES ('$email', '$Password')";
$buyerquery = "INSERT INTO buyers (user_id) SELECT (id) FROM users WHERE email = '$email'";
$sellerquery = "INSERT INTO sellers (user_id) SELECT (id) FROM users WHERE email = '$email'";
$emailquery = ("SELECT * FROM users WHERE email = '$email'");


$emailresult = mysqli_query($connect, $emailquery);
$emailcheck = mysqli_num_rows($emailresult)>0;
if($emailcheck){
	echo " Email already registered.";
}
else{
if ($Password == $repeat_password){
$result = mysqli_query($connect,$query)
	or die(" insert into database unsuccessfull");
}
}
/*only inserting data if the password and password repeat match. 
noting to user that information did not insert */



//if user registers as buyer then insert id into buyers table...auto incrementing buyer id


if ($accounttype == "buyer"){
$buyerresult = mysqli_query($connect, $buyerquery);
}

//if user registers as seller then insert id into sellers table..auto incrementing seller id
if ($accounttype == "seller"){
$sellerresult = mysqli_query($connect, $sellerquery);
}





// telling user if their passwords do not match

if ($result and $Password == $repeat_password)
{
	echo " Registered successfully. Registered with email: $email";
}
else{
	echo " Passwords do not match";
}
mysqli_close($connect);
	
?> 



