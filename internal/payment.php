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
	<h2>Card Details</h2>
	<form method="post" action="?p=confirm_payment" class="form-horizontal">		
        <div class="form-group">
            <label for="card_type" class="col-lg-2 control-label">Type</label>
            <div class="col-lg-10">
              	<select class="form-control" name="card_type">
                  	<option value="VISA">VISA</option>
                  	<option value="MasterCard">MasterCard</option>
                  	<option value="American Express">American Express</option>
              	</select>
            </div>
        </div>
		<div class="form-group">
            <label for="card_owner" class="col-lg-2 control-label">Cardholder Name</label>
            <div class="col-lg-10">
              	<input type="text" class="form-control" name="card_owner" required oninvalid="return required()">
            </div>
        <div class="form-group">
            <label for="card_number" class="col-lg-2 control-label">Card Number</label>
            <div class="col-lg-10">
              	<input type="text" class="form-control" name="card_number" maxlength="16" required oninvalid="return required()">
            </div>
        </div>
        <div class="form-group">
            <label for="card_PID" class="col-lg-2 control-label">CVV</label>
            <div class="col-lg-10">
              	<input type="text" class="form-control" name="card_cvv" maxlength="3" required oninvalid="return required()">
            </div>
        </div>
        <div class="form-group">
            <label for="card_expire" class="col-lg-2 control-label">Expiry Date</label>
			<div class="col-lg-10">
			<select name="card_month">
                    <option value="01">January</option>
                    <option value="02">February </option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
            </select>
            <select name="card_year">
                    <option value="21"> 2021</option>
                    <option value="22"> 2022</option>
                    <option value="23"> 2023</option>
                    <option value="24"> 2024</option>
                    <option value="25"> 2025</option>
                    <option value="26"> 2026</option>
					<option value="27"> 2027</option>
					<option value="28"> 2028</option>
            </select>
			</div>
        </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
              	<button type="reset" class="btn btn-default">Clear</button>
              	<button type="submit" class="btn btn-primary">Purchase</button>
            </div>
        </div>
    </form>
<?php	
?>