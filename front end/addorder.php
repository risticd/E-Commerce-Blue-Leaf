<?php
	include('includes/connection.php');
	include("includes/functions.php");

	if(isset($_SESSION["username"]))
	{
		$username = $_SESSION["username"];
		$date = date("Y/m/d");
		$num = rand();
		$account_select = "SELECT account_id FROM account WHERE username = '{$username}';";
		$result = mysql_query($account_select, $con);
		$num_rows = mysql_num_rows($result);

		if($num_rows > 0)
		{
			while($row = mysql_fetch_array($result))
			{
				$customer_order_insert = "INSERT INTO customer_order
				(customer_order_id, fk_account_id, customer_order_date, col)
				VALUES (null, '{$row['account_id']}', '{$date}', '{$num}');";

				mysql_query($customer_order_insert, $con);

				$customer_order_select = "SELECT customer_order_id
				FROM customer_order WHERE fk_account_id = '{$row['account_id']}'
				AND customer_order_date = '{$date}' AND col = '{$num}'";
				$result1 = mysql_query($customer_order_select, $con);
				$num_rows1 = mysql_num_rows($result1);

				if($num_rows1 > 0)
				{
					while($row1 = mysql_fetch_array($result1))
					{
						if(isset($_SESSION['cart'])) 
						{
							$max = count($_SESSION['cart']);

							for($i=0; $i < $max; $i++)
							{

								$pid = $_SESSION['cart'][$i]['productid'];

								$product_select = "SELECT product_id FROM product
								WHERE product_number = '{$pid}';";
								$result2 = mysql_query($product_select, $con);
								$num_rows2 = mysql_num_rows($result2);

								if($num_rows2 > 0)
								{
									while($row2 = mysql_fetch_array($result2))
									{
										$productid = $row2['product_id'];
									}
								}

								$customerorderid = $row1['customer_order_id'];
								$colour = $_SESSION['cart'][$i]['colour'];
								$size = $_SESSION['cart'][$i]['size'];
								$quantity = $_SESSION['cart'][$i]['qty'];
								$subtotal = number_format(get_order_total(), 2);
								$totalprice = $_SESSION["ttl"];
								if($_SESSION['cart'][$i]['designlocation'] == "")
								{
									$designlocation = "";
								}
								else
								{
									$designlocation = $_SESSION['cart'][$i]['designlocation'];
								}
								if($_SESSION['cart'][$i]['designposition'] == "")
								{
									$designposition = "";
								}

								else
								{
									$designposition = $_SESSION['cart'][$i]['designposition'];
								}
          						$designimage = $_SESSION['cart'][$i]['image'];
          						if($_SESSION['cart'][$i]['daterequired'] == "")
          						{
          							$daterequired = "0000-00-00";
          						}

          						else
          						{
          							$daterequired = $_SESSION['cart'][$i]['daterequired'];
          						}
          						$orderstatus = 'pending';

	          					$customer_order_product_insert = "INSERT INTO customer_order_product
	          					(fk_product_id, fk_customerorder_id, colour, size, product_quantity,
	          					subtotal_price, total_price, design_location, design_position, 
	          					design_image_path, date_required, customer_order_status)
	          					VALUES ('{$productid}', '{$customerorderid}', '{$colour}', '{$size}', 
	          					'{$quantity}', '{$subtotal}', '{$totalprice}', '{$designlocation}',
	          					'{$designposition}', null, '{$daterequired}', '{$orderstatus}');";

								//echo $designimage;
								

								mysql_query($customer_order_product_insert, $con);
							}
						}
						echo 'Thank you for your order! <br/> Click <a href="myaccount.php">here</a> to view your
						current orders.';
					}
				}
			}
		}

		else
		{
			die('Error.');
		}
	}

	else
	{
		echo 'Please log in to continue.';
	}
?>