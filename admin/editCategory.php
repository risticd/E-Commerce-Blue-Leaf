<?PHP
/*--------------------------------------------------------------------------------------
@Desc       :   Simple and Cool Paging with PHP
@author     :   SachinKRaj - http://blog.sachinkraj.com
@updates    :   http://blog.sachinkraj.com/how-to-create-simple-paging-with-php-cs/
@Comments   :   If you like my work, please drop me a comment on the above post link. 
                Thanks!
---------------------------------------------------------------------------------------*/
    function check_integer($which) {
        if(isset($_REQUEST[$which])){
            if (intval($_REQUEST[$which])>0) {
                return intval($_REQUEST[$which]);
            } else {
                return false;
            }
        }
        return false;
    }//end of check_integer()

    function get_current_page() {
        if(($var=check_integer('page'))) {
            //return value of 'page', in support to above method
            return $var;
        } else {
            //return 1, if it wasnt set before, page=1
            return 1;
        }
    }//end of method get_current_page()

    function doPages($page_size, $thepage, $query_string, $total=0) {
        
        //per page count
        $index_limit = 10;

        //set the query string to blank, then later attach it with $query_string
        $query='';
        
        if(strlen($query_string)>0){
            $query = "&amp;".$query_string;
        }
        
        //get the current page number example: 3, 4 etc: see above method description
        $current = get_current_page();
        
        $total_pages=ceil($total / $page_size);
        $start=max($current-intval($index_limit/2), 1);
        $end=$start+$index_limit-1;

        echo '<br /><br /><div class="paging">';

        if($current==1) {
           // echo '<span class="prn">&lt; Previous</span>&nbsp;';
        } else {
            $i = $current-1;
            echo '<a href="'.$thepage.'?page='.$i.$query.'" class="prn" rel="nofollow" title="go to page '.$i.'">&lt; Previous</a>&nbsp;';
            echo '<span class="prn">...</span>&nbsp;';
        }

        if($start > 1) {
            $i = 1;
            echo '<a href="'.$thepage.'?page='.$i.$query.'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }

        for ($i = $start; $i <= $end && $i <= $total_pages; $i++){
            if($i==$current) {
                echo '<span>'.$i.'</span>&nbsp;';
            } else {
                echo '<a href="'.$thepage.'?page='.$i.$query.'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
            }
        }

        if($total_pages > $end){
            $i = $total_pages;
            echo '<a href="'.$thepage.'?page='.$i.$query.'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }

        if($current < $total_pages) {
            $i = $current+1;
            echo '<span class="prn">...</span>&nbsp;';
            echo '<a href="'.$thepage.'?page='.$i.$query.'" class="prn" rel="nofollow" title="go to page '.$i.'">Next &gt;</a>&nbsp;';
        } else {
           // echo '<span class="prn">Next &gt;</span>&nbsp;';
        }
        
        
    }
?>


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
//
//}


function validateCategory() {

	var productCategory = document.forms["category_form"]["category_name"].value;
	var regex1 = /^[a-zA-Z]+$/;


	// Category
	if(productCategory == null || productCategory == "")
	{
		alert("Category must be filled out.");
		return false;
	}

	if(!productCategory.match(regex1))
	{
		alert("Invalid Category only enter letters.");
		return false;
	}



}


</script>

<?php
   // if header changed location is loaded into 
   include("include/header.php"); 
   
   ?>
   <style type="text/css">
/*---Lets style paging to make it look more cool--*/
     
     /*--example specific styling: you dont need it really in your script, it is just to make this example look good---*/
        body { font-family: Helvetica, arial, sans-serif; font-size:13px; font-weight: normal;}
        
     /*---Paging specific styling----*/     
        .paging { padding:10px 0px 0px 0px; text-align:center; font-size:13px;}
        .paging.display{text-align:right;}
        .paging a, .paging span {padding:2px 8px 2px 8px; font-weight :normal}
        .paging span {font-weight:bold; color:#000; font-size:13px; }
        .paging a, .paging a:visited {color:#000; text-decoration:none; border:1px solid #dddddd;}
        .paging a:hover { text-decoration:none; background-color:#6C6C6C; color:#fff; border-color:#000;}
        .paging span.prn { font-size:13px; font-weight:normal; color:#aaa; }
        .paging a.prn, .paging a.prn:visited { border:2px solid #dddddd;}
        .paging a.prn:hover { border-color:#000;}
        .paging p#total_count{color:#aaa; font-size:12px; font-weight: normal; padding-top:8px; padding-left:18px;}
        .paging p#total_display{color:#aaa; font-size:12px; padding-top:10px;}
</style>

<div id="wrapper" />
<div id="leftBar">
   <?php include("include/links.php"); ?>
</div>
<div id="rightContent" />
<h3>Edit Category</h3>

	<div id="smallRight2" />
<?php
   // Includes required files
   include("connection/connect.php"); 


   // renders the form for the fields required
function renderForm($id, $category, $error)
 {


  if(!isset($_POST['submit'])){


	

   ?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="category_form" onsubmit="return validateCategory()"/>
<input type="hidden" name="category_id" value="<?php echo $id; ?>"/>
   <table width="650">
   <tr><td colspan="2" class="nohightlight"><h4>Please edit Category</h4></td></tr>
			<tr>

			</td>
		 <tr>
         <td class="nohightlight">Category:</td>
         <td class="nohightlight"><input type="text" name="category_name" value="<?php echo $category ?>"></td>
      </tr>
	  <tr>
         <td class="nohightlight"><input type="button" title="Add Product" value="Add Product" onclick="window.location = 'AddProduct.php';">
		 <td class="nohightlight"><input type="submit" name="submit" value="Save" /></td>
      </tr>
	  <tr>
	  	 <td class="nohightlight"><input type="button" title="Add Category" value="Add Category" onclick="window.location = 'AddCategory.php';">
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

 }
             

?>
   
  </table>            
</form>


<?php



 
 // check form that it has been submitted
 if (isset($_POST['submit']))
 { 
 // getting the account_id for each row
 if (is_numeric($_POST['category_id']))
 {
 // gets the form data and making sure it's valid
 $id = $_POST['category_id'];
 $category = mysql_real_escape_string(htmlspecialchars($_POST['category_name']));



 // save the data to the database
 mysql_query(" UPDATE category
    SET category_name='$category' WHERE category_id=$id")
 or die(mysql_error()); 


 
  // once saved, redirect back to the view page
 header("Location: AddCategory.php"); 
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
 if (isset($_GET['category_id']) && is_numeric($_GET['category_id']) && $_GET['category_id'] > 0)
 {
 // selecting all the field and displaying them into the textboxes
 $id = $_GET['category_id'];
 $result = mysql_query("SELECT category_name FROM category WHERE category_id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 

 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // pulling data from the account table
// $id = $row['category_id'];
 $category = $row['category_name'];

 // renders the form
 renderForm($id, $category, '');
 }
 }
 }
 
$per_page = 10;

if(!isset($_GET['page']))
{

$page = 0;
}else

{
$page = $_GET['page'];

}
if($page<=1)
{
$start = 0;
}
else
{
 $start = $page * $per_page - $per_page;
}

 

$sql = "SELECT category_id, category_name FROM category WHERE category_id=category_id";

$num_rows = mysql_num_rows(mysql_query($sql));

$num_pages = ($num_rows % $per_page);

$sql .= " LIMIT $start, $per_page";


$result = mysql_query($sql);


           
        // display data in table
        
        echo "<table width='650' class='sortable'>";
        echo "<tr> 
		<th colspan='3' title='sort' class='ui-state-default'><a href='#'>Category</a></th></tr> 
		";

        // loop through results of database query, displaying them in the table
       while($row = mysql_fetch_array($result))
{

                //echo out the contents of each row into a table
                echo "<tr>";
			    echo '<td>' . $row['category_name'] . '</td>';
				echo '<td><a href="editCategory.php?category_id=' . $row['category_id'] . '"><img src="images/icn_edit.png"></a></td>';
                echo "</tr>"; 
 } 

        echo "</table>";
		
 //close table>
$prev = $page - 1;
$next = $page + 1;

doPages(10, 'AddCategory.php', 'category=categoryname', $num_rows);

 
?>

</div>
</div>
</div>


 


<?php include("include/footer.php"); 
   ?>
