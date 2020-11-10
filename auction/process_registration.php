<?php

//connecting to database

$servername = 'localhost';
$username = 'Jacob';
$password = '';
$database_name = 'testdb';
$connect=mysqli_connect($servername, $username, $password, $database_name);
	
//checking connection and printing whether or not it connected	
if($connect){
	echo "connection success.";
}
else{
	echo "Connection failed";
}

//defining POST variables
$email = $_POST['email'];
$Password = $_POST['password'];
$repeat_password = $_POST['passwordrepeat'];





//Creating insert code to insert registration into user table of testdb database

$query = "INSERT INTO users (email, password) VALUES ('$email', '$Password')";
$buyerquery = "INSERT INTO buyers (user_id) SELECT (id) FROM users";
$sellerquery = "INSERT INTO sellers (user_id) SELECT (id) FROM users";
/*only inserting data if the password and password repeat match. 
noting to user that information did not insert */

if ($Password == $repeat_password){
$result = mysqli_query($connect,$query)
	or die(" insert into database unsuccessfull");
}

//if user registers as buyer then insert id into buyers table...auto incrementing buyer id
if ($_POST['accountType'] == "buyer"){
$buyerresult = mysqli_query($connect, $buyerquery);
}

//if user registers as seller then insert id into sellers table..auto incrementing seller id
if ($_POST['accountType'] == "seller"){
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



