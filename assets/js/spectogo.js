const currentUrl = function() {
    return $(location).attr('href');
}
const back = function() {
    currentUrl();
}

const backToChooseLens = function() {
    $(document).on('click', '.backToChooseLens', function(e) {
        location.href = API_URL + 'choose-your-lens';
    })
}
$(document).ready(function(){
    backToChooseLens();
    // var URI = $(location).attr('href');
    // console.log(URI);
    // let $bannerUL = $('#bannerUL');
    // $bannerUL.loading();
    // setTimeout(function(){
    //     $bannerUL.loading('stop');
    // },1000);
    // setTimeout(function(){
    //     loadBanner();
    // },1001);
    var $bannerCategoryLink = $('.bannerCategoryLink');
    $bannerCategoryLink.on('click', function () {
        let categoryId = $(this).attr('data-categoryId');
        let categoryName = $(this).attr('data-categoryName');
        setTimeout(() => {
            location.href = API_URL + 'products/categories/' + categoryName;
    
        }, 300);
    
    });
    if (page == 'product-details' || page == 'choose-your-lens' || page == 'preview') {
        console.log(page);
        var owl = $('.owl-carousel');
        $(document).ready(function () {
            $('header').removeClass('home-header');
            var bigimage = $("#big");
            var thumbs = $("#thumbs");
            //var totalslides = 10;
            var syncedSecondary = true;
    
            bigimage
                .owlCarousel({
                    items: 1,
                    slideSpeed: 2000,
                    nav: false,
                    autoplay: true,
                    dots: false,
                    loop: true,
                    responsiveRefreshRate: 200,
                    navText: [
            '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
            '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
          ]
                })
                .on("changed.owl.carousel", syncPosition);
    
            thumbs
                .on("initialized.owl.carousel", function () {
                    thumbs
                        .find(".owl-item")
                        .eq(0)
                        .addClass("current");
                })
                .owlCarousel({
                    items: 4,
                    dots: true,
                    nav: true,
                    navText: [
            '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
            '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
          ],
                    smartSpeed: 200,
                    slideSpeed: 500,
                    slideBy: 4,
                    responsiveRefreshRate: 100
                })
                .on("changed.owl.carousel", syncPosition2);
    
            function syncPosition(el) {
                //if loop is set to false, then you have to uncomment the next line
                //var current = el.item.index;
    
                //to disable loop, comment this block
                var count = el.item.count - 1;
                var current = Math.round(el.item.index - el.item.count / 2 - 0.5);
    
                if (current < 0) {
                    current = count;
                }
                if (current > count) {
                    current = 0;
                }
                //to this
                thumbs
                    .find(".owl-item")
                    .removeClass("current")
                    .eq(current)
                    .addClass("current");
                var onscreen = thumbs.find(".owl-item.active").length - 1;
                var start = thumbs
                    .find(".owl-item.active")
                    .first()
                    .index();
                var end = thumbs
                    .find(".owl-item.active")
                    .last()
                    .index();
    
                if (current > end) {
                    thumbs.data("owl.carousel").to(current, 100, true);
                }
                if (current < start) {
                    thumbs.data("owl.carousel").to(current - onscreen, 100, true);
                }
            }
    
            function syncPosition2(el) {
                if (syncedSecondary) {
                    var number = el.item.index;
                    bigimage.data("owl.carousel").to(number, 100, true);
                }
            }
    
            thumbs.on("click", ".owl-item", function (e) {
                e.preventDefault();
                var number = $(this).index();
                bigimage.data("owl.carousel").to(number, 300, true);
            });
        });
    }
    loadFooterCategoryComponent();
    loadHeaderCategoryComponent();
});
// const loadBanner = function() {
//     fetch(API_URL + '/banners')
//       .then(function(response) {
//         return response.json();
//     }).then(function(myJson) {
//         let res = myJson;
//         let banners = myJson.data;
//         let bannerArr = [];
//         $.each(banners, function(index, banner) {
//             bannerArr.push(BannerComponent({index: index, banner: banner, bannerImageUrl: res.bannerImageUrl}));
//         })
//        $bannerUL = $('#bannerUL');
//        $bannerUL.append(bannerArr.join(''));
//     });
// }


