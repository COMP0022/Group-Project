<?php

// TODO: Extract $_POST variables, check they're OK, and attempt to make a bid.
// Notify user of success/failure and redirect/give navigation options.
session_start();
$bid_price = $_POST['bid'];
$buyer_userid = $_SESSION['username'];  // retreive the input form from listing.php
$item_id = $_SESSION['bided_item_id'];  // retreive the bided item's id;

date_default_timezone_set("Europe/London");
$bid_time = date("Y-m-d H:i:s");

include_once 'opendb.php'; 
$bid_query = "INSERT INTO bids (buyer_id, listing_id, bidtime, bidprice) VALUES ($buyer_userid, $item_id, '$bid_time', $bid_price)";
$bid_result = mysqli_query($connection,$bid_query) or die(" Insert into database unsuccessfull");
if($bid_result){echo "Bid placed successfully at: " . $bid_time;}
?>