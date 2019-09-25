<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Http\Response;
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
        Testimonial
    */
    public function reglaze(){
        $data['banners'] = $this->getBannerDetails();
        $data['partner'] = $this->getBrandDetails();
        $data['frames'] = $this->getFrameDetails();
        $data['webManage'] = $this->getContactDetails();
        $data['reglazes'] = $this->getreglaze(array("r.status" => 1));
        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/pages/reglaze');
        $this->load->view('frontend/layout/footer');
    }
    public function setReglazeFrame(){
        $this->setRequest($_REQUEST);
        if(isset($this->request['frame_id']) || !empty($this->request['frame_id'])) {
            if(is_array($this->request) && in_array($this->request['frame_id'], $this->request)) {
                $this->setReglazeFrameId($this->request['frame_id']);
            } 
        }
        $reglaze = array(
            "reglazeFrameId" => $this->reglazeFrameId
        );
        $sessionUserData = $this->session->userdata();
        if($this->reglazeFrameId) {
            if(!empty($sessionUserData)|| isset($sessionUserData)) {
                if(is_array($sessionUserData) && array_key_exists('product', $sessionUserData)) {
                    $this->setProduct($sessionUserData['product']); // previous session product wihtout reglazeFrameId
                    $this->session->set_userdata('product', array_merge($this->getProduct(), $reglaze));
                    $flag = true;
                }else{
                    $this->session->set_userdata('product', array());
                    $sessionUserData = $this->session->userdata();
                    $this->setProduct($sessionUserData['product']);
                    $this->session->set_userdata('product', array_merge($this->getProduct(), $reglaze));
                    $flag = true;
                }
                if($flag) {
                    $this->setProduct($sessionUserData['product']); // new session product with reglazeFrameId
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
        } else {
            $this->response = new Response(
                array(
                    'data' => [],
                    'statusCode' => Response::HTTP_NOT_FOUND,
                    'message' => 'Reglaze Frame is not set',
                ),
                Response::HTTP_OK,
                ['Content-Type', 'application/json']
            );
        }
        $this->response->send();
    }
    /*
        Contact Us Email Send(Both of Contact us Page Section and Footer Section)
    */
    public function contactUsEmail(){
        $to = "anurag@astutemyndz.com";
        $subject = "New Contact Us";
        $html = '
            <table style="width: 100%; background-color:#e3f6fa; padding-bottom:20px;" cellpadding = "0" cellspacing = "0" border = 1>
                <tr>
                    <td style="width: 30%;">Name : </td>';
        if($this->input->post('contactFormFirstName') && $this->input->post('contactFormLastName')){
            $html .='   <td style="width: 70%;">
                            <b>'.$this->input->post('contactFormFirstName').' '.$this->input->post('contactFormLastName'). '</b>
                        </td>';
        }else{
            $html .='   <td style="width: 70%;">
                            <b>'.$this->input->post('contactFormName').'</b>
                        </td>';
        }
        $html .='   </tr>';
        if($this->input->post('contactFormPhone')){
        $html .=    '<tr>
                        <td style="width: 30%;">Phone : </td>
                        <td style="width: 70%;"><b>'.$this->input->post('contactFormPhone').'</b></td>
                    </tr>';
        }
        $html .= '
                <tr>
                    <td style="width: 30%;">Email : </td>
                    <td style="width: 70%;"><b>'.$this->input->post('contactFormEmail').'</b></td>
                </tr>
                <tr>
                    <td style="width: 30%;">Message : </td>
                    <td style="width: 70%;"><b>'.$this->input->post('contactFormMessage').'</b></td>
                </tr>
                <tr>
                    <td style="width: 30%;"></td>
                    <td style="width: 70%;"><b>'.date_format(date_create(date('Y-m-d')), 'j F, Y').'</b></td>
                </tr>
            </table>';
        $this->cm->sendMail($to, $subject, $html);
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