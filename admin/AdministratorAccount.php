<?PHP
/*--------------------------------------------------------------------------------------
@Desc       :   Simple and Cool Paging with PHP
@author     :   SachinKRaj - http://blog.sachinkraj.com
@updates    :   http://blog.sachinkraj.com/how-to-create-simple-paging-with-php-cs/
@Comments   :   If you like my work, please drop me a comment on the above post link. 
                Thanks!
---------------------------------------------------------------------------------------*/
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


<!------------------------------------------
MMDA - Sheridan College Learning
Modified: Oct 1st 2012
-> Edit Account Page
-------------------------------------------->
<link rel="stylesheet" href="mos-style.css" type="text/css" media="screen" />
<?php
// holds a session
include("Session/sessions.php"); 

?>


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
	<h3>Administrator Account</h3>
	<div id="smallRight2">

	  <div class="header-right" style="height:40px;">
                    Search by Name: <input style="width:150px;" id="admin_search" type="text"></div>
            

	<table width="650" class="ui-grid-content ui-widget-content cStoreDataTable" id="cStoreDataTable">
                <thead>
                    <tr>
                        <th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					
                    </tr>
                </thead>
                <tbody id="adminResults"></tbody>
            </table>



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


$sql = "Select * from account where account_type = 2";

$num_rows = mysql_num_rows(mysql_query($sql));

$num_pages = ($num_rows % $per_page);

$sql .= " LIMIT $start, $per_page";


$result = mysql_query($sql);


                
        // display data in table
        
         echo "<table width='650'>";
        echo "<tr> 
		<th class='ui-state-default'>First Name</th> 
		<th class='ui-state-default'>Last Name</th> 
		<th class='ui-state-default'>UserName</th> 
		<th class='ui-state-default'>Role</th>
		<th class='ui-state-default'>Account Status</th>
		<th class='ui-state-default'>View</th></tr>";

        // loop through results of database query, displaying them in the table
       while($row = mysql_fetch_array($result))
{

                // echo out the contents of each row into a table
                echo "<tr>";
                echo '<td>' . $row['first_name'] . '</td>';
                echo '<td>' . $row['last_name'] . '</td>';
				echo '<td>' . $row['username'] . '</td>';
				echo '<td>' . $row['account_type'] . '</td>';
				echo '<td>' . $row['status'] . '</td>';
                echo '<td><a href="editAdministratorAccount.php?account_id=' . $row['account_id'] . '"><img src="images/icn_edit.png"></a></td>';
                echo "</tr>"; 
        } 

        echo "</table>";


        //close table>
$prev = $page - 1;
$next = $page + 1;




		 doPages(10, 'AdministratorAccount.php', 'category=products', $num_rows); 

		mysql_close($con);


?>
				
				</div>
				</div>
			</div>

		
<?php
include("include/footer.php"); 

?>
