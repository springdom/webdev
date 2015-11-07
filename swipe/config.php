<?php

/*
 * Required Swipe Config
 * TODO: SET YOUR CREDENTIALS HERE! (Find these in your Merchant login under Settings -> API Credentials)
 */
$swipeConfig = array(
	'merchantId' => '124310DDB2B2D0',
	'apiKey' => '9ddf64d63ad2a93f684f53b6b58ffb22a503e5678338090081d2b2cbb2fb033b',
	'apiUrl' => 'https://api.swipehq.com/',
	'paymentPageUrl' => 'https://payment.swipehq.com/',
);



/*
 * Your Store Config
 * TODO: update this
 */
$yourStorePaymentCompleteUrl = 'http://merchant.swipehq.com/admin/developers/api-demo/payment-complete.php';



/*
 * Example Content
 */
$yourStoreItems = array(
		1234 => array('name' 	=> 'Blue Hammer',
					  'price' 	=> 15),
		1235 => array('name' 	=> 'Yellow Screwdriver',
					  'price' 	=> 7.95)
);

// stock
try{
	session_start();
}catch(Exception $e){}

if(!isset($_SESSION['yourStoreStock'])){
	$_SESSION['yourStoreStock'] = array(
		1234 => 100,
		1235 => 50
	);
}



/*
 * Dynamic Config (only needed for the Swipe API Demo, can be safely ignored/deleted)
 */
if(isset($_SESSION['api_demo'])){
	$swipeConfig = $_SESSION['api_demo']['swipeConfig'];
	$yourStorePaymentCompleteUrl = $_SESSION['api_demo']['yourStorePaymentCompleteUrl'];
}
