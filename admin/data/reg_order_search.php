<?php
// holds a session
include("../Session/sessions.php"); 

?>


<?php
// if header changed location is loaded into 
include("../include/header.php"); 

?>

<div id="wrapper">

		<div id="leftBar">
	<?php include("../include/links.php"); ?>
	</div>
	<div id="rightContent">
	<h3>Manage Orders</h3>
	<div id="smallRight2">

	<script>var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();</script><a href="http://www.printfriendly.com" style="color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Printer Friendly and PDF"><img style="border:none;" src="https://pf-cdn.printfriendly.com/images/icons/pf-button-both.gif" alt="Print Friendly and PDF"/></a> 

<?php


	
	include("../connection/connect.php"); 


    /* The search input from user ** passed from jQuery .get() method */
    $param = $_GET["query"];


    /* If connection to database, run sql statement. */
    if ($con) {

        /* Fetch the users input from the database and put it into a
         valuable $fetch for output to our table. */
        $fetch = mysql_query("SELECT customer_order_product.fk_customerorder_id, customer_order.customer_order_id, product.product_number, product.product_name, customer_order_product.product_quantity, product.base_price, customer_order_product.colour, customer_order_product.size, customer_order_product.customer_order_status, customer_order_product.total_price FROM product, customer_order_product, customer_order, account WHERE product.product_id = customer_order_product.fk_product_id AND customer_order_product.fk_customerorder_id = customer_order.customer_order_id AND username REGEXP '^$param' ORDER BY customer_order_product.fk_customerorder_id");
		
        /*
           Retrieve results of the query to and build the table.
           We are looping through the $fetch array and populating
           the table rows based on the users input.
         */
		
		$orderid = "";
		$totalPrice = "";
		echo "<table>";
        while ($row = mysql_fetch_object($fetch) ) {
		
		
		if($orderid != $row->fk_customerorder_id)
			{
		$orderid = $row->fk_customerorder_id;
		echo '<tr>';
		echo '<td>' . "Order Number:" . '</td>';
		echo '<td>' . $orderid . '</td>';

		echo '</tr>';
			}

			if($totalPrice != $row->total_price)
			{
		$totalPrice = $row->total_price;
		echo '<tr>';
		echo '<td>' . "Total Price:" . '</td>';
		echo '<td>' . $totalPrice . '</td>';

		echo '</tr>';
			}

		

			echo '<tr>';
			
			
			//echo '<td>' . $row->fk_customerorder_id . '</td>';
		
			echo '<td>' . $row->product_number . '</td>';
			echo '<td>' . $row->product_name . '</td>';
			echo '<td>' . $row->product_quantity . '</td>';
			echo '<td>' . $row->colour . '</td>';
			echo '<td>' . $row->base_price . '</td>';
			echo '<td>' . $row->size . '</td>';
			echo '<td>' . $row->customer_order_status . '</td>';
			
			
		    //echo '<td><a href="editProduct.php?product_id=' . $row->product_id . '"><img src="images/icn_edit.png"></a></td>';
            echo "</tr>"; 

		

		}
			echo "</table>";
		
		}
   ?>
		</div>
			</div>

		
<?php
include("../include/footer.php"); 

?>