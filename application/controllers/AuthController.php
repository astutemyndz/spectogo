<?php
// use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response;
defined('BASEPATH') OR exit('No direct script access allowed');
class AuthController extends Common_Controller {
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        if(isLoggedIn()) {
            redirect(base_url());
        }
        $data['banners'] = $this->getBannerDetails();
        $data['partner'] = $this->getBrandDetails();
        $data['frames'] = $this->getFrameDetails();
        $data['webManage'] = $this->getContactDetails();
        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/pages/sign-in');
        $this->load->view('frontend/layout/footer');
    }
    public function signUp() {
        if(isLoggedIn()) {
            redirect(base_url());
        }
        $data['banners'] = $this->getBannerDetails();
        $data['partner'] = $this->getBrandDetails();
        $data['frames'] = $this->getFrameDetails();
        $data['webManage'] = $this->getContactDetails();
        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/pages/sign-up');
        $this->load->view('frontend/layout/footer');
    }
    public function doRegistration(){
        $chk = $this->cm->get_all('users', array("email" => $this->input->post('signUpEmail')));
        if(empty($chk)){
            $inArray = [
                'name'              => $this->input->post('signUpName'),
                'email'             => $this->input->post('signUpEmail'),
                'login_password'    => md5($this->input->post('signUpPassword'))
            ];
            $insert_id = $this->cm->insert('users', $inArray);
            if($insert_id){
                print "ok~~Profile Created Successfully !!!";
            }else{
                print "notok~~Something Went Wrong !!! Please Try Again !!!";
            }
        }else{
            print 'notok~~Sorry !!! Email already exists !!!';
        }
    }
    public function registerOrNot() {
        $this->setRequest($_REQUEST);
        if(!empty($this->request['loginEmail']) || isset($this->request['loginEmail'])) {
            $this->condition = array('email' => $this->request['loginEmail']);
            $this->user = $this->cm->get_all('users', $this->condition);
            if(!empty($this->user)) {
                return true;
            } 
            return false;
        }
    }
    public function doLogin() {
        if(!$this->registerOrNot()) {
            $this->setResponse(new Response(
                array(
                    'data' => $this->request['loginEmail'],
                    'statusCode' => Response::HTTP_NOT_FOUND,
                    'message' => 'Account does not exists! please do register',
                ),
                Response::HTTP_OK,
                ['Content-Type', 'application/json']
            ));
        } else {
            $this->condition = array('email' => $this->request['loginEmail'], "login_password" => md5($this->input->post('loginPassword')), "login_type" => 2 );
            $this->user = $this->cm->get_all('users', $this->condition);
            if(!empty($this->user)){
                $this->setSession('user', (array) $this->user[0]);
                $this->setResponse(new Response(
                    array(
                        'data' => $this->user,
                        'statusCode' => Response::HTTP_OK,
                        'message' => 'Login Success',
                    ),
                    Response::HTTP_OK,
                    ['Content-Type', 'application/json']
                ));
            } else {
                $this->setResponse(new Response(
                    array(
                        'data' => $this->user,
                        'statusCode' => Response::HTTP_NOT_FOUND,
                        'message' => 'You have entered invalid credentials',
                    ),
                    Response::HTTP_OK,
                    ['Content-Type', 'application/json']
                ));
            }
        }
        $this->sendResponse();
    }
    public function logOut(){
        $this->emptyUser();
        redirect(base_url());
    }
}
