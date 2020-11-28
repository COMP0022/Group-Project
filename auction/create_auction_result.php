<?php include_once("header.php")?>

<div class="container my-5">

<?php
// This function takes the form data and adds the new auction to the database.

/* TODO #1: Connect to MySQL database (perhaps by requiring a file that
            already does this). */
$servername = "localhost";
$username = "COMP0022";
$password = "test";
$database_name = "testdb";
$connect=mysqli_connect($servername, $username, $password, $database_name);
	
if($connect){
	
}
else{
	echo "Connection failed.";
}

/* TODO #2: Extract form data into variables. Because the form was a 'post'
            form, its data can be accessed via $POST['auctionTitle'], 
            $POST['auctionDetails'], etc. Perform checking on the data to
            make sure it can be inserted into the database. If there is an
            issue, give some semi-helpful feedback to user. */

			//THIS CHECK CAN BE COMPLETED SIMULTANIOUSLY WITH #3. Check after insert statement
  
$Title = mysqli_real_escape_string($connect, $_POST['auctionTitle']);
$Details = mysqli_real_escape_string($connect, $_POST['auctionDetails']);
$Category = $_POST['auctionCategory'];
$Start_price = $_POST['auctionStartPrice'];
$Reserve_Price = $_POST['auctionReservePrice'];
$End_Date = $_POST['auctionEndDate'];

date_default_timezone_set('Europe/London');
$current = date('Y-m-d H:i', time());
$posttime = $current;


//session--login user id inserted into listings table
$user_id = $_SESSION['user_id'];
 


/* TODO #3: If everything looks good, make the appropriate call to insert
            data into the database. */

			
$Catquery = "(SELECT catID FROM categories WHERE name = '$Category')";

$query = "INSERT INTO listings (item_title, posttime, user_id, itemdescription, category, startprice, reserveprice, endtime) VALUES ('$Title', '$posttime', $user_id, '$Details', $Catquery, $Start_price, $Reserve_Price, '$End_Date')";



$newposttime = date("Y.mdHis", strtotime($posttime));

$newenddate = date("Y.mdHis", strtotime($End_Date));

if (empty($End_Date)){
	echo " Auction must have an end date. ";
}

elseif($newenddate <= $newposttime){
	echo " Auction end datetime must be later than current datetime. ";
}
elseif ($newenddate > ($newposttime + 1)){
	echo " Cannot create auction more than a year in advance. ";
	}
elseif(empty($Title)){
	echo " Auction must have a title name.  ";
}
elseif(empty($Start_price)){
	echo " Auction must have a start price. ";
}
elseif($Start_price <= 0){
	echo " Start price must be greater than zero. ";
}
elseif(empty($Reserve_Price)){
	$reservequery = $query = "INSERT INTO listings (item_title, posttime, user_id, itemdescription, category, startprice, reserveprice, endtime) VALUES ('$Title', '$posttime', $user_id, '$Details', $Catquery, $Start_price, NULL, '$End_Date')";
	$result1 = mysqli_query($connect, $reservequery);
	}
elseif ($Reserve_Price <= 0 or 0 <= $Reserve_Price and $Reserve_Price < $Start_price){
	echo " Reserve price must be greater than or equal to start price. ";
}

else
{
$result = mysqli_query($connect,$query)
	or die(" Error inserting auction details. ");
}




	
	               

// If all is successful, let user know.
if ($result or $result1){
	echo('<div class="text-center">Auction successfully created! <a href="mylistings.php">View your new listing.</a></div>');
}
else{
	echo "Make sure to check data types and try again"; 
}


mysqli_close($connect);


?>

</div>


<?php include_once("footer.php")?>