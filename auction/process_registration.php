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
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

$Password = $_POST['password'];
$repeat_password = $_POST['passwordrepeat'];
$accounttype = $_POST['accountType'];







//Creating insert code to insert registration into user table of testdb database

$query = "INSERT INTO users (email, password) VALUES ('$email', SHA('$Password'))";
$buyerquery = "INSERT INTO buyers (user_id) SELECT (id) FROM users WHERE email = '$email'";
$sellerquery = "INSERT INTO sellers (user_id) SELECT (id) FROM users WHERE email = '$email'";
$emailquery = ("SELECT * FROM users WHERE email = '$email'");


$emailresult = mysqli_query($connect, $emailquery);
$emailcheck = mysqli_num_rows($emailresult)>0;
if($emailcheck){
	echo " Email already registered. ";
	header('Refresh:3, url=browse.php'); //add sessions later
}
else{
if (filter_var($email, FILTER_VALIDATE_EMAIL)){
	if ($Password != $repeat_password){
		echo " Passwords do not match. ";
	}
	elseif (strlen($Password) < 5){
		echo " Password must contain at least 5 characters. ";
	}
	elseif (strpos($Password, " ") !== false){
		echo " Password must not contain white spaces. ";
	}
	else{
		$result = mysqli_query($connect,$query)
		or die(" insert into database unsuccessfull ");
		header('Refresh:3, url=browse.php'); //add sessions later.
}
}
else{
	echo " Email or password is not valid. ";
}
}
/*only inserting data if the password and password repeat match, password contains not whitespaces,
password is at least 5 characters, and email is valid/available.
noting to user that information did not insert*/



//if user registers as buyer then insert id into buyers table...auto incrementing buyer id

if (isset($result)){
	if ($accounttype == "buyer"){
		$buyerresult = mysqli_query($connect, $buyerquery);
}

//if user registers as seller then insert id into sellers table..auto incrementing seller id
	if ($accounttype == "seller"){
		$sellerresult = mysqli_query($connect, $sellerquery);
}
}





// telling user they registered successfully and returning the email.  

if (isset($result))
{
	echo " Registered successfully. Registered with email: $email ";
}
else{
	echo " Registered unsuccessfully. ";
	header('Refresh:3; url=register.php'); //add sessions later.  
}


mysqli_close($connect);
	
?> 



