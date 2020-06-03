<?php	
	require_once "internal/cart_operations.php";	

	if(isset($_POST['pid'])){
		$pid = $_POST['pid'];
	}

	if(isset($pid)){
		// new item selected
		if(!isset($_SESSION['cart'])){			
			$_SESSION['cart'] = array();
			$_SESSION['total_items'] = 0;
			$_SESSION['total_price'] = '0.00';
		}

		if(!isset($_SESSION['cart'][$pid])){
			$_SESSION['cart'][$pid] = 1;
		} elseif(isset($_POST['cart'])){
			$_SESSION['cart'][$pid]++;
			unset($_POST);
		}
	}

	//when update button is clicked, change the qty of each product
	if(isset($_POST['update'])){
		foreach($_SESSION['cart'] as $pid =>$qty){
			if($_POST[$pid] == '0'){
				unset($_SESSION['cart']["$pid"]);
			} else {
				$_SESSION['cart']["$pid"] = $_POST["$pid"];
			}
		}
	}	
	
	$title = "Cart";

	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
		$_SESSION['total_price'] = total_price($_SESSION['cart']);
		$_SESSION['total_items'] = total_items($_SESSION['cart']);
?>
   	<form action="?p=cart" method="post">
	   	<table class="table">
	   		<tr>
	   			<th>Item</th>
	   			<th>Price</th>
	  			<th>Quantity</th>
	   			<th>Total</th>
	   		</tr>
			   
	   		<?php
		    	foreach($_SESSION['cart'] as $pid => $qty){
					$conn = db_connect();
					$row = mysqli_fetch_assoc(getproductByID($conn, $pid));
			?>
			<tr>
				<td><?php echo $row['Title']; ?></td>
				<td><?php echo "€" . $row['Price']; ?></td>
				<td><input type="text" value="<?php echo $qty; ?>" size="3" name="<?php echo $pid; ?>"></td>
				<td><?php echo "€" . $qty * $row['Price']; ?></td>
			</tr>
			<?php } ?>
		    <tr>		    	
		    	<th>&nbsp;</th>
		    	<th><?php echo $_SESSION['total_items']; ?></th>
		    	<th><?php echo "€" . $_SESSION['total_price']; ?></th>
		    </tr>
	   	</table>
		   <input type="submit" class="btn btn-primary" name="update" value="Update Cart">
		   <a href='?p=empty_cart' class='btn btn-primary'>Empty Cart</a>	
	</form>
	<br/><br/>
	<a href="?p=checkout" class="btn btn-primary">Go To Checkout</a> 
	<a href="?p=products" class="btn btn-primary">Continue Shopping</a>	
<?php
	} else {
		echo "<p class=\"text-warning\">Your Cart is Empty!</p>";
	}
	if(isset($conn)){ mysqli_close($conn); }
?>



