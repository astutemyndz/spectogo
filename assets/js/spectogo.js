

var API_URL = 'http://localhost/spectogo';
var banners = [];
fetch(API_URL + '/banners')
    .then(function (response) {
        return response.json();
    })
    .then(function (myJson) {
        let res = myJson;
        //console.log(res);
        let banners = myJson.data;
        let bannerArr = [];
        //console.log(banners);
        $.each(banners, function (index, banner) {
            // console.log(banner);
            bannerArr.push(BannerComponent({
                index: index,
                banner: banner,
                bannerImageUrl: res.bannerImageUrl
            }));
        })
        /// console.log(bannerArr);
        $bannerUL = $('#bannerUL');
        $bannerUL.append(bannerArr.join(''));
    });


const BannerComponent = function (props) {
    //console.log(props);
    let categoryName = props.banner.categoryName;
    categoryName = categoryName.toUpperCase();
    categoryName = categoryName.replace(" ", "_");
    return ('<li class="tp-revslider-slidesli" data-categoryId="' + props.banner.categoryId + '" data-categoryName="' + props.banner.categoryName + '" data-transition="crossfade" data-param1="' + props.index + '" ><a href="' + API_URL + '/products/categories/' + categoryName + '"><img src="' + props.bannerImageUrl + props.banner.bannerImage + '" class="w-100 rev-slidebg " alt="' + categoryName + '" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" /></a</li>');
}

var $bannerCategoryLink = $('.bannerCategoryLink');

$bannerCategoryLink.on('click', function () {
    let categoryId = $(this).attr('data-categoryId');
    let categoryName = $(this).attr('data-categoryName');
    setTimeout(() => {
        location.href = API_URL + '/product/category/' + categoryName;

    }, 300);

});

if (page == 'product-details' || page == 'choose-your-lens') {
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


// Private method
const ProductComponent = function (props) {
    //console.log(props);
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
    let style = {
        wishlistButton: {
            class: 'wislist'
        }
    };
    if (props.product.wishlistId) {
        style = {
            wishlistButton: {
                class: 'removeWishlist'
            }
        };
    }
    return (
        `
            <div class="col-md-4 col-sm-6 text-center mb-5 product_box position-relative">
                <a href="` + API_URL + `/product-details/` + props.product.slug + `">
                    <div class="product">
                        <img src="` + props.productImageUrl + props.product.primary_image + `" class="w-50 w-sm-75 w-lg-100" />
                        <h6 class="mb-0 text-color-9 pt-2 pb-1 text-uppercase">` + props.product.brand_name + `</h6>
                        <h5 class="mb-0 font-weight-bold pb-1">` + props.product.name + `</h5>
                        <h5 class="mb-0 text-primary font-weight-semibold pb-2">£` + sellePrice + `</h5>
                    </div>
                </a>
                <ul class="choose-glass-color">
                    ` +
        $.each(colurs, function (index, color) {
            `<li style="background-color : #` + color + `"></li>`
        }) +
        `
                    
                </ul>
                <div class="d-flex flex-row justify-content-center position-absolute w-100 top_position">
                    <div class="col-lg-6 col-md-6 col-sm-6 pr-md-0 pr-4 text-left">
                        <button data-id_products="` + props.product.id + `" data-id_users="` + props.user.id + `" data-wishlistId="` + props.product.wishlistId + `" type="button" class="text-uppercase btn btn-primary ` + style.wishlistButton.class + `"><i class="fa fa-heart" aria-hidden="true"></i> wishlist</button>
                    </div>
                </div>
            </div>
        `
    );
}

const LensCategoryComponent = function(options) {
    return(`
    <li class="nav-item">
        <a class="getLensSubCategory nav-link d-inline-block pl-3 pr-3 text-color-6 font-weight-bold mb-2" data-toggle="tab" href="#single-vision" role="tab" aria-controls="single-vision" id="`+options.lensCategory.lensCatId+`">
        `+options.lensCategory.lensCatName+`
        </a>
        <span class="arrow_box"></span>
    </li>
    `)
}
const LensSubCategoryComponent = function(options) {
    return(`
    <div class="text-center col-md-4 col-sm-4 col-12 mb-sm-0 mb-4" onclick="setLensSubCatId('`+options.lensSubCategory.lensSubCatId+`')">
        <div class="rounded-circle mx-auto mb-3 bg-dark" style="height:100px;width:100px;line-height:100px;">
            <img src="`+options.subCatImageUrl+options.lensSubCategory.image+`" class="w-50" />
        </div>
        <h5 class="text-uppercase font-weight-bold mb-0">`+options.lensSubCategory.lensSubCatName+`</h5>
        <h6 class="text-color-3 font-italic mt-1" style="font-size:12px;">Single Vision</h6>
        <p class="text-color-5">`+options.lensSubCategory.description+`</p>
        <a href="javascript:void(0)" class="d-block">
            <span class="bg-primary badge rounded-circle p-0">
                <i class="fa fa-angle-right text-white" aria-hidden="true"></i>
            </span>
        </a>
    </div>
    `)
}
// Load lens start of code
const onLoadLensEventHandler = function (options) {
    let lensCategoryArr = [];
    let $lensCategoryListFragment = $('#vertical_tab');
    fetch(API_URL + '/filterLensDetails', {
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
    });
}
const onLoadLensSubCategoryEventHandler = function (options, callback) {
    fetch(API_URL + '/filterLensDetails', {
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
$(document).ready(function () {
    const options = {
        lensCatId: ''
    }
    loadLensCategory(options);
}).on("click", ".getLensSubCategory", function (e) {
    let subCategoryArr = []; 
    const options = {
        lensCatId: $(this).attr('id')
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
    fetch(API_URL + '/products', {
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

        fetch(API_URL + '/wishlist/add', {
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
                setTimeout(() => {
                    location.href = API_URL + '/sign-in';
                }, 300);
            }
            if (res.statusCode === 201) {
                alert(res.message);

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
    setTimeout(function () {
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
        url: API_URL + "/filterProductImageByColor",
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
            url: API_URL + "/filterProductImageByColor",
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
                console.log(data);
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
}).on("click", ".wislist", function (e) {
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
    fetch(API_URL + '/wishlist/add', {
        headers: {
            "Content-Type": 'application/x-www-form-urlencoded'
        },
        method: 'post',
        body: $.param(data)
    }).then(function (response) {
        return response.json();
    }).then(function (myJson) {
        let res = myJson;
        console.log(res);
        if (res.statusCode === 401) {
            messageBox('Authentication', res.message, 'warning', API_URL + '/sign-in')
        }
        if (res.statusCode === 201) {
            loadProduct(optionsWithWishlist);
        }
    });

}).on("click", ".removeWishlist", function (e) {
    // Init variable

    const wishlistId = $(this).attr("data-wishlistId");

    const data = {
        wishlistId: wishlistId
    };



    fetch(API_URL + '/wishlist/remove', {
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