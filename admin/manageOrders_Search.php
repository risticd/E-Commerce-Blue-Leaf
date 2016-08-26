<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="js/jquery-ui.js"></script>

<?php
// holds a session
include("Session/sessions.php"); 

?>

<script type="text/javascript">
$(function()
{
$( "#datepicker" ).datepicker();
});
$(function()
{
$( "#datepicker2" ).datepicker();
});
</script>



<?php
// if header changed location is loaded into 
include("include/header.php"); 

?>

<div id="wrapper">

		<div id="leftBar">
	<?php include("include/links.php"); ?>
	</div>
	<div id="rightContent">
	<h3>Manage Orders Results</h3>
	<div id="smallRight2">

	  <form action="top_selling_search.php" method="GET" width="675">
	  <div class="header-right">
      Date Required: <input style="width:150px;" id="datepicker" name="daterequired" type="text"> 
	  Ordered Date: <input style="width:150px;" id="datepicker2" name="customerorderdate" type="text">
	  <input type="submit" value="Search"></div>
		</form>
		<br/><br/>

                
<?php


	
	include("connection/connect.php"); 


    /* The search input from user ** passed from jQuery .get() method */
    $query = $_GET["daterequired"];
	$query2 = $_GET["customerorderdate"];
	//$min_length = 5;

	 //if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
         
        //$query = htmlspecialchars($query);
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        //$query = mysql_real_escape_string($query);

    /* If connection to database, run sql statement. */
    if ($con) {
        /* Fetch the users input from the database and put it into a
         valuable $fetch for output to our table. */
        
		$fetch = mysql_query("SELECT account.username, customer_order_product.fk_customerorder_id, customer_order.customer_order_date, customer_order.date_required, customer_order_product.customer_order_status, customer_order_product.total_price FROM customer_order_product, customer_order, account WHERE customer_order_product.fk_customerorder_id = customer_order.customer_order_id AND customer_order.fk_account_id=account.account_id AND date_required REGEXP '^$query' AND customer_order_date REGEXP '^$query2' AND customer_order_status != 'completed' ORDER BY customer_order_product.total_price DESC ");

	
		
        /*
           Retrieve results of the query to and build the table.
           We are looping through the $fetch array and populating
           the table rows based on the users input.
         */
		
		

		echo "<div style='max-height:500px; overflow-y:auto';>";
		echo "<table width='630'>";

		if(mysql_num_rows($fetch) > 0){ 


			echo "<tr> 
		<th class='ui-state-default'>Username</th> 
		<th class='ui-state-default'>Customer Order</th> 
		<th class='ui-state-default'>Order Date</th> 
		<th class='ui-state-default'>Due Date</th>
		<th class='ui-state-default'>Order Status</th>
		<th class='ui-state-default'>Total Price</th> 
		<th class='ui-state-default'>View</th> 
		</tr>
		";
			echo '<tr>';
	
        while($row = mysql_fetch_object($fetch) ) {


			

		
		//if($orderid != $row->fk_customerorder_id)
			///{
	    //$orderid = $row->fk_customerorder_id;
		
//		echo '<tr>';
//		echo '<td colspan="2">' . "Order Number:   " . $orderid . '</td>';
//		echo '</tr>';
//		echo '<tr>';
//		echo '<td colspan="2">' . "Name:   " . $row->first_name . " " . $row->last_name .  '</td>';
//		echo '<td colspan="2">' . "Address:   " . $row->address . '</td>';
//		echo '</tr>';
//		echo '<tr>';
//		echo '<td colspan="2">' . "City:   " . $row->city .  '</td>';
//		echo '<td colspan="2">' . "Province:   " . $row->province . '</td>';
//		echo '</tr>';
//		echo '<tr>';
//		echo '<td colspan="6">' . "<hr/>" . '</td>';
//		echo '</tr>';
//		echo '<tr>';
//		echo '<td colspan="6" text-align: "right">' . "Sub Total: $" . $row->subtotal_price . '</td>';
//		echo '</tr>';
//		echo '<tr>';
//		echo '<td colspan="6">' . "Tax: $"  .$tax. '</td>';
//		echo '</tr>';
//		echo '<tr>';
//		echo '<td colspan="6">' . "Total Price: $" . $row->total_price . '</td>';
//		echo '</tr>';

		
	
			//}

			

			
			//echo '<td>' . $row->fk_customerorder_id . '</td>';
		
			echo '<td>' . $row->username . '</td>';
			echo '<td>' . $row->fk_customerorder_id . '</td>';
			echo '<td>' . $row->customer_order_date . '</td>';
			echo '<td>' . $row->date_required . '</td>';
			echo '<td>' . $row->customer_order_status . '</td>';
			echo '<td>' . '$' . $row->total_price . '</td>';
			
			
			if(($row->customer_order_status == 'pending')||($row->customer_order_status == 'shipped')){

			echo '<td><a href="editMangeOrders.php?fk_customerorder_id=' . $row->fk_customerorder_id . '"><img src="images/icn_edit.png"></a></td>';

			}

			else if($row->customer_order_status == 'cancelled'){

			echo '<td><img src="images/icn_alert_cancelled.png"></td>';

			}

			else if($row->customer_order_status == 'completed'){

			echo '<td><img src="images/icn_alert_success.png"></td>';
			
			}
		
		
			
			
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