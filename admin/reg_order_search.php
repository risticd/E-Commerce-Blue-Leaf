<?php
// holds a session
include("Session/sessions.php"); 

?>


<?php
// if header changed location is loaded into 
include("include/header.php"); 

?>

<div id="wrapper">

		<div id="leftBar">
	<?php include("include/links.php"); ?>
	</div>
	<div id="rightContent">
	<h3>Order</h3>
	<div id="smallRight2">

	<script>var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();</script><a href="http://www.printfriendly.com" style="color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Printer Friendly and PDF"><img style="border:none;" src="https://pf-cdn.printfriendly.com/images/icons/pf-button-both.gif" alt="Print Friendly and PDF"/></a> 


	<form action="reg_order_search.php" method="GET" width="675">
	  <div class="header-right">
      Search By: Customer Order# <input style="width:150px;" name="query" type="text"><input type="submit" value="Search"></div>
	  </form>
	 <br/><br/>

                
<?php


	
	include("connection/connect.php"); 


    /* The search input from user ** passed from jQuery .get() method */
    $query = $_GET["query"];
	
	//$min_length = 5;

	 //if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
         
        //$query = htmlspecialchars($query);
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        //$query = mysql_real_escape_string($query);

    /* If connection to database, run sql statement. */
    if ($con) {

        /* Fetch the users input from the database and put it into a
         valuable $fetch for output to our table. */
        $fetch = mysql_query("SELECT account.username, account.first_name, account.last_name, account.address, account.city, account.province, customer_order_product.fk_customerorder_id, customer_order.customer_order_id, product.product_number, product.product_name, customer_order_product.product_quantity, product.base_price, customer_order_product.colour, customer_order_product.size, customer_order_product.customer_order_status, customer_order_product.subtotal_price, customer_order_product.total_price FROM product, customer_order_product, customer_order, account WHERE product.product_id = customer_order_product.fk_product_id AND customer_order_product.fk_customerorder_id = customer_order.customer_order_id AND account.account_id = fk_account_id AND customer_order_product.total_price != '0.00' AND customer_order_product.fk_customerorder_id=$query ");

		$fetch2 = mysql_query("SELECT account.username, account.first_name, account.last_name, account.address, account.city, account.province, customer_order_product.fk_customerorder_id, customer_order.customer_order_id, product.product_number, product.product_name, customer_order_product.product_quantity, product.base_price, customer_order_product.colour, customer_order_product.size, customer_order_product.customer_order_status, customer_order_product.subtotal_price, customer_order_product.total_price FROM product, customer_order_product, customer_order, account WHERE product.product_id = customer_order_product.fk_product_id AND customer_order_product.fk_customerorder_id = customer_order.customer_order_id  AND account.account_id = fk_account_id AND customer_order_product.total_price != '0.00' AND customer_order_product.fk_customerorder_id=$query");


		
		
        /*
           Retrieve results of the query to and build the table.
           We are looping through the $fetch array and populating
           the table rows based on the users input.
         */
		
		$orderid = "";
		$totalPrice = "";
		$tax = 0.13;

		
		echo "<div style='max-height:500px; overflow-y:auto';>";
		echo "<table width='630'>";

		if(mysql_num_rows($fetch) > 0){ 
	
        while($row = mysql_fetch_object($fetch) ) {


			

		
		if($orderid != $row->fk_customerorder_id)
			{
		$orderid = $row->fk_customerorder_id;
		$base_price = $row->base_price;
		$product = $row->product_quantity;
		
		echo '<tr>';
		echo '<td colspan="2">' . "Order Number:   " . $orderid . '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td colspan="2">' . "Name:   " . $row->first_name . " " . $row->last_name .  '</td>';
		echo '<td colspan="2">' . "Address:   " . $row->address . '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td colspan="2">' . "City:   " . $row->city .  '</td>';
		echo '<td colspan="2">' . "Province:   " . $row->province . '</td>';
		echo '</tr>';
		echo "<tr> 
		<th class='ui-state-default'>Product Number</th> 
		<th class='ui-state-default'>Product Name</th>
		<th class='ui-state-default'>Quantity</th> 
		<th class='ui-state-default'>Colour</th>
		<th class='ui-state-default'>Price</th>
		<th class='ui-state-default'>Size</th>
		</tr>";

	
		if(mysql_num_rows($fetch2) > 0){
		while($row2 = mysql_fetch_object($fetch2) ) {
		echo '<tr>';
			echo '<td>' . $row2->product_number . '</td>';
			echo '<td>' . $row2->product_name . '</td>';
			echo '<td>' . $row2->product_quantity . '</td>';
			echo '<td>' . $row2->colour . '</td>';
			echo '<td>' . $row2->base_price . '</td>';
			echo '<td>' . $row2->size . '</td>';
			echo '</tr>';
			}

		}
		$price =  $base_price * $product;
	    $taxes = $tax * $price;
		$total = (($tax * $price) + $price);

		echo '<tr>';
		echo '<td colspan="6" style="text-align: right">' . "<hr/>" . '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td colspan="6" style="text-align: right">' . "Sub Total: $" .number_format($price,2) . '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td colspan="6" style="text-align: right">' . "Tax: $"  .number_format($taxes,2) . '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td colspan="6" style="text-align: right">' . "Total Price: $" .number_format($total, 2). '</td>';
		echo '</tr>';

		
	
			}

			

			
			
			//echo '<td>' . $row->fk_customerorder_id . '</td>';
		
			
			//echo '<td>' . $row->customer_order_status . '</td>';
			
			
			
		    //echo '<td><a href="editProduct.php?product_id=' . $row->product_id . '"><img src="images/icn_edit.png"></a></td>';
            echo '</tr>'; 
			

		}


	

		
		

		}else{
			echo '<tr>';
			echo '<td>' . "Sorry there are not results found or the acccount has been complete" . '</td>';
			echo '</tr>';

		}

		}
   
			
		     echo "</table>";
			 echo "</div>";
			
			



		 
   ?>

		</div>
			</div>

		
<?php
include("include/footer.php"); 

?>