// const BannerComponent = function(props) {
//     let categoryName = props.banner.categoryName;
//         categoryName = categoryName.toUpperCase();
//         categoryName = categoryName.replace(" ", "_");
//      return ('<li class="tp-revslider-slidesli " data-categoryId="'+props.banner.categoryId+'" data-categoryName="'+props.banner.categoryName+'" data-transition="crossfade" data-param1="'+props.index+'" ><a href="'+API_URL+'/products/categories/'+categoryName+'"><img src="'+props.bannerImageUrl+props.banner.bannerImage+'" class="w-100 rev-slidebg " alt="'+categoryName+'" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" /></a</li>');
// }
const loadHeaderCategoryComponent = function() {
    var category = [];
    fetch(API_URL + 'banners')
      .then(function(response) {
        return response.json();
    })
      .then(function(myJson) {
        let res = myJson;
        let data = myJson.data;
        $.each(data, function(index, banner) {
            category.push(CategoryComponent({index: index, banner: banner, bannerImageUrl: res.bannerImageUrl}));
        });
        $HeaderCategoryComponent = $('.HeaderCategoryComponent');
        //$HeaderCategoryComponent.loading();
        // setTimeout(function(){
        //     $HeaderCategoryComponent.loading('stop');
        // },1000);
        setTimeout(function(){
            $HeaderCategoryComponent.prepend(category.join(''));
        },1001);
       
    });
    
}
const loadFooterCategoryComponent = function() {
    var bannerCategory = [];
    fetch(API_URL + 'banners')
      .then(function(response) {
        return response.json();
    })
      .then(function(myJson) {
        let res = myJson;
        let data = myJson.data;
        $.each(data, function(index, banner) {
            bannerCategory.push(CategoryComponent({index: index, banner: banner, bannerImageUrl: res.bannerImageUrl}));
        });
        $FooterCategoryComponent = $('.FooterCategoryComponent');
        // $FooterCategoryComponent.loading();
        // setTimeout(function(){
        //     $FooterCategoryComponent.loading('stop');
        // },1000);
        setTimeout(function(){
            $FooterCategoryComponent.prepend(bannerCategory.join(''));
        },1001);
       
    });
    
}
const CategoryComponent = function(props) {
    let categoryName = props.banner.categoryName;
        categoryName = categoryName.toUpperCase();
        categoryName = categoryName.replace(" ", "_");
     return ('<li class="nav-item" data-categoryId="'+props.banner.categoryId+'" data-categoryName="'+props.banner.categoryName+'" data-param="'+props.index+'" ><a class="nav-link" href="'+API_URL+'products/categories/'+categoryName+'">'+categoryName+'</a</li>');
}
const ColorComponent = function(props) {
   // console.log(props);
    return (`<li style="background-color:#3330;"><i class="fa fa-circle" style="color: #` + props.color + `"></i></li>`);
}
const ProductComponent = function(props) {
    //console.log(props);
    let sellPrice = props.product.sell_price;
    // sellPrice is an Array
    sellPrice = sellPrice.toString().split(",");
    // sellPrice is a string
    sellPrice = sellPrice[0].toString();

    let colors = props.product.color;
    // colurs is an Array
    colors = colors.split(',');
    let style = {
        wishlistButton: {
            class: 'wishlist'
        }
    };
    if (props.product.wishlistId) {
        style = {
            wishlistButton: {
                class: 'removeWishlist'
            }
        };
    }
    let colorsComponent = '';
    //console.log(colors);
    $.each(colors, function (index, color) {
        colorsComponent += (ColorComponent({color: color}));
    });
    //console.log(colorsComponent);
    return (
        `
            <div class="col-md-4 col-sm-6 text-center mb-5 product_box position-relative">
                <a href="` + API_URL + `product-details/categories/`+ props.product.cat_name + "/" + props.product.slug + `">
                    <div class="product">
                        <img src="` + props.productImageUrl + props.product.primary_image + `" class="w-50 w-sm-75 w-lg-100" />
                        <h6 class="mb-0 text-color-9 pt-2 pb-1 text-uppercase">` + props.product.brand_name + `</h6>
                        <h5 class="mb-0 font-weight-bold pb-1">` + props.product.name + `</h5>
                        <h5 class="mb-0 text-primary font-weight-semibold pb-2">£` + sellPrice + `</h5>
                    </div>
                </a>
                <ul class="choose-glass-color">
                   `+colorsComponent+`
                </ul><div class="d-flex flex-row justify-content-center position-absolute w-100 top_position">
                    <div class="col-lg-6 col-md-6 col-sm-6 pr-md-0 pr-4 text-left">
                        
                    </div>
                </div>
            </div>
        `
    );
}
//<button data-id_products="`+props.product.id+`" data-id_users="`+props.user.id+`" data-wishlistId="`+props.product.wishlistId+`" type="button" class="text-uppercase btn btn-primary wishlistButtonLoader `+style.wishlistButton.class+`"><i class="fa fa-heart" aria-hidden="true"></i> wishlist</button>
$('.addPres').click(function(){
    $('.addPresDiv').removeClass('d-none');
    $('#saveYourPrescription').addClass('d-none');
});
$('.useOldPres').click(function(){
    $('.addPresDiv').addClass('d-none');
    $('#saveYourPrescription').removeClass('d-none');
});


