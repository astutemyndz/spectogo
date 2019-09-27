<div id="cart" class="content_section bg-secondary pt-4">
    <div class="container">
  		<div class="row">
        	<div class="col-12">
            	 <h4 class="text-center font-weight-bold mt-0">Your Cart</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="cart-area">
                    <table class="table">
                        <tbody id="cartItems">
                            <!--Cart Item Component-->
                            <tr height="10"></tr>
                        </tbody>
                    </table>
                    <div class="shoping-continue">
                        <a href="<?=base_url()?>">Continue Shoping..</a>
                    </div>
                </div>  
            </div>
            <div class="col-sm-4">
                <div class="cart-total" >
                  <div id="cartSummery"></div>
                    <!--Cart Summery Component-->
                    <!--Checkout Button Component-->
                    <a href="<?=base_url('cart/checkout')?>">
                        <button type="button" class="checkout-btn d-none">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Proceed to Checkout
                        </button>
                    </a>
                </div>
                <div class="apply-coupon">
                    <table class="table table-borderless">
                      <!--Apply Coupon Code Component-->
                    </table>
                </div>
                <div class="accept-card-view">
                    <p>At Checkout We Accept:</p>
                    <img src="<?php echo base_url('assets/images/accept_cards.png');?>" class="img-fluid"/>
                </div>
            </div>
        </div>
    </div>
</div>
<script>page = 'cart';</script>