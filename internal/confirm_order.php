<?php
    require_once "internal/cart_operations.php";    
    
    $count = $_SESSION['total_items'];
    $shippingfee = 10;
    $amount = ($_SESSION['total_price'] + $shippingfee);
    $payment_mode = $_POST['payment_mode'];        
	
    $sql = "INSERT INTO orders (Customer, Amount, payment_mode, ship_name, ship_address, ship_city, ship_zipcode, ship_country)  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("iissssss", $_SESSION['userid'], $amount, $payment_mode, $_POST['ship_name'], $_POST['ship_address'], $_POST['ship_city'], $_POST['ship_zipcode'], $_POST['ship_country']);
    $r = $stmt->execute();
    if(! $r) {
		print "Application Error: ". $mysqli->error;
		return;
	}    
 
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
    print "<br><b>$count Product(s) were added to your order. Total cost :  $amount &euro;</b>.";

    //Email Order Confirmation to User
    $to = "ho17@hw.ac.uk"; //this is for testing only. to change to customer's email
    $subject = "Confirmation of Order# $orderid";    
    $headers = "From: Biblioo Webstore";
    $msg = "
    <html>
    <head>
    <title>Order Confirmation</title>
    </head>
    <body>
    <p>This is to confirm your order with ID number: $orderid</p>  
    <p>Please expect your order to reach within 5-15 business days.</p>
    <p>Thank you for your purchase!</p>
    </body>
    </html>
    ";
    mail($to,$subject,$msg,$headers);

    if ($payment_mode==1){
        print "<br>Your order has been processed sucessfully. Please proceed to <a href='?p=payment'>Payment</a>.";
    } elseif ($payment_mode==2){
        print "<br>Your order has been processed sucessfully. Please check your email.";        
        $_SESSION['cart'] = array();
    }
?>
