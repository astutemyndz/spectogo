<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Common_Controller extends CI_Controller {

    protected $data         = array();
    protected $request      = array();
    protected $category     = '';
    protected $details      = '';
    protected $options      = array();
    protected $condition    = array();
    protected $slug         = '';
    protected $wishlist     = false;
    protected $joinWishlist = false;
    protected $join         = array();
    protected $joinCategory = true;
    protected $joinFrames   = true;
    protected $user         = array();
    protected $userId       = '';
    protected $primaryTable = '';


	function __construct() {
     	parent::__construct();
	}
    public function checkLogin(){
        if(!$this->session->userdata('UserId')){
            redirect(base_url('sign-in'));
        }
    }
    public function checkAdminLogin(){
        if(!$this->session->userdata('adminUserId')){
            redirect(base_url('admin'));
        }
    }
    public function getAdminDetails(){
        return $this->cm->get_specific('users', array("id" => $this->session->userdata('adminUserId'), "login_type" => 1));
    }
    public function commonFileUpload($path = '', $imageName = '', $imageInputName = '', $oldImage = ''){
        $pro_image = '';
        $upPath = FCPATH . $path;
        if (!file_exists($upPath)) {
            mkdir($upPath, 0777, true);
        }
        $config = array(
            'upload_path' => $upPath,
            'allowed_types' => "gif|jpg|png|jpeg|JPEG|JPG|GIF|PNG",
            'overwrite' => TRUE,
            'max_size' => "8192000",
            /*'max_height' => "1536",
            'max_width' => "2048",*/
            'encrypt_name' => TRUE
        );
        $config['file_name'] = time().$imageName;
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if ($this->upload->do_upload($imageInputName)) {
            $imageDetailArray = $this->upload->data();
            $pro_image = $imageDetailArray['file_name'];
            if($oldImage != ''){
                if (file_exists($upPath.$oldImage)) {
                    unlink($upPath.$oldImage);
                }
            }
        }else{
            $res = $this->upload->display_errors();
        }
        return $pro_image;
    }
    public function getBannerDetails(){
        $join[] = ['table' => 'categories c', 'on' => 'c.id = b.cat_id', 'type' => 'left'];
        return $this->cm->select('banners b', array("b.status" => 1, "c.status" => 1), 'b.id, b.image, b.cat_id, b.status, c.name cat_name', 'b.id', 'asc', $join);
    }
    public function getBrandDetails(){
        return $this->cm->get_specific('brands', array("status" => 1));
    }
    public function getFrameDetails(){
        return $this->cm->get_specific('frames', array("status" => 1));
    }
    public function getProductFeatures(){
        $opt['categories']  = $this->cm->get_all('categories');
        $opt['specs']       = $this->cm->get_all('specs');
        $opt['frames']      = $this->cm->get_all('frames');
        $opt['brands']      = $this->cm->get_all('brands');
        return $opt;
    }
    public function productLedger($prodId = '', $attributeId = '', $color = '', $transType = '', $quantity = '', $comment = ''){
        $insertArray = array(
            "product_id"        => $prodId,
            "attribute_id"      => $attributeId,
            "color"             => $color,
            "transaction_type"  => $transType,
            "quantity"          => $quantity,
            "comment"           => $comment
        );
        $this->cm->insert('product_ledger', $insertArray);
    }
    public function getProductDetails($id = ''){
        if($id != ''){
            $condition = array(
                "p.id" => $id
            );
        }else{
            $condition = array();
        }
        $join[] = ['table' => 'categories c', 'on' => 'c.id = p.cat_id', 'type' => 'left'];
        $join[] = ['table' => 'specs s', 'on' => 's.id = p.spec_id', 'type' => 'left'];
        $join[] = ['table' => 'frames f', 'on' => 'f.id = p.frame_id', 'type' => 'left'];
        $join[] = ['table' => 'brands b', 'on' => 'b.id = p.brand_id', 'type' => 'left'];
        $temp = $this->cm->select('products p', $condition, 'p.*, b.name brand_name, c.name cat_name, f.name frame_name, s.name spec_name, (select GROUP_CONCAT(pi.id) from product_images pi where pi.product_id = p.id) images_id, (select GROUP_CONCAT(pi.image) from product_images pi where pi.product_id = p.id) images', 'p.id', 'desc', $join); 
        return $temp;
    }

    public function setCategory($category) {
        $this->category = $category;
        return $this;
    }
    public function setDetails($details) {
        $this->details = $details;
        return $this;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setOptions($options) {
        $this->options = $options;
        return $this;
    }
    public function setWishlist($wishlist) {
        $this->wishlist = $wishlist;
        return $this;
    }
    public function setSlug($slug) {
        $this->slug = $slug;
        return $this;
    }
    public function setUser($user) {
        $this->user = $user;
        return $this;
    }
    public function getProductListDetails($options = null) {
       // $flag = false;
        $this->setOptions($options);
        $this->sql = '';
        $this->primaryTable = 'products p';
        $this->condition[] = array("p.status" => 1);

        if(isset($this->options) || !empty($this->options) || $this->options != null) {
           
            if(isset($this->options['category']) || !empty($this->options['category'])) {
                if(is_array($this->options) && in_array($this->options['category'], $this->options)) {
                    $this->setCategory($this->options['category']);
                } 
            }
            if(isset($this->options['details']) || !empty($this->options['details'])) {
                if(is_array($this->options) && in_array($this->options['details'], $this->options)) {
                    $this->setDetails($this->options['details']);
                }
            }
            if(isset($this->options['wishlist']) || !empty($this->options['wishlist'])) {
                if(is_array($this->options) && in_array($this->options['wishlist'], $this->options)) {
                    $this->setWishlist($this->options['wishlist']);
                }
            }
            if(isset($this->options['slug']) || !empty($this->options['slug'])) {
                if(is_array($this->options) && in_array($this->options['slug'], $this->options)) {
                    $this->setSlug($this->options['slug']);
                }
            }
            if(isset($this->options['user']) || !empty($this->options['user'])) {
                if(is_array($this->options) && in_array($this->options['user'], $this->options)) {
                    $this->setUser($this->options['user']);
                }
            }
            //Filter data by category

            if($this->category) {
                switch($this->category) {
                    case 'categories':
                        $this->joinCategory = true;
                        $this->condition[]  = array("c.name" => ucwords(strtolower(str_replace('_', ' ', $this->details))));
                        break;
                    case 'frames':
                        $this->joinFrames   = true;
                        $this->condition[]  = array("f.name" => ucwords(strtolower(str_replace('_', ' ', $this->details))));
                        break;
                    default:
                        $this->condition[] = array();
                        break;
                }
            }
           
             //Filter data by slug

            if($this->slug) {
                $this->condition[] = array("p.slug" => $this->options['slug']);
            }
            // echo "<pre>";
            // print_r($this->options);
            // exit;
            if($this->user) {
                if(is_array($this->user) && in_array($this->user['id'], $this->user)) {
                    $this->setUserId($this->user['id']);
                }
            }

            if($this->userId && $this->wishlist) {
                $this->condition[]  = array('wl.id_users' => $this->userId);
                $this->joinWishlist = true;
            }

        /** ########## Join tables start of code ########## */
            // Categories
            if($this->joinCategory) {
                $this->join[] = ['table' => 'categories c', 'on' => 'c.id = p.cat_id', 'type' => 'left'];
                $this->sql   .= ',c.name cat_name';
            }
            // Frames
            if($this->joinFrames) {
                $this->join[]     = ['table' => 'frames f', 'on' => 'f.id = p.frame_id', 'type' => 'left'];
                $this->sql .= ',f.name frame_name';
            }
            //Wishlists
            if($this->joinWishlist) {
                $this->join[]       = ['table' => 'wishlists wl', 'on' => 'wl.id_products = p.id', 'type' => 'left'];
                $this->sql         .= ',wl.id wishlistId';
            }
        /** ########## Join tables end of code ########## */
           
        } else {
            $this->join[] = ['table' => 'categories c', 'on' => 'c.id = p.cat_id', 'type' => 'left'];
            $this->sql   .= ',c.name cat_name';

            $this->join[] = ['table' => 'frames f', 'on' => 'f.id = p.frame_id', 'type' => 'left'];
            $this->sql   .= ',f.name frame_name';
        } 
        
        
        if(isset($this->condition) || !empty($this->condition) && is_array($this->condition)) {
            for($i = 0; $i < count($this->condition); $i++) {
                foreach($this->condition[$i] as $k => $v) {
                    $condition[$k] = $v;
                }
            }
        }
        $this->condition = $condition;
        $this->join[] = ['table' => 'specs s', 'on' => 's.id = p.spec_id', 'type' => 'left'];
        $this->join[] = ['table' => 'brands b', 'on' => 'b.id = p.brand_id', 'type' => 'left'];
        $this->join[] = ['table' => 'banners bn', 'on' => 'bn.cat_id = c.id', 'type' => 'left'];
        // echo "<pre>";
        // print_r($this->join);
        // exit;
        
        $this->sql .= ',p.id, p.name, p.slug, p.primary_image, p.description, p.arm, p.bridge, p.lens, p.height, p.sku, p.warranty, p.progressives, p.includes, p.single_vision, p.spring_hinge, p.suitable_for_tints';
        $this->sql .= ',b.name brand_name';
        $this->sql .= ',s.name spec_name';
        $this->sql .= ',bn.image banner_image';
        $this->sql .= ',(select GROUP_CONCAT(pa.color) from product_attribute pa where pa.product_id = p.id order by pa.id ASC) color';
        $this->sql .= ',(select GROUP_CONCAT(pa.color_name) from product_attribute pa where pa.product_id = p.id order by pa.id ASC) color_name';
        $this->sql .= ',(select GROUP_CONCAT(pa.price) from product_attribute pa where pa.product_id = p.id order by pa.id ASC) price';
        $this->sql .= ',(select GROUP_CONCAT(pa.sell_price) from product_attribute pa where pa.product_id = p.id order by pa.id ASC) sell_price';
        $this->sql .= ',(select GROUP_CONCAT(pa.discount) from product_attribute pa where pa.product_id = p.id order by pa.id ASC) discount';
        $this->sql .= ',(select GROUP_CONCAT(pa.stock) from product_attribute pa where pa.product_id = p.id order by pa.id ASC) stock';
        $this->sql .= ',(select GROUP_CONCAT(pi.image) from product_images pi where pi.product_id = p.id order by pi.id ASC) product_images';
       
        $productList = $this->cm->select($this->primaryTable, $this->condition, $this->sql, 'p.id', 'DESC', $this->join, $limit='', $offset=0, $group_by = '', $row = true);
        return $productList;
    }
    
    
    public function isAjaxRequest() {
        if ($this->input->is_ajax_request()) {
            return true;
        }
         return false;
    }
   

   

    public function isPost() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            return true;
        }
        return false;
    }

    public function setRequest(array $request) {
        if($this->isPost()) {
            foreach($request as $key => $value){
                $this->request[$key] = $this->input->post($key);
           }
        } else {
            $this->request = array();
        }
        return $this->request;
    }
    public function getRequest() {
        return $this->request;
    }


    
}
?>
