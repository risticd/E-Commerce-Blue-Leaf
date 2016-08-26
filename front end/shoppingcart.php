<?php
  include("includes/connection.php");
  include("includes/functions.php");

  if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
    remove_product($_REQUEST['pid']);
  }
  else if($_REQUEST['command']=='clear'){
    unset($_SESSION['cart']);
  }
  else if($_REQUEST['command']=='update'){
    $max=count($_SESSION['cart']);
    for($i=0;$i<$max;$i++){

      $rand=$_SESSION['cart'][$i]['randomid'];

      $q=intval($_REQUEST['randomid'.$rand]);
      if($q>0 && $q<=999){
        $_SESSION['cart'][$i]['qty']=$q;
      }
      else{
        $msg='Some products not updated!, quantity must be a number between 1 and 999';
      }
    }
  }

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
<script language="javascript">
  function del(pid){
    if(confirm('Do you really mean to delete this item')){
      document.form1.pid.value=pid;
      document.form1.command.value='delete';
      document.form1.submit();
    }
  }
  function clear_cart(){
    if(confirm('This will empty your shopping cart, continue?')){
      document.form1.command.value='clear';
      document.form1.submit();
    }
  }
  function update_cart(){
    document.form1.command.value='update';
    document.form1.submit();
  }
</script>
<style type="text/css">
  .a
  {
    margin-bottom: 100px;
  }

  .tdstyle
  {
  	position:relative;
  	bottom: 30px;
  }

  #prodnumtd
  {
    position:relative;
    bottom: 33px;
  }

  .productname
  {
  	/*color:rgb(66,66,148);*/
    font-weight: bold;
  }

  .taxstyle
  {
  	position:relative;
  	bottom:10px;
  }

  .grandtotal
  {
    position:relative;
  	bottom:20px;
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

<form name="form1">
<input type="hidden" name="pid" />
<input type="hidden" name="command" />
  <div style="margin-left:-45px; width:880px;" >
    <div style="padding-bottom:10px">
      <h1 align="center">Your Shopping Cart</h1>
    </div>
    <br />
      <div style="color:#F00"></div>
      <table border="0" cellpadding="5px" cellspacing="15px" style="width="100%";>
      <?php
      if(isset($_SESSION['cart'])){
              echo "<tr bgcolor='#FFFFFF' style='font-weight:bold;'><td>Product #</td><td>Product Name</td><td>Base Price</td><td>Quantity</td><td>Price w\Quantity &amp; Design</td><td>Options</td></tr>";
        $max=count($_SESSION['cart']);
        for($i=0;$i<$max;$i++){
          $pid=$_SESSION['cart'][$i]['productid'];
          $rand=$_SESSION['cart'][$i]['randomid'];
          $q=$_SESSION['cart'][$i]['qty'];
          $colour=$_SESSION['cart'][$i]['colour'];
          $size=$_SESSION['cart'][$i]['size'];
          $designlocation=$_SESSION['cart'][$i]['designlocation'];
          $designposition=$_SESSION['cart'][$i]['designposition'];
          $daterequired=$_SESSION['cart'][$i]['daterequired'];
          $pname=get_product_name($pid);
          $pNum = get_product_number($pid);
          $design = "";
          if($q==0) continue;
      ?>
      <?php
      if($designlocation || $designposition != "")
      {
        $design = "<b>Design</b>: $designlocation, $designposition";
      }
      else
      {
        $design = "<b>Design</b>: None";
      }
      ?>
                  <?php
                  if($design != "<b>Design</b>: None")
                  {
                    $designcostsh = number_format(get_price($pid) * 0.40, 2);
                    $designcost += number_format(get_price($pid) * 0.40, 2);
                  }
                  else
                  {
                    $designcostsh = number_format(0.00, 2);
                    $designcost += number_format(0.00, 2);
                  }
                  ?>
                <tr bgcolor="#FFFFFF">
                <td class="tdstyle"><div id="prodnumtd"><?php echo $pid ?></div></td>
                <td><?php echo "<div>$pname</div> ---- <br/> <b>Colour</b>: $colour <br/> <b>Size</b>: $size <br/> $design <br/> <b>Design Cost</b>: $$designcostsh" ?></td>
                <td class="tdstyle"><center>$<?php echo number_format(get_price($pid), 2)?></center></td>
                <td class="tdstyle"><input type="text" name="randomid<?php echo $rand?>" value="<?php echo $q?>" maxlength="3" size="9" /></td>
                <td class="tdstyle"><center>
                  <?php
                  if($design != "<b>Design</b>: None")
                  {
                    $ttl += number_format((get_price($pid) + get_price($pid) * 0.40)*$q, 2); 
                    echo '$' . number_format((get_price($pid) + get_price($pid) * 0.40)*$q, 2);
                  }
                  else
                  {
                    $ttl += number_format(get_price($pid)*$q, 2);
                    echo '$' . number_format(get_price($pid)*$q, 2);
                  }
                  ?></center>
                </td>
                <td class="tdstyle"><a href="javascript:del(<?php echo $pid?>)">Remove</a></td>
                </tr>
            <?php
        }
      ?>
        <tr>
        <td colspan="7" align="right">Total: $<?php echo number_format($ttl, 2)?></td>
        </tr>
        <tr class="a">
        <td colspan="7" align="right" class="taxstyle">Tax Amount: $<?php echo number_format(($ttl) * 0.13, 2)?></td>
        </tr>
        <tr>
          <?php $_SESSION["ttl"] = number_format(($ttl) * 1.13, 2); ?>
        <td colspan="7" align="right" class="grandtotal"><h2>Grand Total: $<?php echo number_format(($ttl) * 1.13, 2)?></h2></td>
        </tr>
        <tr>
        <td colspan="7" align="right"><span style='float:right; margin-left:10px;'><input type="button" class="search-submit" value="Checkout" onclick="window.location.href='confirmorder.php'"></span><span style='float:right; margin-left:10px;'><input type="button" class="search-submit" value="Update" onclick="update_cart()"></span><span style='float:right;'><input type="button" class="search-submit" value="Clear" onclick="clear_cart()"></span></td>
        </tr>
      <?php
            }
      else {
        echo "<tr bgColor='#FFFFFF'><td>There are no items in your shopping cart!</td>";
      }
    ?>
        </table>
    </div>
</form>
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