const LensCategoryComponent = function(options) {
    return(`
    <li class="nav-item">
        <a class="getLensSubCategory nav-link d-inline-block pl-3 pr-3 text-color-6 font-weight-bold mb-2" data-toggle="tab" href="#single-vision" role="tab" aria-controls="single-vision" data-lensCatId="`+options.lensCategory.lensCatId+`" id="lensCategory_`+options.index+`">
        `+options.lensCategory.lensCatName+`
        </a>
        <span class="arrow_box"></span>
    </li>
    `)
}
const LensSubCategoryComponent = function(options) {
    return(`
    <a class="col-md-4 col-sm-4 " href="javascript:void(0)" class="d-block nextBtn">
    <input type="hidden" value="">
    <div class="text-center col-12 mb-sm-0 mb-4 subCategoryBox" onclick="setLensSubCatId('`+options.lensSubCategory.lensSubCatId+`')">
        <div class="rounded-circle mx-auto mb-3 bg-dark" style="height:100px;width:100px;line-height:100px;">
            <img src="`+options.subCatImageUrl+options.lensSubCategory.image+`" class="w-50" />
        </div>
        <h5 class="text-uppercase font-weight-bold mb-0">`+options.lensSubCategory.lensSubCatName+`</h5>
        <h6 class="text-color-3 font-italic mt-1" style="font-size:12px;">Single Vision</h6>
        <p class="text-color-5">`+options.lensSubCategory.description+`</p>
        
            <span class="bg-primary badge rounded-circle p-0">
                <i class="fa fa-angle-right text-white" aria-hidden="true"></i>
            </span>
        
    </div>
    </a>
    `)
}
// Load lens start of code

const onLoadLensEventHandler = function (options) {
    let lensCategoryArr = [];
    let $lensCategoryListFragment = $('#vertical_tab');
    fetch(API_URL + 'filterLensDetails', {
        headers: {
            "Content-Type": 'application/x-www-form-urlencoded'
        },
        method: 'post',
        body: $.param(options)
    })
    .then(function (response) {
        return response.json();
    })
    .then(function (myJson) {
        let res = myJson;
        let data = myJson.data;
        $.each(data, function (index, lens) {
            lensCategoryArr.push(LensCategoryComponent({
                index: index,
                lensCategory: lens,
                productImageUrl: (res.subCatImageUrl) ? res.subCatImageUrl : ''
            }));
        });
        $lensCategoryListFragment.html(lensCategoryArr.join(''));
        $("#lensCategory_0").trigger('click');
    });
}
const onLoadLensSubCategoryEventHandler = function (options, callback) {
    fetch(API_URL + 'filterLensDetails', {
        headers: {
            "Content-Type": 'application/x-www-form-urlencoded'
        },
        method: 'post',
        body: $.param(options)
    })
    .then(function (response) {
        return response.json();
    })
    .then(function (myJson) {
        let res = myJson;
        callback(res);
    });
}
// load lens end of code
const loadLensCategory = function (options) {
    let $lensCategoryListFragment = $('#vertical_tab');
    $lensCategoryListFragment.loading();
    setTimeout(function () {
        $lensCategoryListFragment.loading('stop');
    }, 1000);
    setTimeout(function () {
        onLoadLensEventHandler(options);
    }, 1001);
}
// lens and tints
const LensComponent = function(options) {
    return(`
    <li class="nav-item">
        <a class="lens nav-link d-inline-block pl-3 pr-3 text-color-6 font-weight-bold mb-2" data-toggle="tab" href="#single-vision" role="tab" aria-controls="single-vision" data-lensId="`+options.lens.id+`" id="lens_`+options.index+`">
        `+options.lens.name+`
        </a>
        <span class="arrow_box"></span>
    </li>
    `)
}
const LensTintDetailsComponent = function(options) {
    return(`
    <a class="col-md-4 col-sm-4 " href="javascript:void(0)" class="d-block nextBtn">
    <input type="hidden" value="">
    <div class="text-center col-12 mb-sm-0 mb-4 subCategoryBox" onclick="setLensTintToProduct('`+options.lensTintDetails.lensDetailsId+`')">
        <div class="rounded-circle mx-auto mb-3 bg-dark" style="height:100px;width:100px;line-height:100px;">
            <img src="`+options.imageUrl+options.lensTintDetails.lensDetailsImage+`" class="w-50" />
        </div>
        <h5 class="text-uppercase font-weight-bold mb-0">`+options.lensTintDetails.lensDetailsName+`</h5>
        <h6 class="text-color-3 font-italic mt-1" style="font-size:12px;">Single Vision</h6>
        <p class="text-color-5">`+options.lensTintDetails.lensDetailsDescription+`</p>
        <p class="text-color-5">`+options.lensTintDetails.lensDetailsInclude+`</p>
        <p class="text-color-5">`+options.lensTintDetails.lensDetailsPrice+`</p>
            <span class="bg-primary badge rounded-circle p-0">
                <i class="fa fa-angle-right text-white" aria-hidden="true"></i>
            </span>
    </div>
    </a>
    `)
}
const onLoadLensTintsEventHandler = function (options) {
    let arr = [];
    let $tintsTabFragment = $('#tintsTab');
    fetch(API_URL + 'lens/tints', {
        headers: {
            "Content-Type": 'application/x-www-form-urlencoded'
        },
        method: 'post',
        body: $.param(options)
    })
    .then(function (response) {
        return response.json();
    })
    .then(function (myJson) {
        let res = myJson;
        let data = res.data;
        //console.log(data);
        $.each(data, function (index, lens) {
            arr.push(LensComponent({
                index: index,
                lens: lens
            }));
        });
        $tintsTabFragment.html(arr.join(''));
        $("#lens_0").trigger('click');
    });
}
const onLoadLensTintsDetailsEventHandler = function (options, callback) {
    fetch(API_URL + 'lens/tints/details', {
        headers: {
            "Content-Type": 'application/x-www-form-urlencoded'
        },
        method: 'post',
        body: $.param(options)
    })
    .then(function (response) {
        return response.json();
    })
    .then(function (myJson) {
        let res = myJson;
        callback(res);
    });
}
$(document).ready(function () {
    const options = {
        lensCatId: ''
    }
    loadLensCategory(options);
    onLoadLensTintsEventHandler();
}).on('click', '.lens', function(e){
    let lensId = $(this).attr('data-lensId');
    let arr = []; 
    const options = {
        lensId: lensId
    }
    let $tintsVisionFragment = $('#tintsVision');
    $tintsVisionFragment.loading();

    setTimeout(function () {
        $tintsVisionFragment.loading('stop');
    }, 1000);
    setTimeout(function () {
        onLoadLensTintsDetailsEventHandler(options, function(res) {
            let data = res.data;
            let STATUS_CODE = res.statusCode;
            if(STATUS_CODE === 200) {
                $.each(data, function (index, lensTintDetails) {
                    arr.push(LensTintDetailsComponent({
                        index: index,
                        lensTintDetails: lensTintDetails,
                        imageUrl: (res.imageUrl) ? res.imageUrl : ''
                    }));
                    
                });
            }
            //console.log(arr);
            $tintsVisionFragment.html(arr.join(''));
        });
    }, 1001);
}).on("click", ".getLensSubCategory", function (e) {
    let subCategoryArr = []; 
    const options = {
        lensCatId: $(this).attr('data-lensCatId')
    }

    let $lensSubCategoryListFragment = $('#singleVision');
    $lensSubCategoryListFragment.loading();
    setTimeout(function () {
        $lensSubCategoryListFragment.loading('stop');
    }, 1000);
    setTimeout(function () {
        onLoadLensSubCategoryEventHandler(options, function(res) {
            let data = res.data;
            let STATUS_CODE = res.statusCode;
            if(STATUS_CODE === 200) {
                $.each(data, function (index, subCategory) {
                    subCategoryArr.push(LensSubCategoryComponent({
                        index: index,
                        lensSubCategory: subCategory,
                        subCatImageUrl: (res.subCatImageUrl) ? res.subCatImageUrl : ''
                    }));
                    
                });
            }
            
            $lensSubCategoryListFragment.html(subCategoryArr.join(''));
        });
    }, 1001);
});
//Load products
const onLoadProductEventHandler = function (options) {
    let productArr = [];
    let $productListFragment = $('#productListFragment');
    fetch(API_URL + 'products', {
            headers: {
                "Content-Type": 'application/x-www-form-urlencoded'
            },
            method: 'post',
            body: $.param(options)
        })
        .then(function (response) {
            return response.json();
        })
        .then(function (myJson) {
            let res = myJson;
            let products = myJson.data;
            $.each(products, function (index, product) {
                productArr.push(ProductComponent({
                    index: index,
                    product: product,
                    productImageUrl: res.productImageUrl,
                    user: options.user
                }));
            });
            $productListFragment.html(productArr.join(''));

        });
}

