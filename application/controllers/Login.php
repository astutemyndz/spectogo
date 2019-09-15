<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends Common_Controller {
    public function index(){
        if($this->session->userdata('UserId')){
            redirect(base_url());
        }
        $data['banners'] = $this->getBannerDetails();
        $data['partner'] = $this->getBrandDetails();
        $data['frames'] = $this->getFrameDetails();
        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/pages/sign-in');
        $this->load->view('frontend/layout/footer');
    }
    public function signUp() {
        if($this->session->userdata('UserId')){
            redirect(base_url());
        }
        $data['banners'] = $this->getBannerDetails();
        $data['partner'] = $this->getBrandDetails();
        $data['frames'] = $this->getFrameDetails();
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
    public function doLogin(){
        $chk = $this->cm->get_all('users', array("email" => $this->input->post('loginEmail'), "login_password" => md5($this->input->post('loginPassword')), "login_type" => 2 ));
        if(empty($chk)){
            print 'Sorry !!! Email & Password mismatch !!!';   
        }else{
            $this->session->set_userdata('UserId', $chk[0]->id);
            $this->session->set_userdata('UserName', $chk[0]->name);
            print 'ok';
        }
    }
    public function logOut(){
        $this->session->set_userdata('UserId', '');
        $this->session->set_userdata('UserName', '');
        $this->session->unset_userdata('UserId');
        $this->session->unset_userdata('UserName');
        redirect(base_url());
    }
}
