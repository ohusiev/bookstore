<?php
	function db_connect(){
		$conn = mysqli_connect("localhost", "root", "", "bookstore2020");
		if(!$conn){
			echo "Can't connect database " . mysqli_connect_error($conn);
			exit;
		}
		return $conn;
	}

	function getproductByID($conn, $pid){
		$query = "SELECT Title, Price FROM product WHERE ID = '$pid'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}		
		return $result;
	}

	function getproductprice($pid){
		$conn = db_connect();
		$query = "SELECT Price FROM product WHERE ID = '$pid'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "get product price failed! " . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['Price'];
	}
   
    function total_price($cart){
		$price = 0;
		if(is_array($cart)){
		  	foreach($cart as $pid => $qty){
		  		$bookprice = getproductprice($pid);
		  		if($bookprice){
		  			$price += $bookprice * $qty;
		  		}
		  	}
		}
		return $price;
	}

	function total_items($cart){
		$items = 0;
		if(is_array($cart)){
			foreach($cart as $pid => $qty){
				$items += $qty;
			}
		}
		return $items;
	}

	function getOrderId($conn, $customerid){
		$query = "SELECT ID FROM orders WHERE Customer = '$customerid'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "retrieve data failed!" . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['ID'];
	}


?>