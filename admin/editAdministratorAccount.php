<!------------------------------------------
MMDA - Sheridan College Learning
Modified: Oct 1st 2012
-> Edit Employee Acount Page
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
	<h3>Edit Administrator Account</h3>

	<div id="smallRight2">
	
	<?php

        // connection to blueleaf database
include("connection/connect.php"); 

// renders the form for the fields required
function renderForm($id, $firstname, $lastname, $company, $address, $city, $province, $postal, $hphone, $cphone, $ext, $user, $email, $account_type, $status, $error)
 {

// error message on validation

 if ($error != '')
 {
 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 }
 
 ?> 
    <!---displays fields and text fields in a table format-->
 <!---displays fields and text fields in a table format-->
 <form action="" method="post">
<input type="hidden" name="account_id" value="<?php echo $id; ?>"/>
 <table  width="650">
 <tr>
 <td>Account Number:</td><td><?php echo $id; ?></td>
 </tr>
 <tr>
 <td>First Name:</td><td><input type="text" name="first_name" value="<?php echo $firstname; ?>"/></td>
 </tr>
 <tr>
 <td>Last Name:</td><td><input type="text" name="last_name" value="<?php echo $lastname; ?>"/></td>
 </tr>
 <tr>
 <td>Company Name:</td><td><input type="text" name="company_name" value="<?php echo $company; ?>"/></td>
 </tr>
  <tr>
 <td>Address:</td><td><input type="text" name="address" value="<?php echo $address; ?>"/></td>
 </tr>
  <tr>
 <td>City:</td><td><input type="text" name="city" value="<?php echo $city; ?>"/></td>
 </tr>
 <tr>
 <td>Province:</td>
 <td>
   <?php

$result = mysql_query("SELECT * FROM account WHERE account_id = $id");    

	 echo "<select name='province'>";

	while($row = mysql_fetch_assoc($result)) {

	
		?>

	
    <option value="1"<?php if ($row['province'] == 'AB') echo ' selected="selected"'; ?>>AB</option>
    <option value="2"<?php if ($row['province'] == 'BC') echo ' selected="selected"'; ?>>BC</option>
    <option value="3"<?php if ($row['province'] == 'MB') echo ' selected="selected"'; ?>>MB</option>
	<option value="4"<?php if ($row['province'] == 'NB') echo ' selected="selected"'; ?>>NB</option>
	<option value="5"<?php if ($row['province'] == 'NL') echo ' selected="selected"'; ?>>NL</option>
	<option value="6"<?php if ($row['province'] == 'NT') echo ' selected="selected"'; ?>>NT</option>
	<option value="7"<?php if ($row['province'] == 'NS') echo ' selected="selected"'; ?>>NS</option>
	<option value="8"<?php if ($row['province'] == 'NU') echo ' selected="selected"'; ?>>NU</option>
	<option value="9"<?php if ($row['province'] == 'ON') echo ' selected="selected"'; ?>>ON</option>
	<option value="10"<?php if ($row['province'] == 'PE') echo ' selected="selected"'; ?>>PE</option>
	<option value="11"<?php if ($row['province'] == 'QC') echo ' selected="selected"'; ?>>QC</option>
	<option value="12"<?php if ($row['province'] == 'SK') echo ' selected="selected"'; ?>>SK</option>
	<option value="13"<?php if ($row['province'] == 'YT') echo ' selected="selected"'; ?>>YT</option>


	<?php

		

		
	}
		
		echo "\r\n</select>";
				

	?>
	
 </td>
 </tr>
 <tr>
 <td>Postal Code:</td><td><input type="text" name="postal_code" maxlength="6" tooltipText="Postal Code ex.K8K7K8" value="<?php echo $postal; ?>"/></td>
 </tr>
 <tr>
 <td>Phone Number:</td><td><input type="text" name="phone_number" tooltipText="Phone Number ex.000-000-0000" value="<?php echo $hphone; ?>"/></td>
 </tr>
 <tr>
 <td>Cell Number:</td><td><input type="text" name="cell_phone" tooltipText="Cell Phone ex.000-000-0000" value="<?php echo $cphone; ?>"/></td>
 </tr>
 <tr>
 <td>Phone Ext:</td><td><input type="text" name="phone_ext" tooltipText="Extention ex.0000" value="<?php echo $ext; ?>"/></td>
 </tr>
  <tr>
 <td>Email:</td><td><input type="text" name="email" tooltipText="example@someexample.com" value="<?php echo $email; ?>"/></td>
 </tr>
   <tr>
 <td>Username:</td><td><input type="text" name="username" value="<?php echo $user; ?>"/></td>
 </tr>
 <tr>
 <td>Role:</td>
 <td>
<select name="account_type">
  <option value="2">Admin</option>
  <option value="1">User</option>
  </select>
 </td>
 </tr>
 <tr>
 <td>Status:</td>
 <td>
 <?php


	$sql = "SELECT account_id, status FROM account where account_id=$id";
	$result = mysql_query($sql);
	echo "<select name='status'>";
	while ($row = mysql_fetch_array($result)) {
						
						
	echo "<option value=". $row['status'] .">". $row['status'] ."</option>";


	 if($status == 'Disabled')
		{
		echo "<option value='1'>Active</option>";
	 }
	
	 if($status == 'Active')
		{
		echo "<option value='2'>Disabled</option>";
	 }

				
			
	}

	
				
	
	echo "</select>";
				
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
 if (is_numeric($_POST['account_id']))
 {
 // gets the form data and making sure it's valid
 $id = $_POST['account_id'];
 $firstname = mysql_real_escape_string(htmlspecialchars($_POST['first_name']));
 $lastname = mysql_real_escape_string(htmlspecialchars($_POST['last_name']));
 $company = mysql_real_escape_string(htmlspecialchars($_POST['company_name']));
 $address = mysql_real_escape_string(htmlspecialchars($_POST['address']));
 $city = mysql_real_escape_string(htmlspecialchars($_POST['city']));
 $province = mysql_real_escape_string(htmlspecialchars($_POST['province']));
 $postal = mysql_real_escape_string(htmlspecialchars($_POST['postal_code']));
 $hphone = mysql_real_escape_string(htmlspecialchars($_POST['phone_number']));
 $cphone = mysql_real_escape_string(htmlspecialchars($_POST['cell_phone']));
 $ext = mysql_real_escape_string(htmlspecialchars($_POST['phone_ext']));
 $email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
 $user = mysql_real_escape_string(htmlspecialchars($_POST['username']));
 $account_type = mysql_real_escape_string(htmlspecialchars($_POST['account_type']));
 $status = mysql_real_escape_string(htmlspecialchars($_POST['status']));



//***************************validation start here with all the fields*****************************************************************************

if (!preg_match("/^[a-zA-Z]+$/",$firstname)|| (empty($_POST['first_name']))){
$error = "Please enter your first name.";
renderForm($id, $firstname, $lastname, $company, $address, $city, $province, $postal, $hphone, $cphone, $ext, $user, $email, $account_type, $status, $error);
} 


elseif (!preg_match("/^[a-zA-Z]+$/",$lastname)|| (empty($_POST['last_name']))){
$error = "Please enter your last name.";
renderForm($id, $firstname, $lastname, $company, $address, $city, $province, $postal, $hphone, $cphone, $ext, $user, $email, $account_type, $status, $error);
} 

elseif (!preg_match ("/[a-zA-Z0-9]+$/", $address)|| (empty($_POST['address']))){
$error = "Please fill out your address.";
renderForm($id, $firstname, $lastname, $company, $address, $city, $province, $postal, $hphone, $cphone, $ext, $user, $email, $account_type, $status, $error);
}


elseif (!preg_match("/^[a-zA-Z]+$/",$city)|| (empty($_POST['city']))){
$error = "Please enter your city.";
renderForm($id, $firstname, $lastname, $company, $address, $city, $province, $postal, $hphone, $cphone, $ext, $user, $email, $account_type, $status, $error);
} 


elseif (!preg_match("/^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$/",$postal)|| (empty($_POST['postal_code']))){
$error = "Please enter your postal code.";
renderForm($id, $firstname, $lastname, $company, $address, $city, $province, $postal, $hphone, $cphone, $ext, $user, $email, $account_type, $status, $error);
} 


elseif (!preg_match("/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i",$hphone)|| (empty($_POST['phone_number']))){
$error = "Please enter your phone number.";
renderForm($id, $firstname, $lastname, $company, $address, $city, $province, $postal, $hphone, $cphone, $ext, $user, $email, $account_type, $status, $error);
} 


elseif (!preg_match("/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i",$cphone)){
$error = "Please enter your cell number.";
renderForm($id, $firstname, $lastname, $company, $address, $city, $province, $postal, $hphone, $cphone, $ext, $user, $email, $account_type, $status, $error);
} 


elseif (!preg_match("/^[0-9]{4,6}+$/",$ext)|| (empty($_POST['phone_ext']))){
$error = "Please enter your extention.";
renderForm($id, $firstname, $lastname, $company, $address, $city, $province, $postal, $hphone, $cphone, $ext, $user, $email, $account_type, $status, $error);
} 

elseif (!preg_match("/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/",$email)){
$error = "Please enter your email.";
renderForm($id, $firstname, $lastname, $company, $address, $city, $province, $postal, $hphone, $cphone, $ext, $user, $email, $account_type, $status, $error);
} 


elseif (empty($_POST['username'])){
$error = "Please fill out username.";
renderForm($id, $firstname, $lastname, $company, $address, $city, $province, $postal, $hphone, $cphone, $ext, $user, $email, $account_type, $status, $error);

 }

else
 {


 // save the data to the database
 mysql_query("UPDATE account SET first_name='$firstname', last_name='$lastname', company_name='$company', address='$address', city='$city', province='$province', postal_code='$postal', phone_number='$hphone', cell_phone='$cphone', phone_ext='$ext', email='$email', username='$user', account_type='$account_type', status='$status' WHERE account_id=$id")
 or die(mysql_error()); 
 

 if ($_POST['account_type'] == '1') {
    header("Location: CustomerAccounts.php");
} else if ($_POST['account_type'] == '2') {
    header("Location:AdministratorAccount.php");
} 
 
 }
 }

 
 }
 
 
 else
 // if the form hasn't been submitted, get the data from the db and display the form
 {
 
 // checking the account_id that it's greater than zero
 if (isset($_GET['account_id']) && is_numeric($_GET['account_id']) && $_GET['account_id'] > 0)
 {
 // selecting all the field and displaying them into the textboxes
 $id = $_GET['account_id'];
 $result = mysql_query("SELECT first_name, last_name, company_name, address, city, province, postal_code, phone_number, cell_phone, phone_ext, email, username, account_type, status FROM account WHERE account_id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 

 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // pulling data from the account table
 $firstname = $row['first_name'];
 $lastname = $row['last_name'];
 $company = $row['company_name'];
 $address = $row['address'];
 $city = $row['city'];
 $province = $row['province'];
 $postal = $row['postal_code'];
 $hphone = $row['phone_number'];
 $cphone = $row['cell_phone'];
 $ext = $row['phone_ext'];
 $email = $row['email'];
 $user = $row['username'];
 $account_type = $row['account_type'];
 $status = $row['status'];

 // renders the form
 renderForm($id, $firstname, $lastname, $company, $address, $city, $province, $postal, $hphone, $cphone, $ext, $user, $email, $account_type, $status, '');
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