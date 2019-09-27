<?php
$subTotal = 0;
if(!empty($this->cart->contents())){
  foreach($this->cart->contents() as $cart){
    $subTotal += $cart['subtotal'];
  }
}
define('PAYPAL_ID', 'rakeshmaity271-facilitator@gmail.com'); 
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");
?>
<div id="main" class="content_section bg-secondary pt-4">
    <div class="container" style="margin-top: 115px;">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>Please Wait !!! You're current being redirected to Payment Section !!!</h3>
                <img src="<?=base_url('assets/images/loader.gif')?>">
                <form action="<?=PAYPAL_URL?>" method="post" id="paymentForm">
                    <!-- Identify your business so that you can collect the payments. -->
                    <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">
                    <!-- Specify a Buy Now button. -->
                    <input type="hidden" name="cmd" value="_xclick">
                    <!-- Specify details about the item that buyers will purchase. -->
                    <input type="hidden" name="item_name" value="Temp321">
                    <input type="hidden" name="item_number" value="Temp123">
                    <input type="hidden" name="amount" value="<?=$subTotal?>">
                    <input type="hidden" name="currency_code" value="GBP">
                    <!-- Specify URLs -->
                    <input type="hidden" name="return" value="<?=base_url('payment-success')?>">
                    <input type="hidden" name="cancel_return" value="<?=base_url('payment-cancel')?>">
                </form>
            </div>
        </div>
    </div>
</div>
<script>page = 'reditect-to-payment';</script>
