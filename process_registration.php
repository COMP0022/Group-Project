<?php
$servername = "localhost";
$username = "root";
$password = "";
$database_name = "testdb";
$connect=mysqli_connect($servername, $username, $password, $database_name);
	
if($connect){
	echo "connection success";
}
else{
	echo "Connection failed";
}

$email = $_POST['email'];
$Password = $_POST['password'];



$query = "INSERT INTO users (email, password) VALUES ('$email', '$Password');";
	   
$result = mysqli_query($connect,$query)
	or die("Error making saveToDatabase query");
	
mysqli_close($connect)
	
?> 


