$(document).ready(function () {

	if ($(window).innerWidth() > 1025) {
        $("html").niceScroll({
            cursorborder: 0,
            cursorborderradius: 5,
            cursorcolor: 'rgba(0, 0, 0, 0.8)',
            cursorwidth: 10,
            horizrailenabled: false,
            mousescrollstep: 40,
            scrollspeed: 88,
            background: 'rgba(222, 222, 222, .75)',
        });
    }
    $('ul.navbar-nav li:first-child').click(function () { // When arrow is clicked
        $('body,html').animate({
            scrollTop: 0 // Scroll to top of body
        }, 500);
    });
	$('ul.navbar-nav li:nth-child(2)').click(function () { // When arrow is clicked
		$('body,html').animate({
			scrollTop: $("#block2").offset().top - 100
		}, 500);
	});
	$('ul.navbar-nav li:nth-child(3)').click(function () { // When arrow is clicked
		$('body,html').animate({
			scrollTop: $("#block3").offset().top - 100
		}, 500);
	});
	$('ul.navbar-nav li:nth-child(4)').click(function () { // When arrow is clicked
		$('body,html').animate({
			scrollTop: $("#contact").offset().top - 100
		}, 500);
	});
	

	$(".slick-banner").slick({
		arrows: false,
		dots: true,
		customPaging: function (slider, i) {
			var thumb = $(slider.$slides[i]).data();
			return '<a>' + 0 + (i + 1) + '</a>';
		},
		infinite: true,
		speed: 800,
		slidesToShow: 1,
		slidesToScroll: 1,
		cssEase: 'linear',
		autoplay: true,
		autoplaySpeed: 5000

	});
	
	$('.bootstrap-switch-label').click(function () { // When arrow is clicked

		if (!$(this).parent('.bootstrap-switch').hasClass('bootstrap-switch-off')) {
			$('body,html').animate({
				scrollTop: $("#block2").offset().top - 100
			}, 800);
		}

	});

	var waypoint = new Waypoint({
		element: document.getElementById('block2'),
		handler: function (direction) {
			if (direction === 'down') {
				$('#block2').closest("#block2").find(".title").addClass("active");
				$('#block2').closest("#block2").find("#block2-right").addClass("animated fadeInUp");
				$('#block2 .text .members .col-sm-3').each(function (i) {
				var row = $(this);
				setTimeout(function () {
					row.addClass('animated fadeInUp', !row.hasClass('animated fadeInUp'));
				}, 300 * i);

			});
			}
		},
		offset: 200
	});
	var waypoint = new Waypoint({
		element: document.getElementById('block3'),
		handler: function (direction) {
			if (direction === 'down') {
				$('#block3').closest("#block3").find(".title").addClass("active");
				$('.services .row .item').each(function (i) {
				var row = $(this);
				setTimeout(function () {
					row.addClass('animated fadeInUp', !row.hasClass('animated fadeInUp'));
				}, 300 * i);

			});
			}
		},
		offset: 200
	});
	
});