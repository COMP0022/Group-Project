<?php include_once("header.php")?>

<div class="container my-5">

<?php

// This function takes the form data and adds the new auction to the database.

/* TODO #1: Connect to MySQL database (perhaps by requiring a file that
            already does this). */
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

/* TODO #2: Extract form data into variables. Because the form was a 'post'
            form, its data can be accessed via $POST['auctionTitle'], 
            $POST['auctionDetails'], etc. Perform checking on the data to
            make sure it can be inserted into the database. If there is an
            issue, give some semi-helpful feedback to user. */

			//THIS CHECK CAN BE COMPLETED SIMULTANIOUSLY WITH #3. Check after insert statement

$Title = $_POST['auctionTitle'];
$Details = $_POST['auctionDetails'];
$Category = $_POST['auctionCategory'];
$Start_price = $_POST['auctionStartPrice'];
$Reserve_Price = $_POST['auctionReservePrice'];
$End_Date = $_POST['auctionEndDate'];


/* TODO #3: If everything looks good, make the appropriate call to insert
            data into the database. */

			/*we can either delete the "posttime" attribute from our database
			or I can add an html script in create_auction.php
			*/
$query = "INSERT INTO listings (item_title, itemdescription, category, startprice, reserveprice, endtime) VALUES ('$Title', '$Details'), ('$Category'), ('$Start_price'), ('$Reserve_price'), ('$End_Date')";

$result = mysqli_query($connect,$query)
	or die("Error inserting auction details");
	

	
	               

// If all is successful, let user know.
if ($result){
	echo('<div class="text-center">Auction successfully created! <a href="FIXME">View your new listing.</a></div>');
}
else{
	echo "make sure to check data types and try again"; 
}


mysqli_close($connect);


?>

</div>


<?php include_once("footer.php")?>