const CartItemComponent = function(props) {
    return(`
    <tr>
        <td><img src="`+props.image+`" class="img-fluid"></td>
        <td>
            <h3>`+props.name+`</h3>
            <p><strong>Colour:</strong> `+props.attributes.color.name+`</p>
            <p><strong>Size:</strong> `+props.arm+`-`+props.bridge+`-`+props.lens+`-`+props.height+` </p>
            <p><strong>Frame Price: &pound;<span>`+parseFloat(props.attributes.sellPrice).toFixed(2)+`</span></strong></p>
            <p class="cart-ditels-more"><span>"`+props.lensTint.lensDetailsName+`"</span> Items usually completed within 7-10 working days. Allow longer for complex prescriptions & tints — Details</p>
        </td>
        <td class="text-center">
            <h4 class="cart-table-price">&pound;`+props.price.toFixed(2)+`</h4> 
            <div class="layout-inline add-remove-cart">
               
                <input type="numeric" value="1" disabled />
                
            </div>
            <a href="javascript:void(0);" class="removeCart" data-rowId="`+props.rowId+`"><i title="Remove" class="fa fa-trash-o" aria-hidden="true"></i></a>
        </td>
    </tr>
    `);
}
const EmptyCartItemComponent = function() {
    return(`
    <tr>
       <td style="text-align: center;"><h2>Your cart is empty!</h2></td>
    </tr>
    `);
}
const EmptyCartSummeryComponent = function() {
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
                <td class="text-right total-price">&pound;0.00</td>
            </tr>
            <tr>
                <td><strong>Total</strong> </td>
                <td class="text-right total-price"><strong>&pound;0.00</strong> </td>
            </tr>
            </tbody>
        </table>
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
                <td class="text-right total-price">&pound;`+props.subTotal+` </td>
            </tr>
           
            <tr>
                <td><strong>Total</strong> </td>
                <td class="text-right total-price"><strong>&pound;`+props.subTotal+`</strong> </td>
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
const NumberOfCartItemComponent = function(props) {
    return(`<span class="badge badge-success rounded-pill">`+props.numberOfCartItem+`</span>`);
}
/**
 * @desc List of cart item start of code
 */
const cartUrl = API_URL + 'onLoadCartEventHandler';
const onLoadCartEventHandler = function() {
    let arr= [];
    $cartItems = $('#cartItems');
    $cartSummery = $('#cartSummery');
    fetch(cartUrl)
    .then(function (response) {
        return response.json();
    })
    .then(function (myJson) {
       
        const numberOfCartItem = myJson.count;
        const data = myJson.data;
        if(Object.keys(data).length > 0) {
            $numberOfCartItemComponent = $('.numberOfCartItemComponent');
            $numberOfCartItemComponent.html(NumberOfCartItemComponent({numberOfCartItem: numberOfCartItem}));
            let subTotal = 0;
            $.each(data, function(index, props) {
                //console.log(index);
                subTotal += parseFloat(props.subtotal);
                props = {
                    ...props,
                    rowId: index
                }
                arr.push(CartItemComponent(props));
            });
            $cart = $('#cart');
            $cart.loading();
        
            setTimeout(() => {
                $cart.loading('stop');
                $cartItems.html(arr.join(''));
                $cartSummery.html(CartSummeryComponent({subTotal: parseFloat(subTotal).toFixed(2)}));
            }, 1000);
        } else {
            $cartItems.html(EmptyCartItemComponent());
            $cartSummery.html(EmptyCartSummeryComponent());
            $('.checkout-btn').addClass('d-none').removeClass('d-block');
        }        
    });
}


// List of cart item end of code

// Get Preview Details start of code
const previewUrl = API_URL + 'onLoadPreviewEventHandler';
const onLoadFetchPreviewEventHandler = function(callback) {
    fetch(previewUrl)
    .then(function (response) {
        return response.json();
    })
    .then(function (myJson) {
        return callback(myJson);
    }).catch(function(err) {
        console.log(err);
    });
}


// Get Preview Details end of code

// Add to cart start of code
const addToCartUrl = API_URL + 'addToCart';
const onClickCartEventHandler = function(props, callback) {
    let data = (props.data) ? props.data : {};
    //console.log(props);
    let sellPrice = (data.productAttributeSellPrice) ? parseFloat(data.productAttributeSellPrice) : 0;
    let lensDetailsPrice = (data.lensTint) ? parseFloat(data.lensTint.lensDetailsPrice) : 0;
    let totalSellPrice = 0;
    totalSellPrice = (sellPrice + lensDetailsPrice).toFixed(2);

    let options = {
            id: data.productId,
            name: data.productName,
            image: props.productImagePath + data.productPrimaryImage,
            imagePath: props.productImagePath,
            description: data.productDescription,
            description: data.productDescription,
            lensSubCatId: data.lensSubCatId,
            arm:data.productArm,
            bridge:data.productBridge,
            lens:data.productLens,
            height:data.productHeight,
            warranty: data.productWarranty,
            progressive: data.productProgressive,
            includes:data.productIncludes,
            singleVision:data.productSingleVision,
            springHinge:data.productSpringHinge,
            suitableForTints:data.productSuitableForTints,
            color:{
                code: data.productDescription,
                name: data.productColor,
            },
            attributes: {
                color: {
                    name: data.productAttributeColorName,
                    code: data.productAttributeColorCode,
                },
                price: data.productAttributePrice,
                sellPrice: data.productAttributeSellPrice,
                discount: data.productAttributeDiscount,
                stock: data.productAttributeStock
            },
           
        
        prescription: data.prescription,
        lensTint: data.lensTint,
        qty: 1,
        price: totalSellPrice
    };
        fetch(addToCartUrl, {
            headers: {
                "Content-Type": 'application/x-www-form-urlencoded'
            },
            method: 'post',
            body: $.param(options)
        }).then(function (response) {
            return response.json();
        }).then(function (myJson) {
            return callback(myJson);
        }).catch(function(err) {
            console.log(err);
        });
}

const CartComponent = function(props) {
    return(`<span class="badge badge-success rounded-pill">0</span>`);
}

// Remove Cart
const removeCartUrl = API_URL + 'onClickRemoveCartEventHandler';
const onClickRemoveCartEventHandler = function(options, callback) {
    fetch(removeCartUrl, {
        headers: {
            "Content-Type": 'application/x-www-form-urlencoded'
        },
        method: 'post',
        body: $.param(options)
    }).then(function (response) {
        return response.json();
    }).then(function (myJson) {
        return callback(myJson);
    }).catch(function(err) {
        console.log(err);
    });
}

















$(document).ready(function () {
    onLoadCartEventHandler();
}).on('click', '.addToCart', function(e) {
    onLoadFetchPreviewEventHandler(function(res) {
        const props = res;
        $preview = $('#preview');
        $preview.loading();
        setTimeout(() => {
            $preview.loading('stop');
            onClickCartEventHandler(props);

        }, 2000);
         setTimeout(() => {
        location.href = API_URL + 'cart';            
        }, 2001);
        
    });
   
}).on('click', '.removeCart', function(e) {
    
    const options = {rowId: $(this).attr('data-rowId')};
    console.log(options);
    onClickRemoveCartEventHandler(options, function() {
        onLoadCartEventHandler();
    });
   
});
/*.on('click', '.lens', function(e){

});
*/