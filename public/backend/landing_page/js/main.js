$(document).ready(function(){
	$(".owl-carousel").owlCarousel({
		loop: true,
		autoplay: true,
		autoplayTimeout: 5000,
		autoplayHoverPause: true,
		dots: false,
		margin: 10,
		nav: false,
		responsive: {
			0	: {
				items: 1,
			},
			700: {
				items: 2,
			},
			1200: {
				items: 3,
			},
		},
	});
  });



AOS.init({
	duration: 1200,
});