const addToWishlistProduct = function (callback) {
    // Product add to wishlist start of code
    var $wishListButton = $(".wislist");
    $wishListButton.on('click', function () {
        const id_products = $(this).data("id_products");
        const id_users = $(this).data("id_users");
        const data = {
            id_products: id_products,
            id_users: id_users
        };

        fetch(API_URL + 'wishlist/add', {
            headers: {
                "Content-Type": 'application/x-www-form-urlencoded'
            },
            method: 'post',
            body: $.param(data)
        }).then(function (response) {
            return response.json();
        }).then(function (myJson) {
            let res = myJson;
            //console.log(res);
            if (res.statusCode === 401) {
                setTimeout(() => {
                    location.href = API_URL + '/sign-in';
                }, 300);
            }
            if (res.statusCode === 201) {
               

            }
        });
        callback();
    });
    // end of code
}
const loadProduct = function (options) {

    let $productListFragment = $('#productListFragment');
    $productListFragment.loading();
    setTimeout(function () {
        $productListFragment.loading('stop');
    }, 1000);
    setTimeout(function() {
        onLoadProductEventHandler(options);
    }, 1001);
}
const currentUrlToArray = function () {
    var url = $(location).attr('href').split("/");
    return url;
}
const getCategoryNameFromUrl = function () {
    return currentUrlToArray()[6];
}




