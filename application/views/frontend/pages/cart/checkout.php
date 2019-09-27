<?php
$subTotal = 0;
if(!empty($this->cart->contents())){
  foreach($this->cart->contents() as $cart){
    $subTotal += $cart['subtotal'];
  }
}
?>
<div id="main" class="content_section bg-secondary pt-4">
  <div class="container">
  	<div class="row">
      <div class="col-12">
        <h4 class="text-center font-weight-bold mb-4">Checkout</h4>
      </div>
    </div>
    <div class="row">
      
        <div class="col-sm-8">
          <div class="checkout-area">
            <div class="account-form-area checkout-details checkout-first">
              <h3>1. Billing Address <i class="fa fa-check-circle"></i></h3>
              <form id="checkOutForm">
              <div class="form-group">
                <label>Full Name</label>
                <input type="text" value="<?php if($this->session->userdata('billingAddress')) { print $this->session->userdata('billingAddress')['name']; } ?>" class="form-control requiredCheck" name="billingName" id="" data-check="Billing Full Name">
              </div>
              <div class="form-group">
                <label>Address Line 1</label>
                <input type="text" value="<?php if($this->session->userdata('billingAddress')) { print $this->session->userdata('billingAddress')['addOne']; } ?>" class="form-control requiredCheck" name="billingAddOne" id="" data-check="Billing Address Line 1">
              </div>
              <div class="form-group">
                <label>Address Line 2</label>
                <input type="text" value="<?php if($this->session->userdata('billingAddress')) { print $this->session->userdata('billingAddress')['addTwo']; } ?>" class="form-control" name="billingAddTwo" id="billingAddTwo">
              </div>
              <div class="form-row">
                <div class="form-group col-sm-6">
                  <label>Town/City</label>
                  <input type="text" value="<?php if($this->session->userdata('billingAddress')) { print $this->session->userdata('billingAddress')['city']; } ?>" class="form-control requiredCheck" name="billingCity" id="" data-check="Billing City">
                </div>
                <div class="form-group col-sm-6">
                  <label>County/State</label>
                  <input type="text" value="<?php if($this->session->userdata('billingAddress')) { print $this->session->userdata('billingAddress')['state']; } ?>" class="form-control requiredCheck" name="billingState" id="" data-check="Billing State">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-sm-6">
                  <label>Post Code/Zip</label>
                  <input type="text" value="<?php if($this->session->userdata('billingAddress')) { print $this->session->userdata('billingAddress')['zip']; } ?>" class="form-control requiredCheck" name="billingZip" id="" data-check="Billing Zip">
                </div>
                <div class="form-group col-sm-6">
                  <label>Country</label>
                  <select class="form-control requiredCheck" name="billingCountry" id="" data-check="Billing Country">
                    <option value="">Select Country</option>
                    <option value="UK" <?php if($this->session->userdata('billingAddress')) { if($this->session->userdata('billingAddress')['country'] == 'UK'){ print 'selected';}} ?>>UK</option>
                    <option value="USA" <?php if($this->session->userdata('billingAddress')) { if($this->session->userdata('billingAddress')['country'] == 'USA'){ print 'selected';}} ?>>USA</option>
                  </select>
                </div>
              </div>
              <div class="custom-control custom-checkbox checkbox-check">
                <input type="checkbox" class="custom-control-input" value="unchecked" name="shiping" id="shiping">
                <label class="custom-control-label" for="shiping">SHIP TO A DIFFERENT ADDRESS?</label>
              </div>
            </div>
            <div class="account-form-area checkout-details checkout-first shipping-address d-none">
              <h3>2. Delivery Address <i class="fa fa-check-circle"></i></h3>
              <div class="form-group">
                <label>Full Name</label>
                <input type="text" value="<?php if($this->session->userdata('shippingAddress')) { print $this->session->userdata('shippingAddress')['name']; } ?>" class="form-control" name="shippingName" id="shippingName" data-check="Shipping Name">
              </div>      	
              <div class="form-group">
                <label>Address Line 1</label>
                <input type="text" value="<?php if($this->session->userdata('shippingAddress')) { print $this->session->userdata('shippingAddress')['addOne']; } ?>" class="form-control" name="shippingAddOne" id="shippingAddOne" data-check="Shipping Address 1">
              </div>
              <div class="form-group">
                <label>Address Line 2</label>
                <input type="text" value="<?php if($this->session->userdata('shippingAddress')) { print $this->session->userdata('shippingAddress')['addTwo']; } ?>" class="form-control" name="shippingAddTwo" id="shippingAddTwo">
              </div>
              <div class="form-row">
                <div class="form-group col-sm-6">
                  <label>Town/City</label>
                  <input type="text" value="<?php if($this->session->userdata('shippingAddress')) { print $this->session->userdata('shippingAddress')['city']; } ?>" class="form-control" name="shippingCity" id="shippingCity" data-check="Shipping City">
                </div>
                <div class="form-group col-sm-6">
                  <label>County/State</label>
                  <input type="text" value="<?php if($this->session->userdata('shippingAddress')) { print $this->session->userdata('shippingAddress')['state']; } ?>" class="form-control" name="shippingState" id="shippingState" data-check="Shipping State">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-sm-6">
                  <label>Post Code/Zip</label>
                  <input type="text" value="<?php if($this->session->userdata('shippingAddress')) { print $this->session->userdata('shippingAddress')['zip']; } ?>" class="form-control" name="shippingZip" id="shippingZip" data-check="Shipping Zip">
                </div>
                <div class="form-group col-sm-6">
                  <label>Country</label>
                  <select class="form-control" name="shippingCountry" id="shippingCountry" data-check="Shipping Country">
                  <option value="">Select Country</option>
                    <option value="UK" <?php if($this->session->userdata('shippingAddress')) { if($this->session->userdata('shippingAddress')['country'] == 'UK'){ print 'selected';}} ?>>UK</option>
                    <option value="USA" <?php if($this->session->userdata('shippingAddress')) { if($this->session->userdata('shippingAddress')['country'] == 'USA'){ print 'selected';}} ?>>USA</option>
                  </select>
                </div>
              </div>     
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="checkout-details">
            <div class="payment-form">
              <div class="payment-option">
                <div class="custom-control custom-checkbox checkbox-check">
                    <input type="checkbox" class="custom-control-input" id="checkPaypal">
                    <label class="custom-control-label" for="checkPaypal">Paypal</label>
                    <img src="img/payple.png" class="img-fluid payment-option-image payple-image pull-right" alt=""/>
                </div>  
                <div class="payple-area p-3">
                <p>You are about to make a Payment of &pound;<?=$subTotal?></p>
                  <button class="subscribe btn btn-primary btn-block" id="paypal-submit" type="submit" disabled> Make a Payment </button>
                </div>
              </div>
            </div>
          </div>      
        </div>
      </form>
    </div>
  </div>
</div>
<script>page = 'cart';</script>