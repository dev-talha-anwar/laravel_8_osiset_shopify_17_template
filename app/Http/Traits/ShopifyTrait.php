<?php
namespace App\Http\Traits;

use App\Http\Traits\ShopifyApiTrait;
use App\Models\Country;
use App\Models\StoreProduct;
use Illuminate\Support\Facades\Request;

trait ShopifyTrait {

	use ShopifyApiTrait;

	public function shopApi($shop = null)
	{
		$this->shop($shop);
		return $this->api_request('GET', "getShopProperties");
	}

	public function getProducts($params = null,$shop = null){
		$this->shop($shop);
		return $this->api_request('GET', "getAllProducts",null , $params);
	}

	public function getAllWebhooks($params = null,$shop = null){
		$this->shop($shop);
		return $this->api_request('GET', "getAllWebhooks",null , $params);
	}

}