
<?php

include("connection/connect.php"); 


include("Session/sessions.php"); 


include("include/header.php");


?>


<div id="wrapper">

		<div id="leftBar">
		<?php include("include/links.php"); ?>
	</div>
	<div id="rightContent">
	<h3>Dashboard</h3>
	<div class="shortcutHome">
	  <a href="viewtopselling.php"><img src="css/img/posting.png"><br>
	    Top Selling</a>
		</div>
		<div class="shortcutHome">
		<a href="CustomerAccounts.php"><img src="css/img/halaman.png"><br>
		Customer</a>
		</div>
		<div class="shortcutHome">
		<a href="AdministratorAccount.php"><img src="css/img/photo.png"><br>
		Administrator</a>
		</div>
		<div class="shortcutHome">
		<a href="viewOutStandingBalance.php"><img src="css/img/quote.png"><br>
		Outstanding Balance</a>
		</div>
		<div class="shortcutHome">
		<a href="manageOrders.php"><img src="css/img/bukutamu.png"><br>
		Orders</a>
		</div>
		
		<div class="clear"></div>

	
	<div id="smallRight2">

	<div width="650"><h3>Top Items</h3>

		<?php
			include("connection/connect.php"); 


			$sql = "SELECT product.product_number, product.product_name, vendor.vend_name, product.base_price, product.sizes, customer_order_product.product_quantity, customer_order_product.total_price FROM product, vendor, customer_order_product WHERE customer_order_product.fk_product_id = product.product_id AND product.fkvendor_id=vendor.vendor_id GROUP BY product.product_number ORDER BY product.base_price * customer_order_product.product_quantity DESC LIMIT 5";
			$result = mysql_query($sql);


		echo "<table width='650' class='sortable'>";
        echo "<tr> 
		<th class='ui-state-default'>Product Number</th> 
		<th class='ui-state-default'>Product Name</th>
		<th class='ui-state-default'>Vendor Name</th> 
		<th class='ui-state-default'>Size</th>
		<th class='ui-state-default'>Price</th>
		<th class='ui-state-default'>Amount Purchased</th>
		<th class='ui-state-default'>Total Amount</th>
		";

			  while($row = mysql_fetch_array($result))
{				
				$price = $row['base_price'];
				$quantity = $row['product_quantity'];
				$total = $price * $quantity;

                // echo out the contents of each row into a table
                echo "<tr>";
				echo '<td>' . $row['product_number'] . '</td>';
				echo '<td>' . $row['product_name'] . '</td>';
				echo '<td>' . $row['vend_name'] . '</td>';
				echo '<td>' . $row['sizes'] . '</td>';
				echo '<td>' . $row['base_price'] . '</td>';
				echo '<td>' . $row['product_quantity'] . '</td>';
				echo '<td>' .number_format($total, 2).'</td>';
			
                echo "</tr>"; 
 } 

        echo "</table>";

		mysql_close($con);

		?>
		
		</div>
		
		</div>
		
	</div>
<?php
include("include/footer.php"); 

?>
