<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CartController extends Common_Controller {

    public $defaultStore = 'sessionStorage';
	public $cartItems = array();
    private $isCart = false;

    function __construct() {
        parent::__construct();
        $this->cart->product_name_safe = FALSE;
        //$this->isCart = (count($this->cart->contents()) > 0) ? true : false;
        
    }
   
    /**
     * List of cart items or Cart page
     * @return view
     */
    public function index()	{
       
        $this->load->view('frontend/layout/header');
        $this->load->view('frontend/pages/cart/index');
        $this->load->view('frontend/layout/footer');
    }
   
    
	
}
