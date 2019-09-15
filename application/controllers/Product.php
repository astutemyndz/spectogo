<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Http\Response;
class Product extends Common_Controller {

    private $listOfProduct = array();
    public function __construct() {
        parent::__construct();
       
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
        // echo "<pre>";
        // print_r($this->listOfProduct);
        
        if($this->listOfProduct) {
            $response = new Response(
                array(
                    'data' => $this->listOfProduct,
                    'statusCode' => Response::HTTP_OK,
                    'message' => Response::$statusTexts[200]
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
            $data['product'] = $this->getProductListDetails(array('category' => $category, 'details'=> $details));
            $this->load->view('frontend/layout/header', $data);
            $this->load->view('frontend/pages/product');
            $this->load->view('frontend/layout/footer');
        }else{
            redirect(base_url());
        }
    }
    public function productDetails($slug = ''){
        $data['banners'] = $this->getBannerDetails();
        $data['partner'] = $this->getBrandDetails();
        $data['frames'] = $this->getFrameDetails();
        $data['product'] = $this->getProductListDetails(array('slug' => $slug));
        // echo '<pre>';
        // print_r($data['product']); die;
        $this->session->set_userdata('choosenProduct', $data['product'][0]['id']);
        $this->session->set_userdata('choosenColor', explode(',', $data['product'][0]['color'])[0]);
        $this->load->view('frontend/layout/header', $data);
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
        if(!$this->session->userdata('choosenProduct') && !$this->session->userdata('choosenColor')){
            redirect(base_url());
        }else{
            
            echo $this->session->userdata('choosenProduct'). ' '.$this->session->userdata('choosenColor'); die;
            
            $this->load->view('frontend/layout/header');
            $this->load->view('frontend/pages/choose-your-lens');
            $this->load->view('frontend/layout/footer');
        }
        
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
