<?php
defined('BASEPATH') OR exit('No direct script access allowed');


use Models\Wishlists\WishlistModel;

use Services\Wishlists\WishlistService;

class Welcome extends CI_Controller {
    //protected $customerService;

	public function index()
	{
		 $productService = new ProductService(new ProductModel());
		 echo "<pre>";
		 print_r($productService->getProducts());
		// echo $productService->getTable();
		$wish = new WishlistService(new WishlistModel());
		echo "<pre>";
		print_r($wish->getWishlistProducts());
        
	}
}
