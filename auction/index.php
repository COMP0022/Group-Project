<?php
  // For now, index.php just redirects to browse.php, but you can change this
  // if you like.
  if ($_SESSION['account_type'] = 'buyer')
  {header("Location: browse.php");}
  if ($_SESSION['account_type'] = 'seller')
  {header("Location: listing.php");}
?>