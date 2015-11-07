<?php

require_once __DIR__ . '/SwipeProduct.php';


/**
 * This class is a simple client for connecting to the Swipe API. It has cut-down
 * functionality for simplicity. Advanced functionality can be added by referring to the API docs:
 * 		merchant.swipehq.com/admin/main/index.php?module=developers&action=payments-page-details
 */
class Swipe {

	protected $merchantId;
	protected $apiKey;

	protected $apiUrl;
	protected $paymentPageUrl;


	public function __construct(array $config){
		if(!isset($config['merchantId'])){
			throw new Exception('Required config value missing: merchantId');
		}
		if(!isset($config['apiKey'])){
			throw new Exception('Required config value missing: apiKey');
		}
		if(!isset($config['apiUrl'])){
			throw new Exception('Required config value missing: apiUrl');
		}
		if(!isset($config['paymentPageUrl'])){
			throw new Exception('Required config value missing: paymentPageUrl');
		}
		$this->merchantId = $config['merchantId'];
		$this->apiKey = $config['apiKey'];
		$this->apiUrl = $config['apiUrl'];
		$this->paymentPageUrl = $config['paymentPageUrl'];
	}



	/**
	 * API call for creating "identifiers" for simple ad-hoc transactions, see:
	 * 	merchant.swipehq.com/admin/main/index.php?module=developers&action=api
	 *
	 * @param string $itemName
	 * @param number $amount
	 * @param string $userData (for tracking what is being purchased)
	 * @param string $paymentCompleteUrl (where the Payment Page will redirect on completion)
	 * @param string $livePaymentNotificationUrl (the page that Swipe will call after a payment has been completed)
	 * @return int an "identifier id", this is what you pass to the payment page
	 */
	public function createTransactionIdentifier($itemName, $itemPrice, $userData, $paymentCompleteUrl, $livePaymentNotificationUrl){
		$responseData = $this->callAPI('createTransactionIdentifier.php',
								    array('td_item' 			=> $itemName,
										  'td_amount'			=> $itemPrice,
								    	  'td_user_data' 		=> $userData,
								    	  'td_callback_url' 	=> $paymentCompleteUrl,
								    	  'td_lpn_url' 			=> $livePaymentNotificationUrl));
		return $responseData['identifier'];
	}

	/**
	 * API call for veriying transactions, see:
	 * 	merchant.swipehq.com/admin/main/index.php?module=developers&action=verify
	 *
	 * @return boolean true if Accepted, otherwise Declined or pending
	 */
	public function isTransactionAccepted($transactionId){
		$responseData = $this->callAPI('verifyTransaction.php',
								    array('transaction_id' => $transactionId));
		// transaction_approved is the definitive answer, ignore status
		return $responseData['transaction_approved'] === 'yes';
	}



	/**
	 * @return array of SwipeProduct
	 */
	public function getProducts(){
		$responseData = $this->callAPI('fetchProducts.php');
		$products = array();
		foreach($responseData as $productArray){
			$product = new SwipeProduct($productArray['product_id'],
										 $productArray['prod_name'],
										 $productArray['prod_description'],
										 $productArray['prod_sale_price'],
										 $productArray['prod_rrp'],
										 $productArray['prod_minimum_purchase'],
										 $productArray['prod_accepted_url'],
										 $productArray['prod_declined_url']);
			$products[$product->getId()] = $product;
		}
		return $products;
	}

	/**
	 * @return SwipeProduct
	 */
	public function getProduct($id){
		$products = $this->getProducts();
		return $products[$id];
	}

	/**
	 * Creates the given Product, giving it an id
	 * @return void
	 */
	public function addProduct(SwipeProduct $product){
		$responseData = $this->callAPI('createProduct.php',
									   array('prod_name' 				=> $product->getName(),
									   		 'prod_description' 		=> $product->getDescription(),
									   		 'prod_sale_price' 			=> $product->getSalePrice(),
									   		 'prod_rrp' 				=> $product->getRecommendedSalePrice(),
									   		 'prod_minimum_purchase' 	=> $product->getMinimumQuantity(),
											 'prod_accepted_url' 		=> $product->getPaymentCompleteUrl(),
											 'prod_declined_url' 		=> $product->getPaymentCompleteUrl()
		));
		$productId = $responseData['product_id'];
		$product->setId($productId);
	}

	/**
	 * Updates an existing Product
	 */
	public function updateProduct(SwipeProduct $product){
		$responseData = $this->callAPI('updateProduct.php',
									   array('product_id' 				=> $product->getId(),
									   		 'prod_name' 				=> $product->getName(),
											 'prod_description' 		=> $product->getDescription(),
											 'prod_sale_price' 			=> $product->getSalePrice(),
											 'prod_rrp' 				=> $product->getRecommendedSalePrice(),
											 'prod_minimum_purchase' 	=> $product->getMinimumQuantity(),
									   		 'prod_accepted_url' 		=> $product->getPaymentCompleteUrl(),
									   		 'prod_declined_url' 		=> $product->getPaymentCompleteUrl(),
		));
	}


	/**
	 * Get a link to the payment page for an ad hoc transaction
	 * @param string $identifier
	 */
	public function getAdHocPaymentPageUrl($identifierId){
		return $this->paymentPageUrl. '?identifier_id='.$identifierId;
	}

	/**
	 * Get a link to the payment page for a product
	 * @param string $productId
	 * @param int $quantity - optional, defaults to 1
	 */
	public function getProductPaymentPageUrl($productId, $quantity = null){
		$r = $this->paymentPageUrl. '?product_id='.$productId;
		if($quantity != null){
			$r .= '&item_quantity='.$quantity;
		}
		return $r;
	}



	/**
	 * Helper function to send a POST request to the Swipe API.
	 * @param string $url
	 * @param array $data array of key-value parameter pairs
	 * @return array of API response data.
	 */
	protected function callAPI($apiScript, $data = array()) {
		// Append common parameters
		$data['merchant_id'] = $this->merchantId;
		$data['api_key'] = $this->apiKey;
		$data['apikey'] = $this->apiKey; // some APIs use this variation... so we pass both

		/*
		 * This function uses cURL to make a HTTP request.
		 * See: http://www.php.net/manual/en/book.curl.php
		 */
		$url = $this->apiUrl . $apiScript;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		$html = curl_exec($ch);
		if(curl_errno($ch) !== 0){
			die('Error connecting to the Swipe API: '.curl_error($ch));
		}
		curl_close($ch);

		/*
		 * All API calls return JSON (http://www.json.org/) responses in the format:
		 * 	{"response_code":200,"message":"OK","data":{"identifier":"XXXX"}}
		 *
		 * We decode the response to get our PHP array, and return the data array:
		 * 	array('response_code' => 200, 'message' => 'OK', 'data' => array('identifier' => 'XXXX'))
		 *
		 * See: merchant.swipehq.com/admin/main/index.php?module=developers&action=apiformat
		 */
		$responseArray = json_decode($html, true);
		if($responseArray === null){
			die('Error connecting to the Swipe API: '.$html);
		}
		if($responseArray['response_code'] != '200'){
			die('Error response from the Swipe API: <pre>'.print_r($responseArray,true).'</pre><br/><br/>'.
	     		'Url was: <pre>'.$url.'</pre><br/><br/>'.
	     		'Request Parameters were: <pre>'.print_r($data,true).'</pre>');
		}
		return $responseArray['data'];
	}

}

