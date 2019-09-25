/* Load Header And Footer */
// jQuery(function ($) {
//     var functions = {
//         fileLoader: function (params) {
//             /* Template File Load Function. */
//             var params = jQuery.parseJSON(params);
//             var path = "template/include/" + params.filename + "." + params.extension;
//             var file = $.get(path).done(function (data) {
//                     $(params.target).append(data);
//                 })
//                 .fail(function (error) {
//                     if (error.status == 404) {
//                         var path = "template/error/" + params.filename + "_error." + params.extension;
//                         var file = $.get(path)
//                             .done(function (data) {
//                                 $(params.target).append(data);
//                             });
//                     }
//                 });
//         }
//     };

//     $(document).ready(function () {
//         functions.fileLoader(JSON.stringify({
//             'filename': 'header',
//             'extension': 'html',
//             'target': '#header'
//         }));
//         functions.fileLoader(JSON.stringify({
//             'filename': 'footer',
//             'extension': 'html',
//             'target': '#footer'
//         }));
//     });

// });
jQuery(document).ready(function () {
    jQuery(".prescription_box").hover(function () {
        jQuery(this).toggleClass("bg-primary");
    });
});
$(function () {
    var color_option = $('.color_option a').click(function () {
        color_option.removeClass('active');
        $(this).addClass('active');
    });
});
// SHOPPING CART PLUS OR MINUS
$('a.qty-minus').on('click', function (e) {
    e.preventDefault();
    var $this = $(this);
    var $input = $this.closest('div').find('input');
    var value = parseInt($input.val());

    if (value > 1) {
        value = value - 1;
    } else {
        value = 1;
    }

    $input.val(value);

});
$('a.qty-plus').on('click', function (e) {
    e.preventDefault();
    var $this = $(this);
    var $input = $this.closest('div').find('input');
    var value = parseInt($input.val());

    if (value < 100) {
        value = value + 1;
    } else {
        value = 100;
    }

    $input.val(value);
});
$(document).ready(function () {
    $('.partner-slide').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        dots: false,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    })
})
$(document).ready(function () {
    $('.asd').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        dots: false,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    })
})
function searchpopup() {
    document.getElementById("show_search").style.display = "block";
}
function closesearch() {
    document.getElementById("show_search").style.display = "none";
}
//$('.wall').jaliswall({item:'.wall-item'});