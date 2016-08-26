<?php

	
	include("../connection/connect.php"); 


    /* The search input from user ** passed from jQuery .get() method */
    $param = $_GET["outstandingBal"];


    /* If connection to database, run sql statement. */
    if ($con) {

        /* Fetch the users input from the database and put it into a
         valuable $fetch for output to our table. */
           $fetch = mysql_query("SELECT account.first_name, account.last_name, customer_order.customer_order_id, customer_order.customer_order_date, customer_order_product.date_required, customer_order_product.total_price, customer_order_product.customer_order_status FROM account, customer_order, customer_order_product WHERE account.account_id = customer_order.fk_account_id AND customer_order.customer_order_id = customer_order_product.fk_customerorder_id AND first_name REGEXP '^$param' GROUP BY customer_order.customer_order_id DESC");
		
        /*
           Retrieve results of the query to and build the table.
           We are looping through the $fetch array and populating
           the table rows based on the users input.
         */
        while ($row = mysql_fetch_object( $fetch ) ) {
            echo '<tr>';
			echo '<td>' . $row->first_name . '</td>';
			echo '<td>' . $row->last_name . '</td>';
			echo '<td>' . $row->customer_order_id . '</td>';
			echo '<td>' . $row->customer_order_date . '</td>';
			echo '<td>' . $row->date_required . '</td>';
			echo '<td>' . $row->total_price . '</td>';
			echo '<td>' . $row->customer_order_status . '</td>';
			echo '<td><a href="editBalance.php?customer_order_id=' . $row->customer_order_id . '"><img src="images/icn_edit.png"></a></td>';
            echo "</tr>"; 
       
        }

    }

    /* Free connection resources. */
    mysql_close($con);

    /* Toss back the results to populate the table. */
    //echo $sResults;

?>