function chooseColor(prodId, colorHex) {
    let $owl = $('.commomProduct');
    let $sellPrice = $('.sellPrice');
    let $hexColorCode = $('#hexColorCode');
    let $productId = $('#productId');
    let $chooseLense = $('#chooseLense');
    $.ajax({
        type: "POST",
        url: API_URL + "filterProductImageByColor",
        data: {
            'productId': prodId,
            'hexColorCode': colorHex
        },
        cache: false,
        beforeSend: function () {
            $owl.loading();
            $sellPrice.loading();
            $sellPrice.html("");
        },
        success: function (res) {
            let STATUS_CODE = res.statusCode;
            let data = res.data;

            //console.log(data);


            var thumbHtml = '';
            if (STATUS_CODE === 200) {
                for (var i = 0; i < data.images.length; i++) {
                    thumbHtml += '<div class="item" ><img class="w-75 w-sm-100 mx-auto" src="' + res.imagePath + data.images[i] + '" /></div>';
                };
                setTimeout(function () {
                    $owl.loading('stop');
                    $sellPrice.loading('stop');
                }, 1000);

                setTimeout(function () {
                    $owl.trigger('replace.owl.carousel', thumbHtml).trigger('refresh.owl.carousel');
                    $sellPrice.html(data.sell_price);
                }, 1002);

                $productId.val(data.productId);
                $hexColorCode.val(colorHex);
                $chooseLense.val(1);
            }
        },
        error: function (res) {
            console.log(res);
        }
    });
}

const ajaxRequest = function (url, data = null, options = {
    beforeSend: null,
    method: null,
    afterSend: null
}, callback = null) {
    $.ajax({
        url: API_URL + url,
        type: options.method,
        data: data,
        beforeSend: options.beforeSend,
        success: function (response) {
            if (response) {
                options.afterSend();
            }
            callback(response);
        },
        error: function (response) {
            console.log(response);
        }
    });
}

// Goto for choose lens
$(document).ready(function () {

    let $gtToCart = $('.gtToCart');
    let $hexColorCode = $('#hexColorCode');
    let $productId = $('#productId');
    let $chooseLense = $('#chooseLense');

    $gtToCart.on('click', function () {
        $.ajax({
            type: "POST",
            url: API_URL + "filterProductImageByColor",
            data: {
                'productId': $productId.val(),
                'hexColorCode': $hexColorCode.val(),
                'chooseLense': $chooseLense.val()
            },
            cache: false,
            beforeSend: function () {

            },
            success: function (res) {
                let STATUS_CODE = res.statusCode;
                let data = res.data;
                if (STATUS_CODE === 200) {
                    location.href = API_URL + '/choose-your-lens';
                }
            },
            error: function (res) {
                console.log(res);
            }
        });
    });

})
let userId = $('#userId').attr('data-userId');
const options = {
    categoryName: getCategoryNameFromUrl(),
    user: {
        id: userId,
    }
};
$(document).ready(function () {
    loadProduct(options);
    loadPupillaryDistanceDropDown();
    addYourPrescription();
    onLoadPreviewEventHandler();
}).on("click", ".wishlist", function (e) {
    // Init variable

    const id_products = $(this).data("id_products");
    const id_users = $(this).data("id_users");
    const hexColorCode = $(this).data("hexColorCode");

    const data = {
        id_products: id_products,
        id_users: id_users
    };

    const optionsWithWishlist = {
        categoryName: options.categoryName,
        wishlist: 1,
        user: options.user
    };
    fetch(API_URL + 'wishlist/add', {
        headers: {
            "Content-Type": 'application/x-www-form-urlencoded'
        },
        method: 'post',
        body: $.param(data)
    }).then(function (response) {
        return response.json();
    }).then(function (myJson) {
        let res = myJson;
        if (res.statusCode === 401) {
            messageBox('Authentication', res.message, 'warning', API_URL + '/sign-in')
        }
        if (res.statusCode === 201) {
            loadProduct(optionsWithWishlist);
            console.log('fire');
            $('#productDetailsWishlistButton').removeClass('wishlist').addClass('removeWishlist');
        }
    });

}).on("click", ".removeWishlist", function (e) {
    // Init variable

    const wishlistId = $(this).attr("data-wishlistId");

    const data = {
        wishlistId: wishlistId
    };



    fetch(API_URL + 'wishlist/remove', {
        headers: {
            "Content-Type": 'application/x-www-form-urlencoded'
        },
        method: 'post',
        body: $.param(data)
    }).then(function (response) {
        return response.json();
    }).then(function (myJson) {
        let res = myJson;
        if (res.statusCode === 200) {
            let opt = {
                categoryName: options.categoryName,
                wishlist: null,
                user: options.user
            };
            loadProduct(opt);
        }
    });

});
function setLensSubCatId(subCatId){
    $.ajax({
        type: "POST",
        url: base_url + "set-lens-for-product",
        data: {
            lensSubCatId : subCatId
        },
        cache: false,
        beforeSend: function () {
        },
        success: function (res) {
            let STATUS_CODE = res.statusCode;
            if (STATUS_CODE === 200) {
                $('.prescription').trigger('click');
            } else {
            }
        }
    });
}
function setLensTintToProduct(id){
    // setTimeout(() => {
        
    // }, 1000);
    let data = {
        id: id
    };
    fetch(API_URL + 'setLensTintToProduct', {
        headers: {
            "Content-Type": 'application/x-www-form-urlencoded'
        },
        method: 'post',
        body: $.param(data)
    }).then(function (response) {
        return response.json();
    }).then(function (myJson) {
        let res = myJson;
        if (res.statusCode === 200) {
            console.log(res);
            setTimeout(() => {
                location.href = API_URL + 'preview';
            }, 1000);
        }
    });
}
 // Upload attachment file
  $(function () {
    $fileUploadFragment = $('.upload-btn-wrapper');
    $attachmentPrescription = $('#attachmentPrescription');
    $fileUploadFragment.loading();
    setTimeout(() => {
        $('#attachment').fileupload({
            dataType: 'json',
            add: function (e, data) {
                data.context = $('.loader').text('Uploading...');
                data.submit();
            },
            done: function (e, data) {
                let fileName;
                $.each(data.result.files, function (index, file) {
                    console.log(file);
                    fileName = file.name;
                });
                data.context.text(fileName);
                $attachmentPrescription.val(fileName);
            }
        });
        $fileUploadFragment.loading('stop');
    }, 1001);
   
});
const addYourPrescription = function() {
    $PrescriptionButton = $('.PrescriptionButton');
    $PrescriptionButton.on('click', function(e) {
        //e.preventDefault();
        console.log('click');
        $addPresDiv = $('#addPresDiv');
        $addPresDiv.loading();
        const data = $(".prescription_form").serialize();
        fetch(API_URL + 'setPrescription', {
            headers: {
                "Content-Type": 'application/x-www-form-urlencoded'
            },
            method: 'post',
            body: data
        }).then(function (response) {
            return response.json();
        }).then(function (myJson) {
            let res = myJson;
            if (res.statusCode === 200) {
                console.log(res);
                $addPresDiv.loading('stop');
                $('.lenses').trigger('click');
            }
        });
    })
}

