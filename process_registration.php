<?php
$servername = 'localhost';
$username = 'Jacob';
$password = '';
$database_name = 'testdb';
$connect=mysqli_connect($servername, $username, $password, $database_name);
	
	
if($connect){
	echo "connection success";
}
else{
	echo "Connection failed";
}

$email = $_POST['email'];
$Password = $_POST['password'];
$repeat_password = $_POST['passwordrepeat'];



$query = "INSERT INTO users (email, password) VALUES ('$email', '$Password')";

if ($Password == $repeat_password){
$result = mysqli_query($connect,$query)
	or die(" insert into database unsuccessfull");
}
	
if ($result and $Password == $repeat_password)
{
	echo "registered successfully";
}
else{
	echo "Passwords do not match";
}
mysqli_close($connect);
	
?> 


