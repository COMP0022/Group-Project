<?php
//still need to fill in information to connect but struggling at the moment.  
$link = mysqli_connect("localhost", "root", "")
	
if($link == false){die("ERROR: Could not connect".mysqli_connect_error())}

$usid = $_POST["userident"]
$firstname = $_POST["First_name"]
$lastname = $_POST["Last_name"]
$email = $_POST["email"]
$password = $_POST["password"]



$sq1 = "INSERT INTO Users (userid, Firstname, LastName, Email, Password) VALUES ($usid, $firstname, $lastname, $email, $password)"

mysqli_query($conn, $sq1)




mysqli_close($link)
?>