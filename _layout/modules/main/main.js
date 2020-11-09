$(document).ready(function () {
//	$('.content').infiniteScroll({
//  // options
//  path: '.pagination__next',
//  append: '.item',
//  history: false,
//});
	$(".box_search").mnfixed({
		top: 100,
		break: 991,
		limit: '#limit',
	});
	$('#slick_banner').on('init', function (event, slick) {
		slickDots = $(this).find(".slick-dots");
		slickDots.wrap("<div class='wrapper_relative'></div>");
		slickDots.wrap("<div class='wrapper_banner'></div>");
		slickDots.wrap("<div class='slick-dots-wrap'></div>");
		slickDots.parent(".slick-dots-wrap").wrap("<div class='wrapper_dots'></div>");
		slickDots.parents(".wrapper_dots").wrap("<div class='slick-dots-wrapper'></div>");

		//            slideCount = slick.slideCount;
		//			setSlideCount();
		//			setCurrentSlideNumber(slick.currentSlide);
		//            
	});

	$("#slick_banner").slick({
		arrows: false,
		infinite: true,
		dots: true,
		speed: 500,
		slidesToShow: 1,
		slidesToScroll: 1,
		customPaging: function (slider, i) {
			var thumb = $(slider.$slides[i]).data();
			return '<a>' + 0 + (i + 1) + '</a>';
		},
		cssEase: 'linear',
		autoplay: true,
		autoplaySpeed: 5000,
		

	});





});
