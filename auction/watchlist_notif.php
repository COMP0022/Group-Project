<?php

//Get the emails of people who are watching an item
$watchlist_email_query = "SELECT email FROM users WHERE id IN(SELECT user_id FROM watchlist WHERE listing_id = $item_id)";
$watchlist_result = mysqli_query($connection, $watchlist_email_query)
	or die('Error making watchlist email query');

// Gets the email of the person placing the bid
$buyer_email_query = "SELECT email FROM users WHERE id= $user_id";
$result = mysqli_query($connection, $buyer_email_query)
	or die('Error making buyer email query');
$buyer_email = mysqli_fetch_array($result);

//Gets the title of the auction in question
$listing_title_query = "SELECT item_title FROM listings WHERE listing_id = $item_id";
$title_result = mysqli_query($connection, $listing_title_query)
	or die('Error making listing title query');
$listing_title = mysqli_fetch_array($title_result);

//Gets the email of the outbid buyer
$outbid_query = "SELECT email FROM users WHERE id IN(
						SELECT user_id FROM bids WHERE listing_id = $item_id AND bidprice = $previous_top_bid)";
$outbid_result = mysqli_query($connection, $outbid_query)
	or die('Error making outbid email query');
$outbid_email = mysqli_fetch_array($outbid_result);


$name = "Happy Auction House"; //sender’s name
$email = "happyauctionhouse@gmail.com"; //sender’s e mail address
$recipient = "$outbid_email[0]"; //recipient
$mail_body = "Your bid of £$previous_top_bid on the auction called '$listing_title[0]' as been outbid. The current highest bid is now £$bid_price"; //mail body
$subject = "Outbid notification"; //subject
$header = "From: ". $name ." <" . $email .">\r\n"; //optional headerfields

mail($recipient, $subject,$mail_body ,$header); //mail function


while ($row = mysqli_fetch_array($watchlist_result))
{
	if ($row[0] == $outbid_email[0]) {
		continue;
	}


	if ($row[0] == $buyer_email[0]) {
		$name = "Happy Auction House"; //sender’s name
		$email = "happyauctionhouse@gmail.com"; //sender’s e mail address
		$recipient = "$buyer_email[0]"; //recipient
		$mail_body = "This is an email confirming that you have bid £$bid_price on the auction called '$listing_title[0]'"; //mail body
		$subject = "Bid confirmation"; //subject
		$header = "From: ". $name ." <" . $email .">\r\n"; //optional headerfields

		mail($recipient, $subject,$mail_body ,$header); //mail function
	}
	else {
		$name = "Happy Auction House"; //sender’s name
		$email = "happyauctionhouse@gmail.com"; //sender’s e mail address
		$recipient = "$row[0]"; //recipient
		$mail_body = "The auction called '$listing_title[0]' which you are watching just received a bid for £$bid_price "; //mail body
		$subject = "Auction you are watching"; //subject
		$header = "From: ". $name ." <" . $email .">\r\n"; //optional headerfields

		mail($recipient, $subject,$mail_body ,$header); //mail function
	}
}





?>
