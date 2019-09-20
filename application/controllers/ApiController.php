<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Models\Distance\PupillaryDistanceModel;
use Services\Distance\PupillaryDistanceService;
use Illuminate\Http\Response;
class ApiController extends Common_Controller {

    private $listOfProduct = array();
    private $listOfLens = array();
    private $banners = array();
    private $chooseLense = false;
    private $productAdditionalImage = array();
    private $pupillaryDistanceService;
    private $pupillaryDistances;

    public function __construct() {
        parent::__construct();
        $this->pupillaryDistanceService = new PupillaryDistanceService(new PupillaryDistanceModel());
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
            $this->setResponse(new Response(
                array(
                    'data' => $this->banners,
                    'statusCode' => Response::HTTP_OK,
                    'message' => Response::$statusTexts[200],
                    'bannerImageUrl' => base_url().'assets/images/bannerImage/',
                ),
                Response::HTTP_OK,
                ['Content-Type', 'application/json']
            ));
            
        } else {
            $this->setResponse(new Response(
                array(
                    'data' => [],
                    'statusCode' => Response::HTTP_NOT_FOUND,
                    'message' => Response::$statusTexts[404],
                    'bannerImageUrl' => base_url().'assets/images/bannerImage/',
                ),
                Response::HTTP_OK,
                ['Content-Type', 'application/json']
            ));
        }
        $this->sendResponse();
        
    }
    /**
     * /PupillaryDistanceModel Api
     */
    public function distance() {
        $this->pupillaryDistances = (array) $this->pupillaryDistanceService->getPupillaryDistance();
        if(!empty($this->pupillaryDistances)) {
            $this->setResponse(new Response(
                array(
                    'data' => $this->pupillaryDistances,
                    'statusCode' => Response::HTTP_OK,
                    'message' => Response::$statusTexts[200],
                ),
                Response::HTTP_OK,
                ['Content-Type', 'application/json']
            ));
        } else {
            $this->setResponse(new Response(
                array(
                    'data' => [],
                    'statusCode' => Response::HTTP_NOT_FOUND,
                    'message' => Response::$statusTexts[404],
                    'bannerImageUrl' => base_url().'assets/images/bannerImage/',
                ),
                Response::HTTP_OK,
                ['Content-Type', 'application/json']
            ));
        }
       
        $this->sendResponse();
        
    }
    public function setChooseLense($chooseLense) {
        $this->chooseLense = $chooseLense;
        return $this;
    }
    /**
     * /products Api
     */
    public function products() {
        
      
        if(isLoggedIn()) {
            $this->setUser((array)$this->sessionVar['user']);
        }
        $this->setRequest($_REQUEST);

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
            $this->options[] =  array(
                'user' => $this->user
            );
        }
        $options = array();
        if(isset($this->options) || !empty($this->options) && is_array($this->options)) {
            for($i = 0; $i < count($this->options); $i++) {
                foreach($this->options[$i] as $k => $v) {
                    $options[$k] = $v;
                }
            }
        }
        $this->options = $options;

        // echo "<pre>";
        // print_r($this->options);
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

    public function filterProductImageByColor(){
        $this->setRequest($_REQUEST);

        if(isset($this->request['productId']) || !empty($this->request['productId'])) {
            if(is_array($this->request) && in_array($this->request['productId'], $this->request)) {
                $this->setProductId($this->request['productId']);
            } 
        }
        if(isset($this->request['hexColorCode']) || !empty($this->request['hexColorCode'])) {
            if(is_array($this->request) && in_array($this->request['hexColorCode'], $this->request)) {
                $this->setHexColorCode($this->request['hexColorCode']);
            } 
        }

        if(isset($this->request['chooseLense']) || !empty($this->request['chooseLense'])) {
            if(is_array($this->request) && in_array($this->request['chooseLense'], $this->request)) {
                $this->setChooseLense($this->request['chooseLense']);
            } 
        }

        if($this->productId) {
            $this->options[] = array(
                'productId' => $this->productId
            );
        }
        if($this->hexColorCode) {
            $this->options[] = array(
                'hexColorCode' => $this->hexColorCode
            );
        }

       
        $options = array();

        if(isset($this->options) || !empty($this->options) && is_array($this->options)) {
            for($i = 0; $i < count($this->options); $i++) {
                foreach($this->options[$i] as $k => $v) {
                    $options[$k] = $v;
                }
            }
        }
        $this->options = $options;


        if(isset($this->options) || !empty($this->options)) {
            $this->filterArray = $this->filterArray($options);
        } else {
            $this->filterArray = array();
        }

        if(!empty($this->filterArray) || isset($this->filterArray)) {
            foreach($this->filterArray as $arr) {
                $this->productAdditionalImage['images'] = explode(',', $arr['images']);
            }
        }

        if(!empty($this->productAdditionalImage) || isset($this->productAdditionalImage)) {
            $completeFilterArray = array();
            $completeFilterArray = array_merge($this->filterArray[0],$this->productAdditionalImage);
        }
       
        if($this->filterArray) {

            $this->response = new Response(
                array(
                    'data' => $completeFilterArray,
                    'statusCode' => Response::HTTP_OK,
                    'message' => Response::$statusTexts[200],
                    'imagePath' => base_url().'assets/images/productImage/'
                ),
                Response::HTTP_OK,
                ['Content-Type', 'application/json']
            );

            $sessionUserData = $this->session->userdata();
            if($this->chooseLense) {
                if(!empty($sessionUserData)|| isset($sessionUserData)) {
                    if(is_array($sessionUserData) && in_array('product', $sessionUserData)) {
                        $this->session->unset('product');
                    } else {
                        $this->session->set_userdata('product', array_merge(array('hexColorCode' => $this->hexColorCode), $completeFilterArray));
                    }
                }
            } else {
                $this->session->set_userdata('product', []);
            }
            
        } else {
            $this->response = new Response(
                array(
                    'data' => [],
                    'statusCode' => Response::HTTP_NOT_FOUND,
                    'message' => Response::$statusTexts[404],
                    'imagePath' => base_url().'assets/images/productImage/'
                ),
                Response::HTTP_OK,
                ['Content-Type', 'application/json']
            );
        }
        $this->response->send();

    }
    public function filterLensDetails(){
        $this->setRequest($_REQUEST);
        if(isset($this->request['lensCatId']) || !empty($this->request['lensCatId'])) {
            $this->setLensCatId($this->request['lensCatId']);
        }
        if(isset($this->request['lensSubCatId']) || !empty($this->request['lensSubCatId'])) {
            $this->setLensSubCatId($this->request['lensSubCatId']);
        }
        if($this->lensCatId) {
            $this->options[] = array(
                'lensCatId' => $this->lensCatId
            );
        } 
        if($this->lensSubCatId) {
            $this->options[] = array(
                'lensSubCatId' => $this->lensSubCatId
            );
        }
        $options = array();
        if(isset($this->options) || !empty($this->options) && is_array($this->options)) {
            for($i = 0; $i < count($this->options); $i++) {
                foreach($this->options[$i] as $k => $v) {
                    $options[$k] = $v;
                }
            }
        }
        $this->options = $options;
        if(isset($this->options) || !empty($this->options)) {
            $this->listOfLens = $this->filterLens($this->options);
        } else {
            $this->listOfLens = $this->filterLens();
        }
        //echo '<pre>';
        //print_r($this->listOfLens); die;
        if($this->listOfLens) {
            $this->response = new Response(
                array(
                    'data' => $this->listOfLens,
                    'statusCode' => Response::HTTP_OK,
                    'message' => Response::$statusTexts[200],
                    'subCatImageUrl' => base_url().'assets/images/lensSubCatImage/',
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
                ),
                Response::HTTP_OK,
                ['Content-Type', 'application/json']
            );
        }
        $this->response->send();
    }
    
}
?>