/**
 * @Form validation wizard
 */
$(document).ready(function () {

    var navListItems = $('div.setup-panel ul li a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        
        e.preventDefault();
       // console.log('clicked3');
        var $target = $($(this).attr('href')),
                $item = $(this);

        if (!$item.hasClass('disabled')) {
           // console.log('if');
            navListItems.removeClass('active').addClass('');
            $item.addClass('');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        } else {
            console.log('else');
        }
    });

    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='hidden']"),
            isValid = true;

        $(".choose-your-lens").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".choose-your-lens").addClass("has-error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

   // $('div.setup-panel ul li a').trigger('click');
    $('.vision').trigger('click');
});


jQuery(document).ready(function () {
    /* initialize the slider based on the Slider's ID attribute */
    jQuery('#elegant_home_banner').show().revolution({

        /* options are 'auto', 'fullwidth' or 'fullscreen' */
        sliderLayout: 'auto',
        autoHeight: 'on',
        fullScreenAlignForce: 'off',
        stopAfterLoops: 0,
        stopAtSlide: 1,

        /* basic navigation arrows and bullets */
        navigation: {

            arrows: {
                enable: true,
                style: 'uranus',
                hide_onleave: false,

                left: {
                    container: 'slider',
                    h_align: 'right',
                    v_align: 'top',
                    h_offset: 100,
                    v_offset: 160
                },

                right: {
                    container: 'slider',
                    h_align: 'right',
                    v_align: 'top',
                    h_offset: 50,
                    v_offset: 160
                }

            },

            bullets: {
                enable: true,
                style: 'uranus',
                direction: 'verticle',
                hide_onleave: false,
                h_align: 'right',
                v_align: 'top',
                h_offset: 70,
                v_offset: 230,
                space: 0,
                tmp: '<div class="tp-counter text-center">{{param1}}</div>'
            },


        }
    });
});


var $bigImage = $("#big");
var $thumbs = $("#thumbs");

const callbackOwl = function (data) {
    var content = "";
    for (var i in data["items"]) {
        var img = data["items"][i].img;
        var alt = data["items"][i].alt;
        content += "<img src=\"" + img + "\" alt=\"" + alt + "\">"
    }
    $bigImage.html(content);
}
function swal_success(txt) {
    swal({
        text: txt,
        type: "success",
        buttons: true,
        confirmButtonColor: "#48cab2",
        buttons: 'OK',
        closeModal: false
    });
}

function swal_success_then(txt, btn, url) {
    swal({
        title: "Success !!!",
        text: txt,
        type: "success",
        showCancelButton: false,
        confirmButtonColor: "#48cab2",
        confirmButtonText: btn,
        closeOnConfirm: false
    }).then(function () {
        window.location = url;
    });
}

function swal_confirm_then(txt, btn, url) {
    swal({
        title: "Confirmation",
        text: txt,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: btn,
        closeOnConfirm: false
    }).then(function () {
        window.location = url;
    });
}
function messageBox(title, text, type = 'info', url) {
    swal({
        title: title,
        text: text,
        type: type,
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: 'OK',
        closeOnConfirm: false
    }).then(function () {
        window.location = url;
    });
}

function swal_warning(txt) {
    swal({
        text: txt,
        type: "warning",
        buttons: true,
        confirmButtonColor: "#DD6B55",
        buttons: 'OK',
        closeModal: false
    });
}

