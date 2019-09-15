<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once APPPATH . 'core/CommonController.php';
class Home extends Common_Controller {
    public function index() {
        $data['banners'] = $this->getBannerDetails();
        $data['partner'] = $this->getBrandDetails();
        $data['frames'] = $this->getFrameDetails();
        
        
        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/pages/index');
        $this->load->view('frontend/layout/footer');
    }
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /*
        About us
    */
    public function about_us(){
        $data = array();
        $data['cms_data'] = $this->cm->select_row('static_pages', ['id' => 1], '');
        $data['title'] = $data['cms_data']['page_title'].' | shorolafashion.com';
        $data['meta_data'] = ['description'=> $data['cms_data']['page_meta_content']];
        $this->load->view('frontend/cms/about', $data);
    }
    /*
        Privacy Policy
    */
    public function privacy_policy(){
        $data = array();
        $data['cms_data'] = $this->cm->select_row('static_pages', ['id' => 9], '');
        $data['title'] = $data['cms_data']['page_title'].' | shorolafashion.com';
        $data['meta_data'] = ['description'=> $data['cms_data']['page_meta_content']];
        $this->load->view('frontend/cms/privacy_policy', $data);
    }
    /*
        Terms and Conditions
    */
    public function terms_conditions(){
        $data = array();
        $data['cms_data'] = $this->cm->select_row('static_pages', ['id' => 7], '');
        $data['title'] = $data['cms_data']['page_title'].' | shorolafashion.com';
        $data['meta_data'] = ['description'=> $data['cms_data']['page_meta_content']];
        $this->load->view('frontend/cms/terms_conditions', $data);
    }
    /*
        Return Policy
    */
    public function return_policy(){
        $data = array();
        $data['cms_data'] = $this->cm->select_row('static_pages', ['id' => 15], '');
        $data['title'] = $data['cms_data']['page_title'].' | shorolafashion.com';
        $data['meta_data'] = ['description'=> $data['cms_data']['page_meta_content']];
        $this->load->view('frontend/cms/return_policy', $data);
    }
    
    /*
        donot touch or run this function
    */
    public function get_users(){
        $user = $this->cm->select('users', [], '', 'id', 'desc');
        echo '<pre>';
        print_r($user);
    }

}
