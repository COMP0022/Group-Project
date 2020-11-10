<?php
  // For now, index.php just redirects to browse.php, but you can change this
  // if you like.
  session_start();

  if ($_SESSION['account_type'] == 'buyer') {
    echo "Redirecting to browse page";
    header("refresh:3;url=browse.php");}
  if ($_SESSION['account_type'] == 'seller'){
    echo "Redirecting to list page";
    header("refresh:3;url=listing.php");}
?>