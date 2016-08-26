<?php
   // holds a session
   include("Session/sessions.php"); 
   
   ?>
<!------------------------------------------
   MMDA - Sheridan College Learning
   Modified: Oct 4st 2012
   -> Edit Account Page
   -------------------------------------------->
<script type="text/javascript">
//
// window.onload = function ()
//    {
//       document.getElementById("subcat").style.visibility="hidden";
//	   document.getElementById("categ").style.visibility="hidden";
//    }

//   function enableTextbox() {
//   
//   if (document.getElementById("category_name").value == "New Category") {
//   document.getElementById("category").disabled = false;
//   }
//   else {
//   document.getElementById("category").disabled = true;
//   }
//   
//   }


//	function check(){
//if(document.getElementById("subcateg").checked==true)
//        document.getElementById("subcat").style.visibility="visible";
//        else
//        document.getElementById("subcat").style.visibility="hidden";
//
//if(document.getElementById("category").checked==true)
//        document.getElementById("categ").style.visibility="visible";
//        else
//        document.getElementById("categ").style.visibility="hidden";
//

}


function validateCategory() {

	var productCategory = document.forms["category_form"]["category"].value;
	//var productSubCategory = document.forms["category_form"]["sub_category"].value;


	// Category
	if(productCategory == null || productCategory == "")
	{
		alert("Category must be filled out.");
		return false;
	}


</script>

<?php
   // if header changed location is loaded into 
   include("include/header2.php"); 
   
   ?>
<div id="wrapper" />
<div id="leftBar">
   <?php include("include/links.php"); ?>
</div>
<div id="rightContent" />
<h3>Add Product</h3>
<div id="smallRight2" />
<?php
   // Includes required files
   include("connection/connect.php"); 




   
  if(!isset($_POST['submit'])){


	

   ?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" id="product_form" onsubmit="return validateForm()"/>
   <table width="650">
   <tr><td colspan="2"><h4>Please fill out to add product</h4></td></tr>
		 <tr>
         <td>Product Number:</td>
         <td><input type="text" name="product_number" value="Please enter numbers only" onfocus="if(this.value=='Please enter numbers only') this.value='';" 
		 onblur="if (this.value == '') this.value = 'Please enter numbers only';" /></td>
      </tr>
      <tr>
         <td>Vendor Name:</td>
         <td>
            <?php
               include("connection/connect.php"); 
               
               $sql = "SELECT * FROM vendor";
               $result = mysql_query($sql);
               echo "<select name='fkvendor_id'>";
			   ?>
			   <option value="0">Please Choose a Vendor</option>

			   <?php
               while ($row = mysql_fetch_array($result)) {
               echo "<option value='" . $row['vendor_id'] . "'>" . $row['vend_name'] . "</option>";
              }
               echo "</select>";
               echo "<br/>";
               
               ?>
         </td>
      </tr>
      <tr>
         <td>Category Name:</td>
         <td>
            <?php
               include("connection/connect.php"); 
               
               $sql = "SELECT * from category";
               $result = mysql_query($sql);
               echo "<select name='category_id'>";
			   ?>

               <option value="0">Please Choose a Category</option>

			   <?php

               while ($row = mysql_fetch_array($result)) {
               echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
               
               
               
               }
			   echo "</select>";
               echo "<br/>";
			   echo "<br/>";
               
            
               ?>
			    
         
		 <input type="button" title="Click to Add Category" value="Add Category" onclick="window.location = 'AddCategory.php';"></td>
      </tr>
      <tr>
         <td>Sub Category:</td>
         <td>
            <?php
               $sql = "SELECT * from sub_category";
               $result = mysql_query($sql);
               echo "<select name='fk_subcategory_id'>";
			   ?>
               <option value="0">Please Choose a Sub Category</option>
			   <?php
               while ($row = mysql_fetch_array($result)) {
               echo "<option value='" . $row['sub_category_id'] . "'>" . $row['sub_category_name'] . "</option>";
               
               }
			   echo "</select>";
               echo "<br/>";
			   echo "<br/>";
               
               ?>

			   <input type="button" title="Click to Add Sub Category" value="Add Sub Category" onclick="window.location = 'AddSubCategory.php';"></td>
			   
      </tr>
      <tr>
         <td>Product Name:</td>
         <td><input type="text" name="product_name" value="Please enter product name" onfocus="if(this.value=='Please enter product name') this.value='';" 
		 onblur="if (this.value == '') this.value = 'Please enter product name';" /></td>
      </tr>
      <tr>
         <td>Price:</td>
         <td><input type="text" name="base_price" value="ex. 0.00" onfocus="if(this.value=='ex. 0.00') this.value='';" 
		 onblur="if (this.value == '') this.value = 'ex. 0.00';" /></td>
      </tr>
      <tr>
         <td>Colours:</td>
         <td><input type="text" name="colours" value="ex. oranage, blue" onfocus="if(this.value=='ex. oranage, blue') this.value='';" 
		 onblur="if (this.value == '') this.value = 'ex. oranage, blue';" /></td>
      </tr>
      <td>Sizes:</td>
         <td><input type="text" name="sizes"  value="ex. L,S,M" onfocus="if(this.value=='ex. L,S,M') this.value='';" 
		 onblur="if (this.value == '') this.value = 'ex. L,S,M';" /></td>
      </tr>
         <tr>
		<td valign="top">Description:</td><td><textarea style="width:250px; height:100px;" name="description"></textarea></td>
		</tr>
      </tr>
      <tr>
         <td>Small Images: </td>
         <td>
            <input type="file" name="small" />
         </td>
      </tr>
      <tr>
         <td>Large Images: </td>
         <td>
            <input type="file" name="large" />
         </td>
      </tr>
	 <tr>
	 <td></td>
		 <td><input type="submit" name="submit" value="Add Product" /></td>
      </tr>
           
         </td>
      </tr>
   
<?php

		


} else {
			
			 

	
	
	
		  include("connection/connect.php"); 
               //This is the directory where images will be saved 

				

//               $target = "images/products/small/";
//               $target2 = "images/products/large/";
//               
//               $target = $target . basename( $_FILES['small']['name']); 
//               $target2 = $target2 . basename( $_FILES['large']['name']); 
//
//				
//				
//			
//
//		
//               mysql_query("INSERT into product (product_number, fkvendor_id, fk_subcategory_id, product_name, base_price, colours, sizes, description, small_image_path, large_image_path) values ('$_POST[product_number]','$_POST[fkvendor_id]','$_POST[fk_subcategory_id]','$_POST[product_name]','$_POST[base_price]','$_POST[colours]', '$_POST[sizes]','$_POST[description]','$target','$target2')"); 
//               
//               //Writes the photo to the server 
//               if(move_uploaded_file($_FILES['small']['tmp_name'], $target)) 
//               { 
//               
//               //Tells you if its all ok 
//               echo "The file ". basename( $_FILES['small']['name']). " has been uploaded, and your information has been added to the directory"; 
//               } 
//               else { 
//               
//               //Gives and error if its not 
//               echo "Sorry, there was a problem uploading your file."; 
//               } 
//               
//               
//               //Writes the photo to the server 
//               if(move_uploaded_file($_FILES['large']['tmp_name'], $target2)) 
//               { 
//               
//               //Tells you if its all ok 
//               echo "The file ". basename( $_FILES['large']['name']). " has been uploaded, and your information has been added to the directory"; 
//               } 
//               else { 
//               
//               //Gives and error if its not 
//               echo "Sorry, there was a problem uploading your file."; 
//               } 

			   }


              

?>
   
  </table>            
</form>



	</div>

			</div>

 


<?php include("include/footer.php"); 
   ?>


