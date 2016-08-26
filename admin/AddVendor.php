<!------------------------------------------
MMDA - Sheridan College Learning
Modified: Oct 4st 2012
-> Edit Account Page
-------------------------------------------->

<?php
// holds a session
include("Session/sessions.php"); 

?>


<?php
// if header changed location is loaded into 
include("include/header2.php"); 

 

?>



<div id="wrapper">

		<div id="leftBar">
	<?php include("include/links.php"); ?>
	</div>
	<div id="rightContent">
	<h3>Add Vendor</h3>
	<div id="smallRight2">


	<?php
		  if(!isset($_POST['submit'])){
	?>

					
				 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="vendor_form" onsubmit="return validateFormVendor()">
				 <table width="650">
				 <tr><td colspan="2"><h4>Please fill out form to add vendor</h4></td></tr>
				 <tr>
				 <td>Vendor Name:</td>
				 <td><input type="text" value="Please enter vendor name" name="vend_name" onfocus="if(this.value=='Please enter vendor name') this.value='';" onblur="if (this.value == '') this.value = 'Please enter vendor name';"></td>
				 </tr>
				 <tr>
				 <td>Address:</td>
				 <td><input type="text" name="vend_address" value="ex. 1234 Blue Leaf" onfocus="if(this.value=='ex. 1234 Blue Leaf') this.value='';" onblur="if (this.value == '') this.value = 'ex. 1234 Blue Leaf';" /></td>
				 </tr>
				 <tr>
				 <td>City:</td>
				 <td><input type="text" name="vend_city" value="Please enter letters only" onfocus="if(this.value=='Please enter letters only') this.value='';" onblur="if (this.value == '') this.value = 'Please enter letters only';" /></td>
				 </tr>
				 <tr>
				 <td>Province:</td>
				 <td>
				 <select name="vend_province">
					<option value="0">Choose Province</option>
					<option value="1">AB</option>
					<option value="2">BC</option>
					<option value="3">MB</option>
					<option value="4">NB</option>
					<option value="5">NL</option>
					<option value="6">NT</option>
					<option value="7">NS</option>
					<option value="8">NU</option>
					<option value="9">ON</option>
					<option value="10">PE</option>
					<option value="11">QC</option>
					<option value="12">SK</option>
					<option value="13">YT</option>
					</select>
				 </td>
				 </tr>
				 <tr>
				 <td>Postal Code:</td>
				 <td><input type="text" name="vend_postal_code" value="ex. L6L7H4" onfocus="if(this.value=='ex. L6L7H4') this.value='';" onblur="if (this.value == '') this.value = 'ex. L6L7H4';"/></td>
				 </tr>
				 <tr>
				 <td>Business Phone:</td>
				 <td><input type="text" name="vend_phone_number" value="ex. 905-123-4567" onfocus="if(this.value=='ex. 905-123-4567') this.value='';" onblur="if (this.value == '') this.value = 'ex. 905-123-4567';" /></td>
				 </tr>
				 <tr>
				 <td>Email:</td>
				 <td><input type="text" name="vend_email" value="ex. blueleaf@blueleaf.ca" onfocus="if(this.value=='ex. blueleaf@blueleaf.ca') this.value='';" onblur="if (this.value == '') this.value = 'ex. blueleaf@blueleaf.ca';" /></td>
				 
				 </tr>
				 <tr>
				 <td><input type="submit" name="submit" value="New Vendor" /></td>
				 </tr>


				 <?php



} else {



		include("connection/connect.php"); 

	$sql="INSERT INTO vendor (vend_name, vend_address, vend_city, vend_province, vend_postal_code, vend_phone_number, vend_email)
	VALUES
	('$_POST[vend_name]','$_POST[vend_address]','$_POST[vend_city]','$_POST[vend_province]','$_POST[vend_postal_code]','$_POST[vend_phone_number]','$_POST[vend_email]')";

		if (!mysql_query($sql,$con))
		 {
		die('Error: ' . mysql_error());
		}else{
			?>
			 <META HTTP-EQUIV="refresh" CONTENT="3;URL=AddVendor.php">
			 <form action="AddVendor.php" method="post" id="vendor_form" onsubmit="return validateFormVendor()">
				 <table width="650">
				 <tr><td colspan="2"><h4>Vendor successfully inserted</h4></td></tr>
				 <tr>
				 <td>Vendor Name:</td>
				 <td><input type="text" name="vend_name" /></td>
				 </tr>
				 <tr>
				 <td>Address:</td>
				 <td><input type="text" name="vend_address" /></td>
				 </tr>
				 <tr>
				 <td>City:</td>
				 <td><input type="text" name="vend_city" /></td>
				 </tr>
				 <tr>
				 <td>Province:</td>
				 <td>
				 <select name="vend_province">
					<option value="0">Choose Province</option>
					<option value="1">AB</option>
					<option value="2">BC</option>
					<option value="3">MB</option>
					<option value="4">NB</option>
					<option value="5">NL</option>
					<option value="6">NT</option>
					<option value="7">NS</option>
					<option value="8">NU</option>
					<option value="9">ON</option>
					<option value="10">PE</option>
					<option value="11">QC</option>
					<option value="12">SK</option>
					<option value="13">YT</option>
					</select>
				 </td>
				 </tr>
				 <tr>
				 <td>Postal Code:</td>
				 <td><input type="text" name="vend_postal_code" /></td>
				 </tr>
				 <tr>
				 <td>Business Phone:</td>
				 <td><input type="text" name="vend_phone_number" /></td>
				 </tr>
				 <tr>
				 <td>Email:</td>
				 <td><input type="text" name="vend_email" /></td>
				 </tr>
				 <tr>
				 <td><input type="submit" name="submit" value="New Vendor" /></td>
				 </tr>
				 </table>

			<?php


		}
}


		mysql_close($con)


?>
				

 </table>
  
</form> 

				

				</div>
			</div>

		
<?php
include("include/footer.php"); 

?>

