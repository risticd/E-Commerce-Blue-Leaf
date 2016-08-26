<?php

    function check_integer($which) {
        if(isset($_REQUEST[$which])){
            if (intval($_REQUEST[$which])>0) {
                return intval($_REQUEST[$which]);
            } else {
                return false;
            }
        }
        return false;
    }//end of check_integer()

    function get_current_page() {
        if(($var=check_integer('page'))) {
            //return value of 'page', in support to above method
            return $var;
        } else {
            //return 1, if it wasnt set before, page=1
            return 1;
        }
    }//end of method get_current_page()

    function doPages($page_size, $thepage, $query_string, $total=0) {
        
        //per page count
        $index_limit = 10;

        //set the query string to blank, then later attach it with $query_string
        $query='';
        
        if(strlen($query_string)>0){
            $query = "&amp;".$query_string;
        }
        
        //get the current page number example: 3, 4 etc: see above method description
        $current = get_current_page();
        
        $total_pages=ceil($total / $page_size);
        $start=max($current-intval($index_limit/2), 1);
        $end=$start+$index_limit-1;

        echo '<br /><br /><div class="paging">';

        if($current==1) {
           // echo '<span class="prn">&lt; Previous</span>&nbsp;';
        } else {
            $i = $current-1;
            echo '<a href="'.$thepage.'?page='.$i.$query.'" class="prn" rel="nofollow" title="go to page '.$i.'">&lt; Previous</a>&nbsp;';
            echo '<span class="prn">...</span>&nbsp;';
        }

        if($start > 1) {
            $i = 1;
            echo '<a href="'.$thepage.'?page='.$i.$query.'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }

        for ($i = $start; $i <= $end && $i <= $total_pages; $i++){
            if($i==$current) {
                echo '<span>'.$i.'</span>&nbsp;';
            } else {
                echo '<a href="'.$thepage.'?page='.$i.$query.'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
            }
        }

        if($total_pages > $end){
            $i = $total_pages;
            echo '<a href="'.$thepage.'?page='.$i.$query.'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }

        if($current < $total_pages) {
            $i = $current+1;
            echo '<span class="prn">...</span>&nbsp;';
            echo '<a href="'.$thepage.'?page='.$i.$query.'" class="prn" rel="nofollow" title="go to page '.$i.'">Next &gt;</a>&nbsp;';
        } else {
           // echo '<span class="prn">Next &gt;</span>&nbsp;';
        }
        
        
    }
?>

 <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="js/jquery-ui.js"></script>

<!------------------------------------------
MMDA - Sheridan College Learning
Modified: Oct 1st 2012
-> Edit Account Page
-------------------------------------------->

<?php
// holds a session
include("Session/sessions.php"); 

?>

<script type="text/javascript">
$(function()
{
$( "#datepicker" ).datepicker();
});
$(function()
{
$( "#datepicker2" ).datepicker();
});
</script>


<?php
// if header changed location is loaded into 
include("include/header.php"); 

?>

<style type="text/css">
/*---Lets style paging to make it look more cool--*/
     
     /*--example specific styling: you dont need it really in your script, it is just to make this example look good---*/
        body { font-family: Helvetica, arial, sans-serif; font-size:13px; font-weight: normal;}
        
     /*---Paging specific styling----*/     
        .paging { padding:10px 0px 0px 0px; text-align:center; font-size:13px;}
        .paging.display{text-align:right;}
        .paging a, .paging span {padding:2px 8px 2px 8px; font-weight :normal}
        .paging span {font-weight:bold; color:#000; font-size:13px; }
        .paging a, .paging a:visited {color:#000; text-decoration:none; border:1px solid #dddddd;}
        .paging a:hover { text-decoration:none; background-color:#6C6C6C; color:#fff; border-color:#000;}
        .paging span.prn { font-size:13px; font-weight:normal; color:#aaa; }
        .paging a.prn, .paging a.prn:visited { border:2px solid #dddddd;}
        .paging a.prn:hover { border-color:#000;}
        .paging p#total_count{color:#aaa; font-size:12px; font-weight: normal; padding-top:8px; padding-left:18px;}
        .paging p#total_display{color:#aaa; font-size:12px; padding-top:10px;}
</style>

<div id="wrapper">

		<div id="leftBar">
	<?php include("include/links.php"); ?>
	</div>
	<div id="rightContent">
	<h3>Outstanding Invoice</h3>
	<div id="smallRight2">

	  <form action="invoiceSearch.php" method="GET" width="675">
	  <div class="header-right">
      Ordered Date: <input style="width:150px;" id="datepicker" name="customerorderdate" type="text"> 
	  Date Required: <input style="width:150px;" id="datepicker2" name="daterequired" type="text">
	  <input type="submit" value="Search"></div>
		</form>
		<br/><br/>
                              
				<?php


$per_page = 10;

if(!isset($_GET['page']))
{

$page = 0;
}else

{
$page = $_GET['page'];

}
if($page<=1)
{
$start = 0;
}
else
{
 $start = $page * $per_page - $per_page;
}

    // Includes required files
include("connection/connect.php"); 



$sql = "SELECT account.first_name, account.last_name, customer_order.customer_order_id, customer_order.customer_order_date, customer_order.date_required, customer_order_product.total_price, customer_order_product.customer_order_status FROM account, customer_order, customer_order_product WHERE account.account_id = customer_order.fk_account_id AND customer_order.customer_order_id = customer_order_product.fk_customerorder_id AND customer_order_product.customer_order_status = 'pending' GROUP BY customer_order.customer_order_id ORDER BY customer_order_product.total_price DESC";

$num_rows = mysql_num_rows(mysql_query($sql));

$num_pages = ($num_rows % $per_page);

$sql .= " LIMIT $start, $per_page";


$result = mysql_query($sql);


                
        // display data in table
        
        echo "<table width='650' class='sortable'>";
        echo "<tr> 
		<th class='ui-state-default'>First Name</th> 
		<th class='ui-state-default'>Last Name</th>
		<th class='ui-state-default'>Order Number</th> 
		<th class='ui-state-default'>Ordered Date</th>
		<th class='ui-state-default'>Date Required</th>
		<th class='ui-state-default'>Amount Owing</th>
		<th class='ui-state-default'>Payment Status</th>
		<th class='ui-state-default'>View</th></tr>
		</tr>
		";

        // loop through results of database query, displaying them in the table
        // loop through results of database query, displaying them in the table
       while($row = mysql_fetch_array($result))
{


                // echo out the contents of each row into a table
                echo "<tr>";
				echo '<td>' . $row['first_name'] . '</td>';
				echo '<td>' . $row['last_name'] . '</td>';
				echo '<td>' . $row['customer_order_id'] . '</td>';
				echo '<td>' . $row['customer_order_date'] . '</td>';
				echo '<td>' . $row['date_required'] . '</td>';
				echo '<td>' . '$' . $row['total_price'] . '</td>';
				echo '<td>' . $row['customer_order_status'] . '</td>';

				//if(($row['customer_order_status'] == 'pending')||($row['customer_order_status'] == 'cancelled')){
				echo '<td><a href="editInvoice.php?customer_order_id=' . $row['customer_order_id'] . '"><img src="images/icn_edit.png"></a></td>';

				//}
				//else{

				//echo '<td><img src="images/icn_alert_success.png"></td>';
				//}
                 echo "</tr>"; 
 } 

        echo "</table>";


        //close table>
$prev = $page - 1;
$next = $page + 1;



		 doPages(10, 'viewOutStandingInvoice.php', 'category=balances', $num_rows); 

		mysql_close($con);


?>
				
				</div>
				</div>
			</div>

		
<?php
include("include/footer.php"); 

?>
