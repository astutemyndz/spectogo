<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Models\Distance\PupillaryDistanceModel;
use Services\Distance\PupillaryDistanceService;
use Illuminate\Http\Response;
use Models\UploadHandler;
class ApiController extends Common_Controller {
    private $listOfProduct = array();
    private $listOfLens = array();
    private $banners = array();
    private $lens = array();
    private $lensTint = array();
    private $lensTintDetails = array();
    private $chooseLense = false;
    private $productAdditionalImage = array();
    private $pupillaryDistanceService;
    private $pupillaryDistances;
    protected $prescription = array();
    public function __construct() {
        parent::__construct();
        $this->pupillaryDistanceService = new PupillaryDistanceService(new PupillaryDistanceModel());
    }
    public function setAttachment($attachment)
    {
        $config = array(
            'upload_path' => "./uploads/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => TRUE,
            'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height' => "768",
            'max_width' => "1024"
            );
        $uploadPath = $config['upload_path'];
        
        $uid = '10'; //create separate folder for each user 
        $upPath = $uploadPath."/".$uid;
        if(!file_exists($upPath)) 
        {
            mkdir($upPath, 0777, true);
        }
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload($attachment))
        {
            $this->response['errors'] = $this->upload->display_errors();
        }
        else
        {
            $this->response['data'] = $this->upload->data();
        }

