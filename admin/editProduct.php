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
	<h3>Edit Product</h3>

	<div id="smallRight2">
	
	<?php

    // connection to blueleaf database
include("connection/connect.php"); 

// renders the form for the fields required
function renderForm($id, $product_num, $cat_name, $sub_cat, $product_name, $base_price, $colours, $sizes, $description, $error)
 {

// error message on validation


 
 ?> 
    <!---displays fields and text fields in a table format-->
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="register_form" onsubmit="return validateForm()">
<input type="hidden" name="product_id" value="<?php echo $id; ?>"/>
 <table  width="650">
 <tr>
 <td>Product Number:</td><td><input type="text" name="product_number" value="<?php echo $product_num; ?>"/></td>
 </tr>
 <tr>
 <td>Category Name:</td><td><input type="text" name="category_name" value="<?php echo $cat_name; ?>"/></td>
 </tr>
 <tr>
 <td>Sub Category:</td><td><input type="text" name="sub_category_name" value="<?php echo $sub_cat; ?>"/></td>
 </tr>
 <tr>
 <td>Product Name:</td><td><input type="text" name="product_name" value="<?php echo $product_name; ?>"/></td>
 </tr>
 <tr>
 <td>Price: </td><td><input type="text" name="base_price" value="<?php echo $base_price; ?>"/></td>
 </tr>
 <tr>
 <td>Colours:</td><td><input type="text" name="colours" maxlength="6" value="<?php echo $colours; ?>"/></td>
 </tr>
 <tr>
 <td>Sizes:</td><td><input type="text" name="sizes" value="<?php echo $sizes; ?>"/></td>
 </tr>
  <tr>
 <td valign="top">Description:</td><td><textarea style="width:250px; height:100px;" name="description"><?php echo $description; ?></textarea></td>
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
 if (is_numeric($_POST['product_id']))
 {
 // gets the form data and making sure it's valid
 $id = $_POST['product_id'];
 $product_num = mysql_real_escape_string(htmlspecialchars($_POST['product_number']));
 $cat_name = mysql_real_escape_string(htmlspecialchars($_POST['category_name']));
 $sub_cat = mysql_real_escape_string(htmlspecialchars($_POST['sub_category_name']));
 $product_name = mysql_real_escape_string(htmlspecialchars($_POST['product_name']));
 $base_price = mysql_real_escape_string(htmlspecialchars($_POST['base_price']));
 $colours = mysql_real_escape_string(htmlspecialchars($_POST['colours']));
 $sizes = mysql_real_escape_string(htmlspecialchars($_POST['sizes']));
 $description = mysql_real_escape_string(htmlspecialchars($_POST['description']));
 



 // save the data to the database
 mysql_query(" UPDATE product AS product, sub_category AS sub_category , category AS category
    SET product_number='$product_num', category_name='$cat_name', sub_category_name='$sub_cat', product_name='$product_name',  
	base_price='$base_price', colours='$colours', sizes='$sizes', description='$description' 
    WHERE category.category_id = sub_category.fk_categoryid AND sub_category.sub_category_id = product.fk_subcategory_id AND product.product_id=$id")
 or die(mysql_error()); 


 
  // once saved, redirect back to the view page
 header("Location: viewProduct.php"); 
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
 if (isset($_GET['product_id']) && is_numeric($_GET['product_id']) && $_GET['product_id'] > 0)
 {
 // selecting all the field and displaying them into the textboxes
 $id = $_GET['product_id'];
 $result = mysql_query("SELECT product.product_number, category.category_name, sub_category.sub_category_name, product.product_name, product.base_price, product.colours, product.sizes, product.description FROM product, category, sub_category WHERE category.category_id = sub_category.fk_categoryid AND sub_category.sub_category_id = product.fk_subcategory_id AND product.product_id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 

 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // pulling data from the account table
// $id = $row['product_id'];
 $product_num = $row['product_number'];
 $cat_name = $row['category_name'];
 $sub_cat = $row['sub_category_name'];
 $product_name = $row['product_name'];
 $base_price = $row['base_price'];
 $colours = $row['colours'];
 $sizes = $row['sizes'];
 $description = $row['description'];

 // renders the form
 renderForm($id, $product_num, $cat_name, $sub_cat, $product_name, $base_price, $colours, $sizes, $description, '');
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



