<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Http\Response;
class ApiController extends Common_Controller {

    private $listOfProduct = array();
    private $banners = array();
    private $response;

    public function __construct() {
        parent::__construct();
    }

    public function setBanners($banners) {
        $this->banners = $banners;
        return $this;
    }

    /**
     * /banners Api
     */
    public function banners() {
        $this->setBanners($this->getBanners());
        if(!empty($this->banners) && isset($this->banners)) {
            $this->response = new Response(
                array(
                    'data' => $this->banners,
                    'statusCode' => Response::HTTP_OK,
                    'message' => Response::$statusTexts[200],
                    'bannerImageUrl' => base_url().'assets/images/bannerImage/',
                ),
                Response::HTTP_OK,
                ['Content-Type', 'application/json']
            );
            
        } else {
            $this->response = new Response(
                array(
                    'data' => [],
                    'statusCode' => Response::HTTP_NOT_FOUND,
                    'message' => Response::$statusTexts[404],
                    'bannerImageUrl' => base_url().'assets/images/bannerImage/',
                ),
                Response::HTTP_OK,
                ['Content-Type', 'application/json']
            );
        }
        $this->response->send();
        
    }
    /**
     * /products Api
     */
    public function products() {
        /**
         * Only for post request
         */
        $this->setRequest($_REQUEST);
        // print_r($this->getRequest());
        // exit;
        if(isset($this->request['category']) || !empty($this->request['category'])) {
            $this->setCategory($this->request['category']);
        } 
       
        if(isset($this->request['details']) || !empty($this->request['details'])) {
            $this->setDetails($this->request['details']);
        } 
        if(isset($this->request['categoryName']) || !empty($this->request['categoryName'])) {
            $this->setCategoryName($this->request['categoryName']);
        } 
        if(isset($this->request['wishlist']) || !empty($this->request['wishlist'])) {
            $this->setWishlist($this->request['wishlist']);
        } 
        
        if($this->category && $this->details) {
            $this->listOfProduct = $this->getProductListDetails(array('category' => $this->category, 'details'=> $this->details));
        } elseif($this->category) {
            $this->listOfProduct = $this->getProductListDetails(array('categoryId' => $this->category));
        } elseif($this->categoryName) {
            $this->listOfProduct = $this->getProductListDetails(array('categoryName' => $this->getCategoryName(), 'wishlist' => $this->wishlist));
        } else {
            $this->listOfProduct = $this->getProductListDetails();
        }
        
        if($this->listOfProduct) {
            $this->response = new Response(
                array(
                    'data' => $this->listOfProduct,
                    'statusCode' => Response::HTTP_OK,
                    'message' => Response::$statusTexts[200],
                    'bannerImageUrl' => base_url().'assets/images/bannerImage/',
                    'productImageUrl' => base_url().'assets/images/productImage/',
                ),
                Response::HTTP_OK,
                ['Content-Type', 'application/json']
            );
            
        } else {
            $this->response = new Response(
                array(
                    'data' => [],
                    'statusCode' => Response::HTTP_NOT_FOUND,
                    'message' => Response::$statusTexts[404],
                    'bannerImageUrl' => base_url().'assets/images/bannerImage/',
                    'productImageUrl' => base_url().'assets/images/productImage/',
                ),
                Response::HTTP_OK,
                ['Content-Type', 'application/json']
            );
        }
        $this->response->send();
    }
    
}
?>
