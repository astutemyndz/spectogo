<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//use Contracts\Wishlists\WishlistInterface;
use Models\Wishlists\WishlistModel;
use Services\Wishlists\WishlistService;
use Illuminate\Http\Response;

class WishlistController extends Common_Controller {
    protected $wishlistService;

    public function __construct()
    {
        parent::__construct();
        $this->wishlistService = new WishlistService(new WishlistModel());
    }
    // List of wishlist start of code
    public function index()
    {
        $wishlistProducts = $this->getProductListDetails(['user' => array('id' => 3)], true);
        if(count($wishlistProducts) > 0) {
            $response = new Response(
                array(
                    'data' => $wishlistProducts,
                    'bannerImageUrl' => base_url().'assets/images/bannerImage/',
                    'productImageUrl' => base_url().'assets/images/productImage/',
                    'statusCode' => Response::HTTP_OK,
                    'message' => ''
                ),
                Response::HTTP_OK,
                ['Content-Type', 'application/json']
            );
            $response->send();
        } else {
            $response = new Response(
                array(
                    'data' => [],
                    'bannerImageUrl' => '',
                    'productImageUrl' => '',
                    'statusCode' => Response::HTTP_NOT_FOUND,
                    'message' => 'No wishlist found !!!'
                ),
                Response::HTTP_NOT_FOUND,
                ['Content-Type', 'application/json']
            );
            $response->send();
        }
       
       
    }
    public function save(array $data)
    {
        if($this->isAjaxRequest()) {
            $this->setRequest($this->input->post());
            if($this->wishlistService->addProductToWishlist($this->getRequest())) {
                return response()->json([

                ], 200);
            }
        }
        
    }
    public function remove($id)
    {
        
    }
   
    public function destroy()
    {
        
    }
	
    

}
