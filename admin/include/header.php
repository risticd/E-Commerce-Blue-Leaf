<html>
<head>
<title>Blue Leaf</title>
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="css/style.css"> 
<link rel="stylesheet" type="text/css" href="css/layout.css"> 
<link rel="stylesheet" type="text/css" href="css/ie.css">
<link rel="stylesheet" href="css/form-field-tooltip.css" media="screen" type="text/css">
<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="js/hideshow.js" type="text/javascript"></script>
	<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
	<script type="text/javascript" src="js/rounded-corners.js"></script>
	<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="js/jquery-ui.js"></script>
	 <style type="text/css" title="currentStyle">
                @import "css/grid_sytles.css";
                @import "css/themes/smoothness/jquery-ui-1.8.4.custom.css";
    </style>
	<!--validation form -->
	<script type="text/javascript" src="js/validateVendor.js"></script>
	<script type="text/javascript" src="js/validateProduct.js"></script>
	<script type="text/javascript" src="js/validateaccount.js"></script>
	

	<!--jquery script-->
	<script  type="text/javascript" src="js/vendor_search.js"></script>
	<script  type="text/javascript" src="js/product_search.js"></script>
	<script  type="text/javascript" src="js/regularOrder.js"></script>
	<script  type="text/javascript" src="js/adminSearch.js"></script>
	<script  type="text/javascript" src="js/customerSearch.js"></script>
	<script  type="text/javascript" src="js/topselling_search.js"></script>
	<script  type="text/javascript" src="js/outstanding_search.js"></script>
	<script src="js/sort.js"></script>

	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").hide; //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>


</head>

<body>
<div id="header">
	<div class="inHeader">
		<div class="mosAdmin">Welcome, <?php

				echo "" . $_SESSION["username"];

				?><br>
		<a href="welcome.php">Home</a> | <a href="logout.php">Logout</a></div>
	<div class="clear"></div>
	
	</div>
	
</div>