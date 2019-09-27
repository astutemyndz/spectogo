<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Http\Response;
class CartController extends Common_Controller {
    public $defaultStore = 'sessionStorage';
	public $cartItems = array();
    private $isCart = false;
    private $hasCartData = false;
    private $order;
    private $orderAttributes;
    private $orderColors;
    private $orderLensTints;
    private $orderPrescription;
    private $orderPrescriptionDetails;
    private $orderPrescriptionPrism;
    private $payerId;
    private $paymentStatus;
    private $transactionId;
    private $cartData = array();

    function __construct() {
        parent::__construct();
        $this->cart->product_name_safe = FALSE;
        //$this->isCart = (count($this->cart->contents()) > 0) ? true : false;
        if($this->cart->contents()) {
            $this->hasCartData = true;
        }

        $this->getCartData();
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
    public function checkout() {
        $this->load->view('frontend/layout/header');
        $this->load->view('frontend/pages/cart/checkout');
        $this->load->view('frontend/layout/footer');
    }
    public function onClickRemoveCartEventHandler() {
        if($this->cart->contents()) {
            // Remove Cart
            if($this->isPost()) {
                $this->setRequest($_REQUEST);
                if(!empty($this->request) || isset($this->request)) {
                    $data = array(
                        'rowid'   => ($this->request['rowId']) ? $this->request['rowId'] : '',
                        'qty'     => 0
                    );
                    if($this->cart->update($data)) {
                        $this->response = new Response(
                            array(
                                'data' => $this->cart->contents(),
                                'count' => count($this->cart->contents()),
                                'statusCode' => Response::HTTP_OK,
                                'message' => Response::$statusTexts[200],
                            ),
                            Response::HTTP_OK,
                            ['Content-Type', 'application/json']
                        );
                    } else {
                        $this->response = new Response(
                            array(
                                'data' => [],
                                'count' => 0,
                                'statusCode' => Response::HTTP_NOT_FOUND,
                                'message' => Response::$statusTexts[404],
                            ),
                            Response::HTTP_OK,
                            ['Content-Type', 'application/json']
                        );
                    }
                }
            }
        }
        $this->response->send();
    }
    public function onLoadCartEventHandler() {
        if($this->cart->contents()) {
            $this->response = new Response(
                array(
                    'data' => $this->cart->contents(),
                    'count' => count($this->cart->contents()),
                    'statusCode' => Response::HTTP_OK,
                    'message' => Response::$statusTexts[200],
                ),
                Response::HTTP_OK,
                ['Content-Type', 'application/json']
            );
        } else {
            $this->response = new Response(
                array(
                    'data' => [],
                    'count' => 0,
                    'statusCode' => Response::HTTP_NOT_FOUND,
                    'message' => Response::$statusTexts[404],
                ),
                Response::HTTP_OK,
                ['Content-Type', 'application/json']
            );
        }
       $this->response->send();
    }
    public function onClickCartEmptyEventHandler() {
        if($this->cart->contents()) {
            $this->cart->destroy();
            $this->unsetSession('shippingAddress');
            $this->unsetSession('billingAddress');
            $this->response = new Response(
                array(
                    'data' => $this->cart->contents(),
                    'count' => count($this->cart->contents()),
                    'statusCode' => Response::HTTP_OK,
                    'message' => 'Cart is empty!',
                ),
                Response::HTTP_OK,
                ['Content-Type', 'application/json']
            );
        } else {
            $this->response = new Response(
                array(
                    'data' => [],
                    'count' => 0,
                    'statusCode' => Response::HTTP_NOT_FOUND,
                    'message' => Response::$statusTexts[404],
                ),
                Response::HTTP_OK,
                ['Content-Type', 'application/json']
            );
        }
        $this->response->send();
    }
    public function addToCart() {
        if($this->isPost()) {
            $this->setRequest($_REQUEST);
            if($this->cart->insert($this->request)) {
                //$this->setCartItems();
                $this->response = new Response(
                    array(
                        'data' => $this->getCartItems(),
                        'count' => count($this->cart->contents()),
                        'statusCode' => Response::HTTP_OK,
                        'message' => Response::$statusTexts[200],
                    ),
                    Response::HTTP_OK,
                    ['Content-Type', 'application/json']
                );
            } else {
                $this->response = new Response(
                    array(
                        'data' => [],
                        'count' => 0,
                        'statusCode' => Response::HTTP_NOT_FOUND,
                        'message' => Response::$statusTexts[404],
                    ),
                    Response::HTTP_OK,
                    ['Content-Type', 'application/json']
                );
            }
        } else {
            $this->response = new Response(
                array(
                    'data' => [],
                    'statusCode' => Response::HTTP_METHOD_NOT_ALLOWED,
                    'message' => Response::$statusTexts[405],
                ),
                Response::HTTP_OK,
                ['Content-Type', 'application/json']
            );
        }
        $this->response->send();
    }
    public function setCartItems() {
        $this->cartItems =  ($this->cart->contents()) ? $this->cart->contents() : [];
        return $this;
    }
    public function getCartItems() {
        $this->cartItems =  ($this->cart->contents()) ? $this->cart->contents() : [];
        return $this->cartItems;
    }
    public function saveBillingShippingAddress(){
        if($this->input->post()){
            $billingAddress = array(
                "name" => $this->input->post('billingName'),
                "addOne" => $this->input->post('billingAddOne'),
                "addTwo" => $this->input->post('billingAddTwo'),
                "city" => $this->input->post('billingCity'),
                "state" => $this->input->post('billingState'),
                "zip" => $this->input->post('billingZip'),
                "country" => $this->input->post('billingCountry')
            );
            $this->session->set_userdata('billingAddress', $billingAddress);
            if($this->input->post('shiping') == 'checked'){
                $shippingAddress = array(
                    "name" => $this->input->post('shippingName'),
                    "addOne" => $this->input->post('shippingAddOne'),
                    "addTwo" => $this->input->post('shippingAddTwo'),
                    "city" => $this->input->post('shippingCity'),
                    "state" => $this->input->post('shippingState'),
                    "zip" => $this->input->post('shippingZip'),
                    "country" => $this->input->post('shippingCountry')
                );
            }else{
                $shippingAddress = $billingAddress;
            }
            $this->session->set_userdata('shippingAddress', $shippingAddress);

            print_r($billingAddress);
        }
    }
    public function redirectingToPayment(){
        $data['banners'] = $this->getBannerDetails();
        $data['partner'] = $this->getBrandDetails();
        $data['frames'] = $this->getFrameDetails();
        $data['webManage'] = $this->getContactDetails();
        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/pages/redirecting-to-payment');
        $this->load->view('frontend/layout/footer');
    }
    public function getCartData() {
        if($this->hasCartData) {
            $this->cartData =  $this->cart->contents();
        }
        return $this->cartData;
    }
    
    public function setOrder($order) {
        $this->order = $order;
        return $this;
    }
    public function setOrderAttributes($orderAttributes) {
        $this->orderAttributes = $orderAttributes;
        return $this;
    }
    public function setOrderColors($orderColors) {
        $this->orderColors = $orderColors;
        return $this;
    }
    public function setOrderLensTints($orderLensTints) {
        $this->orderLensTints = $orderLensTints;
        return $this;
    }
    public function setOrderPrescription($orderPrescription) {
        $this->orderPrescription = $orderPrescription;
        return $this;
    }
    public function setOrderPrescriptionDetails($orderPrescriptionDetails) {
        $this->orderPrescriptionDetails = $orderPrescriptionDetails;
        return $this;
    }
    public function setOrderPrescriptionPrism($orderPrescriptionPrism) {
        $this->orderPrescriptionPrism = $orderPrescriptionPrism;
        return $this;
    }
    public function setOrderUser($user) {
        $this->user = $user;
        return $this;
    }
    public function setTransaction($transaction) {
        $this->transaction = $transaction;
    }
    public function setPayerId($payerId) {
        $this->payerId = $payerId;
    }
    public function setTransactionId($transactionId) {
        $this->transactionId = $transactionId;
    }
    public function setPaymentStatus($paymentStatus) {
        $this->paymentStatus = $paymentStatus;
    }
    public function saveOrderToDatabase() {
        /*
        if($this->isPost()) 
        {
            $this->setRequest($this->request);
            if(!empty($this->request) || isset($this->request)) {

                if(!empty($this->request['payer_id']) || isset($this->request['payer_id'])) {
                    $this->setPayerId($this->request['payer_id']);
                }
                if(!empty($this->request['txn_id']) || isset($this->request['txn_id'])) {
                    $this->setTransactionId($this->request['txn_id']);
                }
                if(!empty($this->request['payment_status']) || isset($this->request['payment_status'])) {
                    $this->setPaymentStatus($this->request['payment_status']);
                }

                $userData = $this->userdata();

                if(!empty($userData) || isset($userData)) {

                        if(!empty($userData['user']) || isset($userData['user'])) {
                            $this->setUser($userData['user']);
                        }
                        if(!empty($userData['billingAddress']) || isset($userData['billingAddress'])) {
                            $this->setBillingAddress($userData['billingAddress']);
                        }
                        if(!empty($userData['shippingAddress']) || isset($userData['shippingAddress'])) {
                            $this->setShippingAddress($userData['shippingAddress']);
                        }
                        
                }
                if($this->payerId) {

                }

                if($this->cartData) {
                    foreach($this->cartData as $rowId => $data) {
                        $this->order = array(
                            'name' => $data['name']
                        );
                    }
                }

            }
            
        }
        */
    }
    public function paymentSuccess(){
        $this->saveOrder();
        $this->cart->destroy();
        $this->unsetSession('shippingAddress');
        $this->unsetSession('billingAddress');
        $data['banners'] = $this->getBannerDetails();
        $data['partner'] = $this->getBrandDetails();
        $data['frames'] = $this->getFrameDetails();
        $data['webManage'] = $this->getContactDetails();
        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/pages/payment-success');
        $this->load->view('frontend/layout/footer');
    }
    public function paymentCancel(){
        $data['banners'] = $this->getBannerDetails();
        $data['partner'] = $this->getBrandDetails();
        $data['frames'] = $this->getFrameDetails();
        $data['webManage'] = $this->getContactDetails();
        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/pages/payment-cancel');
        $this->load->view('frontend/layout/footer');
    }

    public function saveOrder() {
        if($this->cart->contents()) {
            foreach($this->cart->contents() as $cart) {
                $data = array(
                    'content'=> json_encode($cart),
                );
                $this->db->insert('temp', $data);
            }
        }
        return true;
    }



}
