<?php	
    require_once "internal/cart_operations.php";
    require_once "config.php";
    
	$title = "Checkout";
    
    if(isset ($_SESSION['userid'])) {
?>
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
	</table>
	<form method="post" action="payment.php" class="form-horizontal">		
        <h2>Shipping Address</h2>
        <br>
		<div class="form-group">
			<label for="name" class="control-label col-md-6">Name</label>
			<div class="col-md-6">
				<input type="text" name="name" class="col-md-6" class="form-control" required oninvalid="return required()">
			</div>
		</div>
		<div class="form-group">
			<label for="address" class="control-label col-md-6">Address</label>
			<div class="col-md-6">
				<input type="text" name="address" class="col-md-6" class="form-control" required oninvalid="return required()">
			</div>
		</div>
		<div class="form-group">
			<label for="city" class="control-label col-md-6">City</label>
			<div class="col-md-6">
				<input type="text" name="city" class="col-md-6" class="form-control" required oninvalid="return required()">
			</div>
		</div>
		<div class="form-group">
			<label for="zipcode" class="control-label col-md-6">Zip Code</label>
			<div class="col-md-6">
				<input type="text" name="zipcode" class="col-md-6" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="country" class="control-label col-md-6">Country</label>
			<div class="col-md-6">
				<input type="text" name="country" class="col-md-6" class="form-control" required oninvalid="return required()">
			</div>
		</div>
		<div class="form-group">
            <input type="submit" name="submit" value="Confirm and Proceed to Payment" class="btn btn-primary">
		</div>
	</form>	
<?php
	} else {
        print "You need to login to proceed with your order. <a href='?p=login'>login</a>.";
		return;		
	}
	if(isset($conn)){ mysqli_close($conn); }	
?>
