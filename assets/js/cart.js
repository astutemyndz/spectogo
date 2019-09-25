const CartItemComponent = function(props) {
    return(`
    <tr>
        <td><img src="img/frame-1.png" class="img-fluid"></td>
        <td>
            <h3>Savannah 2444 - Black and Clear</h3>
            <p><strong>Colour:</strong> C33 Black and Clear</p>
            <p><strong>Size:</strong> 149-17-52-42 </p>
            <p><strong>Frame Price: <span>212.50</span></strong></p>
            <p class="cart-ditels-more">Single vision items usually completed within 7-10 working days. Allow longer for complex prescriptions & tints — Details</p>
        </td>
        <td class="text-center">
            <h4 class="cart-table-price">£6.00</h4> 
            <div class="layout-inline add-remove-cart">
                <a href="#" class="qty qty-minus"><i class="fa fa-minus" aria-hidden="true"></i></a>
                <input type="numeric" value="3" />
                <a href="#" class="qty qty-plus"><i class="fa fa-plus" aria-hidden="true"></i></a>
            </div>
            <a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
        </td>
    </tr>
    `);
}

const CartSummeryComponent = function(props) {
    return(`
        <table class="table table-borderless">
            <thead>
            <tr>
                <th colspan="2">Cart Summary</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Sub Total </td>
                <td class="text-right total-price">$199.98 </td>
            </tr>
            <tr>
                <td>Shipping Discount </td>
                <td class="text-right total-price">  - ($15.00) </td>
            </tr>
            <tr>
                <td><strong>Total</strong> </td>
                <td class="text-right total-price"><strong>$199.98</strong> </td>
            </tr>
            </tbody>
        </table>
    `);
}

const CheckoutButtonComponent = function(props) {
    return(`<button type="submit" class="checkout-btn d-block"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Proceed to Checkout</button>`);
}

const CouponCodeComponent = function(props) {
    return(`<tbody>
    <tr>
        <td>
            <p>Apply Coupon Code:</p>
            <div class="form-inline">
              <div class="form-group">
                <input type="text" class="form-control" id="" placeholder="coupon Code">
              </div>
              <button type="submit" class="btn my-btn">Apply Coupon</button>
            </div>
        </td>
    </tr>
  </tbody>`);
}
const TotalNumberOfCartItemComponent = function(props) {
    return(`<p class="text-center mb-3">You have 2 item in your cart</p>`);
}
/**
 * @desc List of cart item start of code
 */
const cartUrl = API_URL + 'cart';
const onLoadCartEventHandler = function() {
    fetch(cartUrl)
    .then(function (response) {
        return response.json();
    })
    .then(function (myJson) {
        return myJson;
    });
}

const loadCart = function() {
    onLoadCartEventHandler.then(function(res) {
        console.log(res);
    })
}
// List of cart item end of code

// Get Preview Details start of code
const previewUrl = API_URL + 'preview';
const onLoadFetchPreviewEventHandler = function() {
    fetch(previewUrl)
    .then(function (response) {
        return response.json();
    })
    .then(function (myJson) {
        return myJson;
    });
}

const preview = function() {
    onLoadFetchPreviewEventHandler.then(function(res) {
        console.log(res);
    })
}
// Get Preview Details end of code

const addToCartUrl = API_URL + 'addToCart';
const onClickCartEventHandler = function() {
    $addToCartClass = $('.addToCart');
    $addToCartClass.on('click', function() {
        fetch(addToCartUrl, {
            headers: {
                "Content-Type": 'application/x-www-form-urlencoded'
            },
            method: 'post',
            body: data
        }).then(function (response) {

        });
    });
}

$(document).ready(function () {
   loadCart();
});
/*.on('click', '.lens', function(e){

});
*/