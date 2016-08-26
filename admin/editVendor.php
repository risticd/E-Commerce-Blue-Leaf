<!------------------------------------------
MMDA - Sheridan College Learning
Modified: Oct 1st 2012
-> Edit Account Page
-------------------------------------------->

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
	<h3>Edit Vendor</h3>

	<div id="smallRight2">
	
	<?php

    // connection to blueleaf database
include("connection/connect.php"); 

// renders the form for the fields required
function renderForm($id, $venName, $address, $city, $province, $postal, $bphone, $email, $error)
 {

 
 ?> 
    <!---displays fields and text fields in a table format-->
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="register_form" onsubmit="return validateForm()">
<input type="hidden" name="vendor_id" value="<?php echo $id; ?>"/>
 <table  width="650">
 <tr>
 <td>Vendor Name:</td><td><input type="text" name="vend_name" value="<?php echo $venName; ?>"/></td>
 </tr>
 <tr>
 <td>Address:</td><td><input type="text" name="vend_address" value="<?php echo $address; ?>"/></td>
 </tr>
  <tr>
 <td>City:</td><td><input type="text" name="vend_city" value="<?php echo $city; ?>"/></td>
 </tr>
 <tr>
 <td>Province:</td>
 <td>
   <?php

$result = mysql_query("SELECT * FROM vendor WHERE vendor_id = $id");    

	 echo "<select name='vend_province'>";

	while($row = mysql_fetch_assoc($result)) {

	
		?>

	
    <option value="1"<?php if ($row['vend_province'] == 'AB') echo ' selected="selected"'; ?>>AB</option>
    <option value="2"<?php if ($row['vend_province'] == 'BC') echo ' selected="selected"'; ?>>BC</option>
    <option value="3"<?php if ($row['vend_province'] == 'MB') echo ' selected="selected"'; ?>>MB</option>
	<option value="4"<?php if ($row['vend_province'] == 'NB') echo ' selected="selected"'; ?>>NB</option>
	<option value="5"<?php if ($row['vend_province'] == 'NL') echo ' selected="selected"'; ?>>NL</option>
	<option value="6"<?php if ($row['vend_province'] == 'NT') echo ' selected="selected"'; ?>>NT</option>
	<option value="7"<?php if ($row['vend_province'] == 'NS') echo ' selected="selected"'; ?>>NS</option>
	<option value="8"<?php if ($row['vend_province'] == 'NU') echo ' selected="selected"'; ?>>NU</option>
	<option value="9"<?php if ($row['vend_province'] == 'ON') echo ' selected="selected"'; ?>>ON</option>
	<option value="10"<?php if ($row['vend_province'] == 'PE') echo ' selected="selected"'; ?>>PE</option>
	<option value="11"<?php if ($row['vend_province'] == 'QC') echo ' selected="selected"'; ?>>QC</option>
	<option value="12"<?php if ($row['vend_province'] == 'SK') echo ' selected="selected"'; ?>>SK</option>
	<option value="13"<?php if ($row['vend_province'] == 'YT') echo ' selected="selected"'; ?>>YT</option>


	<?php

		

		
	}
		
		echo "\r\n</select>";
				

	?>
	
 </td>
 </tr>
 <tr>
 <td>Postal Code:</td><td><input type="text" name="vend_postal_code" maxlength="6"  value="<?php echo $postal; ?>"/></td>
 </tr>
 <tr>
 <td>Business Number:</td><td><input type="text" name="vend_phone_number"  value="<?php echo $bphone; ?>"/></td>
 </tr>
  <tr>
 <td>Email:</td><td><input type="text" name="vend_email" value="<?php echo $email; ?>"/></td>
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
 if (is_numeric($_POST['vendor_id']))
 {
 // gets the form data and making sure it's valid
 $id = $_POST['vendor_id'];
 $venName = mysql_real_escape_string(htmlspecialchars($_POST['vend_name']));
 $address = mysql_real_escape_string(htmlspecialchars($_POST['vend_address']));
 $city = mysql_real_escape_string(htmlspecialchars($_POST['vend_city']));
 $province = mysql_real_escape_string(htmlspecialchars($_POST['vend_province']));
 $postal = mysql_real_escape_string(htmlspecialchars($_POST['vend_postal_code']));
 $bphone = mysql_real_escape_string(htmlspecialchars($_POST['vend_phone_number']));
 $email = mysql_real_escape_string(htmlspecialchars($_POST['vend_email']));
 


 // save the data to the database
 mysql_query("UPDATE vendor SET vend_name='$venName', vend_address='$address', vend_city='$city', vend_province='$province', vend_postal_code='$postal', vend_phone_number='$bphone', vend_email='$email' WHERE vendor_id=$id")
 or die(mysql_error()); 


 
  // once saved, redirect back to the view page
 header("Location: viewVendor.php"); 
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
 if (isset($_GET['vendor_id']) && is_numeric($_GET['vendor_id']) && $_GET['vendor_id'] > 0)
 {
 // selecting all the field and displaying them into the textboxes
 $id = $_GET['vendor_id'];
 $result = mysql_query("SELECT vend_name, vend_address, vend_city, vend_province, vend_postal_code, vend_phone_number, vend_email FROM vendor WHERE vendor_id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 

 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // pulling data from the account table
 $venName = $row['vend_name'];
 $address = $row['vend_address'];
 $city = $row['vend_city'];
 $province = $row['vend_province'];
 $postal = $row['vend_postal_code'];
 $bphone = $row['vend_phone_number'];
 $email = $row['vend_email'];

 // renders the form
 renderForm($id, $venName, $address, $city, $province, $postal, $bphone, $email, '');
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



