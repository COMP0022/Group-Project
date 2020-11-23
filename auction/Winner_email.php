<?php
$winner_email_query = "SELECT email FROM users WHERE id IN(
    SELECT user_id FROM buyers WHERE buyer_id IN(
        SELECT buyer_id FROM bids WHERE bid_id IN(
            SELECT bid_id FROM bids WHERE listing_id = 1 AND bidprice IN(
                SELECT MAX(bidprice) as bidprice FROM bids WHERE listing_id = $item_id))))";

$listing_title_query = "SELECT item_title FROM listings WHERE listing_id = $item_id";

$winner_result = mysqli_query($connection, $winner_email_query)
	or die('Error making winner email query');

$winner_email = mysqli_fetch_array($winner_result);

$seller_email_query = "SELECT email FROM users WHERE id IN(SELECT user_id FROM sellers WHERE seller_id IN(SELECT seller_id FROM listings WHERE listing_id = $item_id))";

$seller_email_result = mysqli_query($connection, $seller_email_query)
	or die('Error making seller email query');
	
$seller_email = mysqli_fetch_array($seller_email_result);

$title_result = mysqli_query($connection, $listing_title_query) or die('Error making listing title query');
	
$listing_title = mysqli_fetch_array($title_result);

$top_bid_query = "SELECT MAX(bidprice) FROM bids WHERE listing_id = $item_id";
			
$top_bid_result = mysqli_query($connection, $top_bid_query)
	or die('Error making top bid query');	

$top_bid = mysqli_fetch_array($top_bid_result);

$name = "Happy Auction House"; //sender’s name
$email = "comp0022auction2020@gmail.com"; //sender’s e mail address
$recipient = "$winner_email[0]"; //recipient
$mail_body = "Congratulations! You bid £$top_bid[0] on the auction called '$listing_title[0]'. This was the highest bid, and you have won!"; //mail body
$subject = "Congratulations"; //subject
$header = "From: ". $name ." <" . $email .">\r\n"; //optional headerfields
mail($recipient, $subject,$mail_body ,$header); //mail function	


$name = "Happy Auction House"; //sender’s name
$email = "comp0022auction2020@gmail.com"; //sender’s e mail address
$recipient = "$seller_email[0]"; //recipient
$mail_body = "Congratulations! Your listing called '$listing_title[0]' has now finished. The winning bid was £$top_bid[0]"; //mail body
$subject = "Auction finished"; //subject
$header = "From: ". $name ." <" . $email .">\r\n"; //optional headerfields

mail($recipient, $subject,$mail_body ,$header); //mail function

?>