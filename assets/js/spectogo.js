var API_URL = 'http://localhost/spectogo';
var banners = [];
fetch(API_URL + '/banners')
  .then(function(response) {
    return response.json();
})
  .then(function(myJson) {
    let res = myJson;
    //console.log(res);
    let banners = myJson.data;
    let bannerArr = [];
    //console.log(banners);
    $.each(banners, function(index, banner) {
       // console.log(banner);
        bannerArr.push(BannerComponent({index: index, banner: banner, bannerImageUrl: res.bannerImageUrl}));
    })
   /// console.log(bannerArr);
   $bannerUL = $('#bannerUL');
   $bannerUL.append(bannerArr.join(''));
});


const BannerComponent = function(props) {
    //console.log(props);
    let categoryName = props.banner.categoryName;
        categoryName = categoryName.toUpperCase();
        categoryName = categoryName.replace(" ", "_");
     return ('<li class="tp-revslider-slidesli" data-categoryId="'+props.banner.categoryId+'" data-categoryName="'+props.banner.categoryName+'" data-transition="crossfade" data-param1="'+props.index+'" ><a href="'+API_URL+'/products/categories/'+categoryName+'"><img src="'+props.bannerImageUrl+props.banner.bannerImage+'" class="w-100 rev-slidebg " alt="'+categoryName+'" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" /></a</li>');
}

var $bannerCategoryLink = $('.bannerCategoryLink');

$bannerCategoryLink.on('click', function() {
    let categoryId = $(this).attr('data-categoryId');
    let categoryName = $(this).attr('data-categoryName');
    setTimeout(() => {
        location.href = API_URL + '/product/category/'+categoryName;
        
    }, 300);
    
});
$(document).ready(function() {
    var url = $(location).attr('href').split("/");;
    //console.log(url);
    const options = {
        categoryName: url[6]
    };
    loadProducts(options, function() {
        
        console.log('d0');
        callbackWishlist(function() {
            callbackLoadProducts({categoryName: options.categoryName, wishlist: 1, user: {id: 2, name: 'Rakesh'}});
        });
    });
    
    
});

//Load products
const loadProducts = function(options, callback) {
    let productArr = [];
    let $productListFragment = $('#productListFragment');
    let data = {categoryName: options.categoryName};
    fetch(API_URL + '/products', {
        headers: { "Content-Type": 'application/x-www-form-urlencoded' },
        method: 'post',
        body: $.param(data)
    })
    .then(function(response) {
        return response.json();
    })
    .then(function(myJson) {
        let res = myJson;
        let products = myJson.data;
        $.each(products, function(index, product) {
            productArr.push(ProductComponent({index: index, product: product, productImageUrl: res.productImageUrl}));
        });
        $productListFragment.html(productArr.join(''));

        callback();
       
    });
}

const callbackWishlist = function(callback) {
     // Product add to wishlist start of code
     var $wishListButton = $(".wislist");
     $wishListButton.on('click', function() {
         const id_products = $(this).data("id_products");
         const id_users = $(this).data("id_users");

         const data = {id_products: id_products, id_users: id_users};
         fetch(API_URL + '/wishlist/add', {
             headers: { "Content-Type": 'application/x-www-form-urlencoded' },
             method: 'post',
             body: $.param(data)
         }).then(function(response) {
             return response.json();
         }).then(function(myJson) {
             let res = myJson;
             if(res.statusCode === 401) {
                 setTimeout(() => {
                     location.href = getBaseURL() + '/sign-in';
                 }, 300);
             }
             if(res.statusCode === 201) {
                 alert(res.message);
                 callback();
             }
         });
     });
     // end of code
}
const callbackLoadProducts = function(options) {
    var productArr = [];
    var $productListFragment = $('#productListFragment');
        fetch(API_URL + '/products', {
            headers: { "Content-Type": 'application/x-www-form-urlencoded' },
            method: 'post',
            body: $.param(options)
        })
        .then(function(response) {
            return response.json();
        })
        .then(function(myJson) {
            let res = myJson;
            let products = myJson.data;
            $.each(products, function(index, product) {
                productArr.push(ProductComponent({index: index, product: product, productImageUrl: res.productImageUrl}));
            })
        $productListFragment.html(productArr.join(''));
    });
}
// Private method
const ProductComponent = function(props) {
    let sellePrice = props.product.sell_price;
        // sellPrice is an Array
        sellePrice = sellePrice.toString().split(",");
        //console.log(sellePrice);
        // sellPrice is a string
        sellePrice = sellePrice[0].toString();
        //console.log(sellePrice);

    let colurs = props.product.color;
        // colurs is an Array
        colurs = colurs.split(',');

    return(
        `
            <div class="col-md-4 col-sm-6 text-center mb-5 product_box position-relative">
                <a href="`+API_URL+`/product-details/`+props.product.slug+`">
                    <div class="product">
                        <img src="`+props.productImageUrl+props.product.primary_image+`" class="w-50 w-sm-75 w-lg-100" />
                        <h6 class="mb-0 text-color-9 pt-2 pb-1 text-uppercase">`+props.product.brand_name+`</h6>
                        <h5 class="mb-0 font-weight-bold pb-1">`+props.product.name+`</h5>
                        <h5 class="mb-0 text-primary font-weight-semibold pb-2">£`+sellePrice+`</h5>
                    </div>
                </a>
                <ul class="choose-glass-color">
                    `+
                        $.each(colurs, function(index, color) {
                            `<li style="background-color : #`+color+`"></li>`
                        })
                    +`
                    
                </ul>
                <div class="d-flex flex-row justify-content-center position-absolute w-100 top_position">
                    <div class="col-lg-6 col-md-6 col-sm-6 pr-md-0 pr-4 text-left">
                        <button data-id_products="`+props.product.id+`" data-id_users="2" tyoe="button" class="text-uppercase btn btn-primary wislist"><i class="fa fa-heart" aria-hidden="true"></i> wishlist</button>
                    </div>
                </div>
            </div>
        `
    );
}
// callback 
const WishlistComponent = function(callback) {

}