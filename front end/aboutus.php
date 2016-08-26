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
<style type="text/css">
#p
{
  width:600px;
  margin-left: 20px;
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
            echo "<li><a href='myaccount.php'>My Account</a></li>";
          }
          ?>
          <li><a href="#" class="active">About Us</a></li>
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
                   <FONT COLOR="white"><center><h2>About Us</h2></center></FONT>
         
                 </div>
              </div>
        </div>
        <br/><br/>
        <h1>Custom Corporate &amp; Team Apparel Embroidery</h1>
        <br/>
        <img src="images/logo2.jpg" alt="" />
        <br/><br/>
        <h2>You are what you wear...</h2>
        <br/>
        <p>
          Blue Leaf Ltd. supplies custom, corporate and team apparel. Through the facilities of our in-house embroidery and screen printing services we are able to provide you with a corporate image that will say a lot about your company - who you are and what you do. We have a creative designer who will work with you to develop the look you are after. Our wide range of quality garments provides lots of ideas from which to choose. 
        </p>
        <br/>
        <h2>Let Blue Leaf enhance your image</h2>
        <br/><br/>
        <h1>Tom Fergus</h1>
        <br/>
        <img src="images/Fergus.jpg" alt="" />
        <br/><br/>
        <p>Though a native of the Windy City, Tom Fergus played his Junior hockey in Canada with the Peterborough Petes then joined the Boston Bruins for the 1981-82 season. Fergus stepped right into the Bruins lineup and scored 15 goals as a rookie. The following year he showed marked improvement with 28 goals and 63 points. Fergus, in just two years had developed into the second line center the Bruins needed to compliment first liner Barry Pederson. In 1984-85 Fergus hit the 30-goal plateau while notching a career-best 73 points. The best numbers of his career didn't stop him from getting traded however. On the eve of the 1985-86 campaign the Bruins shipped the skilled center to the Toronto Maple Leafs for Bill Derlago.</p><br/><p> In Toronto Fergus became the team's top pivot and he responded with a career-high 31 goals and matched his previous seasons output of 73 points. However, the next year didn't go as smoothly. Fergus was held to just 49 points in an injury-shortened 57 games. The next year he had just 50 points for the struggling Leafs and fellow Chicago native Ed Olcyzk took over the first line duties. Now a second line center, Fergus bounced back with 67 points, and a personal best 45 assists in 80 games during the 1988-89 campaign. But his resurgence was short lived and the injury bug came back with a vengeance the following year. Fergus played just 14 games for the Maple Leafs in 1990-91 and when he scored just four points through 11 games the next season, the Toronto brass had seen enough. They placed Fergus on waivers where he was claimed by the Vancouver Canucks. Fergus was able to contribute for Vancouver with 34 points in 44 games to finish out that year, but the next year his scoring slipped and he managed just five goals and 14 points through 36 games. It signalled the end of his big league career. But Fergus continued to play. He signed on with Zug of the Swiss league and spent his final two campaigns there before hanging up his skates for good in 1995.</p>
        <br/>
        <p>Source: http://www.legendsofhockey.net/</p>
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
            echo "<a href='myaccount.php'>My Account</a>";
            echo "<span>|</span>";
          }
          ?>
     <a href="#">About Us</a> <span>|</span> <a href="contact.php">Contact</a></p>

    <p class="right">&#169; 2012 Blue Leaf Ltd. | Design by MDM Solutions | Template by
    <a href="http://chocotemplates.com">Chocotemplates.com</a></p>
  </div>
  <!-- End Footer -->
</div>
<!-- End Shell -->
</body>
</html>