function common_form_checking(flag, msgbox = '') {
    $('.requiredCheck').each(function () {
        if ($.trim($(this).val()) == '') {
            var txt = $(this).attr('data-check') + ' is mandatory !!!';
            if (msgbox != '') {
                $("." + msgbox).text(txt);
            } else {
                swal_warning(txt);
            }
            flag = 'false';
            return false;
        } else {
            if ($(this).attr('data-check') == 'Email') {
                var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
                if (reg.test($.trim($(this).val())) == false) {
                    var txt = 'Enter valid Email address !!!';
                    if (msgbox != '') {
                        $("." + msgbox).text(txt);
                    } else {
                        swal_warning(txt);
                    }
                    flag = 'false';
                    return false;
                }
            }
            if ($(this).attr('data-check') == 'Phone') {
                if ($.trim($(this).val()).length != 10) {
                    var txt = 'Enter 10 digit phone number !!!';
                    if (msgbox != '') {
                        $("." + msgbox).text(txt);
                    } else {
                        swal_warning(txt);
                    }
                    flag = 'false';
                    return false;
                }
            }
            if ($(this).attr('data-check') == 'Zip') {
                if ($.trim($(this).val()).length != 6) {
                    var txt = 'Enter 6 digit Postcode !!!';
                    if (msgbox != '') {
                        $("." + msgbox).text(txt);
                    } else {
                        swal_warning(txt);
                    }
                    flag = 'false';
                    return false;
                }
            }
        }
    });
    return flag;
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        if (charCode == 43 || charCode == 45) {
            return true;
        }
        return false;
    }
    return true;
}

function isChar(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if ((charCode >= 65 && charCode <= 122) || charCode == 32 || charCode == 0) {
        return true;
    }
    return false;
}

$(document).on('keyup', '.restrictSpecial', function () {
    var yourInput = $(this).val();
    var re = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
    var isSplChar = re.test(yourInput);
    if (isSplChar) {
        var no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
        $(this).val(no_spl_char);
    }
});
$("#signupForm").submit(function (e) {
    e.preventDefault();
    var tmp = 'true';
    var flag = common_form_checking(tmp);
    if (flag != 'false') {
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: base_url + "do-registration",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $(".signUpBtn").prop("disabled", true);
            },
            success: function (data) {
                $(".signUpBtn").prop("disabled", false);
                var res = data.split('~~');
                if (res[0] == 'ok') {
                    swal_success_then(res[1], 'OK', base_url + 'sign-in');
                } else {
                    swal_warning(res[1]);
                }
            }
        });
    }
});
$("#loginForm").submit(function (e) {
    e.preventDefault();
    var tmp = 'true';
    var flag = common_form_checking(tmp);
    if (flag != 'false') {
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: base_url + "do-login",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $(".logInBtn").prop("disabled", true);
            },
            success: function (res) {
                console.log(res);
                let STATUS_CODE = res.statusCode;
                $(".logInBtn").prop("disabled", false);
                if (STATUS_CODE === 200) {
                    swal_success_then(res.message, 'OK', API_URL);
                } else {
                    swal_warning(res.message);
                }
            }
        });
    }
});


/**
 * @desc Choose your lens page
 */

 // load pupillaryDistance

 const PupillaryDistanceComponent = function(props) {
     return(`<option value="${props.pupillaryDistance.id}">${props.pupillaryDistance.name}</option>`)
 }

 const loadPupillaryDistanceDropDown = function() {
    var pupillaryDistanceArr = [];
    $pupillaryDistance = $('#pupillaryDistance');
    fetch(API_URL + 'distance')
      .then(function(response) {
        return response.json();
    })
      .then(function(myJson) {
        let res = myJson;
        if(res) {
            let data = res.data;
            let STATUS_CODE = res.statusCode;
            //STATUS_CODE = 201;
            if (STATUS_CODE === 200) {
                $.each(data, function(index, pupillaryDistance) {
                    pupillaryDistanceArr.push(PupillaryDistanceComponent({pupillaryDistance: pupillaryDistance}));
                });
                
                setTimeout(function(){
                    $pupillaryDistance.append(pupillaryDistanceArr.join(''));
                },1001);
            } else {
                $("#pupillaryDistance").prop("disabled", true);
                $("#pupillaryDistanceNotFound").html(res.message);
            }
        }
    }).catch(function(err) {
        console.log(err);
    });
 }

 $(document).ready(function() {
    //set initial state.
    $('.addPrism').val(this.checked);
    $('.addPrism').change(function() {
        if(this.checked) {
          $('.copyPrescriptionForm').removeClass('d-none');
        } else {
            $('.copyPrescriptionForm').addClass('d-none');
        }
        $('.addPrism').val(this.checked);  
          
    });

    $('.addAdditionalInfoCheckBox').val(this.checked);
    $('.addAdditionalInfoCheckBox').change(function() {
        if(this.checked) {
          $('.addAdditionalInfoTextArea').removeClass('d-none');
        } else {
            $('.addAdditionalInfoTextArea').addClass('d-none');
        }
        $('.addAdditionalInfoCheckBox').val(this.checked);  
          
    });
   
});


