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

#navigation2 {
    white-space:nowrap;
    position:relative;
    left:50px;
}
#navigation2 ul {
    list-style-type:none;
    height:64px;
    font-weight:bold;
    float:left;
}
#navigation2 ul li {
    float:left;
    display:inline;
    width:110px;
    padding:0px;
    margin-right:0px;
}
#navigation2 ul li a {
    float:left;
    height:64px;
    line-height:64px;
    text-decoration:none;
    color:#fff;
    padding:0 15px;
}
#navigation2 ul li a.active {
    background:#fff;
    color:rgba(0,0,0,0.8);
}
#navigation2 ul li a:hover {
    background:rgb(231,231,231);
    color:rgba(0,0,0,0.8);
}
#navigation2 ul li a.active, a:hover {
    background:#fff;
    color:rgba(0,0,0,0.8);
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
          <li><a href="index.php">Home</a></li>
          <li><a href="shoppingcart.php?command=">Shopping Cart</a></li>
          <?php
          if(isset($_SESSION['username']))
          {
            echo "<li><a href='#' class='active'>My Account</a></li>";
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
        <!-- Navigation -->
        <div id="header">
        <div id="navigation2">
        <ul>
          <li><a href="#" class="active">Account Details</a></li>
          <li><a href="orderhistory.php">Order History</a></li>
        </ul>
      </div>
      </div>
        <br/><br/>
          <?php
            include('includes/connection.php');

            $username = $_SESSION["username"];

            $selacct_query = "SELECT * FROM account WHERE username = '{$username}';";
            $selacct_result = mysql_query($selacct_query, $con);
            $selacct_numrows = mysql_num_rows($selacct_result);

            if($selacct_numrows )
            {
              while($selacct_row = mysql_fetch_array($selacct_result))
              {
          ?>
          <form name="account_details_form" action="updateaccount.php" method="post">
          First Name:
          <br />
          <input type="text" name="firstname" size="40" 
          value="<?php echo $selacct_row['first_name'] ?>" />
          <br />
          Last Name:
          <br />
          <input type="text" name="lastname" size="40"
          value="<?php echo $selacct_row['last_name'] ?>" />
          <br />
          Company Name:
          <br />
          <input type="text" name="companyname" size="40"
          value="<?php echo $selacct_row['company_name'] ?>" />
          <br />
          Address:
          <br />
          <input type="text" name="address" size="40"
          value="<?php echo $selacct_row['address'] ?>" />
          <br />
          City:
          <br />
          <input type="text" name="city" size="40"
          value="<?php echo $selacct_row['city'] ?>" />
          <br />
          Province:
          <br />
          <input type="text" name="prov" size="5" disabled="disabled"
          value="<?php echo $selacct_row['province'] ?>"  />
          <br /> <br/>
          Select Province:
          <br />
          <select name="province" >
            <option value="ON">ON</option>
            <option value="QC">QC</option>
            <option value="NS">NS</option>
            <option value="NB">NB</option>
            <option value="MB">MB</option>
            <option value="BC">BC</option>
            <option value="PE">PE</option>
            <option value="SK">SK</option>
            <option value="AB">AB</option>
            <option value="NL">NL</option>
            <option value="NT">NT</option>
            <option value="YT">YT</option>
            <option value="NU">NU</option>
          </select>
          <br />
          <br />
          Postal Code:
          <br />
          <input type="text" name="postalcode" size="10"
          value="<?php echo $selacct_row['postal_code'] ?>"  />
          <br />
          Phone Number:
          <br />
          <input type="text" name="phonenumber" size="40"
          value="<?php echo $selacct_row['phone_number'] ?>" />
          <br />
          Phone Ext.
          <br />
          <input type="text" name="phone_ext" size="10"
          value="<?php echo $selacct_row['phone_ext'] ?>" />
          <br />
          Cellphone Number:
          <br />
          <input type="text" name="cellphonenumber"  size="40" 
          value="<?php echo $selacct_row['cell_phone'] ?>"/>
          <br />
          Email:
          <br />
          <input type="text" name="email" size="40" 
          value="<?php echo $selacct_row['email'] ?>"/>
          <input type="hidden" name="username" value="<?php echo $username; ?>"
          <br /> <br /> <br />
          <input type="Submit" value="Update Account" />
        </form>
        <?php
          }
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
    <p class="left"><a href="index.php">Home</a> <span>|</span> <a href="shoppingcart.php?command=">Shopping Cart</a>
    <span>|</span>
              <?php
          if(isset($_SESSION['username']))
          {
            echo "<a href='#'>My Account</a>";
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
