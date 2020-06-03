<?php
	require_once "config.php";
	require_once "checkout.php";

	\Stripe\Stripe::setVerifySslCerts(false);

	$token = $_POST['stripeToken'];
	$email = $_POST["stripeEmail"];

	$customer = \Stripe\Customer::create([
		'email' => $email,
		'source'  => $token,
	]);

	// Charge the user's card:
	$charge = \Stripe\Charge::create([
		"customer" => $customer->id
		"amount" => $_SESSION['total_price'],
		"currency" => "eur",		
	]);

	//send an email
	//store information to the database
	echo 'Success! You have been charged €' . ($_SESSION['total_price']);
?>