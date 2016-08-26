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
<script type="text/javascript" src="js/validateregisterform.js">
</script>
<style type="text/css">
#p
{
  width:600px;
  margin-left: 20px;
}

#location
{
  position: absolute;
  bottom:250px;
  right:380px;
}
</style>
</head>
<body>
<!-- Shell -->
<div class="shell">
    <div id="header">
      <h1 id="logo"><a href="index.php">Blue Leaf</a></h1>

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
      </div><!-- Navigation -->
    <!-- Navigation -->
    <div id="navigation">
      <ul>
          <li><a href="#" class="active">Home</a></li>
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
        <div id="p">
              <div style="width:70%;position:relative;right:10px;">
            <div style="top:15px;left:65px;background-color:Gray;position:relative ">
                 <div style="top:-5px;left:-5px;background-color:rgb(66,66,148);position:relative ">
                   <FONT COLOR="white"><center><h2>Create New Account</h2></center></FONT>
         
                 </div>
              </div>
        </div>
        <br/><br/>
        <form name="register_form" action="createaccount.php"
        onsubmit="return validateForm();" method="post">
        First Name:
          <br />
          <input type="text" name="firstname" size="40" />
          <br />
          Last Name:
          <br />
          <input type="text" name="lastname" size="40" />
          <br />
          Company Name:
          <br />
          <input type="text" name="companyname" size="40" />
          <br />
          Address:
          <br />
          <input type="text" name="address" size="40" />
          <br />
          City:
          <br />
          <input type="text" name="city" size="40"  />
          <br /> <br/>
          Province:
          <br />
          <select name="province" >
            <option value="ON">ON</option>
            <option value="QC">QC</option>
            <option value="NS">NS</option>
            <option value="NB">NB</option>
            <option value="MB">MB</option>
            <option value="BC">BC</option>
            <option value="PE">PE</option>
            <option value="SK">SK/option>
            <option value="AB">AB/option>
            <option value="NL">NL</option>
            <option value="NT">NT</option>
            <option value="YT">YT</option>
            <option value="NU">NU</option>
          </select>
          <br />
      <br />
          Postal Code:
          <br />
          <input type="text" name="postalcode" size="10"  />
         <br />
        
          Phone Number:
          <br />
          <input type="text" name="phonenumber" size="40" />
          <br />
          Phone Ext.
          <br />
          <input type="text" name="phone_ext" size="10" />
          <br />
          Cellphone Number:
          <br />
          <input type="text" name="cellphonenumber"  size="40"/>
          <br />
          Email:
          <br />
          <input type="text" name="email" size="40"  />
          <br />
          Username:
          <br />
          <input type="text" name="username" size="40" />
          <br />
          Password:
          <br />
          <input type="password" name="password" size="40" />
          <br /><br />
          <input type="submit" value="Create Account"   />
        </form>
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
    <p class="left"><a href="#">Home</a> <span>|</span> <a href="shoppingcart.php?command=">Shopping Cart</a>
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