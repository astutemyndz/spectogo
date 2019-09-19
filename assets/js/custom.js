/* https://learn.jquery.com/using-jquery-core/document-ready/ */
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
/*$(document).ready(function () {
    alert($(location).attr('pathname'));
    switch ($(location).attr('pathname')) {
        case '/baseballintel/':
            $('.home-nav').addClass('active');
            $('.about-us-nav').removeClass('active');
            $('.get-data-nav').removeClass('active');
            $('.contact-nav').removeClass('active');
            break;
    }
});*/

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


/*
if (page == 'product-details' || page == 'choose-your-lens') {
    $(document).ready(function () {
        $('header').removeClass('home-header');
        if (page == 'product-details') {
            //var totalslides = 10;
            var syncedSecondary = true;

            $bigImage
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
                ],
                    jsonSuccess: callbackOwl

                })
                .on("changed.owl.carousel", syncPosition);

            $thumbs
                .on("initialized.owl.carousel", function () {
                    $thumbs
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
                $thumbs
                    .find(".owl-item")
                    .removeClass("current")
                    .eq(current)
                    .addClass("current");
                var onscreen = $thumbs.find(".owl-item.active").length - 1;
                var start = $thumbs
                    .find(".owl-item.active")
                    .first()
                    .index();
                var end = $thumbs
                    .find(".owl-item.active")
                    .last()
                    .index();

                if (current > end) {
                    $thumbs.data("owl.carousel").to(current, 100, true);
                }
                if (current < start) {
                    $thumbs.data("owl.carousel").to(current - onscreen, 100, true);
                }
            }

            function syncPosition2(el) {
                if (syncedSecondary) {
                    var number = el.item.index;
                    $bigImage.data("owl.carousel").to(number, 100, true);
                }
            }

            $thumbs.on("click", ".owl-item", function (e) {
                e.preventDefault();
                var number = $(this).index();
                $bigImage.data("owl.carousel").to(number, 300, true);
            });
        }
    });
}
*/

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
                    swal_success_then(res.message, 'OK', base_url);
                } else {
                    swal_warning(res.message);
                }
            }
        });
    }
});

