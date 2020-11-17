<?php include_once("header.php")?>
<?php require("utilities.php")?>

<div class="container">

<h2 class="my-3">My listings</h2>

<div id="searchSpecs">
<!-- When this form is submitted, this PHP page is what processes it.
     Search/sort specs are passed to this page through parameters in the URL
     (GET method of passing data to a page). -->
<form method="get" action="mylistings.php">
  <div class="row">
    <div class="col-md-5 pr-0">
      <div class="form-group">
        <label for="keyword" class="sr-only">Search keyword:</label>
	    <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text bg-transparent pr-0 text-muted">
              <i class="fa fa-search"></i>
            </span>
          </div>
          <input type="text" class="form-control border-left-0" name="keyword" id="keyword" placeholder="Search for anything">
        </div>
      </div>
    </div>
    <div class="col-md-3 pr-0">
      <div class="form-group">
        <label for="cat" class="sr-only">Search within:</label>
        <select class="form-control" id="cat" name="cat" >
          <option selected value="all">All categories</option>
          <option value="fill">Fill me in</option>
          <option value="with">with options</option>
          <option value="populated">populated from a database?</option>
        </select>
      </div>
    </div>
    <div class="col-md-3 pr-0">
      <div class="form-inline">
        <label class="mx-2" for="order_by">Sort by:</label>
        <select class="form-control" id="order_by" name="order_by">
          <option selected value="pricelow">Price (low to high)</option>
          <option value="pricehigh">Price (high to low)</option>
          <option value="date">Soonest expiry</option>
        </select>
      </div>
    </div>
    <div class="col-md-1 px-0">
      <button type="submit" class="btn btn-primary">Search</button>
    </div>
  </div>
</form>
</div> <!-- end search specs bar -->


</div>

<?php

  if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'seller')

{
  $seller_userid = $_SESSION['seller_id'];

	$results_per_page = 5;
	if (!isset($_GET['keyword']))
	{
		 $query = "SELECT * FROM listings WHERE item_title IS NOT NULL AND seller_id = $seller_userid";
	}

	else
	{
		$keyword = $_GET['keyword'];

		if ($keyword == '')
		{
			 $query = "SELECT * FROM listings WHERE item_title IS NOT NULL AND seller_id = $seller_userid";
		}
		else
		{
			 $query = "SELECT * FROM listings WHERE item_title LIKE '%$keyword%' AND seller_id = $seller_userid";
		}
	}

	if (!isset($_GET['cat']))
	{
		 $query .= " AND category IS NOT NULL";
	}

	else
	{
		$category = $_GET['cat'];
		if ($category = "all")
		{
			 $query .= " AND category IS NOT NULL";
		}
		else
		{
			 $query .= " AND category = '$category'";
		}
	// We will have to make this mandatory and add a field so that if it is = to all it is as if it is blank.
	}

	if (!isset($_GET['order_by']))
	{
	// TODO: Define behavior if an order_by value has not been specified.
		$query .= " ORDER BY endtime LIMIT $results_per_page";
	}
	else
	{
		$query .= " ORDER BY startprice LIMIT $results_per_page";
	}
}


	include 'opendb.php';

	$tmp = explode(" ",$query);
	$tmp[1] = "COUNT(*)";
	$num_query = implode(" ",$tmp);

	$num_result = mysqli_query($connection, $num_query)
			or die('Error making count query');

	$row = mysqli_fetch_array($num_result);

	$num_results = $row[0];
	echo $num_results;
	$max_page = ceil($num_results / $results_per_page);
	if (!isset($_GET['page']))
		{
		$curr_page = 1;
		}
	else
	{
		if ($_GET['page'] == 1)
		{
			$curr_page = 1;
		}
		else
		{
			$curr_page = $_GET['page'];
			$offset = ($curr_page*$results_per_page)-$results_per_page;
			$query .= " OFFSET $offset";
		}
	}
?>

<div class="container mt-5">

<!-- TODO: If result set is empty, print an informative message. Otherwise... -->


<ul class="list-group">

<!-- TODO: Use a while loop to print a list item for each auction listing
     retrieved from the query -->


     <?php


       // $seller_listings_query = "SELECT * FROM listings WHERE seller_id = $seller_userid"


      ?>
<?php

	$result = mysqli_query($connection, $query)
		or die('Error making select users query');

	while ($row = mysqli_fetch_array($result))
	{
		//Will need to have something for if there haven't been any bids


		$count_bid_query = "SELECT COUNT(*) FROM bids WHERE listing_id = {$row['listing_id']}";

		$count_bid_result = mysqli_query($connection, $count_bid_query)
			or die('Error making top bid query');

		$bid_count = mysqli_fetch_array($count_bid_result);

		if ($bid_count[0] == 0) {
			print_listing_li($row['listing_id'], $row['item_title'], $row['itemdescription'], $row['startprice'], $bid_count[0], date_create($row['endtime']));
		}
		else {
			$top_bid_query = "SELECT MAX(bidprice) FROM bids WHERE listing_id = {$row['listing_id']}";

			$top_bid_result = mysqli_query($connection, $top_bid_query)
				or die('Error making top bid query');

			$top_bid = mysqli_fetch_array($top_bid_result);

			print_listing_li($row['listing_id'], $row['item_title'], $row['itemdescription'], $top_bid[0], $bid_count[0], date_create($row['endtime']));

		}

	}

?>

</ul>

<!-- Pagination for results listings -->
<nav aria-label="Search results pages" class="mt-5">
  <ul class="pagination justify-content-center">

<?php

  // Copy any currently-set GET variables to the URL.
  $querystring = "";
  foreach ($_GET as $key => $value) {
    if ($key != "page") {
      $querystring .= "$key=$value&amp;";
    }
  }

  $high_page_boost = max(3 - $curr_page, 0);
  $low_page_boost = max(2 - ($max_page - $curr_page), 0);
  $low_page = max(1, $curr_page - 2 - $low_page_boost);
  $high_page = min($max_page, $curr_page + 2 + $high_page_boost);

  if ($curr_page != 1) {
    echo('
    <li class="page-item">
      <a class="page-link" href="mylistings.php?' . $querystring . 'page=' . ($curr_page - 1) . '" aria-label="Previous">
        <span aria-hidden="true"><i class="fa fa-arrow-left"></i></span>
        <span class="sr-only">Previous</span>
      </a>
    </li>');
  }

  for ($i = $low_page; $i <= $high_page; $i++) {
    if ($i == $curr_page) {
      // Highlight the link
      echo('
    <li class="page-item active">');
    }
    else {
      // Non-highlighted link
      echo('
    <li class="page-item">');
    }

    // Do this in any case
    echo('
      <a class="page-link" href="mylistings.php?' . $querystring . 'page=' . $i . '">' . $i . '</a>
    </li>');
  }

  if ($curr_page != $max_page) {
    echo('
    <li class="page-item">
      <a class="page-link" href="mylistings.php?' . $querystring . 'page=' . ($curr_page + 1) . '" aria-label="Next">
        <span aria-hidden="true"><i class="fa fa-arrow-right"></i></span>
        <span class="sr-only">Next</span>
      </a>
    </li>');
  }
?>

  </ul>
</nav>


</div>



<?php include_once("footer.php")?>
