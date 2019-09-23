<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once APPPATH . 'core/CommonController.php';
class Home extends Common_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $data['banners'] = $this->getBannerDetails();
        $data['partner'] = $this->getBrandDetails();
        $data['frames'] = $this->getFrameDetails();
        $data['webManage'] = $this->getContactDetails();
        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/pages/index');
        $this->load->view('frontend/layout/footer');
    }
    /*
        Contact us
    */
    public function contactUs(){
        $data['banners'] = $this->getBannerDetails();
        $data['partner'] = $this->getBrandDetails();
        $data['frames'] = $this->getFrameDetails();
        $data['webManage'] = $this->getContactDetails();
        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/pages/contact-us');
        $this->load->view('frontend/layout/footer');
    }
    /*
        Page Info
    */
    public function pageInfo($slug = ''){
        $data['banners'] = $this->getBannerDetails();
        $data['partner'] = $this->getBrandDetails();
        $data['frames'] = $this->getFrameDetails();
        $data['webManage'] = $this->getContactDetails();
        $data['pageInfo'] = $this->cm->select_row('page_management', array("slug" => $slug));;
        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/pages/page-info');
        $this->load->view('frontend/layout/footer');
    }
    /*
        Blogs
    */
    public function blogs(){
        $data['banners'] = $this->getBannerDetails();
        $data['partner'] = $this->getBrandDetails();
        $data['frames'] = $this->getFrameDetails();
        $data['blogs'] = $this->getBlogDetails(array("b.status" => 1));
        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/pages/blogs');
        $this->load->view('frontend/layout/footer');
    }
    /*
        Blog Details
    */
    public function blogDetails($slug = ''){
        $data['banners'] = $this->getBannerDetails();
        $data['partner'] = $this->getBrandDetails();
        $data['frames'] = $this->getFrameDetails();
        $data['webManage'] = $this->getContactDetails();
        $data['blog'] = $this->getBlogDetails(array("b.status" => 1, "b.slug" => $slug));
        $data['relatedBlogs'] = $this->getBlogDetails(array("b.status" => 1), '10', '0');

        $data['comments'] = $this->cm->get_all('blog_comment', array("status" => 1, "blog_id" => $data['blog'][0]['id']));
        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/pages/blog-details');
        $this->load->view('frontend/layout/footer');
    }
    public function postComment(){
        if($this->input->post()){
            $inArray = array(
                "blog_id"       => $this->input->post('blogId'),
                "name"          => ucwords($this->input->post('commentName')),
                "email"         => $this->input->post('commentEmail'),
                "comment"       => $this->input->post('commentDesc')
            );
            $commentId = $this->cm->insert('blog_comment', $inArray);
            $inArray['commentId'] = $commentId;
            $inArray['created_at'] = date_format(date_create(date('Y-m-d')), 'j F, Y');
            print json_encode($inArray);
        }
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
