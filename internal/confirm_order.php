<?php
    require_once "internal/cart_operations.php";    
    
    $count = $_SESSION['total_items'];
    $shippingfee= 10;
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
    //I use SENDMAIL 
        //--see attached php.ini and sendmail.ini files and placed them inside there respective folders inside XAMPP)
        //--restart xampp before running file
    $to = "webtester1996@gmail.com"; //this is for testing purposes only. to change to customer's email
    $subject = "Confirmation of Order# $orderid";    
    $headers = "From: webtester1996@gmail.com";
    $msg = "
    ORDER CONFIRMATION
    This is to confirm your order with reference number: $orderid    
    Please expect your order to reach within 5-15 business days.
    Thank you for your purchase!
    ";  
    if(mail($to, $subject, $msg, $headers)){
        print "<br>Your order has been processed sucessfully. Kindly check your email for confirmation.";
    } else{
        print "<br>Your order has been processed sucessfully. However, your confirmation email did not go through.";
        print "<br>Kindly wait for awhile as we fix this issue. We are sorry for this inconvenience.";
    }

    if ($payment_mode==1){        
        print "<br>Please proceed to <a href='?p=payment'>PAYMENT</a>.";
    } elseif ($payment_mode==2){                
        $_SESSION['cart'] = array();
    }
?>
