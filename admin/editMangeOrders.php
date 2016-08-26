<!------------------------------------------
MMDA - Sheridan College Learning
Modified: Oct 1st 2012
-> Edit Account Page
-------------------------------------------->

<script>

function validateTotal() 

{
	var editTotal = document.forms["register_form"]["total_price"].value;

	var regex1 = /^[0-9]+$/;


		// Total Price
	if(editTotal == null || editTotal == "")
	{
		alert("New Amount Owing must be filled in.");
		return false;
	}

	
	if(editTotal.match(regex1))
	{
		alert("Invalid price.");
		return false;
	}

}

</script>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="js/jquery-ui.js"></script>




<?php
// session page redirects back to login if user has not signed in
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

// header can be changed by going into the include folder and selecting header.php

include("include/header2.php"); 

?>





<div id="wrapper">

		<div id="leftBar">
		
		<?php
		// link can be changed by going into the include folder by selecting link.php which will change the whole admin site
		include("include/links.php"); 
		?>
	</div>
	<div id="rightContent">
	<h3>Edit Order</h3>

	<div id="smallRight2">
	
	<?php

    // connection to blueleaf database
include("connection/connect.php"); 

// renders the form for the fields required
function renderForm($id, $product_num, $product_name, $date, $product_quantity, $colours, $sizes, $status, $error)
 {

// error message on validation


 
 ?> 


    <!---displays fields and text fields in a table format-->
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="register_form" onsubmit="return validateTotal()"/>
<input type="hidden" name="fk_customerorder_id" value="<?php echo $id; ?>"/>
 <table  width="650">
  <tr>
 <td>Product Number:</td><td><?php echo $product_num; ?></td>
 </tr>
 <tr>
 <td>Product Name:</td><td><?php echo $product_name; ?></td>
 </tr>
 <tr>
 <td>Date Required</td><td><input style="width:150px;" id="datepicker2" value="<?php echo $date; ?>" name="date_required" type="text"></td>
 </tr>
 <tr>
 <td>Product Quantity:</td><td><input style="width:150px;"  name="product_quantity" value="<?php echo $product_quantity; ?>"/></td>
 </tr>
 <tr>
 <td>Colours:</td><td><input style="width:150px;" name="colour" value="<?php echo $colours; ?>"/></td>
 </tr>
 <tr>
 <td>Sizes:</td><td><input style="width:150px;"  name="size" value="<?php echo $sizes; ?>"/></td>
 </tr>
 <tr>
 <td>Order Status:</td>
 <td>
 <?php

$result = mysql_query("SELECT * FROM customer_order_product WHERE fk_customerorder_id = $id");    

	 echo "<select name='customer_order_status'>";

	if($row = mysql_fetch_assoc($result)) {

	
		?>

	
    <option value="1"<?php if ($row['customer_order_status'] == 'pending') echo ' selected="selected"'; ?>>pending</option>
    <option value="2"<?php if ($row['customer_order_status'] == 'completed') echo ' selected="selected"'; ?>>completed</option>
    <option value="3"<?php if ($row['customer_order_status'] == 'shipped') echo ' selected="selected"'; ?>>shipped</option>
	<option value="4"<?php if ($row['customer_order_status'] == 'cancelled') echo ' selected="selected"'; ?>>cancelled</option>
	


	<?php

		

		
	}
		
		echo "\r\n</select>";
				

	?>
 </td>
 </tr>
 <tr>
 <td><input type="submit" name="submit" value="Save"></td>
 </tr>

 </table>
</form>




<?php
 }


 
 // check form that it has been submitted
 if (isset($_POST['submit']))
 { 
 // getting the account_id for each row
 if (is_numeric($_POST['fk_customerorder_id']))
 {
 // gets the form data and making sure it's valid
 $id = $_POST['fk_customerorder_id'];
 $product_num = mysql_real_escape_string(htmlspecialchars($_POST['product_number']));
 $product_name = mysql_real_escape_string(htmlspecialchars($_POST['product_name']));
 $date = mysql_real_escape_string(htmlspecialchars($_POST['date_required']));
 $product_quantity = mysql_real_escape_string(htmlspecialchars($_POST['product_quantity']));
 $colours = mysql_real_escape_string(htmlspecialchars($_POST['colour']));
 $sizes = mysql_real_escape_string(htmlspecialchars($_POST['size']));
 $status = mysql_real_escape_string(htmlspecialchars($_POST['customer_order_status']));



 

 // save the data to the database
mysql_query("UPDATE product AS product, customer_order, customer_order_product AS customer_order_product
 SET date_required='$date', product_quantity='$product_quantity', colour='$colours', size='$sizes', customer_order_status='$status' WHERE product.product_id = customer_order_product.fk_product_id AND customer_order_product.fk_customerorder_id=$id")
 or die(mysql_error()); 


 
  // once saved, redirect back to the view page
 header("Location: manageOrders.php"); 
 }
 
 else
 {
 // if the 'id' isn't valid, display an error
 echo 'ERROR MESSAGE';
 }
 }
 else
 // if the form hasn't been submitted, get the data from the db and display the form
 {
 
 // checking the account_id that it's greater than zero
 if (isset($_GET['fk_customerorder_id']) && is_numeric($_GET['fk_customerorder_id']) && $_GET['fk_customerorder_id'] > 0)
 {
 // selecting all the field and displaying them into the textboxes
 $id = $_GET['fk_customerorder_id'];

 $result = mysql_query("SELECT product.product_number, product.product_name, customer_order.date_required, customer_order_product.product_quantity, customer_order_product.colour, customer_order_product.size, customer_order_product.customer_order_status FROM product, customer_order, customer_order_product WHERE product.product_id = customer_order_product.fk_product_id AND fk_customerorder_id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 

 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // pulling data from the account table
 //$id = $row['fk_customerorder_id'];
 $product_num = $row['product_number'];
 $product_name = $row['product_name'];
 $date = $row['date_required'];
 $product_quantity = $row['product_quantity'];
 $colours = $row['colour'];
 $sizes = $row['size'];
 $status = $row['customer_order_status'];

 
 // renders the form
 renderForm($id, $product_num, $product_name, $date, $product_quantity, $colours, $sizes, $status, '');
 }

 }
 }
?>
		
	
		</div>
	</div>
<?php
// includes the foot page
include("include/footer.php"); 

?>
<!---this section uses tooltip for the customer to understand what to put into the textboxes--->
<script type="text/javascript">
var tooltipObj = new DHTMLgoodies_formTooltip();
tooltipObj.setTooltipPosition('right');
tooltipObj.setPageBgColor('#EEEEEE');
tooltipObj.setTooltipCornerSize(15);
tooltipObj.initFormFieldTooltip();
</script>



