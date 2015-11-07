<?php

/**
 * A Product is a pre-registered sale item with Swipe. When a user clicks to buy an
 * item you can pass the product id to the Payment Page and the details of the product
 * will show up. An alternative to Products is Ad-hoc Transactions.
 *
 * Note: this class has been cut down in functionality for simplicity, it does not support
 * multiple currencies or advanced redirect urls. For these advanced functions, see:
 * 	merchant.swipehq.com/admin/main/index.php?module=developers&action=product-apis
 */
class SwipeProduct {

	protected $id;
	protected $name;
	protected $description;
	protected $salePrice;

	protected $recommendedSalePrice;
	protected $minimumQuantity;
	protected $paymentCompleteUrl;


	public function __construct($id = null, $name, $description = null, $salePrice){
		$this->id = $id;
		$this->name = $name;
		$this->description = $description;
		$this->salePrice = $salePrice;

		$this->recommendedSalePrice = $salePrice;
		$this->minimumQuantity = 1;
	}




	public function getId(){
		return $this->id;
	}

	public function getName(){
		return $this->name;
	}

	public function getDescription(){
		return $this->description;
	}

	public function getMinimumQuantity(){
		return $this->minimumQuantity;
	}

	public function getSalePrice(){
		return $this->salePrice;
	}

	public function getRecommendedSalePrice(){
		return $this->recommendedSalePrice;
	}

	public function getPaymentCompleteUrl(){
		return $this->paymentCompleteUrl;
	}



	public function setId($id){
		$this->id = $id;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function setDescription($description){
		$this->description = $description;
	}

	public function setMinimumQuantity($minimumQuantity){
		$this->minimumQuantity = $minimumQuantity;
	}

	public function setSalePrice($salePrice){
		$this->salePrice = $salePrice;
	}

	public function setRecommendedSalePrice($recommendedSalePrice){
		$this->recommendedSalePrice = $recommendedSalePrice;;
	}

	public function setPaymentCompleteUrl($url){
		$this->paymentCompleteUrl = $url;
	}

}
