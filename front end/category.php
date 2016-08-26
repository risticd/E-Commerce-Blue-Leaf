<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Blue Leaf - Home</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/login.css" type="text/css">
<!--[if lte IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" /><![endif]-->
<script src="js/jquery-1.4.1.min.js" type="text/javascript"></script>
<script src="js/jquery.jcarousel.pack.js" type="text/javascript"></script>
<script src="js/jquery-func.js" type="text/javascript"></script>
<script src="js/login.js" type="text/javascript"></script>
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
                </fieldset><input type="submit" id="login" value="Sign in">
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
        <ul>
          <?php
              include('includes/connection.php');

              $categoryid = $_GET['categoryid'];
              $categoryname = $_GET['categoryname'];

              $query = "SELECT product_number, fk_categoryid, product_name, base_price, 
              description, small_image_path FROM product WHERE fk_categoryid = {$categoryid};";

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
                    echo '<li>';
                    echo "<a href='viewproduct.php?command=&productid={$row['product_number']}&categoryid={$categoryid}&categoryname={$categoryname}'>
                    <img src='{$row['small_image_path']}' alt='' /></a>";
                    echo "<div class='product-info'>";
                    echo "<h3>{$row['product_name']}</h3>";
                    echo "<div class='product-desc'>";
                    echo "<h4>Product #{$row['product_number']}</h4>";
                    echo "<p></p>";
                    echo "<strong class='price'>\${$row['base_price']}</strong>";
                    echo "</div>";
                    echo "</div>";
                    echo '</li>';
                  }

                  else
                  {
                    echo "<li class='last'>";
                    echo "<a href='viewproduct.php?command=&productid={$row['product_number']}&categoryid={$categoryid}&categoryname={$categoryname}'>
                    <img src='{$row['small_image_path']}' alt='' /></a>";
                    echo "<div class='product-info'>";
                    echo "<h3>{$row['product_name']}</h3>";
                    echo "<div class='product-desc'>";
                    echo "<h4>Product #{$row['product_number']}</h4>";
                    echo "<p></p>";
                    echo "<strong class='price'>\${$row['base_price']}</strong>";
                    echo "</div>";
                    echo "</div>";
                    echo '</li>';
                  }
                }
              }

              else
              {
                die('There was an error displaying the products!');
              }

              mysql_close($con);
          ?>
        </ul>
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
        <h2><?php echo $_GET['categoryname']; ?><span></span></h2>
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
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php">Back to Categories</a>
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
