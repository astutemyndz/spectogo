<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Http\Response;
class Product extends Common_Controller {
    private $listOfProduct = array();
    public function __construct() {
        parent::__construct();
    }
    public function banners() {
        $response = new Response(
            array(
                'data' => $this->getBanners(),
                'statusCode' => Response::HTTP_OK,
                'message' => Response::$statusTexts[200],
                'bannerImageUrl' => base_url().'assets/images/bannerImage/',
            ),
            Response::HTTP_OK,
            ['Content-Type', 'application/json']
        );
        $response->send();
    }
    public function products() {
        $this->setRequest($_POST);
        if(isset($this->request['category']) || !empty($this->request['category'])) {
            $this->setCategory($this->request['category']);
        } 
        if(isset($this->request['details']) || !empty($this->request['details'])) {
            $this->setDetails($this->request['details']);
        }
        if($this->category && $this->details) {
            $this->listOfProduct = $this->getProductListDetails(array('category' => $this->category, 'details'=> $this->details));
        } else {
            $this->listOfProduct = $this->getProductListDetails();
        }
        if($this->listOfProduct) {
            $response = new Response(
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
            $response->send();
        }
    }
    public function index($category = '', $details = '') {
        if($category != '' && $details != ''){
            $data['banners'] = $this->getBannerDetails();
            $data['partner'] = $this->getBrandDetails();
            $data['frames'] = $this->getFrameDetails();
            $data['webManage'] = $this->getContactDetails();
            $data['product'] = $this->getProductListDetails(array('category' => $category, 'details'=> $details));
        }else{
            redirect(base_url());
        }
        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/pages/product');
        $this->load->view('frontend/layout/footer');
    }
    public function getProductCategoryWise($slug) {
        $this->setCategoryName($slug);
        $data['banners'] = $this->getBannerDetails();
        $data['webManage'] = $this->getContactDetails();
        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/pages/product');
        $this->load->view('frontend/layout/footer');
    }
    public function filterProduct() {
        $this->listOfProduct = $this->getProductListDetails(array('categoryName' => $this->getCategoryName()));
        $response = new Response(
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
       $response->send();
    }
    public function productDetails(){
        if(isLoggedIn()) {
            $this->setUser((array)$this->sessionVar['user']);
        }
        $this->setCategory($this->uri->segment(2));
        $this->setDetails($this->uri->segment(3));
        $this->setSlug($this->uri->segment(4));
        $this->request = array('category' => $this->category, 'details' => $this->details, 'slug' => $this->slug);
        $this->setRequest($this->request);
        if(isset($this->request['wishlist']) || !empty($this->request['wishlist'])) {
            $this->setWishlist($this->request['wishlist']);
        } else {
            $this->setWishlist(false);
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
        if($this->slug) {
            $this->options[] = array(
                'slug' => $this->slug
            );
        }
        if($this->wishlist) {
            $this->options[] = array(
                'wishlist' => $this->wishlist
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
            $this->listOfProduct = $this->getProductListDetails($this->options);
        } else {
            $this->listOfProduct = $this->getProductListDetails();
        }

        if($this->listOfProduct) {
            $this->data['product'] = $this->listOfProduct;
        } else {
            $this->data['product'] = array();
        }
        $this->data['banners'] = $this->getBannerDetails();
        $this->data['partner'] = $this->getBrandDetails();
        $this->data['frames'] = $this->getFrameDetails();
        $this->data['webManage'] = $this->getContactDetails();
        // echo '<pre>';
        // print_r($this->data['product']); die;
        $this->load->view('frontend/layout/header', $this->data);
        $this->load->view('frontend/pages/product-details');
        $this->load->view('frontend/layout/footer');
    }
    public function setColor(){
        $join = array();
        $res = $this->cm->select('product_attribute pa', array("pa.product_id" => $this->input->post('prod_id'), "pa.color" => $this->input->post('color_hex')), 'pa.price, pa.sell_price, pa.discount, pa.stock, (select GROUP_CONCAT(pi.image) from product_images pi where pi.product_id = pa.product_id AND pi.color = pa.color order by pi.id ASC) images', 'pa.id', 'asc', $join);
        $this->session->set_userdata('choosenColor', $this->input->post('color_hex'));
        print json_encode($res);
    }
    public function chooseYourLens(){
        $this->data['webManage'] = $this->getContactDetails();
        $this->load->view('frontend/layout/header', $this->data);
        $this->load->view('frontend/pages/choose-your-lens');
        $this->load->view('frontend/layout/footer');
        
    }
    public function setLensForProduct(){
        $this->setRequest($_REQUEST);
        if(isset($this->request['lensSubCatId']) || !empty($this->request['lensSubCatId'])) {
            if(is_array($this->request) && in_array($this->request['lensSubCatId'], $this->request)) {
                $this->setLensSubCatId($this->request['lensSubCatId']);
            } 
        }
        $lens = array(
            "lensSubCatId" => $this->lensSubCatId
        );
        $sessionUserData = $this->session->userdata();
        if($this->lensSubCatId) {
            if(!empty($sessionUserData)|| isset($sessionUserData)) {                
                if(is_array($sessionUserData) && array_key_exists('product', $sessionUserData)) { 
                    $this->setProduct($sessionUserData['product']); // previous session product wihtout lensCatId
                    if(!empty($this->product)){
                        $this->session->set_userdata('product', array_merge($this->getProduct(), $lens));
                        $flag = true;
                    }else{
                        $flag = false;
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
                }
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
        $this->response->send();
    }

    public function preview() {
        $this->load->view('frontend/layout/header');
        $this->load->view('frontend/pages/preview');
        $this->load->view('frontend/layout/footer');
    }
    
    
    
    
    public function asd(){
        /*$join[] = ['table' => 'categories c', 'on' => 'c.id = p.cat_id', 'type' => 'left'];
        $join[] = ['table' => 'specs s', 'on' => 's.id = p.spec_id', 'type' => 'left'];
        $join[] = ['table' => 'frames f', 'on' => 'f.id = p.frame_id', 'type' => 'left'];
        $join[] = ['table' => 'brands b', 'on' => 'b.id = p.brand_id', 'type' => 'left'];
        $data['products'] = $this->cm->select('products p', $condition, 'p.*, b.name brand_name, c.name cat_name, f.name frame_name, s.name spec_name, (select GROUP_CONCAT(pi.image) from product_images pi where pi.product_id = p.id) images', 'p.id', 'desc', $join);    */
            
        /*$sql = "
        select p.id, p.name, p.primary_image, b.name brand_name, c.name cat_name, f.name frame_name, s.name spec_name,
        
        (select GROUP_CONCAT(pa.id) from product_attribute pa where pa.product_id = p.id) attribute_id,
        
        (select GROUP_CONCAT(pa.color) from product_attribute pa where pa.product_id = p.id) color,
        
        (select GROUP_CONCAT(pa.color_name) from product_attribute pa where pa.product_id = p.id) color_name,
        
        (select GROUP_CONCAT(pa.price) from product_attribute pa where pa.product_id = p.id) price,
        
        (select GROUP_CONCAT(pa.sell_price) from product_attribute pa where pa.product_id = p.id) sell_price,
        
        (select GROUP_CONCAT(pa.discount) from product_attribute pa where pa.product_id = p.id) discount,
        
        (select GROUP_CONCAT(pa.stock) from product_attribute pa where pa.product_id = p.id) stock
        
        from products p 
        
        LEFT JOIN categories c ON c.id = p.cat_id 
        
        LEFT JOIN specs s ON s.id = p.spec_id 
        
        LEFT JOIN frames f ON f.id = p.frame_id 
        
        LEFT JOIN brands b ON b.id = p.brand_id 
        
         
        
        ORDER BY p.id DESC"; */
    }
}
?>
