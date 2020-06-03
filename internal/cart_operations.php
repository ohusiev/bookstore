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

	function getOrderId($conn, $customerid){
		$query = "SELECT ID, oDate FROM orders WHERE Customer= '$customerid'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "retrieve data failed!" . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['ID'];
	}

	function insertIntoOrder($conn, $customerID, $oDate, $total_price, $ship_name, $ship_address, $ship_city, $ship_zip_code, $ship_country){
		$query = "INSERT INTO orders VALUES 
		('', '" . $customerid . "', , '" . $oDate . "', '" . $total_price . "', '" . $ship_name . "', '" . $ship_address . "', '" . $ship_city . "', '" . $ship_zip_code . "', '" . $ship_country . "')";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Insert orders failed " . mysqli_error($conn);
			exit;
		}
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

	function getCustomerId($Fname, $Lname, $Address, $Phone){
		$conn = db_connect();
		$query = "SELECT ID from customer WHERE 
		Fname = '$Fname' AND 
        Lname = '$Lname' AND 
		Address= '$Address' AND 	
		Phone = '$Phone'";
		$result = mysqli_query($conn, $query);
		// if there is customer in db, take it out
		if($result){
			$row = mysqli_fetch_assoc($result);
			return $row['ID'];
		} else {
			return null;
		}
    }
    
    function total_price($cart){
		$price = 0.00;
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


?>