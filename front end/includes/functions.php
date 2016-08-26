<?php
	session_start();
	function get_product_number($pid){
		$result=mysql_query("select product_number from product where product_number=$pid");
		$row=mysql_fetch_array($result);
		return $row['product_number'];
	}

	function select_item($pid){
		$result=mysql_query("select product_number from product where product_number=$pid");
		$row=mysql_fetch_array($result);
		return $row['product_number'];
	}
	function get_product_name($pid){
		$result=mysql_query("select product_name from product where product_number=$pid");
		$row=mysql_fetch_array($result);
		return $row['product_name'];
	}
	function get_price($pid){
		$result=mysql_query("select base_price from product where product_number=$pid");
		$row=mysql_fetch_array($result);
		return $row['base_price'];
	}
	function remove_product($pid){
		$pid=intval($pid);
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid']){
				unset($_SESSION['cart'][$i]);
				break;
			}
		}
		$_SESSION['cart']=array_values($_SESSION['cart']);
	}
	function get_order_total(){
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$price=get_price($pid);
			$sum+=$price*$q;
		}
		return $sum;
	}
	function addtocart($pid,$colour,$rand,$size,$designlocation,$designposition,$daterequired,$image,$q){
		if($pid<1 or $q<1) return;

		if(is_array($_SESSION['cart'])){
			$max=count($_SESSION['cart']);
			$_SESSION['cart'][$max]['productid']=$pid;
			$_SESSION['cart'][$max]['qty']=$q;
			$_SESSION['cart'][$max]['colour']=$colour;
			$_SESSION['cart'][$max]['randomid']=$rand;
			$_SESSION['cart'][$max]['size']=$size;
			$_SESSION['cart'][$max]['designlocation']=$designlocation;
			$_SESSION['cart'][$max]['designposition']=$designposition;
			$_SESSION['cart'][$max]['daterequired']=$daterequired;
			$_SESSION['cart'][$max]['image']=$image;
		}
		else{
			$_SESSION['cart']=array();
			$_SESSION['cart'][0]['productid']=$pid;
			$_SESSION['cart'][0]['qty']=$q;
			$_SESSION['cart'][0]['colour']=$colour;
			$_SESSION['cart'][0]['randomid']=$rand;
			$_SESSION['cart'][0]['size']=$size;
			$_SESSION['cart'][0]['designlocation']=$designlocation;
			$_SESSION['cart'][0]['designposition']=$designposition;
			$_SESSION['cart'][0]['daterequired']=$daterequired;
			$_SESSION['cart'][0]['image']=$image;
		}
	}
?>