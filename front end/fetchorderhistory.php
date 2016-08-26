<?php
	include('includes/connection.php');

	$username = $_SESSION["username"];

	$query =
	"SELECT product.product_number, product.product_name, product.base_price, 
	customer_order.customer_order_date, customer_order_product.fk_customerorder_id, 
	customer_order_product.colour, customer_order_product.size, 
	customer_order_product.product_quantity, customer_order_product.subtotal_price, 
	customer_order_product.total_price, customer_order_product.design_location, 
	customer_order_product.design_position, customer_order_product.date_required, 
	customer_order_product.customer_order_status
	FROM account, product, customer_order, customer_order_product
	WHERE account.account_id = customer_order.fk_account_id
	AND product.product_id = customer_order_product.fk_product_id
	AND customer_order.customer_order_id = customer_order_product.fk_customerorder_id
	AND account.username = '{$username}'
	ORDER BY customer_order_product.fk_customerorder_id;";

	$result = mysql_query($query, $con);
	$num_rows = mysql_num_rows($result);

	if($num_rows > 0)
	{
		echo "<div class='linedash'></div>";
		echo '<br/>';
		echo '<h2>View Order Details:</h2>';
		echo '<br/>';
		while($row = mysql_fetch_array($result))
		{
			if($customerorderid != $row["fk_customerorder_id"])
			{
				$customerorderid = $row["fk_customerorder_id"];
				if($row["customer_order_status"] == "cancelled")
				{
				echo '<h2><a href="orderdetails.php?orderno=' . $customerorderid . '">Order #' . $row["fk_customerorder_id"] . ' </a></h2>';
				echo '<br/>';
				echo 'Date Ordered: ' . $row["customer_order_date"] . '<br/>';
				echo '<br/>';
				echo '<b>Status</b>: ' . $row["customer_order_status"] . '<br/>' . '<br/>';
				}

				else
				{
				echo '<h2><a href="orderdetails.php?orderno=' . $customerorderid . '">Order #' . $row["fk_customerorder_id"] . ' </a></h2>';
				echo '<br/>';
				echo 'Date Ordered: ' . $row["customer_order_date"] . '<br/>';
				echo '<br/>';
				echo '<b>Status</b>: ' . $row["customer_order_status"] . '<br/>';
				echo '<b>Outstanding Balance</b>: $' . $row["total_price"] . '<br/><br/>';
				}
			}
		}
		echo "<div class='linedash'></div>";
}

else
{
	echo 'No orders to display.';
}

mysql_close($con);
?>