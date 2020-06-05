<?php		
	require_once "internal/cart_operations.php";
  
    if(isset ($_SESSION['userid'])) {
?>
	<h2> Order Summary </h2>
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
			<td><?php echo $qty; ?></td>
			<td><?php echo "€" . $qty * $row['Price']; ?></td>
		</tr>
		<?php } ?>
		<tr>			
			<th>&nbsp;</th>
			<th><?php echo $_SESSION['total_items']; ?></th>
			<th><?php echo "€" . $_SESSION['total_price']; ?></th>
		</tr>
		<tr>
			<?php $shippingfee = 10; ?>
			<td>Shipping Fee</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><?php echo "€" . $shippingfee; ?></td>
		</tr>
		<tr>
			<th>Total (Including Shipping)</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th><?php echo "€" . ($_SESSION['total_price'] + $shippingfee); ?></th>
		</tr>
	</table>
	<br>
	<h2>Shipping Address</h2>
	
	<form method='POST' action="?p=confirm_order" class="form-horizontal">		
	<table class="table table-striped">
	<tr><td class="text-right">Payment Mode:</td><td>
		<select class="form-control" name="payment_mode">
        	<option value="1">Pay with Card</option>
            <option value="2">Cash on Delivery</option>            
        </select>
	</td></tr>
	<tr><td class="text-right">Name:</td><td><input class="form-control" type='text' name='ship_name' required oninvalid="return required()"></td></tr>
	<tr><td class="text-right">Address:</td><td><input class="form-control" type='text' name='ship_address' required oninvalid="return required()"></td></tr>
	<tr><td class="text-right">City:</td><td><input class="form-control" type='text' name='ship_city' required oninvalid="return required()"></td></tr>
	<tr><td class="text-right">Zip Code:</td><td><input class="form-control" type='text' name='ship_zipcode'></td></tr>
	<tr><td class="text-right">Country:</td><td><input class="form-control" type='text' name='ship_country' required oninvalid="return required()"></td></tr>
	<tr><td colspan="2" colspan="2" class="text-center">
	<input type="submit" name="submit" value="Confirm your Order" class="btn btn-primary">
	</td></tr>
	</table>        
	</form>	
<?php
	} else {		
		print "You need to login to proceed with your order. <a href='?p=login'>login</a>.";		
		return;		
	}
	if(isset($conn)){ mysqli_close($conn); }	
?>
