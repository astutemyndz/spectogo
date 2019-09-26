<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Models\Wishlists\WishlistModel;
use Services\Wishlists\WishlistService;
use Illuminate\Http\Response;
class WishlistController extends Common_Controller {
    protected $wishlistService;
    public function __construct(){
        parent::__construct();
        $this->wishlistService = new WishlistService(new WishlistModel());
    }
    // List of wishlist start of code
    public function index(){

        $data['banners'] = $this->getBannerDetails();
        $data['partner'] = $this->getBrandDetails();
        $data['frames'] = $this->getFrameDetails();
        $data['webManage'] = $this->getContactDetails();
        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/pages/wishlist');
        $this->load->view('frontend/layout/footer');
        // $wishlistProducts = $this->getProductListDetails(['user' => array('id' => 3)], true);
        // if(count($wishlistProducts) > 0) {
        //     $response = new Response(
        //         array(
        //             'data' => $wishlistProducts,
        //             'bannerImageUrl' => base_url().'assets/images/bannerImage/',
        //             'productImageUrl' => base_url().'assets/images/productImage/',
        //             'statusCode' => Response::HTTP_OK,
        //             'message' => Response::HTTP_OK
        //         ),
        //         Response::HTTP_OK,
        //         ['Content-Type', 'application/json']
        //     );
        //     $response->send();

        // } else {
        //     $response = new Response(
        //         array(
        //             'data' => [],
        //             'bannerImageUrl' => '',
        //             'productImageUrl' => '',
        //             'statusCode' => Response::HTTP_NOT_FOUND,
        //             'message' => 'No wishlist found!'
        //         ),
        //         Response::HTTP_NOT_FOUND,
        //         ['Content-Type', 'application/json']
        //     );
        //     $response->send();
        // }
    }
    public function save(){
        if($this->isPost()) {
            if(!$this->isLoggedIn()) {
                $this->setResponse(new Response(
                    array(
                        'data' => [],
                        'statusCode' => Response::HTTP_UNAUTHORIZED,
                        'message' => Response::$statusTexts[401]
                    ),
                    Response::HTTP_OK,
                    ['Content-Type', 'application/json']
                ));
            }  else {
                $this->setRequest($_POST);
                if($this->wishlistService->addProductToWishlist($this->request)) {
                    $this->setResponse(new Response(
                        array(
                            'data' => [
                                'lastInsertId' => $this->wishlistService->getLastInsertId()
                            ],
                            'statusCode' => Response::HTTP_CREATED,
                            'message' => 'Added to your wishlist'
                        ),
                        Response::HTTP_OK,
                        ['Content-Type', 'application/json']
                    ));
    
                } else {
                    $this->setResponse(new Response(
                        array(
                            'data' => [
                                'lastInsertId' => null
                            ],
                            'statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR,
                            'message' => Response::$statusTexts[500]
                        ),
                        Response::HTTP_OK,
                        ['Content-Type', 'application/json']
                    ));
                }
            }
        } else {
            $this->sentResponse(new Response(
                array(
                    'data' => [
                        'lastInsertId' => null
                    ],
                    'statusCode' => Response::HTTP_METHOD_NOT_ALLOWED,
                    'message' => Response::$statusTexts[405]
                ),
                Response::HTTP_OK,
                ['Content-Type', 'application/json']
            ));
            
        }
        $this->sendResponse();
    }
    public function remove(){
        if($this->isPost()) {
            $this->setRequest($_POST);
            $this->condition = array('id' => $this->request['wishlistId']);
            if($this->wishlistService->removeProductFromWishlistById($this->condition)) {
                $this->setResponse(new Response(
                    array(
                        'data' => [],
                        'statusCode' => Response::HTTP_OK,
                        'message' => 'removed product from your wishlist'
                    ),
                    Response::HTTP_OK,
                    ['Content-Type', 'application/json']
                ));
    
            } else {
                    $this->setResponse(new Response(
                        array(
                            'data' => [],
                            'statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR,
                            'message' => Response::$statusTexts[500]
                        ),
                        Response::HTTP_OK,
                        ['Content-Type', 'application/json']
                    ));
            }
        } else {
            $this->setResponse(new Response(
                array(
                    'data' => [
                        'lastInsertId' => null
                    ],
                    'statusCode' => Response::HTTP_METHOD_NOT_ALLOWED,
                    'message' => Response::$statusTexts[405]
                ),
                Response::HTTP_OK,
                ['Content-Type', 'application/json']
            ));
            
        }
        $this->sendResponse();
    }
}
