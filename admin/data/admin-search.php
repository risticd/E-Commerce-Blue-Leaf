<?php

   include("../connection/connect.php"); 

    /* The search input from user ** passed from jQuery .get() method */
    $param = $_GET["admin_search"];


    /* If connection to database, run sql statement. */
    if ($con) {

        /* Fetch the users input from the database and put it into a
         valuable $fetch for output to our table. */
        $fetch = mysql_query("SELECT * FROM account WHERE first_name REGEXP '^$param' OR last_name REGEXP '^$param'");

        /*
           Retrieve results of the query to and build the table.
           We are looping through the $fetch array and populating
           the table rows based on the users input.
         */
        while ($row = mysql_fetch_object( $fetch ) ) {
            echo '<tr>' ;
            echo '<td>' . $row->first_name . '</td>';
			echo '<td>' . $row->last_name . '</td>';
			echo '<td>' . $row->username . '</td>';
			echo '<td>' . $row->account_type . '</td>';
			echo '<td>' . $row->status . '</td>';
		    echo '<td><a href="editAdministratorAccount.php?account_id=' . $row->account_id . '"><img src="images/icn_edit.png"></a></td>';
            echo "</tr>"; 
       
        }

    }

    /* Free connection resources. */
    mysql_close($con);

    /* Toss back the results to populate the table. */
    //echo $sResults;

?>