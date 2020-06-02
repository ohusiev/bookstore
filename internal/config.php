<?php
	require_once "stripe-php-master/init.php";	
	require_once "cart.php";

	$stripeDetails = array(
		"secretKey" => "sk_test_4eC39HqLyjWDarjtT1zdp7dc",
		"publishableKey" => "pk_test_TYooMQauvdEDq54NiTphI7jx"
	);

	// Set your secret key: remember to change this to your live secret key in production
	// See your keys here: https://dashboard.stripe.com/account/apikeys
	\Stripe\Stripe::setApiKey($stripeDetails['secretKey']);
?>