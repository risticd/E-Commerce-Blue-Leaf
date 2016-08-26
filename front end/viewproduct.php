<?php
  include("includes/connection.php");
  include("includes/functions.php");

  if($_REQUEST['command']=='add' && $_REQUEST['productid'] > 0) {
    $pid=$_REQUEST['productid'];
    $colour=$_REQUEST['colour'];
    $rand=$_REQUEST['randomid'];
    $size=$_REQUEST['size'];
    $designlocation=$_REQUEST['designlocation'];
    $designposition=$_REQUEST['designposition'];
    $daterequired=$_REQUEST['daterequired'];
    $image=$_REQUEST['image'];
    addtocart($pid,$colour,$rand,$size,$designlocation,$designposition,$daterequired,$image,1);
    header("location:shoppingcart.php?command=");
    exit();
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Blue Leaf - Home</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/login.css" type="text/css" />
<!--[if lte IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" /><![endif]-->
<script src="js/jquery-1.4.1.min.js" type="text/javascript"></script>
<script src="js/jquery.jcarousel.pack.js" type="text/javascript"></script>
<script src="js/jquery-func.js" type="text/javascript"></script>
  <script type="text/javascript">
  function addtocart(pid) {
    document.form1.productid.value=pid;
    document.form1.command.value='add';
    document.form1.submit();
  }
  </script>
  <style type="text/css">
    .productinfoname
    {
      position: relative;
      bottom: 335px;
      color:rgb(66,66,148);
      font-family: museo-slab,Tahoma,sans-serif;
      font-size: 20px;
      /*border: 1px solid;*/
    }

    .productinfo
	{
	      position: relative;
	      bottom: 310px;
	      font-family: museo-slab,Tahoma,sans-serif;
	      font-size: 15px;
	      width: 200px;
	      /*border: 1px solid;*/
    }

    .embroideryoptname
	{
	      position: relative;
	      bottom: 280px;
	      color:rgb(66,66,148);
	      font-family: museo-slab,Tahoma,sans-serif;
	      font-size: 20px;
	      /*border: 1px solid;*/
    }

    .embroideryoptinfo
    {
    	      position: relative;
		      bottom: 255px;
		      font-family: museo-slab,Tahoma,sans-serif;
		      font-size: 15px;
		      width: 200px;
	      /*border: 1px solid;*/
    }

    .productimage
    {
      position: relative;
      left: 350px;
      top:90px;
      /*border: 1px solid;*/
      width: 365px;
    }

    .addtocart
    {
    	position: relative;
    	bottom: 245px;
    }

    #mainform
    {
    	height: 745px;
    }
  </style>
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.8.21/themes/base/jquery-ui.css" media="all" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script src="js/login.js" type="text/javascript"></script>

<script type="text/javascript">
$(function()
{
$( "#datepicker" ).datepicker();
});
</script>
</head>
<body>
<!-- Shell -->
<div class="shell">
  <!-- Header -->
  <div id="header">
    <h1 id="logo"><a href="index.php">BlueLeaf</a></h1>
      <div id="login">
        <?php
        if(isset($_SESSION['username']))
        {
            $user = $_SESSION['username'];
            echo "<div id='logout'>";
            echo "&nbsp; &nbsp; &nbsp; Welcome, {$user} <br/> <br />
            <a href='signout.php'><div id='logoutlink'>&nbsp; &nbsp; &nbsp; Sign Out</div></a>";
            echo "</div>";
        }

        else
        {
        ?>
        <div id="loginContainer">
          <a href="#" id="loginButton"><span>Log In</span></a>

          <div style="clear:both"></div>

          <div id="loginBox">
            <form id="loginForm" method="post" action="checklogin.php">
              <fieldset id="body">
                <fieldset>
                  <label for="email">Username</label> <input type="text" name="username"
                  id="email">
                </fieldset>

                <fieldset>
                  <label for="password">Password</label> <input type="password" name=
                  "pass" id="password">
                </fieldset><input type="submit" id="login" value="Sign in" />
              </fieldset><span><a href="register.php" class=
              "alogin">Register</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="" class=
              "alogin">Forgot Password</a></span>
            </form>
          </div>
        </div>
      <?php } ?>
      </div>
    <!-- Navigation -->
    <div id="navigation">
      <ul>
          <li><a href="index.php" class="active">Home</a></li>
          <li><a href="shoppingcart.php?command=">Shopping Cart</a></li>
                    <?php
          if(isset($_SESSION['username']))
          {
            echo "<li><a href='myaccount.php'>My Account</a></li>";
          }
          ?>
          <li><a href="aboutus.php">About Us</a></li>
          <li><a href="contact.php">Contact</a></li>
      </ul>
    </div>
    <!-- End Navigation -->
  </div>
  <!-- End Header -->
  <!-- Main -->
  <div id="main">
    <div class="cl">&nbsp;</div>
    <!-- Content -->
    <div id="content">
      <!-- Content Slider -->
      <div id="slider" class="box">
        <div id="slider-holder">
          <ul>
            <li><a href="#"><img src="images/slide1.jpg" alt="" /></a></li>
            <li><a href="#"><img src="images/slide2.jpg" alt="" /></a></li>
            <li><a href="#"><img src="images/slide3.jpg" alt="" /></a></li>
            <li><a href="#"><img src="images/slide4.jpg" alt="" /></a></li>
          </ul>
        </div>
        <div id="slider-nav"> <a href="#" class="active">1</a> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a> </div>
      </div>
      <!-- End Content Slider -->
      <!-- Products -->
      <div class="products">
        <div class="cl">&nbsp;</div>
          <?php

          $productid = $_GET['productid'];

          $query = "SELECT product_number, product_name, base_price, description, colours, sizes, large_image_path
          FROM product WHERE product_number = '{$productid}';";

          $result = mysql_query($query, $con);
          $num_rows = mysql_num_rows($result);

          if($num_rows > 0)
          {
            while($row = mysql_fetch_array($result))
            {
              echo "<form name='form1' id='mainform'>";
              echo "<input type='hidden' name='productid' />";
              echo "<input type='hidden' name='command' />";
              $id = rand();
              echo "<input type='hidden' name='randomid' value='{$id}' />";
              echo "<div class='productimage'>";
              echo "<img src='{$row['large_image_path']}' alt='' />";
              echo "</div>";
              echo "<div class='productinfoname'>";
              echo "{$row['product_name']}";
              echo "</div>";
              echo "<div class='productinfo'>";
              echo "<b>Product #{$row['product_number']}</b>";
              echo "<br /> <br />";
              echo "<b>Price</b>: \${$row['base_price']}";
              echo "<br /> <br />";
              echo "<b>Description</b>: {$row['description']}";
              echo "<br/> <br/>";
              echo "<b>Available Colours</b>";
              echo "<br/> <br/>";
              echo "<select name='colour'>";
              $coloursarray = explode(',',$row['colours']);
              foreach($coloursarray as $value)
              {
              	echo "<option value='{$value}'>{$value}</option>";
              }
              echo "</select>";
              echo "<br/> <br/>";
              echo "<b>Available Sizes</b>";
              echo "<br/> <br/>";
              echo "<select name='size'>";
			  $sizesarray = explode(',',$row['sizes']);
			  foreach($sizesarray as $value1)
			  {
			  	echo "<option value='{$value1}'>{$value1}</option>";
			  }
              echo "</select>";
              echo "</div>";
              echo "<div class='embroideryoptname'>";
              echo "Embroidery Options";
              echo "</div>";
              echo "<div class='embroideryoptinfo'>";
              echo "<b>Your Logo</b>";
              echo "<br /> <br />";
              echo "<input type='file' name='image' />";
              echo "<br /><br />";
              echo "<b>Location of Logo</b>";
              echo "<br /> <br />";
              echo "<select name='designlocation'>";
              echo "<option value=''>None</option>";
              echo "<option value='Front'>Front</option>";
              echo "<option value='Back'>Back</option>";
              echo "<select>";
              echo "<br /> <br />";
              echo "<b>Position of Logo</b>";
      			  echo "<br /> <br />";
      			  echo "<select name ='designposition'>";
      			  echo "<option value=''>None</option>";
      			  echo "<option value='Top Left'>Top Left</option>";
      			  echo "<option value='Top Middle'>Top Middle</option>";
      			  echo "<option value='Top Right'>Top Right</option>";
      			  echo "<option value='Middle Left'>Middle Left</option>";
      			  echo "<option value='Center'>Center</option>";
      			  echo "<option value='Middle Right'>Middle Right</option>";
      			  echo "<option value='Bottom Left'>Bottom Left</option>";
      			  echo "<option value='Bottom Middle'>Bottom Middle</option>";
      			  echo "<option value='Bottom Right'>Bottom Right</option>";
              echo "<select>";
              echo "<br /> <br />";
              echo "<b>Date Required</b>";
              echo "<br /> <br />";
              echo "<input type='text' id='datepicker' name='daterequired'>";
              echo "</div>";
              echo "<div class='addtocart'>";
              echo "<input type='button' class='search-submit' value='Add to Cart' onclick=\"addtocart({$row['product_number']})\" />";
              echo "</div>";
              echo "</form>";
            }
          }

          else
          {
            die('Error occurred.');
          }

          mysql_close($con);
          ?>
        <div class="cl">&nbsp;</div>
      </div>
      <!-- End Products -->
    </div>
    <!-- End Content -->
    <!-- Sidebar -->
    <div id="sidebar">
      <!-- Search -->

      <!-- End Search -->
      <!-- Categories -->
      <div class="box categories">
        <h2><?php echo "{$_GET["categoryname"]}"; ?> <span></span></h2>
        <div class="box-content">
          <ul>
            <?php
                include('includes/connection.php');

                $categoryid = $_GET['categoryid'];
                $categoryname = $_GET['categoryname'];

                $query = "SELECT * FROM sub_category WHERE fk_categoryid = {$categoryid};";

                $result = mysql_query($query, $con);
                $num_rows = mysql_num_rows($result);
                $i = 0;

                if($num_rows > 0)
                {
                  while($row = mysql_fetch_array($result))
                  {
                    $i++;

                    if($i != ($num_rows))
                    {
                      echo "<li><a href='subcategory.php?categoryid={$row['fk_categoryid']}&categoryname={$categoryname}&subcategoryid={$row['sub_category_id']}'>
                      {$row['sub_category_name']}</a></li>";
                    }

                    else
                    {
                      echo "<li class='last'><a href='subcategory.php?categoryid={$row['fk_categoryid']}&categoryname={$categoryname}&subcategoryid={$row['sub_category_id']}'>
                      {$row['sub_category_name']}</a></li>";
                    }
                  }
                }

                else
                {
                  die('There was an error displaying the sub categories!');
                }

                mysql_close($con);
            ?>
          </ul>
          <br />
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <?php echo "<a href='category.php?categoryid={$categoryid}&categoryname={$categoryname}'>View all {$categoryname} Products</a>";  ?>
        </div>
      </div>
      <!-- End Categories -->
    </div>
    <!-- End Sidebar -->
    <div class="cl">&nbsp;</div>
  </div>
  <!-- End Main -->
  
  <!-- Footer -->
  <div id="footer">
    <p class="left"><a href="index.php">Home</a> <span>|</span> <a href="shoppingcart.php?command=">Shopping Cart</a>
    <span>|</span>
              <?php
          if(isset($_SESSION['username']))
          {
            echo "<a href='myaccount.php'>My Account</a>";
            echo "<span>|</span>";
          }
          ?>
    <a href="aboutus.php">About Us</a> <span>|</span> <a href="contact.php">Contact</a></p>

    <p class="right">&#169; 2012 Blue Leaf Ltd. | Design by MDM Solutions | Template by
    <a href="http://chocotemplates.com">Chocotemplates.com</a></p>
  </div>
  <!-- End Footer -->
</div>
<!-- End Shell -->
</body>
</html>