<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
        $data['webManage'] = $this->getContactDetails();
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
    /*
        Post Comment for Blog
    */
    public function postComment(){
        if($this->input->post()){
            $inArray = array(
                "blog_id"       => $this->input->post('blogId'),
                "name"          => ucwords($this->input->post('commentName')),
                "email"         => $this->input->post('commentEmail'),
                "comment"       => $this->input->post('commentDesc')
            );
            $commentId = $this->cm->insert('blog_comment', $inArray);
            $inArray['created_at'] = date_format(date_create(date('Y-m-d')), 'j F, Y');
            print json_encode($inArray);
        }
    }
    public function newsletterSubscribe(){
        if($this->input->post()){
            if(!empty($this->cm->get_specific('newsletter', array("email" => $this->input->post('newsletter_email'))))){
                $commentId = $this->cm->insert('newsletter', array("email" => $this->input->post('newsletter_email')));
                print "ok";
            }else{
                print "notok";
            }
        }
    }
    /*
        Testimonial
    */
    public function testimonial(){
        $data['banners'] = $this->getBannerDetails();
        $data['partner'] = $this->getBrandDetails();
        $data['frames'] = $this->getFrameDetails();
        $data['webManage'] = $this->getContactDetails();
        $data['testimonials'] = $this->cm->get_all('testimonial', array("status" => 1));
        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/pages/testimonial');
        $this->load->view('frontend/layout/footer');
    }
    /*
        Search Product
    */
    public function searchProduct(){
        if($this->input->post()){
            $option = array();
            $option['productName'] = $this->input->post('search_product');
            $product = $this->getProductListDetails($option);
            print json_encode($product);
        }
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
