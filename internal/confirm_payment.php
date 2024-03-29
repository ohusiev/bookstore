<style>
.borders-intro { box-sizing: border-box; margin-bottom: 41px; !important; padding: 0 40px; }
.borders-intro span.reg { font-size: 70%; position: relative; top: -4px; }
.cities {
  background-color: lightgray;
  color: black;
  margin: 20px;
  padding: 20px;
}
</style>
<body>
<div class="breadcrumb">
        <div class="container">
            <a class="breadcrumb-item" href="index.php?p=start">Home</a>
            <span class="breadcrumb-item active">Cart</span>
			<span class="breadcrumb-item active">Payment</span>
</div>
</div>
<body>

<?php
    require_once "internal/cart_operations.php"; 

    $card_owner=$_POST['card_owner'];
    $card_number=$_POST['card_number'];
    $card_cvv=$_POST['card_cvv'];
    $card_expiry=$_POST['card_year'] . '/' . $_POST['card_month'];

    $conn = db_connect();    
    $orderid = getOrderId($conn, $_SESSION['userid']); 

    $sql = "INSERT INTO carddetails (Orders, card_owner, card_number, card_cvv, card_expiry)  VALUES (?, ?, ?, ?, ?)";
    //$sql = "UPDATE orders SET card_owner='$card_owner', card_number='$card_number', 'card_cvv='$card_cvv', card_expiry='$card_expiry' WHERE ID=$orderid";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("isiis", $orderid, $card_owner, $card_number, $card_cvv, $card_expiry);
    $r = $stmt->execute();
    if(! $r) {
        print "Application Error: ". $mysqli->error;
		return;
    } else{
    
    //Email Order Confirmation to User
    //I use SENDMAIL 
        //--see attached php.ini and sendmail.ini files and placed them inside there respective folders inside XAMPP)
        //--restart xampp before running file
        $to = "webtester1996@gmail.com"; //this is for testing purposes only. to change to customer's email
        $subject = "INVOICE";    
        $headers = "From: webtester1996@gmail.com";
        $msg = "
        INVOICE
        This is to confirm your payment with the following details:
        Cardholder: $card_owner
        Card Number: $card_number 
        CVV: $card_cvv
        Expiry Date: $card_expiry
        Thank you for your purchase!
        ";  
        if(mail($to, $subject, $msg, $headers)){
            print "<br>Your payment has been processed sucessfully. Kindly check your email for your invoice.";
        } else{
            print "<br>The email did not go through. Please wait for us to resend your invoice";                        
        }
        $_SESSION['cart'] = array();
    }    
    
	if(isset($conn)){
		mysqli_close($conn);
	}
?>