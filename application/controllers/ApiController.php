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
        } else {
            $this->setWishlist(false);
        }

        if(isset($this->request['user']) || !empty($this->request['user'])) {
           $this->setUser($this->request['user']);
        } 

        if($this->category) {
            $this->options[] = array(
                'category' => $this->category
            );
        }
        if($this->details) {
            $this->options[] = array(
                'details' => $this->details
            );
        }
        if($this->categoryName) {
            $this->options[] = array(
                'categoryName' => $this->categoryName
            );
        }
        if($this->categoryId) {
            $this->options[] = array(
                'categoryId' => $this->categoryId
            );
        }
        if($this->wishlist) {
            $this->options[] = array(
                'wishlist' => $this->wishlist
            );
        }

        if($this->user) {
            $this->options[] = $this->user;
        }
        if(isset($this->options) || !empty($this->options) && is_array($this->options)) {
            for($i = 0; $i < count($this->options); $i++) {
                foreach($this->options[$i] as $k => $v) {
                    $options[$k] = $v;
                }
            }
        }
        $this->options = $options;


        if(isset($this->options) || !empty($this->options)) {
            $this->listOfProduct = $this->getProductListDetails($this->options);
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
