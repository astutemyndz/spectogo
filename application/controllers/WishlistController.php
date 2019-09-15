<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
                    'message' => Response::HTTP_OK
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
                    'message' => 'No wishlist found!'
                ),
                Response::HTTP_NOT_FOUND,
                ['Content-Type', 'application/json']
            );
            $response->send();
        }
       
       
    }
    public function save()
    {
        if($this->isPost()) {
            $this->setRequest($_POST);
            if(!empty($this->request['id_users'])) {
                if($this->wishlistService->addProductToWishlist($this->request)) {
                    $response = new Response(
                        array(
                            'data' => [
                                'lastInsertId' => $this->wishlistService->getLastInsertId()
                            ],
                            'statusCode' => Response::HTTP_CREATED,
                            'message' => 'Added to your wishlist'
                        ),
                        Response::HTTP_OK,
                        ['Content-Type', 'application/json']
                    );
                    $response->send();
    
                } else {
                   
                    $response = new Response(
                        array(
                            'data' => [
                                'lastInsertId' => null
                            ],
                            'statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR,
                            'message' => Response::$statusTexts[500]
                        ),
                        Response::HTTP_OK,
                        ['Content-Type', 'application/json']
                    );
                    $response->send();
                }
            } else {
                $response = new Response(
                    array(
                        'data' => [
                            'lastInsertId' => null
                        ],
                        'statusCode' => Response::HTTP_UNAUTHORIZED,
                        'message' => Response::$statusTexts[401]
                    ),
                    Response::HTTP_OK,
                    ['Content-Type', 'application/json']
                );
                $response->send();
            }
            
            
        } else {
            $response = new Response(
                array(
                    'data' => [
                        'lastInsertId' => null
                    ],
                    'statusCode' => Response::HTTP_METHOD_NOT_ALLOWED,
                    'message' => Response::$statusTexts[405]
                ),
                Response::HTTP_OK,
                ['Content-Type', 'application/json']
            );
            $response->send();
        }
        
    }
        
}
  
	
    


