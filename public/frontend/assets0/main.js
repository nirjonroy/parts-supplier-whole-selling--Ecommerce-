(function ($) {
    "use strict";

    new WOW().init();  

    /*---background image---*/
	function dataBackgroundImage() {
		$('[data-bgimg]').each(function () {
			var bgImgUrl = $(this).data('bgimg');
			$(this).css({
				'background-image': 'url(' + bgImgUrl + ')', // + meaning concat
			});
		});
    }
    
    $(window).on('load', function () {
        dataBackgroundImage();
    });
    
    /*---stickey menu---*/
    $(window).on('scroll',function() {    
           var scroll = $(window).scrollTop();
           if (scroll < 100) {
            $(".sticky-header").removeClass("sticky");
           }else{
            $(".sticky-header").addClass("sticky");
           }
    });
    

    /*---slider activation---*/
    $('.slider_area').owlCarousel({
        animateOut: 'fadeOut',
        autoplay: true,
		loop: true,
        nav: false,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 1,
        margin: -30,
        dots:true,
    });
    
    /*---product column5 activation---*/
    //    $('.product_column5').on('changed.owl.carousel initialized.owl.carousel', function (event) {
    //     $(event.target).find('.owl-item').removeClass('last').eq(event.item.index + event.page.size - 1).addClass('last')}).owlCarousel({
    //     autoplay: true,
	// 	loop: true,
    //     nav: true,
    //     autoplay: false,
    //     autoplayTimeout: 8000,
    //     items: 5,
    //     margin:20,
    //     dots:false,
    //     navText: ['<i class="fa-solid fa-arrow-left"></i>','<i class="fa-solid fa-arrow-right"></i>'],
    //     responsiveClass:true,
	// 	responsive:{
	// 			0:{
	// 			items:1,
	// 		},
    //         576:{
	// 			items:2,
	// 		},
    //         768:{
	// 			items:3,
	// 		},
    //         992:{
	// 			items:4,
	// 		},
    //         1200:{
	// 			items:5,
	// 		},


	// 	  }
    // });
    
    /*---product column4 activation---*/
       $('.product_column4').on('changed.owl.carousel initialized.owl.carousel', function (event) {
        $(event.target).find('.owl-item').removeClass('last').eq(event.item.index + event.page.size - 1).addClass('last')}).owlCarousel({
        autoplay: true,
		loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 5,
        margin:20,
        dots:false,
        navText: ['<i class="fa-solid fa-arrow-left"></i>','<i class="fa-solid fa-arrow-right"></i>'],
        responsiveClass:true,
		responsive:{
				0:{
				items:1,
			},
            576:{
				items:2,
			},
            768:{
				items:3,
			},
            992:{
				items:3,
			},
            1200:{
				items:4,
			},


		  }
    });
    
     /*---product column3 activation---*/
     $('.product_column3').on('changed.owl.carousel initialized.owl.carousel', function (event) {
        $(event.target).find('.owl-item').removeClass('last').eq(event.item.index + event.page.size - 1).addClass('last')}).owlCarousel({
        autoplay: true,
		loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 3,
        margin:20,
        dots:false,
        navText: ['<i class="fa-solid fa-arrow-left"></i>','<i class="fa-solid fa-arrow-right"></i>'],
        responsiveClass:true,
		responsive:{
				0:{
				items:1,
			},
            576:{
				items:2,
			},
            768:{
				items:3,
			},
            992:{
				items:2,
			},
            1200:{
				items:3,
			},


		  }
    });
    
    /*---productnav column3 activation---*/
    $('.productnav_column3').on('changed.owl.carousel initialized.owl.carousel', function (event) {
        $(event.target).find('.owl-item').removeClass('last').eq(event.item.index + event.page.size - 1).addClass('last')}).owlCarousel({
        autoplay: true,
		loop: true,
        nav: false,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 3,
        margin:10,
        dots:false,
    });
    
    $('.productnav_column3 a').on('click',function(e){
      e.preventDefault();

      var $href = $(this).attr('href');

      $('.productnav_column3 a').removeClass('active');
      $(this).addClass('active');

      $('.product_thumb .tab-pane').removeClass('active show');
      $('.product_thumb '+ $href ).addClass('active show');

    })
    
    
     /*---productnavbottom column3 activation---*/
    $('.productnavbottom_column3').on('changed.owl.carousel initialized.owl.carousel', function (event) {
        $(event.target).find('.owl-item').removeClass('last').eq(event.item.index + event.page.size - 1).addClass('last')}).owlCarousel({
        autoplay: true,
		loop: true,
        nav: false,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 3,
        margin:10,
        dots:false,
    });
    
    $('.productnavbottom_column3 a').on('click',function(e){
      e.preventDefault();

      var $href = $(this).attr('href');

      $('.productnavbottom_column3 a').removeClass('active');
      $(this).addClass('active');

      $('.product_thumbtav2 .tab-pane').removeClass('active show');
      $('.product_thumbtav2 '+ $href ).addClass('active show');

    })
    
    
    /*---featured column3 activation---*/
    $('.featured_column4').on('changed.owl.carousel initialized.owl.carousel', function (event) {
        $(event.target).find('.owl-item').removeClass('last').eq(event.item.index + event.page.size - 1).addClass('last')}).owlCarousel({
        autoplay: true,
		loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 8000,
        margin:20,
        items: 4,
        dots:false,
         navText: ['<i class="fa-solid fa-arrow-left"></i>','<i class="fa-solid fa-arrow-right"></i>'],
        responsiveClass:true,
		responsive:{
				0:{
				items:1,
			},
            576:{
				items:2,
			},
            768:{
				items:3,
			},
            992:{
				items:3,
			},
            1200:{
				items:4,
			},

		  }
    });
    
     /*---featured column3 activation---*/
    $('.small_product_column3').on('changed.owl.carousel initialized.owl.carousel', function (event) {
        $(event.target).find('.owl-item').removeClass('last').eq(event.item.index + event.page.size - 1).addClass('last')}).owlCarousel({
        autoplay: true,
		loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 3,
        margin:20,
        dots:false,
        navText: ['<i class="fa-solid fa-arrow-left"></i>','<i class="fa-solid fa-arrow-right"></i>'],
        responsiveClass:true,
		responsive:{
				0:{
				items:1,
			},
            576:{
				items:2,
			},
            768:{
				items:2,
			},
            992:{
				items:3,
			},
            1200:{
				items:3,
			},


		  }
    });
    
   
    
    /*---product column4 activation---*/
    $('.blog_column2').owlCarousel({
        autoplay: true,
		loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 2,
        margin:20,
        dots:false,
       navText: ['<i class="fa-solid fa-arrow-left"></i>','<i class="fa-solid fa-arrow-right"></i>'],
        responsiveClass:true,
		responsive:{
				0:{
				items:1,
			},
            576:{
				items:2,
			},
            768:{
				items:1,
			},
             992:{
				items:2,
			}, 
		  }
    });
    $('.product_column5').owlCarousel({
        autoplay: true,
		loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 2,
        margin:20,
        dots:false,
       navText: ['<i class="fa-solid fa-arrow-left"></i>','<i class="fa-solid fa-arrow-right"></i>'],
        responsiveClass:true,
		responsive:{
				0:{
				items:2,
			},
            576:{
				items:3,
			},
            768:{
				items:4,
			},
             1200:{
				items:6,
			}, 
		  }
    });
    
    /*---blog thumb activation---*/
    $('.blog_thumb_active').owlCarousel({
        autoplay: true,
		loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 1,
        margin:20,
        navText: ['<i class="fa-solid fa-arrow-left"></i>','<i class="fa-solid fa-arrow-right"></i>'],
    });
    
    /*---brand container activation---*/
     $('.brand_container').on('changed.owl.carousel initialized.owl.carousel', function (event) {
        $(event.target).find('.owl-item').removeClass('last').eq(event.item.index + event.page.size - 1).addClass('last')}).owlCarousel({
        autoplay: true,
		loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 5,
        dots:false,
         navText: ['<i class="fa-solid fa-arrow-left"></i>','<i class="fa-solid fa-arrow-right"></i>'],
        responsiveClass:true,
		responsive:{
				0:{
				items:1,
			},
            400:{
				items:2,
			},
            576:{
				items:3,
			},
            768:{
				items:4,
			},
            992:{
				items:5,
			},
            1200:{
				items:6,
			},

		  }
    });
    

    /*---single product activation---*/
    $('.single-product-active').owlCarousel({
        autoplay: true,
		loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 4,
        margin:15,
        dots:false,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsiveClass:true,
		responsive:{
				0:{
				items:1,
			},
            320:{
				items:2,
			},
            420:{
				items:3,
			},
            576:{
				items:4,
			},
            992:{
				items:3,
			},
            1200:{
				items:4,
			},


		  }
    });
 
 
    /*js ripples activation*/
    $('.js-ripples').ripples({
		resolution: 512,
		dropRadius: 20,
		perturbance: 0.04
	});
    
    
})(jQuery);	
