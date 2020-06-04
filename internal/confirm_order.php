<?php
    require_once "internal/cart_operations.php";
    
    $count = $_SESSION['total_items'];
    $shippingfee = 20;
    $amount = ($_SESSION['total_price'] + $shippingfee);
    $date = date("Y-m-d");       
	
    $sql = "INSERT INTO orders (Customer, oDate, Amount, ship_name, ship_address, ship_city, ship_zipcode, ship_country)  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("iiisssss", $_SESSION['userid'], $date, $amount, $_POST['ship_name'], $_POST['ship_address'], $_POST['ship_city'], $_POST['ship_zipcode'], $_POST['ship_country']);
    $r = $stmt->execute();
    if(! $r) {
		print "Application Error: ". $mysqli->error;
		return;
	}    

    // take orderid from order to insert order items  
    $orderid = $mysqli->insert_id;
    foreach($_SESSION['cart'] as $pid => $qty){
        $sql = "INSERT INTO orderdetails (Orders,Quantity,Product) VALUES (?,?,?)";
        $stmt = $mysqli->prepare($sql);
	    $stmt->bind_param("iii", $orderid, $qty, $pid);
        $r = $stmt->execute();
        if(! $r) {
		    print "Application Error: ". $mysqli->error;
		    return;
	    }    
    }

    print "<br><b>$count Products were added to your order. Total cost :  $amount &euro;</b>.";
	$_SESSION['cart'] = array();
?>
	<p class="lead text-success">Your order has been processed sucessfully. </p>

<?php
	if(isset($conn)){
		mysqli_close($conn);
	}
?>