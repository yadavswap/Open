$(function() {
    'use strict'; // Start of use strict


    /*--------------------------
    scrollUp
    ---------------------------- */
    $.scrollUp({
        scrollText: '<i class="fa fa-angle-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });
 

	/*------------------------------------------------------------------
        Year
    ------------------------------------------------------------------*/
	$(function(){
    var theYear = new Date().getFullYear();
    $('#year').html(theYear);
    });

    // Mean Menu JS
    jQuery('.mean-menu').meanmenu({ 
        meanScreenWidth: "991"
    });

    /*------------------------------------------------------------------
        Fixed Header
    ------------------------------------------------------------------*/
    
		jQuery(window).on('scroll', function() {
			if ($(this).scrollTop() > 100) {
				$('.navbar-area').addClass("sticky");
			} else {
				$('.navbar-area').removeClass("sticky");
			}
        });

	/*------------------------------------------------------------------
        Slider One Carousel
    ------------------------------------------------------------------*/
    if ($('.slider-one__carousel').length) {
        var slideOneWrap = $('.slider-one');
        var slideOneCarousel = $('.slider-one__carousel').owlCarousel({
            loop: true,
            items: 1,
            margin: 0,
            dots: true,
            nav: false,
            animateOut: 'slideOutDown',
            animateIn: 'fadeIn',
            active: true,
            smartSpeed: 1000,
            autoplay: 7000
        });
        slideOneWrap.find('.slide-one__left-btn').on('click', function (e) {
            slideOneCarousel.trigger('next.owl.carousel');
            e.preventDefault();
        });
        slideOneWrap.find('.slide-one__right-btn').on('click', function (e) {
            slideOneCarousel.trigger('prev.owl.carousel');
            e.preventDefault();
        });
    }
    
   /*------------------------------------------------------------------
		Quote Popup
	------------------------------------------------------------------*/	   
    $('.open-popup-link').magnificPopup({
        type: 'inline',
        midClick: true,
        mainClass: 'mfp-fade'
    });   

	/*------------------------------------------------------------------
        Search Popup JS
    ------------------------------------------------------------------*/
    

    $('.close-btn').on('click',function() {
        $('.search-overlay').fadeOut();
        $('.search-btn').show();
        $('.close-btn').removeClass('active');
    });
    $('.search-btn').on('click',function() {
        $(this).hide();
        $('.search-overlay').fadeIn();
        $('.close-btn').addClass('active');
    });

    /*------------------------------------------------------------------
        Counter Sec
    ------------------------------------------------------------------*/

        $('.timer').countTo();
        $('.fun-fact').appear(function() {
            $('.timer').countTo();
        }, {
            accY: -100
        });


     // Gallery 
    $('.gallery-view').magnificPopup({
        delegate: 'a',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] 
        }
    });

    /*----------------------------
    Brand Slider
    ---------------------------- */
	$('.brand-slider').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        autoplay:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:3,
                nav:false
            },
            1000:{
                items:4,
                nav:true,
                loop:false
            }
        }
        });		        
    /*------------------------------------------------------------------
        Testimonials Sec
    ------------------------------------------------------------------*/
    	$('.test-active').owlCarousel({
        loop:true,
        margin:30,
        items:1,
        navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        nav:false,
        dots:false,
        responsive:{
            0:{
                items:1,
                margin: 0
            },
            767:{
                items:2
            },
            992:{
                items:2
            },
            1200:{
                items:3
            }
        }
    });

    // FAQ Accordion
		$(function() {
            $('.accordion').find('.accordion-title').on('click', function(){
                // Adds Active Class
                $(this).toggleClass('active');
                // Expand or Collapse This Panel
                $(this).next().slideToggle('fast');
                // Hide The Other Panels
                $('.accordion-content').not($(this).next()).slideUp('fast');
                // Removes Active Class From Other Titles
                $('.accordion-title').not($(this)).removeClass('active');		
            });
        });
        
    /*------------------------------------------------------------------
        Edupark Carousel
    ------------------------------------------------------------------*/
	
	if ($('.edupark-carousel').length) {
        $(".edupark-carousel").each(function (index) {
        var $owlAttr = {navText: [ '<span class="icon fa fa-angle-left"></span>', '<span class="icon fa fa-angle-right"></span>' ]},
        $extraAttr = $(this).data("options");
        $.extend($owlAttr, $extraAttr);
        $(this).owlCarousel($owlAttr);
    });
}

/* ==========================================================================
   When document is Scrollig, do
   ========================================================================== */
	
   $(window).on('scroll', function() {
    headerStyle();
});

});

/*------------------------------------------------------------------
 Loader 
------------------------------------------------------------------*/
jQuery(window).on("load scroll", function() {
    'use strict'; // Start of use strict
    // Loader 
     $('#dvLoading').fadeOut('slow', function () {
            $(this).remove();
        });
	$('.google-map').on('click', function() {
            $('.google-map').find('iframe').css("pointer-events", "auto");
        });
    //Animation Numbers	 
    jQuery('.animateNumber').each(function() {
        var num = jQuery(this).attr('data-num');
        var top = jQuery(document).scrollTop() + (jQuery(window).height());
        var pos_top = jQuery(this).offset().top;
        if (top > pos_top && !jQuery(this).hasClass('active')) {
            jQuery(this).addClass('active').animateNumber({
                number: num
            }, 2000);
        }
    });
	  
});
