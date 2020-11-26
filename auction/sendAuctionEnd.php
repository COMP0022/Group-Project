<?php include 'opendb.php'?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// user sessions?


// $winner_email_query = "SELECT email FROM bids AS bi INNER JOIN buyers AS bu USING(buyer_id) INNER JOIN users AS u ON bu.user_id = u.id
// WHERE listing_id = $item_id AND bidprice IN (SELECT MAX(bidprice) FROM bids WHERE listing_id = $item_id)";
//
// $listing_title_query = "SELECT item_title FROM listings WHERE listing_id = $item_id";
//
// $winner_result = mysqli_query($connection, $winner_email_query)
// 	or die('Error making winner email query');
//
// $winner_email = mysqli_fetch_array($winner_result);
//
// $seller_email_query = "SELECT email FROM users WHERE id IN(SELECT user_id FROM sellers WHERE seller_id IN(SELECT seller_id FROM listings WHERE listing_id = $item_id))";
//
// $seller_email_result = mysqli_query($connection, $seller_email_query)
// 	or die('Error making seller email query');
//
// $seller_email = mysqli_fetch_array($seller_email_result);
//
// $title_result = mysqli_query($connection, $listing_title_query) or die('Error making listing title query');
//
// $listing_title = mysqli_fetch_array($title_result);
//
// $top_bid_query = "SELECT MAX(bidprice) FROM bids WHERE listing_id = $item_id";
//
// $top_bid_result = mysqli_query($connection, $top_bid_query)
// 	or die('Error making top bid query');
//
// $top_bid = mysqli_fetch_array($top_bid_result);

function smtpmailer($to, $from, $from_name, $subject, $body)
    {

        $mail = new PHPMailer();

        /* Tells PHPMailer to use SMTP. */
        $mail->isSMTP();

        $mail->Mailer = "smtp";

        $mail->SMTPDebug  = 1;
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";

        /* SMTP parameters. */
        $mail->Port       = 465;
        $mail->Host       = "ssl://smtp.gmail.com";
        $mail->Username   = "andrewalexfredjacob@gmail.com";
        $mail->Password   = "test1234!";

        $mail->IsHTML(true);
        /* Add a recipient. */
        $mail->AddAddress($to, 'Seller');
        /* Set the mail sender. */
        $mail->SetFrom($from, $from_name);
        /* Set the subject. */
        $mail->Subject = $subject;

        /* Set the mail message body. */
        $mail->Body = $body;

        /* Finally send the mail. */
        if(!$mail->Send())
        {
            $error ="Email failed to send.";
            return $error;
        }
        else
        {
            $error = "Thanks You !! Your email is sent.";
            return $error;
        }

    }
?>
<?php

    $from = 'andrewalexfredjacob@gmail.com';
    $name = 'Auction Bot';
    $toSeller   = 'chengoconnell@gmail.com';
    $subjSeller = 'Your auction has finished.';
    $msgSeller = 'Your listing called "Charizard" has now finished.';
    // $msgSeller = 'Your listing called '$listing_title[0]' has now finished.';

    $toBuyer   = 'chengoconnell@gmail.com';
    $subjBuyer = 'Your auction has finished.';
    $msgBuyer = 'Congratulations! You bid 200 pounds on the auction called "Charizard". This was the highest bid, and you have won!';
    // $msgBuyer = 'Congratulations! You bid £$top_bid[0] on the auction called '$listing_title[0]'. This was the highest bid, and you have won!';


    $error=smtpmailer($toSeller,$from,$name,$subjSeller,$msgSeller);
    $error=smtpmailer($toBuyer,$from,$name,$subjBuyer,$msgBuyer);


?>


<html>
    <head>
        <title>PHPMailer 5.2 testing from DomainRacer</title>
    </head>
    <body style="background: black;">
        <center><h2 style="padding-top:70px;color: white;"><?php echo $error; ?></h2></center>
    </body>

</html>
