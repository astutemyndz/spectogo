/*

Template: Sawaeed Al-Nab'a 

NOTE: This file includes all revolution slider scripts.

*/

(function($){
  "use strict";

/*************************************
 		slider 01
 **************************************/
 var revapi267,
     tpj=jQuery;
      tpj(document).ready(function() {
        if(tpj("#rev_slider_267_1").revolution == undefined){
          revslider_showDoubleJqueryError("#rev_slider_267_1");
        }else{
          revapi267 = tpj("#rev_slider_267_1").show().revolution({
            sliderType:"standard",
            sliderLayout:"fullwidth",
            dottedOverlay:"none",
            delay:9000,
            navigation: {
              keyboardNavigation:"off",
              keyboard_direction: "horizontal",
              mouseScrollNavigation:"off",
                             mouseScrollReverse:"default",
              onHoverStop:"off",
              touch:{
                touchenabled:"on",
                touchOnDesktop:"off",
                swipe_threshold: 75,
                swipe_min_touches: 1,
                swipe_direction: "horizontal",
                drag_block_vertical: false
              }
              ,
              arrows: {
                style:"zeus",
                enable:true,
                hide_onmobile:true,
                hide_under:767,
                hide_onleave:true,
                hide_delay:200,
                hide_delay_mobile:0,
                tmp:'<div class="tp-title-wrap">    <div class="tp-arr-imgholder"></div> </div>',
                left: {
                  h_align:"left",
                  v_align:"center",
                  h_offset:20,
                                    v_offset:0
                },
                right: {
                  h_align:"right",
                  v_align:"center",
                  h_offset:20,
                                    v_offset:0
                }
              }
            },
            visibilityLevels:[1240,1024,778,480],
            gridwidth:1240,
            gridheight:600,
            lazyType:"none",
            shadow:0,
            spinner:"spinner2",
            stopLoop:"off",
            stopAfterLoops:-1,
            stopAtSlide:-1,
            shuffle:"off",
            autoHeight:"off",
            disableProgressBar:"on",
            hideThumbsOnMobile:"off",
            hideSliderAtLimit:0,
            hideCaptionAtLimit:0,
            hideAllCaptionAtLilmit:0,
            debugMode:false,
            fallbacks: {
              simplifyAll:"off",
              nextSlideOnWindowFocus:"off",
              disableFocusListener:false,
            }
          });
        }
      });

 
 })(jQuery);


   