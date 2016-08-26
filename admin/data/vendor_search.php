<?php

	include("../connection/connect.php"); 

    /* The search input from user ** passed from jQuery .get() method */
    $param = $_GET["vendor_search"];


    /* If connection to database, run sql statement. */
    if ($con) {

        /* Fetch the users input from the database and put it into a
         valuable $fetch for output to our table. */
        $fetch = mysql_query("SELECT * FROM vendor WHERE vend_name REGEXP '^$param'");

        /*
           Retrieve results of the query to and build the table.
           We are looping through the $fetch array and populating
           the table rows based on the users input.
         */
        while ( $row = mysql_fetch_object( $fetch ) ) {
            echo '<tr>';
            echo '<td>' . $row->vend_name . '</td>';
			echo '<td>' . $row->vend_phone_number . '</td>';
			echo '<td>' . $row->vend_email . '</td>';
		    echo '<td><a href="editVendor.php?vendor_id=' . $row->vendor_id . '"><img src="images/icn_edit.png"></a></td>';
            echo "</tr>"; 
       
        }

    }

    /* Free connection resources. */
    mysql_close($con);

    /* Toss back the results to populate the table. */
    //echo $sResults;

?>