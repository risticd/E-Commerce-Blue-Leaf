<?php 
include('includes/connection.php'); 
include("includes/functions.php"); 
?>

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
<style type="text/css">
#confirmorder
{
  width: 670px;
}

#confirmbutton
{
  position: relative;
  bottom: 39px;
  right: 80px;
}

.linedash
{
  border-bottom:dashed 1px #ccc;
}
</style>
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
          <li><a href="index.php">Home</a></li>
          <li><a href="#" class="active">Shopping Cart</a></li>
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
          <center><h1>Order Confirmation</h1></center>
          <div id="confirmorder">
          <br/>
          <?php
          if(isset($_SESSION['cart'])) 
          {
            $max = count($_SESSION['cart']);

            for($i = 0; $i < $max; $i++)
            {
              $pid = $_SESSION['cart'][$i]['productid'];
              $pname = get_product_name($pid);
              $colour = $_SESSION['cart'][$i]['colour'];
              $size = $_SESSION['cart'][$i]['size'];
              $designlocation = $_SESSION['cart'][$i]['designlocation'];
              $designposition = $_SESSION['cart'][$i]['designposition'];
              if($designlocation || $designposition != "")
              {
                $design = "Design: {$designlocation}" . ', ' . "{$designposition}";
              }
              else
              {
                $design = "None";
              }
              $baseprice = get_price($pid);
              $quantity = $_SESSION['cart'][$i]['qty'];
              $actualprice = number_format(get_price($pid) * $quantity, 2);
              $total = number_format(get_order_total(), 2);
              $daterequired = $_SESSION['cart'][$i]['daterequired'];
              if($design != "None")
              {
                $designcostsh = number_format(get_price($pid) * 0.40, 2);
                $designcost += number_format(get_price($pid) * 0.40, 2);
              }
              else
              {
                $designcostsh = number_format(0.00, 2);
                $designcost += number_format(0.00, 2);
              }
              if($design != "None")
              {
                $quantanddes = number_format((get_price($pid) + get_price($pid) * 0.40)*$quantity, 2);
              }
              else
              {
                $quantanddes += number_format(get_price($pid)*$quantity, 2);
              }
              $taxamt = number_format($quantanddes * 0.13, 2);
              $grandtotal = number_format($quantanddes * 1.13, 2);

              echo "Product #{$pid}";
              echo '<br/>';
              echo "Product Name: {$pname}";
              echo '<br/>';
              echo "Colour: {$colour}";
              echo '<br/>';
              echo "Size: {$size}";
              echo '<br/>';
              echo "Base Price: \${$baseprice}";
              echo '<br/>';
              echo "Design: {$design}";
              echo '<br/>';
              echo 'Design Cost: $' . $designcostsh;
              echo '<br/>';
              echo "Quantity: {$quantity}";
              echo '<br/>';
              echo "Date Required: {$daterequired}";
              echo '<br/><br/>';
              echo "<div class='linedash'></div>";
              echo '<br/>';
            }

            echo "<div align='right'>";
            echo "Total: \${$quantanddes}";
            echo '<br/><br/>';
            echo "Tax Amount: \${$taxamt}";
            echo '<br/><br/>';
            echo "<h2>Grand Total: \${$grandtotal}</h2>";
            // PayPal Code
            echo '</div>';
          }
          ?>
        </div>
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
        <h2>Categories <span></span></h2>
        <div class="box-content">
          <ul>
            <?php
                include('includes/connection.php');

                $query = "SELECT * FROM category;";

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
                      echo "<li><a href='category.php?categoryid={$row['category_id']}&categoryname={$row['category_name']}'>{$row['category_name']}</a></li>";
                    }

                    else
                    {
                      echo "<li class='last'><a href='category.php?categoryid={$row['category_id']}&categoryname={$row['category_name']}'>{$row['category_name']}</a></li>";
                    }
                  }
                }

                else
                {
                  die('There was an error displaying the categories!');
                }

                mysql_close($con);
            ?>
          </ul>
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
    <p class="left"><a href="index.php">Home</a> <span>|</span> <a href="#">Shopping Cart</a>
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
