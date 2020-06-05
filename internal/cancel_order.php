<?php
    require_once "internal/cart_operations.php";

    $conn = db_connect();    
    $orderid = getOrderId($conn, $_SESSION['userid']);
    
    $sql = "DELETE FROM orders INNER JOIN orderdetails WHERE orders.ID=orderdetails.Orders and orders.ID='$orderid'";
    $stmt = $mysqli->prepare($sql);
    $r = $stmt->execute();
    if($r) {
        print "Your order is cancelled and deleted from our system.";
    } else {
        print "<br>Error encountered. Please try <a href='?p=cancel_order'>AGAIN</a>." ;
    }

?>
