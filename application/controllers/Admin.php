<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once APPPATH . 'core/CommonController.php';
class Admin extends Common_Controller {
	public function index(){
        if($this->session->userdata('adminUserId') != ''){
			redirect(base_url('admin/dashboard'));
		}
        $this->load->view('backend/pages/login');
    }
    public function doLogin() {
        $data = array(
            'email' => $this->input->post('email'),
            'login_password' => md5($this->input->post('password')),
            'login_type' => 1
        );
        $chk = $this->cm->get_specific('users', $data);
        if(!empty($chk)){
            $this->session->set_userdata('adminUserId', $chk[0]->id);
            $this->session->set_userdata('adminName', $chk[0]->name);
        }
        redirect(base_url('admin'));
    }
    public function doLogout(){
        $this->session->unset_userdata('adminUserId');
        $this->session->unset_userdata('adminName');
        $this->session->set_flashdata('success_msg', 'You have logged out successfully.');
        redirect(base_url('admin'));
    }
    public function dashboard(){
        $this->checkAdminLogin();
        //$data['adminDetails'] = $this->getAdminDetails();
        $this->load->view('backend/layout/header');
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/dashboard');
        $this->load->view('backend/layout/footer');
    }
    public function profile(){
        $this->checkAdminLogin();
        if($this->input->post('update_pro')){
            $updateArray = array(
                "name"         => $this->input->post('name'),
                "email"         => $this->input->post('email'),
                "phone"         => $this->input->post('phone'),
                "updated_at"    => date('Y-m-d H:i:s')
            );
            if($this->input->post('password') != ''){
                $updateArray['login_password'] = md5($this->input->post('password'));
            }
            $this->cm->update('users', array("id" => $this->session->userdata('adminUserId'), "login_type" => 1), $updateArray);
            $this->session->set_userdata('adminName', $this->input->post('name'));
        }
        $data['adminDetails'] = $this->getAdminDetails();
        $this->load->view('backend/layout/header',$data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/profile');
        $this->load->view('backend/layout/footer');
    }
    public function changeStatus(){
        if($this->input->post()){
            $id = $this->input->post('id');
            $table = $this->input->post('table');
            $status = $this->cm->changeStatus($table, ['id' => $id]);
            if($status == 1){
                echo '<span class="glyphicon glyphicon-ok-sign green-check-icon"></span>'; die();
            } elseif($status == 0){
                echo '<span class="glyphicon glyphicon-remove-sign red-check-icon"></span>'; die();
            }
        }
    }
    public function categoryManagement(){
        if($this->input->post()){
            if($this->input->post('category_edit_id') == ''){
                if(empty($this->cm->get_specific('categories', array("LOWER(name)" => strtolower($this->input->post('catName')))))){
                    $this->cm->insert('categories', array("name" => ucwords($this->input->post('catName'))));
                    $this->session->set_flashdata('msg', 'Category Successfully Added !!!');
                }else{
                    $this->session->set_flashdata('msg', 'Category Already Exists !!!');
                }
            }else{
                if(empty($this->cm->get_specific('categories', array("LOWER(name)" => strtolower($this->input->post('catName')), "id != " => $this->input->post('category_edit_id'))))){
                    $this->cm->update('categories', array("id" => $this->input->post('category_edit_id')), array("name" => ucwords($this->input->post('catName')), "updated_at" => date('Y-m-d H:i:s')));
                    $this->session->set_flashdata('msg', 'Category Successfully Updated !!!');
                }else{
                    $this->session->set_flashdata('msg', 'Category Already Exists !!!');
                }
            }
        }
        $data['cat'] = $this->cm->get_all('categories');
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/category');
        $this->load->view('backend/layout/footer');
    }
    public function addCategory($id = ''){
        if($id != ''){
            $data['cat'] = $this->cm->get_specific('categories', array("id" => $id));
        }else{
            $data = array();
        }
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/add-category');
        $this->load->view('backend/layout/footer');
    }
    public function bannerManagement(){
        if($this->input->post()){
            $files = $_FILES;
            if(empty($this->cm->get_specific('banners', array("cat_id" => $this->input->post('catName'))))){
                if (!empty($files) && $files['file']['name'] != '') {
                    $image = $this->commonFileUpload('assets/images/bannerImage/', $files['file']['name'], 'file');
                    $this->cm->insert('banners', array("cat_id" => $this->input->post('catName'), "image" => $image));
                    $this->session->set_flashdata('msg', 'Banner Successfully Added !!!');
                }
            }else{
                $this->session->set_flashdata('msg', 'Category Already Exists !!!');
            }
        }
        $join[] = ['table' => 'categories c', 'on' => 'c.id = b.cat_id', 'type' => 'left'];
        $data['banner'] = $this->cm->select('banners b', array(), 'b.id, b.image, b.cat_id, b.status, c.name cat_name', 'b.id', 'desc', $join);
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/banner-management');
        $this->load->view('backend/layout/footer');
    }
    public function addBanner(){
        $data['cat'] = $this->cm->get_all('categories', array("status" => 1));
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/add-banner');
        $this->load->view('backend/layout/footer');
    }
    public function deleteBanner(){
        $this->cm->delete('banners', array("id" => $this->input->post('id')));
        if (file_exists(FCPATH.'assets/images/bannerImage/'.$this->input->post('image'))) {
            unlink(FCPATH.'assets/images/bannerImage/'.$this->input->post('image'));
        }   
    }
    public function specsManagement(){
        if($this->input->post()){
            if($this->input->post('specs_edit_id') == ''){
                if(empty($this->cm->get_specific('specs', array("LOWER(name)" => strtolower($this->input->post('specsName')))))){
                    $this->cm->insert('specs', array("name" => ucfirst($this->input->post('specsName'))));
                    $this->session->set_flashdata('msg', 'Specs Type Successfully Added !!!');
                }else{
                    $this->session->set_flashdata('msg', 'Specs Type Already Exists !!!');
                }
            }else{
                if(empty($this->cm->get_specific('specs', array("LOWER(name)" => strtolower($this->input->post('specsName')), "id != "=> $this->input->post('specs_edit_id'))))){
                    $this->cm->update('specs', array("id" => $this->input->post('specs_edit_id')), array("name" => ucfirst($this->input->post('specsName')), "updated_at" => date('Y-m-d H:i:s')));
                    $this->session->set_flashdata('msg', 'Specs Type Successfully Updated !!!');
                }else{
                    $this->session->set_flashdata('msg', 'Specs Type Already Exists !!!');
                }
            }
        }
        $data['specs'] = $this->cm->get_all('specs');
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/specs');
        $this->load->view('backend/layout/footer');
    }
    public function addSpecs($id = ''){
        if($id != ''){
            $data['specs'] = $this->cm->get_specific('specs', array("id" => $id));
        }else{
            $data = array();
        }
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/add-specs');
        $this->load->view('backend/layout/footer');
    }
    public function frameManagement(){
        if($this->input->post()){
            if($this->input->post('frame_edit_id') == ''){
                if(empty($this->cm->get_specific('frames', array("LOWER(name)" => strtolower($this->input->post('frameName')))))){
                    $this->cm->insert('frames', array("name" => ucfirst($this->input->post('frameName'))));
                    $this->session->set_flashdata('msg', 'Frame Successfully Added !!!');
                }else{
                    $this->session->set_flashdata('msg', 'Frame Already Exists !!!');
                }
            }else{
                if(empty($this->cm->get_specific('frames', array("LOWER(name)" => strtolower($this->input->post('frameName')), "id != " => $this->input->post('frame_edit_id'))))){
                    $this->cm->update('frames', array("id" => $this->input->post('frame_edit_id')), array("name" => ucfirst($this->input->post('frameName')), "updated_at" => date('Y-m-d H:i:s')));
                    $this->session->set_flashdata('msg', 'Frame Successfully Updated !!!');
                }else{
                    $this->session->set_flashdata('msg', 'Frame Already Exists !!!');
                }
            }
        }
        $data['frames'] = $this->cm->get_all('frames');
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/frames');
        $this->load->view('backend/layout/footer');
    }
    public function addFrame($id = ''){
        if($id != ''){
            $data['frames'] = $this->cm->get_specific('frames', array("id" => $id));
        }else{
            $data = array();
        }
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/add-frame');
        $this->load->view('backend/layout/footer');
    }
    public function brandManagement(){
        if($this->input->post()){
            if($this->input->post('brand_edit_id') == ''){
                if(empty($this->cm->get_specific('brands', array("LOWER(name)" => strtolower($this->input->post('brandName')))))){
                    $files = $_FILES;
                    if (!empty($files) && $files['file']['name'] != '') {
                        $image = $this->commonFileUpload('assets/images/brandImage/', $files['file']['name'], 'file');                        
                    }else{
                        $image = '';
                    }
                    $this->cm->insert('brands', array("name" => $this->input->post('brandName'), "image" => $image));
                    $this->session->set_flashdata('msg', 'Brand Successfully Added !!!');
                }else{
                    $this->session->set_flashdata('msg', 'Brand Already Exists !!!');
                }
            }else{
                if(empty($this->cm->get_specific('brands', array("LOWER(name)" => strtolower($this->input->post('brandName')), "id != " => $this->input->post('brand_edit_id'))))){
                    $files = $_FILES;
                    if (!empty($files) && $files['file']['name'] != '') {
                        $image = $this->commonFileUpload('assets/images/brandImage/', $files['file']['name'], 'file', $this->input->post('old_brand_image'));
                    }else{
                        $image = $this->input->post('old_brand_image');
                    }
                    $this->cm->update('brands', array("id" => $this->input->post('brand_edit_id')), array("name" => ucfirst($this->input->post('brandName')), "image" => $image, "updated_at" => date('Y-m-d H:i:s')));
                    $this->session->set_flashdata('msg', 'Brand Successfully Updated !!!');
                }else{
                    $this->session->set_flashdata('msg', 'Brand Already Exists !!!');
                }
            }
        }
        $data['brands'] = $this->cm->get_all('brands');
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/brand');
        $this->load->view('backend/layout/footer');
    }
    public function addBrand($id = ''){
        if($id != ''){
            $data['brands'] = $this->cm->get_specific('brands', array("id" => $id));
        }else{
            $data = array();
        }
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/add-brand');
        $this->load->view('backend/layout/footer');
    }
    public function productManagement(){
        if($this->input->post()){
            if($this->input->post('product_edit_id') == ''){
                if(empty($this->cm->get_specific('products', array("LOWER(name)" => strtolower($this->input->post('productName')), "LOWER(sku)" => strtolower($this->input->post('productSKU')))))){
                    $files = $_FILES;
                    $insertArray = array(
                        "name"                  => $this->input->post('productName'),
                        "slug"                  => str_replace(' ', '-', strtolower($this->input->post('productName'))).'-'.str_replace(' ', '-', strtolower($this->input->post('productSKU'))),
                        "cat_id"                => $this->input->post('productCat'),
                        "spec_id"               => $this->input->post('productSpec'),
                        "frame_id"              => $this->input->post('productFrame'),
                        "brand_id"              => $this->input->post('productBrand'),
                        "description"           => $this->input->post('productDesc'),
                        "main_color"            => $this->input->post('productColor'),
                        "main_color_name"       => $this->input->post('productColorName'),
                        "price"                 => $this->input->post('productPrice'),
                        "sell_price"            => $this->input->post('productSellPrice'),
                        "discount"              => $this->input->post('productDiscount'),
                        "stock"                 => $this->input->post('productStock'),
                        "arm"                   => $this->input->post('productArm'),
                        "bridge"                => $this->input->post('productBridge'),
                        "lens"                  => $this->input->post('productLens'),
                        "height"                => $this->input->post('productHeight'),
                        "sku"                   => strtoupper($this->input->post('productSKU')),
                        "warranty"              => $this->input->post('productWarranty'),
                        "progressives"          => $this->input->post('productProgressives'),
                        "includes"              => $this->input->post('productIncludes'),
                        "single_vision"         => $this->input->post('productSingleVision'),
                        "spring_hinge"          => $this->input->post('productSpringHinge'),
                        "suitable_for_tints"    => $this->input->post('productSuitableforTints')
                    );
                    $prodId = $this->cm->insert('products', $insertArray);
                    $insertArrayTwo = array(
                        "product_id"    => $prodId,
                        "color"         => $this->input->post('productColor'),
                        "color_name"    => $this->input->post('productColorName'),
                        "price"         => $this->input->post('productPrice'),
                        "sell_price"    => $this->input->post('productSellPrice'),
                        "discount"      => $this->input->post('productDiscount'),
                        "stock"         => $this->input->post('productStock')
                    );
                    $atrId = $this->cm->insert('product_attribute', $insertArrayTwo);
                    $this->productLedger($prodId, $atrId, $this->input->post('productColor'), 'in', $this->input->post('productStock'), 'Product Opening Stock');
                    if(count($files['moreImage']['name'])> 0){
                        $fileArray = $files['moreImage'];
                        $upPath = FCPATH . 'assets/images/productImage/';
                        if (!file_exists($upPath)) {
                            mkdir($upPath, 0777, true);
                        }
                        $config = array(
                            'upload_path' => $upPath,
                            'allowed_types' => "gif|jpg|png|jpeg|JPEG|JPG|GIF|PNG",
                            'overwrite' => TRUE,
                            'max_size' => "8192000",
                            'encrypt_name' => TRUE
                        );
                        for($p = 0; $p<count($fileArray['name']); $p++){
                            $tmp = '';
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
                                    if($p == 0){
                                        $tmp = 'primary_image';
                                    }elseif($p == 1){
                                        $tmp = 'primary_image_one';
                                    }elseif($p == 2){
                                        $tmp = 'primary_image_two';
                                    }else{
                                        $tmp = 'primary_image_three';
                                    }
                                    $this->cm->update('products', array("id" => $prodId), array($tmp => $imageDetailArray['file_name']));
                                    $this->cm->insert('product_images', array("product_id" => $prodId, "color" => $this->input->post('productColor'), "image" => $imageDetailArray['file_name']));
                                }
                            }
                        }
                    }
                    $this->session->set_flashdata('msg', 'Product Successfully Added !!!');
                }else{
                    $this->session->set_flashdata('msg', 'Product Already Exists !!!');
                }
            }else{
                if(empty($this->cm->get_specific('products', array("LOWER(name)" => strtolower($this->input->post('productName')), "LOWER(sku)" => strtolower($this->input->post('productSKU')), "id != " => $this->input->post('product_edit_id'))))){
                    $files = $_FILES;
                    $old_primary_image = $this->input->post('old_primary_image');
                    $old_primary_image_one = $this->input->post('old_primary_image_one');
                    $old_primary_image_two = $this->input->post('old_primary_image_two');
                    $old_primary_image_three = $this->input->post('old_primary_image_three'); 
                    $updateArray = array(
                        "name"                  => $this->input->post('productName'),
                        "cat_id"                => $this->input->post('productCat'),
                        "spec_id"               => $this->input->post('productSpec'),
                        "frame_id"              => $this->input->post('productFrame'),
                        "brand_id"              => $this->input->post('productBrand'),
                        "description"           => $this->input->post('productDesc'),
                        "main_color"            => $this->input->post('productColor'),
                        "main_color_name"       => $this->input->post('productColorName'),
                        "price"                 => $this->input->post('productPrice'),
                        "sell_price"            => $this->input->post('productSellPrice'),
                        "discount"              => $this->input->post('productDiscount'),
                        "stock"                 => $this->input->post('productStock'),
                        "arm"                   => $this->input->post('productArm'),
                        "bridge"                => $this->input->post('productBridge'),
                        "lens"                  => $this->input->post('productLens'),
                        "height"                => $this->input->post('productHeight'),
                        "sku"                   => strtoupper($this->input->post('productSKU')),
                        "warranty"              => $this->input->post('productWarranty'),
                        "progressives"          => $this->input->post('productProgressives'),
                        "includes"              => $this->input->post('productIncludes'),
                        "single_vision"         => $this->input->post('productSingleVision'),
                        "spring_hinge"          => $this->input->post('productSpringHinge'),
                        "suitable_for_tints"    => $this->input->post('productSuitableforTints'),
                        "updated_at"            => date('Y-m-d H:i:s')
                    );
                    if($old_primary_image != ''){
                        $updateArray['primary_image'] = $old_primary_image;
                    }
                    if($old_primary_image_one != ''){
                        $updateArray['primary_image_one'] = $old_primary_image_one;
                    }
                    if($old_primary_image_two != ''){
                        $updateArray['primary_image_two'] = $old_primary_image_two;
                    }
                    if($old_primary_image_three != ''){
                        $updateArray['primary_image_three'] = $old_primary_image_three;
                    }
                    $this->cm->update('products', array("id" => $this->input->post('product_edit_id')), $updateArray);
                    $prodAttr = $this->cm->get_specific('product_attribute', array("product_id" => $this->input->post('product_edit_id'), "color" => $this->input->post('old_productColor')));
                    $prodAttrId = $prodAttr[0]->id;
                    if($this->input->post('productColor') != $this->input->post('old_productColor')){
                        $this->cm->update('product_images', array("product_id" => $this->input->post('product_edit_id'), "color" => $this->input->post('old_productColor')), array("color" => $this->input->post('productColor')));
                        $this->cm->update('product_ledger', array("product_id" => $this->input->post('product_edit_id'), "color" => $this->input->post('old_productColor')), array("color" => $this->input->post('productColor')));
                    }
                    if($this->input->post('productStock') != $this->input->post('old_productStock')){
                        if($this->input->post('productStock') > $this->input->post('old_productStock')){
                            $inout = 'in';
                            $quantity = $this->input->post('productStock') - $this->input->post('old_productStock');
                        }elseif($this->input->post('productStock') < $this->input->post('old_productStock')){
                            $inout = 'out';
                            $quantity = $this->input->post('old_productStock') - $this->input->post('productStock');
                        }
                        $this->productLedger($this->input->post('product_edit_id'), $prodAttrId, $this->input->post('productColor'), $inout, $quantity, 'Product Stock Adjustment');
                    }
                    $updateArray = array(
                        "color"         => $this->input->post('productColor'),
                        "color_name"    => $this->input->post('productColorName'),
                        "price"         => $this->input->post('productPrice'),
                        "sell_price"    => $this->input->post('productSellPrice'),
                        "discount"      => $this->input->post('productDiscount'),
                        "stock"         => $this->input->post('productStock'),
                        "updated_at"    => date('Y-m-d H:i:s')
                    );
                    $this->cm->update('product_attribute', array("id" => $prodAttrId), $updateArray);                    
                    if(count($files['moreImage']['name'])> 0){
                        $fileArray = $files['moreImage'];
                        $upPath = FCPATH . 'assets/images/productImage/';
                        if (!file_exists($upPath)) {
                            mkdir($upPath, 0777, true);
                        }
                        $config = array(
                            'upload_path' => $upPath,
                            'allowed_types' => "gif|jpg|png|jpeg|JPEG|JPG|GIF|PNG",
                            'overwrite' => TRUE,
                            'max_size' => "8192000",
                            'encrypt_name' => TRUE
                        );
                        for($p = 0; $p<count($fileArray['name']); $p++){
                            $tmp = '';
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
                                    if($old_primary_image == ''){
                                        $tmp = 'primary_image';
                                        $old_primary_image = 'notnull';
                                    }
                                    if($old_primary_image_one == ''){
                                        $tmp = 'primary_image_one';
                                        $old_primary_image_one = 'notnull';
                                    }
                                    if($old_primary_image_two == ''){
                                        $tmp = 'primary_image_two';
                                        $old_primary_image_two = 'notnull';
                                    }
                                    if($old_primary_image_three == ''){
                                        $tmp = 'primary_image_three';
                                        $old_primary_image_three = 'notnull';
                                    }
                                    $this->cm->update('products', array("id" => $this->input->post('product_edit_id')), array($tmp => $imageDetailArray['file_name']));
                                    $this->cm->insert('product_images', array("product_id" => $this->input->post('product_edit_id'), "color" => $this->input->post('productColor'), "image" => $imageDetailArray['file_name']));
                                }
                            }
                        }
                    }
                    $this->session->set_flashdata('msg', 'Product Successfully Updated !!!');
                }else{
                    $this->session->set_flashdata('msg', 'Product Already Exists !!!');
                }
            }
        }
        $data['products'] = $this->getProductDetails();
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/products');
        $this->load->view('backend/layout/footer');
    }
    public function addProduct($id = ''){
        $data['options'] = $this->getProductFeatures();        
        if($id != ''){
            $data['products'] = $data['products'] = $this->getProductDetails($id);
        }
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/add-product');
        $this->load->view('backend/layout/footer');
    }
    public function deletePrimaryImage(){
        if($this->input->post()){
        $this->cm->delete('product_images', array("image" => $this->input->post('image'), "product_id" => $this->input->post('prod_id')));
        $this->cm->update('products', array("id" => $this->input->post('prod_id')), array($this->input->post('img_field') => ''));
        if (file_exists(FCPATH.'assets/images/productImage/'.$this->input->post('image'))) {
            unlink(FCPATH.'assets/images/productImage/'.$this->input->post('image'));
        }
        }
    }
    public function deleteRelImage(){
        $this->cm->delete('product_images', array("id" => $this->input->post('id')));
        if (file_exists(FCPATH.'assets/images/productImage/'.$this->input->post('image'))) {
            unlink(FCPATH.'assets/images/productImage/'.$this->input->post('image'));
        }   
    }
    public function addProductAttribute($id = ''){
        if($id != ''){
            $data['products'] = $data['products'] = $this->getProductDetails($id);
            $data['attribute'] = $this->db->query("SELECT DISTINCT id, color, color_name FROM `product_attribute` WHERE  product_id = '".$id."'")->result();
        }
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/add-product-attribute');
        $this->load->view('backend/layout/footer');
    }
    public function getAttributeDetails(){
        $join = array();
        $data['atrDetails'] = $this->cm->select('product_attribute pa', array('pa.id' => $this->input->post('atr_id')), 'pa.*, (select GROUP_CONCAT(pi.id) from product_images pi where pi.product_id = pa.product_id AND pi.color = pa.color) images_id, (select GROUP_CONCAT(pi.image) from product_images pi where pi.product_id = pa.product_id AND pi.color = pa.color) images', 'pa.id', 'desc', $join);
        $html = $this->load->view('backend/pages/ajax-load', $data, TRUE);
        print $html.'~~'.$data['atrDetails'][0]['color'].'~~'.$data['atrDetails'][0]['id'];
    }
    public function saveProductAttributeDetails(){
        if($this->input->post()){
            if($this->input->post('product_attribute_id') == ''){
                if(empty($this->cm->get_specific('product_attribute', array("product_id" => $this->input->post('product_edit_id'), "color" => $this->input->post('productColor'))))){
                    $insertArray = array(
                        "product_id"    => $this->input->post('product_edit_id'),
                        "color"         => $this->input->post('productColor'),
                        "color_name"    => $this->input->post('productColorName'),
                        "price"         => $this->input->post('productPrice'),
                        "sell_price"    => $this->input->post('productSellPrice'),
                        "discount"      => $this->input->post('productDiscount'),
                        "stock"         => $this->input->post('productStock')
                    );
                    $atrId = $this->cm->insert('product_attribute', $insertArray);
                    $this->productLedger($this->input->post('product_edit_id'), $atrId, $this->input->post('productColor'), 'in', $this->input->post('productStock'), 'Product Opening Stock');
                    $files = $_FILES;
                    if(count($files['moreImage']['name'])> 0){
                        $this->commonFileArrayUpload('assets/images/productImage/', $files['moreImage'], 'product_images', array("product_id" => $this->input->post('product_edit_id'), "color" => $this->input->post('productColor')));
                    }
                    $this->session->set_flashdata('msg', 'Product Attributes Successfully Added !!!');
                }else{
                    $this->session->set_flashdata('msg', 'Product Attributes Already Exists !!!');
                }
            }else{
                if(empty($this->cm->get_specific('product_attribute', array("product_id" => $this->input->post('product_edit_id'), "color" => $this->input->post('productColor'), "id != " => $this->input->post('product_attribute_id'))))){
                    $updateArray = array(
                        "color"         => $this->input->post('productColor'),
                        "color_name"    => $this->input->post('productColorName'),
                        "price"         => $this->input->post('productPrice'),
                        "sell_price"    => $this->input->post('productSellPrice'),
                        "discount"      => $this->input->post('productDiscount'),
                        "stock"         => $this->input->post('productStock'),
                        "updated_at"    => date('Y-m-d H:i:s')
                    );
                    $this->cm->update('product_attribute', array("id" => $this->input->post('product_attribute_id')), $updateArray);
                    if($this->input->post('productColor') != $this->input->post('old_productColor')){
                        $this->cm->update('product_images', array("product_id" => $this->input->post('product_edit_id'), "color" => $this->input->post('old_productColor')), array("color" => $this->input->post('productColor')));
                        $this->cm->update('product_ledger', array("product_id" => $this->input->post('product_edit_id'), "attribute_id" => $this->input->post('product_attribute_id')), array("color" => $this->input->post('productColor')));
                    }
                    if($this->input->post('productStock') != $this->input->post('old_productStock')){
                        if($this->input->post('productStock') > $this->input->post('old_productStock')){
                            $inout = 'in';
                            $quantity = $this->input->post('productStock') - $this->input->post('old_productStock');
                        }elseif($this->input->post('productStock') < $this->input->post('old_productStock')){
                            $inout = 'out';
                            $quantity = $this->input->post('old_productStock') - $this->input->post('productStock');
                        }
                        $this->productLedger($this->input->post('product_edit_id'), $this->input->post('product_attribute_id'), $this->input->post('productColor'), $inout, $quantity, 'Product Stock Adjustment');
                    }
                    $files = $_FILES;
                    if(count($files['moreImage']['name'])> 0){
                        $this->commonFileArrayUpload('assets/images/productImage/', $files['moreImage'], 'product_images', array("product_id" => $this->input->post('product_edit_id'), "color" => $this->input->post('productColor')));
                    }
                    $this->session->set_flashdata('msg', 'Product Attributes Successfully Updated !!!');
                }else{
                    $this->session->set_flashdata('msg', 'Product Attributes Already Exists !!!');
                }
            }
            redirect(base_url('admin/product-management'));
        }
    }
    public function lensManagement(){
        if($this->input->post()){
            if($this->input->post('lenscategory_edit_id') == ''){
                if(empty($this->cm->get_specific('lens_category', array("LOWER(name)" => strtolower($this->input->post('lensCatName')))))){
                    $this->cm->insert('lens_category', array("name" => ucwords($this->input->post('lensCatName'))));
                    $this->session->set_flashdata('msg', 'Lens Category Successfully Added !!!');
                }else{
                    $this->session->set_flashdata('msg', 'Lens Category Already Exists !!!');
                }
            }else{
                if(empty($this->cm->get_specific('lens_category', array("LOWER(name)" => strtolower($this->input->post('lensCatName')), "id != " => $this->input->post('lenscategory_edit_id'))))){
                    $this->cm->update('lens_category', array("id" => $this->input->post('lenscategory_edit_id')), array("name" => ucwords($this->input->post('lensCatName')), "updated_at" => date('Y-m-d H:i:s')));
                    $this->session->set_flashdata('msg', 'Lens Category Successfully Updated !!!');
                }else{
                    $this->session->set_flashdata('msg', 'Lens Category Already Exists !!!');
                }
            }
        }
        $data['lens'] = $this->cm->get_all('lens_category');
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/lens-category');
        $this->load->view('backend/layout/footer');
    }
    public function addLens($id = ''){
        if($id != ''){
            $data['lens'] = $this->cm->get_specific('lens_category', array("id" => $id));
        }else{
            $data = array();
        }
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/add-lens-category');
        $this->load->view('backend/layout/footer');
    }
    public function lensSubCategoryManagement(){
        if($this->input->post()){
            $files = $_FILES;
            if($this->input->post('lenssubcategory_edit_id') == ''){
                if(empty($this->cm->get_specific('lens_sub_category', array("LOWER(name)" => strtolower($this->input->post('lensSubCatName')), "lens_cat_id" => $this->input->post('lensCatId'))))){
                    if (!empty($files) && $files['lensSubCatImage']['name'] != '') {
                        $image = $this->commonFileUpload('assets/images/lensSubCatImage/', $files['lensSubCatImage']['name'], 'lensSubCatImage');
                    }
                    $inArray = array(
                        "lens_cat_id"   => $this->input->post('lensCatId'),
                        "name"          => ucwords($this->input->post('lensSubCatName')),
                        "description"   => $this->input->post('lensSubCatDescription'),
                        "image"         => $image
                    );
                    $this->cm->insert('lens_sub_category', $inArray);
                    $this->session->set_flashdata('msg', 'Lens Sub Category Successfully Added !!!');
                }else{
                    $this->session->set_flashdata('msg', 'Lens Sub Category Already Exists !!!');
                }
            }else{
                if(empty($this->cm->get_specific('lens_sub_category', array("LOWER(name)" => strtolower($this->input->post('lensSubCatName')), "lens_cat_id" => $this->input->post('lensCatId'), "id != " => $this->input->post('lenssubcategory_edit_id'))))){
                    if (!empty($files) && $files['lensSubCatImage']['name'] != '') {
                        $image = $this->commonFileUpload('assets/images/lensSubCatImage/', $files['lensSubCatImage']['name'], 'lensSubCatImage', $this->input->post('old_lensSubCatImage'));
                    }else{
                        $image = $this->input->post('old_lensSubCatImage');
                    }
                    $upArray = array(
                        "lens_cat_id"   => $this->input->post('lensCatId'),
                        "name"          => ucwords($this->input->post('lensSubCatName')),
                        "description"   => $this->input->post('lensSubCatDescription'),
                        "image"         => $image,
                        "updated_at" => date('Y-m-d H:i:s')
                    );                    
                    $this->cm->update('lens_sub_category', array("id" => $this->input->post('lenssubcategory_edit_id')), $upArray);
                    $this->session->set_flashdata('msg', 'Lens Sub Category Successfully Updated !!!');
                }else{
                    $this->session->set_flashdata('msg', 'Lens Sub Category Already Exists !!!');
                }
            }
        }
        $data['lens'] = $this->getLensDetails();
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/lens-sub-category');
        $this->load->view('backend/layout/footer');
    }
    public function addLensSubCategory($id = ''){
        $data['lensCat'] = $this->cm->get_all('lens_category');
        if($id != ''){
            $data['lens'] = $this->getLensDetails(array("lsc.id" => $id));
        }
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/add-lens-sub-category');
        $this->load->view('backend/layout/footer');
    }
    public function pupillaryDistance(){
        if($this->input->post()){
            if($this->input->post('pd_edit_id') == ''){
                if(empty($this->cm->get_specific('pupillary_distance', array("LOWER(name)" => strtolower($this->input->post('pdName')))))){
                    $this->cm->insert('pupillary_distance', array("name" => ucwords($this->input->post('pdName'))));
                    $this->session->set_flashdata('msg', 'Pupillary Distance Successfully Added !!!');
                }else{
                    $this->session->set_flashdata('msg', 'Pupillary Distance Already Exists !!!');
                }
            }else{
                if(empty($this->cm->get_specific('pupillary_distance', array("LOWER(name)" => strtolower($this->input->post('pdName')), "id != " => $this->input->post('pd_edit_id'))))){
                    $this->cm->update('pupillary_distance', array("id" => $this->input->post('pd_edit_id')), array("name" => ucfirst($this->input->post('pdName')), "updated_at" => date('Y-m-d H:i:s')));
                    $this->session->set_flashdata('msg', 'Pupillary Distance Successfully Updated !!!');
                }else{
                    $this->session->set_flashdata('msg', 'Pupillary Distance Already Exists !!!');
                }
            }
        }
        $data['pds'] = $this->cm->get_all('pupillary_distance');
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/pupillary-distance');
        $this->load->view('backend/layout/footer');
    }
    public function addPupillaryDistance($id = ''){
        if($id != ''){
            $data['pd'] = $this->cm->get_specific('pupillary_distance', array("id" => $id));
        }else{
            $data = array();
        }
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/add-pupillary-distance');
        $this->load->view('backend/layout/footer');
    }
    public function lensesAndTints(){
        if($this->input->post()){
            if($this->input->post('lenscategory_edit_id') == ''){
                if(empty($this->cm->get_specific('lenses_and_tints', array("LOWER(name)" => strtolower($this->input->post('lensCatName')))))){
                    $this->cm->insert('lenses_and_tints', array("name" => ucwords($this->input->post('lensCatName'))));
                    $this->session->set_flashdata('msg', 'Lenses & Tints Category Successfully Added !!!');
                }else{
                    $this->session->set_flashdata('msg', 'Lenses & Tints Category Already Exists !!!');
                }
            }else{
                if(empty($this->cm->get_specific('lenses_and_tints', array("LOWER(name)" => strtolower($this->input->post('lensCatName')), "id != " => $this->input->post('lenscategory_edit_id'))))){
                    $this->cm->update('lenses_and_tints', array("id" => $this->input->post('lenscategory_edit_id')), array("name" => ucwords($this->input->post('lensCatName')), "updated_at" => date('Y-m-d H:i:s')));
                    $this->session->set_flashdata('msg', 'Lenses & Tints Category Successfully Updated !!!');
                }else{
                    $this->session->set_flashdata('msg', 'Lenses & Tints Category Already Exists !!!');
                }
            }
        }
        $data['lens'] = $this->cm->get_all('lenses_and_tints');
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/lenses-and-tints');
        $this->load->view('backend/layout/footer');
    }
    public function addLensesAndTints($id = ''){
        if($id != ''){
            $data['lens'] = $this->cm->get_specific('lenses_and_tints', array("id" => $id));
        }else{
            $data = array();
        }
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/add-lenses-and-tints');
        $this->load->view('backend/layout/footer');
    }
    public function lensesAndTintsDetails(){
        if($this->input->post()){
            $files = $_FILES;
            if($this->input->post('lenssubcategory_edit_id') == ''){
                if(empty($this->cm->get_specific('lenses_and_tints_details', array("LOWER(name)" => strtolower($this->input->post('lensSubCatName')), "lenses_and_tints_id" => $this->input->post('lensCatId'))))){
                    if (!empty($files) && $files['lensSubCatImage']['name'] != '') {
                        $image = $this->commonFileUpload('assets/images/lensesAndTintsImage/', $files['lensSubCatImage']['name'], 'lensSubCatImage');
                    }
                    $inArray = array(
                        "lenses_and_tints_id"   => $this->input->post('lensCatId'),
                        "name"                  => ucwords($this->input->post('lensSubCatName')),
                        "description"           => $this->input->post('lensSubCatDescription'),
                        "includes"              => $this->input->post('lensSubCatIncludes'),
                        "price"                 => $this->input->post('lensSubCatPrice'),
                        "image"                 => $image
                    );
                    $this->cm->insert('lenses_and_tints_details', $inArray);
                    $this->session->set_flashdata('msg', 'Lenses & Tints Sub Category Successfully Added !!!');
                }else{
                    $this->session->set_flashdata('msg', 'Lenses & Tints Sub Category Already Exists !!!');
                }
            }else{
                if(empty($this->cm->get_specific('lenses_and_tints_details', array("LOWER(name)" => strtolower($this->input->post('lensSubCatName')), "lenses_and_tints_id" => $this->input->post('lensCatId'), "id != " => $this->input->post('lenssubcategory_edit_id'))))){
                    if (!empty($files) && $files['lensSubCatImage']['name'] != '') {
                        $image = $this->commonFileUpload('assets/images/lensesAndTintsImage/', $files['lensSubCatImage']['name'], 'lensSubCatImage', $this->input->post('old_lensSubCatImage'));
                    }else{
                        $image = $this->input->post('old_lensSubCatImage');
                    }
                    $upArray = array(
                        "lenses_and_tints_id"   => $this->input->post('lensCatId'),
                        "name"                  => ucwords($this->input->post('lensSubCatName')),
                        "description"           => $this->input->post('lensSubCatDescription'),
                        "includes"              => $this->input->post('lensSubCatIncludes'),
                        "price"                 => $this->input->post('lensSubCatPrice'),
                        "image"                 => $image,
                        "updated_at"            => date('Y-m-d H:i:s')
                    );                    
                    $this->cm->update('lenses_and_tints_details', array("id" => $this->input->post('lenssubcategory_edit_id')), $upArray);
                    $this->session->set_flashdata('msg', 'Lenses & Tints Sub Category Successfully Updated !!!');
                }else{
                    $this->session->set_flashdata('msg', 'Lenses & Tints Sub Category Already Exists !!!');
                }
            }
        }
        $data['lens'] = $this->getLensAndTints();
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/lenses-and-tints-details');
        $this->load->view('backend/layout/footer');
    }
    public function addLensesAndTintsDetails($id = ''){
        $data['lensCat'] = $this->cm->get_all('lenses_and_tints');
        if($id != ''){
            $data['lens'] = $this->getLensAndTints(array("latd.id" => $id));
        }
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/add-lenses-and-tints-details');
        $this->load->view('backend/layout/footer');
    }
    public function reglazeManagement(){
        if($this->input->post()){
            $files = $_FILES;
            if($this->input->post('reglaze_edit_id') == ''){
                if(empty($this->cm->get_specific('reglaze', array("frame_id" => $this->input->post('frameId'))))){
                    if (!empty($files) && $files['reglazeImage']['name'] != '') {
                        $image = $this->commonFileUpload('assets/images/reglazeImage/', $files['reglazeImage']['name'], 'reglazeImage');
                    }
                    $inArray = array(
                        "frame_id"  => $this->input->post('frameId'),
                        "price"     => $this->input->post('reglazePrice'),
                        "image"     => $image
                    );
                    $this->cm->insert('reglaze', $inArray);
                    $this->session->set_flashdata('msg', 'Reglaze Details Successfully Added !!!');
                }else{
                    $this->session->set_flashdata('msg', 'Reglaze Details Already Exists !!!');
                }
            }else{
                if(empty($this->cm->get_specific('reglaze', array("frame_id" => strtolower($this->input->post('frameId')), "id != " => $this->input->post('reglaze_edit_id'))))){
                    if (!empty($files) && $files['reglazeImage']['name'] != '') {
                        $image = $this->commonFileUpload('assets/images/reglazeImage/', $files['reglazeImage']['name'], 'reglazeImage', $this->input->post('old_reglazeImage'));
                    }else{
                        $image = $this->input->post('old_reglazeImage');
                    }
                    $upArray = array(
                        "frame_id"      => $this->input->post('frameId'),
                        "price"         => $this->input->post('reglazePrice'),
                        "image"         => $image,
                        "updated_at"    => date('Y-m-d H:i:s')
                    );                    
                    $this->cm->update('reglaze', array("id" => $this->input->post('reglaze_edit_id')), $upArray);
                    $this->session->set_flashdata('msg', 'Reglaze Details Successfully Updated !!!');
                }else{
                    $this->session->set_flashdata('msg', 'Reglaze Details Already Exists !!!');
                }
            }
        }
        $data['frames'] = $this->cm->get_all('frames');
        $data['reglaze'] = $this->getreglaze();
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/reglaze');
        $this->load->view('backend/layout/footer');
    }
    public function addReglaze($id = ''){
        $data['frames'] = $this->cm->get_all('frames');
        if($id != ''){
            $data['reglaze'] = $this->getreglaze(array('r.id' => $id));
        }
        $this->load->view('backend/layout/header', $data);
        $this->load->view('backend/layout/sidemenu');
        $this->load->view('backend/pages/add-reglaze');
        $this->load->view('backend/layout/footer');
    }
    
}
