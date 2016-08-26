 <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="js/jquery-ui.js"></script>

<!------------------------------------------
MMDA - Sheridan College Learning
Modified: Oct 1st 2012
-> Edit Account Page
-------------------------------------------->
<?php
// holds a session
include("Session/sessions.php"); 

$tax = 0.13;

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
	<h3>Manage Orders</h3>
	<div id="smallRight2">

	     <form action="manageOrders_Search.php" method="GET" width="675">
	  <div class="header-right">
		Ordered Date: <input style="width:150px;" id="datepicker2" name="customerorderdate" type="text">
	    Date Required: <input style="width:150px;" id="datepicker" name="daterequired" type="text"> 
	  <input type="submit" value="Search"></div>
		</form>
		<br/><br/>
		<?php
    /* If connection to database, run sql statement. */
    if ($con) {

        /* Fetch the users input from the database and put it into a
         valuable $fetch for output to our table. */
        $fetch = mysql_query("SELECT account.username, customer_order_product.fk_customerorder_id, customer_order.customer_order_date, customer_order.date_required, customer_order_product.customer_order_status, customer_order_product.total_price FROM customer_order_product, customer_order, account WHERE customer_order_product.fk_customerorder_id = customer_order.customer_order_id AND customer_order.fk_account_id=account.account_id AND customer_order_status != 'completed' GROUP BY customer_order_product.fk_customerorder_id ORDER BY customer_order_product.total_price DESC ");
		
        /*
           Retrieve results of the query to and build the table.
           We are looping through the $fetch array and populating
           the table rows based on the users input.
         */
		
		

		echo "<div style='max-height:500px; overflow-y:auto';>";
		echo "<table width='630'>";

		echo "<tr> 
		<th class='ui-state-default'>Username</th> 
		<th class='ui-state-default'>Customer Order</th> 
		<th class='ui-state-default'>Order Date</th> 
		<th class='ui-state-default'>Due Date</th>
		<th class='ui-state-default'>Order Status</th>
		<th class='ui-state-default'>Total Price</th> 
		<th class='ui-state-default'>View</th> 

		</tr>";

		//$orderid = "";
		//$totalPrice = "";


		if(mysql_num_rows($fetch) > 0){ 


	
       while($row = mysql_fetch_object($fetch) ) {

		

		
		//if($orderid != $row->fk_customerorder_id)
		//{
		//$orderid = $row->fk_customerorder_id;
	
		
		echo '<tr>';
		//echo '<td colspan="2">' . "Order Number:   " . $orderid . '</td>';

	
		//}

		

			echo '<tr>';
			
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

			echo '<td><a href="editMangeOrders.php?fk_customerorder_id=' . $row->fk_customerorder_id . '"><img src="images/icn_alert_cancelled.png"></a></td>';

			}

			else if($row->customer_order_status == 'completed'){

			echo '<td><img src="images/icn_alert_success.png"></td>';
			
			}
		
            echo '</tr>'; 
		
		
			}

		
		}
   
			
		     echo "</table>";
			
			
		
		
    }
	?>
	
			</div>
			</div>
			</div>

			

		
<?php
include("include/footer.php"); 

?>