const onLoadPreviewEventHandler = function () {
    let $previewFragment = $('#preview');
    $previewFragment.loading();

    let url = API_URL + 'onLoadPreviewEventHandler';
    setTimeout(() => {
        $previewFragment.loading('stop');
        fetch(url)
    .then(function (response) {
        return response.json();
    })
    .then(function (myJson) {
        let res = myJson;
        let data = res.data;
        
        let options = {
            product: {
                id: data.productId,
                name: data.productName,
                image: res.productImagePath + data.productPrimaryImage,
                imagePath: res.productImagePath,
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
               
            },
            prescription: data.prescription,
            lensTint: data.lensTint
        };
        console.log(options);
        $previewFragment.html(PreviewMainComponent(options));
     });
    }, 1000);
    
}


const PreviewHeaderComponent = function(props) {
    return(`
        <div class="col-12">
            <div class="add-to-cart-area">
            <h4 class="text-center font-weight-bold mt-0">Your new glasses</h4>
            <p class="text-center mb-4">Confirm they're correct then add to your basket.</p>
            </div>
        </div>
    `);
}

const PreviewFrameComponent = function(props) {
    return(`
    <div class="col-sm-4">
	  	<div class="selected-frame text-center">
	  		<h3>Your frame</h3>
	  		<img src="`+props.product.image+`" class="img-fluid"/>
	  		<h4>`+props.product.name+`</h4>
	  		<p>`+props.product.attributes.color.name+`</p>
	  		<p><strong>Size</strong>: `+props.product.arm + `-` +props.product.bridge+`-`+props.product.lens+`-`+props.product.height+`</p>
	  		<p>$`+props.product.attributes.sellPrice+`.00 (frame price) <br>`+props.product.includes+`</p>
	  	</div>
	  </div>
    `);
}
const PreviewPrescriptionComponent = function(props) {
    //console.log(props.prescription);
    return(`
            <div class="col-sm-4">
                <div class="your-presciption">
                    <div class="pd-15">
                    <h3>Your prescription</h3>
                    <p class="text-center">Single Vision - Reading</p>
                    <table class="table table-sm text-center scriptForm unstriped table-borderless">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Sphere</th>
                                <th>Cylinder</th>
                                <th>Axis</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="rightEye">
                                <td class="eye">
                                    <strong>OD</strong>
                                    <br>
                                    <em>(Right Eye)</em>
                                </td>
                                <td class="grey-cell">
                                    `+props.prescription.details[0].sphere+`
                                </td>
                                <td class="grey-cell">
                                    `+props.prescription.details[0].cylinder+`
                                </td>
                                <td class="grey-cell">
                                    `+props.prescription.details[0].axis+`
                                </td>
                            </tr>
                            <tr class="leftEye">
                                <td class="eye">
                                    <strong>OS</strong>
                                    <br>
                                    <em>(Left Eye)</em>
                                </td>
                                <td class="grey-cell">
                                    `+props.prescription.details[1].sphere+`
                                </td>
                                <td class="grey-cell">
                                    `+props.prescription.details[1].cylinder+`
                                </td>
                                <td class="grey-cell">
                                    `+props.prescription.details[1].axis+`
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>PD</strong>
                                </td>
                                <td class="grey-cell" colspan="4">
                                    <strong>`+props.prescription.id_pupillary_distance+`</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                        </div>
                </div>
            </div>
    `);
}

const PreviewLensComponent = function(props) {
    let lensDetailsPrice = (parseFloat(props.lensTint.lensDetailsPrice).toFixed(2));
    if(lensDetailsPrice) {
        lensDetailsPrice = lensDetailsPrice;
    } else {
        lensDetailsPrice = '0.00'
    }
  
    return(`
            <div class="col-sm-4">
                <div class="my-lenses">
                    <h3>Your lenses</h3>
                    <table class="table scriptForm unstriped lensesConfirm table-borderless">
                    <tbody>
                        <tr>
                            <td class="text-left">`+props.lensTint.lensName+`</td>
                            <td class="text-center"><strong></strong></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td class="text-left">`+props.lensTint.lensDetailsName+`</td>
                            <td class="text-center"><strong>$`+lensDetailsPrice+`</strong></td>
                            <td class="text-right"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    `);
}
const PreviewTotalComponent = function(props) {
    let sellPrice = parseFloat(props.product.attributes.sellPrice);
    let lensDetailsPrice = parseFloat(props.lensTint.lensDetailsPrice);
    let totalSellPrice = 0;
    totalSellPrice = (sellPrice + lensDetailsPrice).toFixed(2);
    return(`
    <div class="col-12">
        <ul class="cart-add">
            <li class="add-cart-total">Eyewear Total: <span>$`+totalSellPrice+`</span></li>
            <li><a href="javascript:void(0);" class="addToCart">Add To Cart</a></li>
            <li><a href="javascript:void(0);" class="backToChooseLens">Back</a></li>
        </ul>
    </div>
    `);
}

const PreviewMainComponent = function(props) {
    return(`
        <div class="container">
            <div class="row">
            `+PreviewHeaderComponent(props)+`
            `+PreviewFrameComponent(props)+`
            `+PreviewPrescriptionComponent(props)+`
            `+PreviewLensComponent(props)+`
            `+PreviewTotalComponent(props)+`
            </div>
        </div>
    `);
}
