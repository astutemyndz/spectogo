<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Http\Response;
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
            // Remove Cart
            if($this->isPost()) {
                $this->setRequest($_REQUEST);
                if(!empty($this->request) || isset($this->request)) {
                    $data = array(
                        'rowid'   => ($this->request['rowId']) ? $this->request['rowId'] : '',
                        'qty'     => 0
                    );
                    echo "<pre>";
                    print_r($data);
                    exit;
            
                    $this->cart->update($data);
                }
                // $this->response = new Response(
                //     array(
                //         'data' => $this->cart->contents(),
                //         'count' => count($this->cart->contents()),
                //         'statusCode' => Response::HTTP_OK,
                //         'message' => Response::$statusTexts[200],
                //     ),
                //     Response::HTTP_OK,
                //     ['Content-Type', 'application/json']
                // );
              
            }
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
   
    
	
}
