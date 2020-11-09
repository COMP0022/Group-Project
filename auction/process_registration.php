<?php

//connecting to database

$servername = 'localhost';
$username = 'Jacob';
$password = '';
$database_name = 'testdb';
$connect=mysqli_connect($servername, $username, $password, $database_name);
	
//checking connection and printing whether or not it connected	
if($connect){
	echo "connection success";
}
else{
	echo "Connection failed";
}

//defining POST variables
$email = $_POST['email'];
$Password = $_POST['password'];
$repeat_password = $_POST['passwordrepeat'];
$buyer = $_POST['buyer'];
$seller = $_POST['seller'];


//Creating insert code to insert registration into user table of testdb database

$query = "INSERT INTO users (email, password) VALUES ('$email', '$Password')";

/*only inserting data if the password and password repeat match. 
noting to user that information did not insert */

if ($Password == $repeat_password){
$result = mysqli_query($connect,$query)
	or die(" insert into database unsuccessfull");
}

/* writing an if statement below to register user as buyer or seller and not both.  
slightly confusing given the autoincrementation of both buyer_id and seller_id */


// telling user if their passwords do not match

if ($result and $Password == $repeat_password)
{
	echo "registered successfully";
}
else{
	echo "Passwords do not match";
}
mysqli_close($connect);
	
?> 
