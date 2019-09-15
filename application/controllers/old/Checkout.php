<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }  
	/*
        checkout init
    */
    public function index(){ 
        
        if(isset($_COOKIE[LOGIN_COOKIE_NAME]) && !empty($_COOKIE[LOGIN_COOKIE_NAME])){
            
            //redirect to activation page if user not verified there profile
            if(GetUserDetailsById(GetUserId())['account_verified'] == 'No'){
                redirect(base_url().'profile/activation');
            }
            
            $data = array();
            $data['title'] = "Select Shipping Address > Review Order > Place Order | shorolafashion.com";

            if(isset($_COOKIE[CART_COOKIE_NAME]) && !empty($_COOKIE[CART_COOKIE_NAME])){
                $cookie = stripslashes($_COOKIE[CART_COOKIE_NAME]);
                $savedCartArray = json_decode($cookie, true);                
                $cookie_cart_id = $savedCartArray['cookie_cart_id'];
                //get user cart details
                $user_cart_details = GetUserCartDetailsByCartId($cookie_cart_id);
                if(!empty($user_cart_details)){
                    $data['order_summery'] = $user_cart_details;
                }
            } else {
                redirect(base_url().'my-cart');
            }

            /*$data['user_address'] = $this->cm->select('user_addresses a', ['a.user_id'=> GetUserId()], '', 'a.id', 'desc');*/
            
            $join[] = ['table' => 'user_countries uc', 'on' => 'a.country_id = uc.id', 'type' => 'inner'];
            $join[] = ['table' => 'user_states us', 'on' => 'a.state_id = us.id', 'type' => 'left'];
            $join[] = ['table' => 'user_cities uci', 'on' => 'a.city_id = uci.id', 'type' => 'left'];
            $data['user_address'] = $this->cm->select('user_addresses a', ['a.user_id'=> GetUserId()], 'a.*,uc.name country_name, uc.sortname, us.name state_name,uci.name city_name', 'a.id', 'desc', $join);
            $this->load->view('frontend/checkout',$data);
        } else {            
            redirect(base_url().'user/login?return_to='.urlencode(current_url()));
        }
    }
        
    /*
        REceive checkout form data
    */
    public function receive_checkout_form_data(){
        
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {            
            if(isset($_COOKIE[LOGIN_COOKIE_NAME]) && !empty($_COOKIE[LOGIN_COOKIE_NAME])){
                
                //redirect to activation page if user not verified there profile
                if(GetUserDetailsById(GetUserId())['account_verified'] == 'No'){
                    echo json_encode(array('success'=> false, 'message'=> "Please verify your profile", 'verify'=> false, 'url'=> urlencode(base_url('profile/activation')))); die();
                }
                //post data
                $ord_delivery_address = $this->input->post('ord_delivery_address', true);
                $ord_payment_mode = $this->input->post('ord_payment_mode', true);
                if(!$ord_delivery_address){
                    echo json_encode(array('success'=> false, 'message'=> "Please select delivery address", 'tab'=> 1)); die();
                }
                if(!$ord_payment_mode){
                    echo json_encode(array('success'=> false, 'message'=> "Please select payment option", 'tab'=> 3)); die();
                }
                //get cart data
                if(isset($_COOKIE[CART_COOKIE_NAME]) && !empty($_COOKIE[CART_COOKIE_NAME])){
                    $cookie = stripslashes($_COOKIE[CART_COOKIE_NAME]);
                    $cookie_cart_id = json_decode($cookie, true)['cookie_cart_id'];
                    //get user cart details
                    $user_cart_details = GetUserCartDetailsByCartId($cookie_cart_id);
                    if(!empty($user_cart_details)){
                        
                        /*echo '<pre>';
                        print_r($user_cart_details); die;*/
                        
                        $order_no = 'ORDSF'.time();
                        if($ord_payment_mode == 'ord_cod'){
                            $pay_moed = 'COD';
                        } else {
                            $pay_moed = 'PAYPAL';
                            //this message not needed when paypal is working fine it is just for testing.
                            echo json_encode(array('success'=> false, 'message'=> "Paypal is not integration here just for testing.", 'tab'=> 3)); die();
                        }
                        //get user delivery address
                        $adJoin[] = ['table' => 'user_countries c', 'on' => 'a.country_id = c.id', 'type' => 'inner'];
                        $adJoin[] = ['table' => 'user_states s', 'on' => 'a.state_id = s.id', 'type' => 'left'];
                        $adJoin[] = ['table' => 'user_cities cc', 'on' => 'a.city_id = cc.id', 'type' => 'left'];
                        $delivery_address = $this->cm->select_row('user_addresses a', ['a.id'=> $ord_delivery_address, 'a.user_id'=> GetUserId()], 'a.id,a.name,a.phone,a.address,a.landmark,a.address_type,c.name country,c.sortname,s.name state,cc.name city', $adJoin);
                        //Create order array and ready to insert
                        $in_order = [
                            'user_id'=> GetUserId(),
                            'order_no' => $order_no,
                            'payment_mode' => $pay_moed,
                            'total_amount' => 0.00,
                            'payment_status' => 'Pending',
                            'order_status' => 'Pending',
                            'delivery_address' => json_encode($delivery_address)
                        ];
                        $CREATE_ORDER = $this->cm->insert('user_orders', $in_order);
                        if(!$CREATE_ORDER){
                            //if not created successfully order
                            $this->cm->update('user_orders', ['id'=> $CREATE_ORDER], ['order_status'=> 3]);
                            echo json_encode(array('success'=> false, 'message'=> "Sorry Your order cannot be completed at this time. Please try again.", 'tab'=> 3)); die();
                        }
                        //if order created successfully then check unique order no
                        if($this->cm->select_row('user_orders', ['id !='=> $CREATE_ORDER,'order_no'=> $order_no], 'id')){
                            //update order no
                            $this->cm->update('user_orders', ['id'=> $CREATE_ORDER], ['order_no'=> $order_no.$CREATE_ORDER]);
                        }
                        //Create order details and ready to insert
                        $total_amount_in_order = 0.00;
                        $in_order_details = [];
                        foreach($user_cart_details as $cart_data){
                            
                            $total_price = $cart_data['sell_price'];
                            $discount_price = '';
                            if($cart_data['set_discount'] == 'Yes' && $cart_data['discount_percentage'] > 0){ 
                                $total_price = $cart_data['sell_price']- (($cart_data['sell_price'] * $cart_data['discount_percentage']) / 100);
                                $discount_price = $cart_data['sell_price']- (($cart_data['sell_price'] * $cart_data['discount_percentage']) / 100);
                            }
                            $total_amount_in_order += $total_price * $cart_data['quantity'];
                            //create order details array
                            $in_order_details[] = [
                                'order_id' => $CREATE_ORDER,
                                'product_id' => $cart_data['product_id'],
                                'product_size' => $cart_data['size'],
                                'product_color' => $cart_data['color'],
                                'quantity' => $cart_data['quantity'],
                                'sell_price' => $cart_data['sell_price'],
                                'discount_percentage' => $cart_data['discount_percentage'],
                                'discount_price' => $discount_price,
                                'status' => 0
                            ];
                        }
                        //if order details array is not empty
                        if($in_order_details){
                            $CREATE_ORDER_DETAILS = $this->db->insert_batch('user_order_details', $in_order_details);
                            if(!$CREATE_ORDER_DETAILS){
                                //order cannot be completed.
                                $this->cm->update('user_orders', ['id'=> $CREATE_ORDER], ['order_status'=> 3]);
                                echo json_encode(array('success'=> false, 'message'=> "Sorry Your order cannot be completed at this time. Please try again.", 'tab'=> 3)); die();
                            }
                            //update total amount in order table
                            $this->cm->update('user_orders', ['id'=> $CREATE_ORDER], ['total_amount'=> $total_amount_in_order]);
                            //if order created successfully
                            foreach($user_cart_details as $cart_data){
                                //get product data
                                $product_data = $this->cm->select_row('products', ['id'=> $cart_data['product_id']], 'id,purchase_quantity');
                                //update current stock
                                $this->cm->update('products', ['id'=> $cart_data['product_id']], ['purchase_quantity'=> $product_data['purchase_quantity']-$cart_data['quantity']]);
                                //create stock log                                
                                $this->cm->insert('product_stock_log', [
                                    'product_id' => $cart_data['product_id'],
                                    'previous_stock' => $product_data['purchase_quantity'],
                                    'new_stock' => $cart_data['quantity'],
                                    'current_stock' => $product_data['purchase_quantity']-$cart_data['quantity'],
                                    'status' => 'OUT',
                                    'remarks' => 'Order Success with Order ID '.$order_no
                                ]);                                
                            }
                            //get current order details
                            $current_ord_dtls = $this->cm->select('user_order_details', ['order_id'=> $CREATE_ORDER], 'id');
                            if($current_ord_dtls){
                                foreach($current_ord_dtls as $cur){
                                    //create order log
                                    $this->cm->insert('user_order_logs', ['order_id'=> $CREATE_ORDER, 'order_details_id'=> $cur['id'], 'status'=> 0]);
                                }
                            }
                            //remove item from cart
                            unset($_COOKIE[CART_COOKIE_NAME]);
                            setcookie(CART_COOKIE_NAME, "", time() - 3600, "/");
                            //update order status is success
                            $this->cm->update('user_orders', ['id'=> $CREATE_ORDER], ['order_status'=> 2]);
                            echo json_encode(array('success'=> true, 'message'=> "successfully your order")); die();
                        } else {
                            //update order status is faild
                            $this->cm->update('user_orders', ['id'=> $CREATE_ORDER], ['order_status'=> 3]);
                            echo json_encode(array('success'=> false, 'message'=> "Sorry Your order cannot be completed at this time. Please try again.", 'tab'=> 3)); die();
                        }
                    }
                } else {
                    //if user cart is empty
                    echo json_encode(array('success'=> false, 'message'=> "Your cart is empty!", 'tab'=> 3)); die();
                }
            } else {
                echo json_encode(array('success'=> false, 'message'=> "", 'login'=> false, 'current_url'=> urlencode(base_url('checkout')))); die();
            }
        }
    }
}
?>