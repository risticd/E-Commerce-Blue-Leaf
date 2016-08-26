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



<?php
// session page redirects back to login if user has not signed in
include("Session/sessions.php"); 

?>



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
	<h3>Edit Invoice</h3>

	<div id="smallRight2">
	
	<?php

    // connection to blueleaf database
include("connection/connect.php"); 

// renders the form for the fields required
function renderForm($id, $first, $last, $orderdate, $duedate, $total, $status, $error)
 {

// error message on validation

 if ($error != '')
 {
 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 }
 
 ?> 


    <!---displays fields and text fields in a table format-->
 <form action="" method="post" id="register_form" onsubmit="return validateTotal()"/>
<input type="hidden" name="customer_order_id" value="<?php echo $id; ?>"/>
 <table  width="650">
 <tr>
 <td>Customer ID:</td><td name="customer_order_id"><?php echo $id; ?></td>
 </tr>
 <tr>
 <td>First Name:</td><td><?php echo $first; ?></td>
 </tr>
 <tr>
 <td>Last Name:</td><td><?php echo $last; ?></td>
 </tr>
 <tr>
 <td>Order Date:</td><td><?php echo $orderdate; ?></td>
 </tr>
  <tr>
 <td>Date Required:</td><td><?php echo $duedate; ?></td>
 </tr>
 <tr>
 <td>Amount Owing:</td><td>$<?php echo $total; ?></td>
 </tr>
  <tr>
 <td>New Amount Owing:</td><td><input type="text" name="total_price"></td>
 </tr>
  <td>Payment Status</td>
 <td>
<select name="customer_order_status">
  <option value="1">pending</option>
  <option value="2">completed</option>
  </select>
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
 if (is_numeric($_POST['customer_order_id']))
 {
 // gets the form data and making sure it's valid
 $id = $_POST['customer_order_id'];
 $first = mysql_real_escape_string(htmlspecialchars($_POST['first_name']));
 $last = mysql_real_escape_string(htmlspecialchars($_POST['last_name']));
 $orderdate = mysql_real_escape_string(htmlspecialchars($_POST['customer_order_date']));
 $duedate = mysql_real_escape_string(htmlspecialchars($_POST['date_required']));
 $total = mysql_real_escape_string(htmlspecialchars($_POST['total_price']));
 $status = mysql_real_escape_string(htmlspecialchars($_POST['customer_order_status']));


 

 // save the data to the database
 mysql_query("UPDATE account AS account, customer_order AS customer_order, customer_order_product AS customer_order_product
    SET customer_order_product.total_price='$total', customer_order_product.customer_order_status='$status'
    WHERE account.account_id = customer_order.fk_account_id AND customer_order.customer_order_id = customer_order_product.fk_customerorder_id AND customer_order.customer_order_id=$id")
 or die(mysql_error()); 


 
  // once saved, redirect back to the view page
 header("Location: viewOutStandingInvoice.php"); 
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
 if (isset($_GET['customer_order_id']) && is_numeric($_GET['customer_order_id']) && $_GET['customer_order_id'] > 0)
 {
 // selecting all the field and displaying them into the textboxes
 $id = $_GET['customer_order_id'];

 $result = mysql_query("SELECT account.first_name, account.last_name, customer_order.customer_order_id, customer_order.customer_order_date, customer_order.date_required, customer_order_product.total_price, customer_order_product.customer_order_status FROM account, customer_order, customer_order_product WHERE account.account_id = customer_order.fk_account_id AND customer_order.customer_order_id = customer_order_product.fk_customerorder_id AND customer_order.customer_order_id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 

 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // pulling data from the account table
 $id = $row['customer_order_id'];
 $first = $row['first_name'];
 $last = $row['last_name'];
 $orderdate = $row['customer_order_date'];
 $duedate = $row['date_required'];
 $total = $row['total_price'];
 $status = $row['customer_order_status'];
 
 // renders the form
 renderForm($id, $first, $last, $orderdate, $duedate, $total, $status, '');
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



