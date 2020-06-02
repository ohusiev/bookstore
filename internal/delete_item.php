<?php

if(!is_array($_SESSION['cart'])) {
	$_SESSION['cart']=array();
}

remove_item();
function remove_item() {
    global $mysqli;

    foreach ($_SESSION['cart'] as $key=>$cartItem) {
        if ($cartItem["code"] == $rem) {
            unset($_SESSION['cart'][$key]);
        }
    }
    print "<a href='?p=cart' class='btn btn-primary'>Back to Cart</a>";
}
