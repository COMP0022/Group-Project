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

if(isset($_POST['button'])){
	$insert=mysqli_query($connect, "INSERT INTO (email, password) VALUES ('$email', '$Password')");
	if($insert){
		echo "Data inserted successful";
	}
	else{
		echo "Data inserted not successful";
		
	}
}


?>