<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Common_Controller extends CI_Controller {

    protected $data         = array();
    protected $product         = array();
    protected $request      = array();
    protected $response      = array();
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
    protected $joinProduct  = false;
    protected $joinLens     = false;
    protected $user         = array();
    protected $userId;
    protected $primaryTable = '';
    protected $secondaryTable = '';
    protected $categoryId;
    protected $categoryName;

    protected $productId;
    protected $hexColorCode;
    protected $resultArray;
    protected $filterArray;

    protected $lensCatId;
    protected $lensSubCatId;

    public $sessionVar;

	function __construct() {
         parent::__construct();
         $this->userdata();
    }
    public function setProduct($product) {
        $this->product = $product;
        return $this;
    }
    public function getProduct() {
        return $this->product;
    }
    public function setResponse($response) {
        $this->response = $response;
        return $this;
    }
    public function getResponse() {
        return $this->response;
    }

    public function sendResponse() {
        $this->response->send();
    }
    public function setProductId($productId) {
        $this->productId = $productId;
        return $this;
    }
    public function getProductId() {
        return $this->productId;
    }
    public function setHexColorCode($hexColorCode) {
        $this->hexColorCode = $hexColorCode;
        return $this;
    }
    public function getHexColorCode() {
        return $this->hexColorCode;
    }
    
    

    
    public function setLensCatId($lensCatId) {
        $this->lensCatId = $lensCatId;
        return $this;
    }
    public function getLensCatId() {
        return $this->lensCatId;
    }
    public function setLensSubCatId($lensSubCatId) {
        $this->lensSubCatId = $lensSubCatId;
        return $this;
    }
    public function getLensSubCatId() {
        return $this->lensSubCatId;
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
    public function commonFileArrayUpload($path = '', $fileArray = array(), $db = '', $oldArray = array()){
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
        for($p = 0; $p<count($fileArray['name']); $p++){
            $newArray = $oldArray;
            if($fileArray['name'][$p] !='' ){
                $_FILES['file']['name']     = $fileArray['name'][$p];
                $_FILES['file']['type']     = $fileArray['type'][$p];
                $_FILES['file']['tmp_name'] = $fileArray['tmp_name'][$p];
                $_FILES['file']['error']    = $fileArray['error'][$p];
                $_FILES['file']['size']     = $fileArray['size'][$p];
                $config['file_name']        = time().$fileArray['name'][$p];
                $this->upload->initialize($config);
                if($this->upload->do_upload('file')){
                    $imageDetailArray = $this->upload->data();
                    $newArray['image'] = $imageDetailArray['file_name'];
                    $this->cm->insert($db, $newArray);
                }
            }
        }
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
    public function getLensDetails($condition = array()){
        $join[] = ['table' => 'lens_category lc', 'on' => 'lc.id = lsc.lens_cat_id', 'type' => 'left'];
        return $this->cm->select('lens_sub_category lsc', $condition, 'lsc.id, lsc.lens_cat_id, lc.name lens_cat_name, lsc.name lens_sub_cat_name, lsc.description, lsc.image, lsc.status', 'lsc.id', 'asc', $join);
    }
    public function getLensAndTints($condition = array()){
        $join[] = ['table' => 'lenses_and_tints lat', 'on' => 'lat.id = latd.lenses_and_tints_id', 'type' => 'left'];
        return $this->cm->select('lenses_and_tints_details latd', $condition, 'latd.id, latd.lenses_and_tints_id, lat.name lensandtint_cat_name, latd.name lensandtint_sub_cat_name, latd.description, latd.image, latd.status, latd.includes, latd.price', 'latd.id', 'asc', $join);
    }
    public function getreglaze($condition = array()){
        $join[] = ['table' => 'frames f', 'on' => 'f.id = r.frame_id', 'type' => 'left'];
        return $this->cm->select('reglaze r', $condition, 'r.id, r.frame_id, f.name frame_name, r.image, r.price, r.status', 'r.id', 'asc', $join);
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
    public function getUser() {
        return $this->user;
    }
    public function setUserId($userId) {
        $this->userId = $userId;
        return $this;
    }
    public function getUserId() {
        return $this->userId;
    }
    public function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;
        return $this;
    }
    public function getCategoryId() {
        return $this->categoryId;
    }
    public function setCategoryName($categoryName) {
        $this->categoryName = $categoryName;
        return $this;
    }
    public function getCategoryName() {
        return $this->categoryName;
    }
    public function getBanners($options = null) {
        $this->primaryTable = "banners t1";
        $this->secondaryTable = "categories t2";
        $this->condition = array("t1.status" => 1);
        $this->sql = "";
        $this->join[] = ["table" => 'categories t2', "on" => "t1.cat_id = t2.id", "type" => "left"];
        
        $this->sql   .= ",t1.id as bannerId, t1.image bannerImage";
        $this->sql   .= ",t2.id as categoryId, t2.name as categoryName";
        return $this->cm->select($this->primaryTable, $this->condition, $this->sql, "t1.id", "DESC", $this->join, $limit = "", $offset = 0, $group_by = "", $row = true);
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
            if(isset($this->options['categoryId']) || !empty($this->options['categoryId'])) {
                if(is_array($this->options) && in_array($this->options['categoryId'], $this->options)) {
                    $this->setCategoryId($this->options['categoryId']);
                } 
            }
            if(isset($this->options['categoryName']) || !empty($this->options['categoryName'])) {
                if(is_array($this->options) && in_array($this->options['categoryName'], $this->options)) {
                    $this->setCategoryName($this->options['categoryName']);
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

            if($this->categoryId) {
                $this->joinCategory = true;
                $this->condition[]  = array("c.id" => $this->categoryId);
            }

            if($this->categoryName) {
               // echo $this->categoryName;
                $this->joinCategory = true;
                $this->condition[]  = array("c.name LIKE" => "$this->categoryName%");
            }
           
             //Filter data by slug
          
            if($this->slug) {
                $this->condition[] = array("p.slug" => $this->options['slug']);
            }
            
            if($this->user) {
                if(is_array($this->user)) {
                    $this->setUserId($this->user['id']);
                } 
            } 

            if($this->userId && $this->wishlist) {
               // echo "ok";
                
                $this->condition[]  = array('wl.id_users' => $this->userId);
                $this->joinWishlist = true;
            }

        /** ########## Join tables start of code ########## */
            // Categories
            if($this->joinCategory) {
                $this->join[] = ['table' => 'categories c', 'on' => 'c.id = p.cat_id', 'type' => 'left'];
                $this->sql   .= ',c.name as cat_name, c.id as categoryId';
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
        $this->sql .= ',p.id, p.name,p.name as productName,p.id as productId, p.slug, p.primary_image, p.primary_image_one, p.primary_image_two, p.primary_image_three, p.description, p.main_color, p.main_color_name, p.price, p.sell_price, p.discount, p.stock, p.arm, p.bridge, p.lens, p.height, p.sku, p.warranty, p.progressives, p.includes, p.single_vision, p.spring_hinge, p.suitable_for_tints';
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
        //if($this->isPost()) {
            foreach($request as $key => $value){
                $this->request[$key] = $_REQUEST[$key];
           }
        // } else {
        //     $this->request = array();
        // }
        return $this;
    }
    public function getRequest() {
        return $this->request;
    }
    
    public function filterArray($options = null) {

        $this->sql = '';
        $this->primaryTable = 'product_attribute pa';
        $this->condition = array();

        $this->setOptions($options);

         if(isset($this->options) || !empty($this->options) || $this->options != null) {
            
            if(isset($this->options['productId']) || !empty($this->options['productId'])) {
                if(is_array($this->options) && in_array($this->options['productId'], $this->options)) {
                    $this->setProductId($this->options['productId']);
                } 
            }
            if(isset($this->options['hexColorCode']) || !empty($this->options['hexColorCode'])) {
                if(is_array($this->options) && in_array($this->options['hexColorCode'], $this->options)) {
                    $this->setHexColorCode($this->options['hexColorCode']);
                } 
            }
        }
        $this->joinProduct = false;

        if($this->productId) {
            $this->joinProduct = true;
            $this->condition[]  = array("pa.product_id" => $this->productId);
        }
        if($this->hexColorCode) {
            $this->condition[]  = array("pa.color" => $this->hexColorCode);
        }

        $condition = array();
        if(isset($this->condition) || !empty($this->condition) && is_array($this->condition)) {
            for($i = 0; $i < count($this->condition); $i++) {
                foreach($this->condition[$i] as $k => $v) {
                    $condition[$k] = $v;
                }
            }
        }
         $this->condition = $condition;
        // echo "<pre>";
        // print_r($this->condition);
        // exit;
        $this->sql .= 'pa.price, pa.sell_price, pa.discount, pa.stock, (select GROUP_CONCAT(pi.image) from product_images pi where pi.product_id = pa.product_id AND pi.color = pa.color order by pi.id ASC) images';
        
        // Join with product table
        if($this->joinProduct) {
            $this->join[] = ['table' => 'products p', 'on' => 'p.id = pa.product_id', 'type' => 'left'];
            $this->sql   .= ',p.id as productId, p.primary_image as productPrimaryImage';
        }

        $this->resultArray = $this->cm->select($this->primaryTable, $this->condition, $this->sql, 'pa.id', 'asc', $this->join);
        if(isset($this->resultArray) && !empty($this->resultArray) && is_array($this->resultArray)) {
            $this->filterArray = $this->resultArray;
        } else {
            $this->filterArray = array();
        }
        return $this->filterArray;
    }
    public function setSession($key, $value) {
        (isset($key)) ? $this->session->set_userdata($key, $value) : $this->session->set_userdata('default', array());
    }
    public function getSession($key) {
        return (isset($key)) ? $this->session->userdata($key) : $this->session->userdata('default');
    }
    public function userdata() {
         if($this->session->userdata()) {
            $this->sessionVar = $this->session->all_userdata();
         } else {
            $this->sessionVar = array();
         }
         return $this->sessionVar;
    }

    public function loggedInUser() {
        if(!empty($this->sessionVar)|| isset($this->sessionVar)) {
            if(is_array($this->sessionVar) && in_array('user', $this->sessionVar)) {
                if(!empty($this->sessionVar['user']) || isset($this->sessionVar['user'])) {
                    $this->setUser($this->sessionVar['user']);
                } 
            }
        }
    }



    // public function userId() {
        // if(!empty($this->sessionVar)|| isset($this->sessionVar)) {
        //     if(is_array($this->sessionVar) && in_array('user', $this->sessionVar)) {
        //         if(!empty($this->sessionVar['user']) || isset($this->sessionVar['user'])) {
        //             $this->setUserId($this->sessionVar['user']['id']);
        //         } 
        //     }
        // }
    // }
    public function isLoggedIn() {
        if(!empty($this->sessionVar)) {
            if(!empty($this->sessionVar['user'])) {
                return true;
            } else {
                return false;
            }
        } 
    }

    public function emptyUser() {
        $this->session->unset_userdata('user');
        return true;
    }
    public function filterLens($options = null) {
        $this->sql = '';
        $this->primaryTable = 'lens_category lc';
        $this->condition = array();
        $this->setOptions($options);
        if(isset($this->options) || !empty($this->options) || $this->options != null) {
            if(isset($this->options['lensCatId']) || !empty($this->options['lensCatId'])) {
                if(is_array($this->options) && in_array($this->options['lensCatId'], $this->options)) {
                    $this->setLensCatId($this->options['lensCatId']);
                } 
            }
            if(isset($this->options['lensSubCatId']) || !empty($this->options['lensSubCatId'])) {
                if(is_array($this->options) && in_array($this->options['lensSubCatId'], $this->options)) {
                    $this->setLensSubCatId($this->options['lensSubCatId']);
                } 
            }
            
        }
        $this->joinLens = false;
        if($this->lensCatId) {
            $this->joinLens = true;
            $this->condition[]  = array("lc.id" => $this->lensCatId);
            $this->condition[]  = array("lsc.status" => 1);
        }
        if($this->lensSubCatId) {
            $this->joinLens = true;
            $this->condition[]  = array("lsc.id" => $this->lensSubCatId);
        }
        $this->condition[]  = array("lc.status" => 1);
        $condition = array();
        if(isset($this->condition) || !empty($this->condition) && is_array($this->condition)) {
            for($i = 0; $i < count($this->condition); $i++) {
                foreach($this->condition[$i] as $k => $v) {
                    $condition[$k] = $v;
                }
            }
        }
        $this->condition = $condition;
        $this->sql .= 'lc.id lensCatId, lc.name as lensCatName';
        // Join with product table
        if($this->joinLens) {
            $this->join[] = ['table' => 'lens_sub_category lsc', 'on' => 'lc.id = lsc.lens_cat_id', 'type' => 'left'];
            $this->sql   .= ',lsc.id as lensSubCatId, lsc.name as lensSubCatName, lsc.description, lsc.image';
        }
        $this->resultArray = $this->cm->select($this->primaryTable, $this->condition, $this->sql, 'lc.id', 'asc', $this->join);
        if(isset($this->resultArray) && !empty($this->resultArray) && is_array($this->resultArray)) {
            $this->filterArray = $this->resultArray;
        } else {
            $this->filterArray = array();
        }
        return $this->filterArray;
    }

    
}
?>
