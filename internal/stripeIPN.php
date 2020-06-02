<?php
	require_once "config.php";
	require_once "cart.php";

	\Stripe\Stripe::setVerifySslCerts(false);

	$token = $_POST['stripeToken'];
	$email = $_POST["stripeEmail"];

	// Charge the user's card:
	$charge = \Stripe\Charge::create(array(
		"amount" => $sum,
		"currency" => "eur",		
		"source" => $token,
	));

	//send an email
	//store information to the database
	echo 'Success! You have been charged €' . ($cart[$sum]);
?>