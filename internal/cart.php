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
</div>
</div>
<body>

<?php	
	require_once "internal/cart_operations.php";	

	if(isset($_REQUEST['pid'])){
		$pid = $_REQUEST['pid'];
	}

	if(isset($pid)){
		// new item selected
		if(!isset($_SESSION['cart'])){			
			$_SESSION['cart'] = array();
			$_SESSION['total_items'] = 0;
			$_SESSION['total_price'] = '0';
		}

		if(!isset($_SESSION['cart'][$pid])){
			$_SESSION['cart'][$pid] = 1;
		} elseif(isset($_REQUEST['cart'])){
			$_SESSION['cart'][$pid]++;
			unset($_REQUEST);
		}
	}

	//when update button is clicked, change the qty of each product
	if(isset($_REQUEST['update'])){
		foreach($_SESSION['cart'] as $pid =>$qty){
			if($_REQUEST[$pid] == '0'){
				unset($_SESSION['cart']["$pid"]);
			} else {
				$_SESSION['cart']["$pid"] = $_REQUEST["$pid"];
			}
		}
	}		

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
	<a href="?p=checkout" class="btn btn-primary">Checkout</a> 
	<a href="?p=products" class="btn btn-primary">Continue Shopping</a>	
<?php
	} else {
		echo "<p class=\"text-warning\">Your Cart is Empty!</p>";
	}
	if(isset($conn)){ mysqli_close($conn); }
?>