        return $this->response;
    }
    public function setBanners($banners) {
        $this->banners = $banners;
        return $this;
    }
    public function setLens($lens) {
        $this->lens = $lens;
        return $this;
    }
    public function setLensTint($lensTint) {
        $this->lensTint = $lensTint;
        return $this;
    }
    public function setLensTintDetails($lensTintDetails) {
        $this->lensTintDetails = $lensTintDetails;
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
     * /banners Api
     */
    public function lens() {
        $this->setLensTint($this->getLensTints());
        if(!empty($this->lensTint) && isset($this->lensTint)) {
            $this->setResponse(new Response(
                array(
                    'data' => $this->lensTint,
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
                ),
                Response::HTTP_OK,
                ['Content-Type', 'application/json']
            ));
        }
        $this->sendResponse();
        
    }
    public function onLoadLensTintsDetailsEventHandler() {
        
            $this->setRequest($_REQUEST);
            if(!empty($this->request) || isset($this->request)) 
            {
                if(!empty($this->request['lensId']) || isset($this->request['lensId'])) 
                {
                    $this->options['lensId'] = $this->request['lensId'];
                } 
                if(is_array($this->options) && array_key_exists('lensId', $this->options)) {
                    if(!empty($this->options['lensId']) || isset($this->options['lensId'])) {
                        $this->setLensTintDetails($this->getLensTintsDetails($this->options));
                        if(!empty($this->lensTintDetails) && isset($this->lensTintDetails)) {

                            $this->setResponse(new Response(
                                array(
                                    'data' => $this->lensTintDetails,
                                    'statusCode' => Response::HTTP_OK,
                                    'message' => Response::$statusTexts[200],
                                    'imageUrl' => base_url().'assets/images/lensesAndTintsImage/'
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
                                ),
                                Response::HTTP_OK,
                                ['Content-Type', 'application/json']
                            ));
                        }
                    } else {
                        $this->setResponse(new Response(
                            array(
                                'data' => [],
                                'statusCode' => Response::HTTP_NOT_FOUND,
                                'message' => 'lens id not found',
                            ),
                            Response::HTTP_OK,
                            ['Content-Type', 'application/json']
                        ));
                    }
                }
            }
            
        
        
        $this->sendResponse();
    }
    /**
     * @desc OnClick set Tint to product session
     */
    public function setLensTintToProduct(){
        $this->setRequest($_REQUEST);
        if(isset($this->request['id']) || !empty($this->request['id'])) {
            if(is_array($this->request) && in_array($this->request['id'], $this->request)) {
                $this->setLensTintDetailsId($this->request['id']);
            } 
        }
        $sessionUserData = $this->userdata();
        
        if($this->lensTintDetailsId) {
            $this->setLensTintDetails($this->getLensTintsDetails(array('id' => $this->lensTintDetailsId))[0]);

            if(!empty($sessionUserData)|| isset($sessionUserData)) {                
                if(is_array($sessionUserData) && array_key_exists('product', $sessionUserData)) { 
                    $this->setProduct($sessionUserData['product']); // previous session product wihtout lensCatId
                    if(!empty($this->product)){
                        $this->setSession('product', array_merge($this->getProduct(), array('lensTint' => $this->lensTintDetails)));
                        $flag = true;
                    }else{
                        $flag = false;
                    }
                    
                }
            }
            if($flag) {
                $this->setProduct($sessionUserData['product']); // new session product with lensCatId
                $this->response = new Response(
                    array(
                        'data' => $this->product,
                        'statusCode' => Response::HTTP_OK,
                        'message' => Response::$statusTexts[200],
                        
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
        } else {
            $this->response = new Response(
                array(
                    'data' => [],
                    'statusCode' => Response::HTTP_NOT_FOUND,
                    'message' => 'lens details id not set',
                ),
                Response::HTTP_OK,
                ['Content-Type', 'application/json']
            );
        }
        $this->response->send();
    }
    public function setPrescription() {
        $this->setRequest($_REQUEST);
            if(!empty($this->request) || isset($this->request)) 
            {
              
                $this->prescription = $this->request['prescription'];
                $sessionUserData = $this->userdata();
                if($this->prescription) {
                    if(!empty($sessionUserData)|| isset($sessionUserData)) {                
                        if(is_array($sessionUserData) && array_key_exists('product', $sessionUserData)) { 
                            $this->setProduct($sessionUserData['product']); // previous session product wihtout lensCatId
                            if(!empty($this->product)){
                                $this->setSession('product', array_merge($this->getProduct(), array('prescription' => $this->prescription)));
                                $flag = true;
                            }else{
                                $flag = false;
                            }
                        }
                    }
                    if($flag) {
                        $this->setProduct($sessionUserData['product']); // new session product with lensCatId
                        $this->response = new Response(
                            array(
                                'data' => $this->product,
                                'statusCode' => Response::HTTP_OK,
                                'message' => Response::$statusTexts[200]
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
                } else {
                    $this->response = new Response(
                        array(
                            'data' => [],
                            'statusCode' => Response::HTTP_NOT_FOUND,
                            'message' => 'lens cat id not set',
                        ),
                        Response::HTTP_OK,
                        ['Content-Type', 'application/json']
                    );
                }
                
            }
            $this->response->send();
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
        if(isset($this->request['brandId']) || !empty($this->request['brandId'])) {
            $this->setBrandId($this->request['brandId']);
        }
        if(isset($this->request['frameName']) || !empty($this->request['frameName'])) {
            $this->setFrameName($this->request['frameName']);
        }
        if(isset($this->request['category']) || !empty($this->request['category'])) {
            $this->setCategory($this->request['category']);
        } 
        if(isset($this->request['details']) || !empty($this->request['details'])) {
            $this->setDetails($this->request['details']);
        }
        // $this->setCategory($this->uri->segment(2));
        // $this->setDetails($this->uri->segment(3));

        if(isset($this->request['categoryName']) || !empty($this->request['categoryName'])) {
            $this->setCategoryName($this->request['categoryName']);
        }
        if(isset($this->request['wishlist']) || !empty($this->request['wishlist'])) {
            $this->setWishlist($this->request['wishlist']);
        } else {
            $this->setWishlist(false);
        }
        // if(isset($this->request['user']) || !empty($this->request['user'])) {
        //    $this->setUser($this->request['user']);
        // }
        if($this->brandId) {
            $this->options[] = array(
                'brandId' => $this->brandId
            );
        }
        if($this->frameName) {
            $this->options[] = array(
                'frameName' => $this->frameName
            );
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
        //print_r($this->options); die;
        if(!empty($this->options)) {
            $this->getProductListDetails($this->options);
            // echo '<pre>';
            // print_r($this->product); die;
            $this->listOfProduct = $this->getProduct();
            //$this->listOfProduct = $this->getProductListDetails($this->options);
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
        // echo "<pre>";
        // print_r($this->filterArray);
        // exit;
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
                        $this->session->set_userdata('product', array_merge(array('productAttributeColorCode' => $this->hexColorCode), $completeFilterArray));
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

    public function attachmentUploadHandler() {
        $this->options = array(
            'upload_dir' => FCPATH.'assets/images/attachments/',
            'upload_url' => base_url().'assets/images/attachments/',
        );
        $upload_handler = new UploadHandler($this->options);
    }

    public function onLoadPreviewEventHandler() {
        $this->setProduct($this->getSession('product'));
        if($this->product) {
            $this->response = new Response(
                array(
                    'data' => $this->product,
                    'statusCode' => Response::HTTP_OK,
                    'message' => Response::$statusTexts[200],
                    'productImagePath' => base_url().'assets/images/productImage/'
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
