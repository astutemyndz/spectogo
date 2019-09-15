<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
    }  
	
    //cart listing
    public function index(){
        
        $data = array();
        $data['title'] = "Shopping Cart | shorolafashion.com";       
        
        if(isset($_COOKIE[CART_COOKIE_NAME]) && !empty($_COOKIE[CART_COOKIE_NAME])){
            
            $cookie = stripslashes($_COOKIE[CART_COOKIE_NAME]);
            $savedCartArray = json_decode($cookie, true);                
            $cookie_cart_id = $savedCartArray['cookie_cart_id'];
            
            /*SELECT c.id,p.name,p.slug,p.primary_image,p.sell_price,p.set_discount,p.discount_percentage,c.product_id,c.quantity,ps.name size,pc.name color
            FROM product_cart c
            join products p on c.product_id = p.id
            join product_variations pv on c.product_variation_id = pv.id
            join product_sizes ps on pv.size_id = ps.id
            join product_colors pc on pv.color_id = pc.id
            WHERE c.cookie_cart_id*/
            
            $data['cart_details'] = GetUserCartDetailsByCartId($cookie_cart_id);
        }
        $this->load->view('frontend/cart_listing',$data);
    }
    /*
        Product add to cart
    */
    public function add_to_cart_product_variation(){
        
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            
            /*unset($_COOKIE[$this->CART_COOKIE_NAME]);
            setcookie($this->CART_COOKIE_NAME, "", time() - 3600, "/");
            exit;*/
            
            $product_id = $this->input->post('product_id');
            $product_size = $this->input->post('product_size');
            $product_color = $this->input->post('product_color');
            if($product_id && $product_size && $product_color){
                if(!$product_size){
                    echo json_encode(array('success'=> false, 'message'=> 'Please select product variation.')); die();
                }
                
                if(!$this->cm->select_row('products', ['id' => $product_id, 'status'=> '1'], 'id')){
                    echo json_encode(array('success'=> false, 'message'=> 'Sorry, the requested product is not available')); die();
                }
                
                /*
                    Save cart data to database when user is login
                */
                if(isset($_COOKIE[CART_COOKIE_NAME]) && !empty($_COOKIE[CART_COOKIE_NAME])){
                
                    $cookie = stripslashes($_COOKIE[CART_COOKIE_NAME]);
                    $savedCartArray = json_decode($cookie, true);
                    $cookie_cart_id = $savedCartArray['cookie_cart_id'];
                    $product_variation_id = $this->cm->select_row('product_variations', ['product_id'=> $product_id, 'size_id'=> $product_size, 'color_id'=> $product_color], 'id');
                    //get cart table data
                    $cart_variation = $this->cm->select_row('product_cart', [
                        'cookie_cart_id' => $cookie_cart_id,
                        'product_id' => $product_id,
                        'product_variation_id' => $product_variation_id['id']
                    ], 'id,product_id,product_variation_id,quantity');
                    if(!empty($cart_variation)){
                        
                        $add_quantity = $cart_variation['quantity'] + 1;
                        //get product details and check product stock
                        $product_details = $this->cm->select_row('products', ['id'=> $product_id], 'id,name,slug,purchase_quantity');
                        if($product_details['purchase_quantity'] < $add_quantity){
                            echo json_encode(array('success'=> true, 'message'=> "no more stock", 'redirect'=> 'yes')); die();
                        }
                        
                        //update quantity cart data
                        $update_status = $this->cm->update('product_cart', ['id'=> $cart_variation['id']], ['quantity' => $cart_variation['quantity'] + 1]);
                        if(!$update_status){
                            echo json_encode(array('success'=> false, 'message'=> 'Faild to add in cart.')); die();
                        }
                        echo json_encode(array('success'=> true, 'message'=> 'Successfully added in cart.', 'redirect'=> 'yes')); die();
                    } else {
                        //insert cart data
                        $insert_status = $this->cm->insert('product_cart', [
                            'cookie_cart_id' => $cookie_cart_id,
                            'product_id' => $product_id,
                            'product_variation_id' => $product_variation_id['id'],
                            'quantity' => 1
                        ]);
                        if(!$insert_status){
                            echo json_encode(array('success'=> false, 'message'=> 'Faild to add in cart.')); die();
                        }
                        echo json_encode(array('success'=> true, 'message'=> 'Successfully added in cart.', 'redirect'=> 'yes')); die();
                    }

                } else {
                    /*
                        Save cart data to database when user not login
                    */
                    $cookie_cart_id = uniqid().''.time();
                    $product_variation = $this->cm->select_row('product_variations', ['product_id'=> $product_id, 'size_id'=> $product_size, 'color_id'=> $product_color], 'id');
                    if($product_variation){
                        $json = json_encode(['cookie_cart_id' => $cookie_cart_id]);
                        setcookie(CART_COOKIE_NAME, $json, time() + (30*24*60*60), "/"); 

                        $insert_status = $this->cm->insert('product_cart', [
                            'cookie_cart_id' => $cookie_cart_id,
                            'product_id' => $product_id,
                            'product_variation_id' => $product_variation['id'],
                            'quantity' => 1
                        ]);
                        if(!$insert_status){
                            echo json_encode(array('success'=> false, 'message'=> 'Faild to add in cart.')); die();
                        }
                        echo json_encode(array('success'=> true, 'message'=> 'Successfully added in cart.', 'redirect'=> 'yes')); die();
                    } else {
                        echo json_encode(array('success'=> false, 'message'=> 'Sorry, the requested product is not available')); die();
                    }                    
                }
            }                      
            
        }
    }
    
    /*
        Update cart product quantity
    */
    public function update_cart_product_quantity(){
        
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if(isset($_COOKIE[CART_COOKIE_NAME]) && !empty($_COOKIE[CART_COOKIE_NAME])){
                
                $cookie = stripslashes($_COOKIE[CART_COOKIE_NAME]);
                $savedCartArray = json_decode($cookie, true);                
                $cookie_cart_id = $savedCartArray['cookie_cart_id'];
                
                $actual_qty = (int)$this->input->post('actual_qty');
                $product_id = $this->input->post('product_id');
                $cart_id = $this->input->post('cart_id');
                
                if($cart_id && $product_id){
                    //get product details and check product stock
                    $product_details = $this->cm->select_row('products', ['id'=> $product_id], 'id,name,slug,purchase_quantity');
                    if(strlen($actual_qty) > 1 || $actual_qty > 5){
                        echo json_encode(array('success'=> false, 'message'=> "We're sorry! Only 5 units of ".$product_details['name']." for each customer.")); die();
                    } elseif($product_details['purchase_quantity'] < $actual_qty){
                        echo json_encode(array('success'=> false, 'message'=> "You can buy only up to ".($actual_qty-1)." unit(s) of this product")); die();
                    }
                    
                    //update cart product quantity
                    if($actual_qty < 1){
                        $product_qty = 1;
                    } else {
                        $product_qty = $actual_qty;
                    }
                    $update_status = $this->cm->update('product_cart', ['id'=> $cart_id], ['quantity'=> $product_qty]);
                    if(!$update_status){
                        echo json_encode(array('success'=> false, 'message'=> "We can't update this item quantity to your cart12")); die();
                    }
                    //Get update cart price summery
                    $cart_html = '';
                    $get_cart_details = GetUserCartDetailsByCartId($cookie_cart_id);
                    if(!empty($get_cart_details)){
                        $data['cart_details'] = $get_cart_details;
                        $cart_html = $this->load->view('frontend/ajax/cart_price_update', $data, TRUE);
                    }
                    echo json_encode(array('success'=> true, 'message'=> 'Successfully update cart', 'html'=> $cart_html)); die();
                } else {
                    echo json_encode(array('success'=> false, 'message'=> 'Faild to update cart quantity.')); die();
                }
            } else {
                echo json_encode(array('success'=> false, 'message'=> "We can't update this item quantity to your cart")); die();
            }
        }
    }
    
    /*
      Product remove from cart  
    */
    public function remove_product_from_cart(){
        
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            
            if(isset($_COOKIE[CART_COOKIE_NAME]) && !empty($_COOKIE[CART_COOKIE_NAME])){
                $cookie = stripslashes($_COOKIE[CART_COOKIE_NAME]);
                $savedCartArray = json_decode($cookie, true);                
                $cookie_cart_id = $savedCartArray['cookie_cart_id'];
                
                $cart_id = $this->input->post('cart_id');
                $product_id = $this->input->post('product_id');
                $cart_status = $this->cm->select_row('product_cart', ['id'=> $cart_id, 'cookie_cart_id' => $cookie_cart_id], 'id');
                if($cart_status){
                    $remove_status = $this->cm->delete('product_cart', ['id'=> $cart_id, 'cookie_cart_id' => $cookie_cart_id]);
                    if(!$remove_status){
                        echo json_encode(array('success'=> false, 'message'=> 'Faild to remove from cart.')); die();
                    }
                    
                    //Get update cart price summery
                    $cart_is_empty = 'YES';
                    $cart_html = '';
                    $get_cart_details = GetUserCartDetailsByCartId($cookie_cart_id);
                    if(!empty($get_cart_details)){
                        $cart_is_empty = 'NO';
                        $data['cart_details'] = $get_cart_details;
                        $cart_html = $this->load->view('frontend/ajax/cart_price_update', $data, TRUE);
                    }
                    
                    echo json_encode(array('success'=> true, 'message'=> 'Successfully removed from your cart.', 'html'=> $cart_html, 'cart_is_empty'=> $cart_is_empty)); die();
                } else {
                    echo json_encode(array('success'=> false, 'message'=> "We can't remove this item to your cart right now")); die();
                }                
            } else {
                echo json_encode(array('success'=> false, 'message'=> "We can't remove this item to your cart right now")); die();
            }
        }
    }
    
    /*
        Before Cheking Place order
    */
    public function before_cheking_place_order(){
        
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            
            if(isset($_COOKIE[CART_COOKIE_NAME]) && !empty($_COOKIE[CART_COOKIE_NAME])){
                $cookie = stripslashes($_COOKIE[CART_COOKIE_NAME]);
                $savedCartArray = json_decode($cookie, true);                
                $cookie_cart_id = $savedCartArray['cookie_cart_id'];
                //get user cart details
                $user_cart_details = GetUserCartDetailsByCartId($cookie_cart_id);
                if(!empty($user_cart_details)){
                    //print_r($user_cart_details);
                    $has_error = array();
                    foreach($user_cart_details as $cart){
                        if(strlen($cart['quantity']) > 1 || $cart['quantity'] > 5){
                            array_push($has_error, "We're sorry! Only 5 units of ".$cart['name']." for each customer.");
                        } elseif($cart['purchase_quantity'] < 1 || $cart['purchase_quantity'] == 0){
                            array_push($has_error, $cart['name']." is out-of-stock please remove from your cart");
                        } elseif($cart['purchase_quantity'] < $cart['quantity']){
                            array_push($has_error, "You can buy only up to ".$cart['purchase_quantity']." unit(s) of ".$cart['name']);
                        } 
                    }

                    if(!empty($has_error)){
                        $return_error = '';
                        foreach($has_error as $error){
                            $return_error .= '<span><i class="fa fa-times" aria-hidden="true"></i> '.$error.'</span><br>';
                        }
                        echo json_encode(array('success'=> false, 'message'=> $return_error)); die();
                    } else {
                        echo json_encode(array('success'=> true, 'message'=> 'no error')); die();
                    }
                }
            }
        }
    }
    
    
}
?>