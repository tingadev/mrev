/** Top Nav
 **************************************************************** **/
vnTRUST.topNav = function () {



	//WAYPOINT MENU-LÍST
	window.onscroll = function () {
		myFunction();


	};

	// Get the header
	var header = document.getElementById("#topnav");


	// Get the offset position of the navbar


	function myFunction() {

		if ($(window).innerWidth() > 768) {
			if (window.pageYOffset > 0) {


				document.getElementById("topnav").classList.add("menu-fixed");
				var src = "images/logo-goc.png";
				document.getElementById("logo-topnav").setAttribute('src', src);

			} else {

				document.getElementById("topnav").classList.remove("menu-fixed");
				var src = "images/logo-bw.png";
				document.getElementById("logo-topnav").setAttribute('src', src);
			}
		}

	}








};
// When the user scrolls the page, execute myFunction 

/** init Load
 **************************************************************** **/
vnTRUST.init = function () {



	$("#slick-qtlv").slick({
		arrows: true,

		infinite: true,
		slidesToShow: 6,
		slidesToScroll: 1,
		cssEase: 'linear',
		autoplay: true,
		responsive: [
			{
				breakpoint: 1060,
				settings: {
					slidesToShow: 5
				}
                 },
			{
				breakpoint: 880,
				settings: {
					slidesToShow: 3
				}
                },

			{
				breakpoint: 480,
				settings: {
					slidesToShow: 2
				}
                }
            ]
	});


	//	PRODUCT
	$('#product').waypoint(function (direction) {
		if (direction === 'down') {
			$('.product-box').each(function (i) {
				var row = $(this);
				setTimeout(function () {
					row.addClass('fadeInUp', !row.hasClass('fadeInUp'));
				}, 400 * i);

			});

		}
	}, {
		offset: '300px'
	}).waypoint(function (direction) {
		if (direction === 'up') {
			// Do stuff
		}
	}, {
		offset: '75%'
	});


	$('#newsRight').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		dots: false,
		autoplay: false,
		autoplaySpeed: 2500,
		speed: 800,
		pauseOnHover: true,
		responsive: [
			{
				breakpoint: 1200,
				settings: {
					slidesToShow: 1
				}

            }
        ]
	});

	//WAYPOINT MENU-LÍST


	$('#about').waypoint(function (direction) {
		if (direction === 'down') {

			$('.block img').each(function (i) {
				var row = $(this);
				setTimeout(function () {
					row.addClass('animated flipInX', !row.hasClass('animated flipInX'));
				}, 100 * i);

			});
			$(this).closest("#about").find(".left").addClass("animated fadeInLeft");

		}
	}, {
		offset: '300px'
	}).waypoint(function (direction) {
		if (direction === 'up') {
			// Do stuff
		}
	}, {
		offset: '75%'
	});









	// ===== Scroll to Top ==== 

	$('#top').click(function () { // When arrow is clicked
		$('body,html').animate({
			scrollTop: 0 // Scroll to top of body
		}, 500);
	});
	$('#backtop').click(function () { // When arrow is clicked
		$('body,html').animate({
			scrollTop: 0 // Scroll to top of body
		}, 500);
	});



	$(".show").click(function () {
		$(this).closest(".info-com").find("ul").toggleClass('display480');
		if ($(this).closest(".show").find("i").hasClass('fa-caret-right')) {
			$(this).closest(".info-com").find("i").removeClass('fa-caret-right');
			$(this).closest(".info-com").find("i").addClass('fa-sort-down');
		} else {
			$(this).closest(".info-com").find("i").addClass('fa-caret-right');
			$(this).closest(".info-com").find("i").removeClass('fa-sort-down');
		}



	});
	//	LANGUAGE
	$(".languageMobile .icon").click(function () {
		if (!$(this).parents(".languageMobile").hasClass("active")) {
			$(this).parents(".languageMobile").addClass("active");
			$(this).parents(".languageMobile").find(".popup").stop().slideDown(200);
			$('html').addClass("openmenu");
		} else {
			$(this).parents(".languageMobile").removeClass("active");
			$(this).parents(".languageMobile").find(".popup").stop().slideUp(200, function () {
				$(this).css({
					"height": "auto"
				});
			});
			$('html').removeClass("openmenu");
		}
	});
	// SELECT J
	$(".select-j .title-s").click(function () {
		if (!$(this).parents(".select-j").hasClass("active")) {
			$(this).parents(".select-j").addClass("active");
			$(this).parents(".select-j").find(".content").stop().slideDown();
		} else {
			$(this).parents(".select-j").removeClass("active");
			$(this).parents(".select-j").find(".content").stop().slideUp();
		}
	});


	//    MENUFIX
	$(".topnav-right .iconmenu").click(function () {


		$(".sub-menu .menu_mobile .divmm").addClass('show');
		if ($(".sub-menu .menu_mobile .divmm").hasClass('show')) {
			$(this).parents(".topnav-right").find(".iconmenu").addClass("menu-trigger");
		}

	});
	$("#close-mmenu").click(function () {



		document.getElementById('menu-fixed').classList.remove("menu-trigger");
	});
	if (!$(".sub-menu .menu_mobile .divmm").hasClass('show')) {
		$(this).parents(".topnav-right").find(".iconmenu").addClass("menu-trigger");
	}




	// QTLV
	$(".qtlv-box .qtlv-circle").hover(function () {

		if (!$(this).parents(".qtlv-box").hasClass("active")) {
			$(this).parents(".qtlv-box").addClass("active");

		} else {
			$(this).parents(".qtlv-box").removeClass("active");

		}
	});

	$('#qtlv').waypoint(function (direction) {
		if (direction === 'down') {

			$(this).closest("#qtlv").find(".title").addClass("active");
			$('.qtlv-box').each(function (i) {
				var row = $(this);
				setTimeout(function () {
					row.addClass('animated fadeInUp', !row.hasClass('aniamted fadeInUp'));
				}, 200 * i);

			});
		}
	}, {
		offset: '300px'
	}).waypoint(function (direction) {
		if (direction === 'up') {
			// Do stuff
		}
	}, {
		offset: '75%'
	});

};

/* Init */
jQuery(window).ready(function () {
	vnTRUST.init();
	vnTRUST.topNav();

});

//GROUP - BUTTON - FOOTER


//OPEN TAB
function openTab(evt, tabName) {
	var i, tabcontent, tablinks;
	tabcontent = document.getElementsByClassName("vnt-tab-content");
	for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	}
	tablinks = document.getElementsByClassName("vnt-btn-tab");
	tablinks = document.getElementsByClassName("vnt-btn-tab");
	for (i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" active", "");

		tablinks[i].classList.remove('t-active');
	}
	document.getElementById(tabName).style.display = "block";
	evt.currentTarget.className += " active";
}

function getTitle(x) {

	document.getElementById('title-tab-i').innerHTML = x.innerHTML;
	document.querySelector('.content').style.display = "none";
	var a = document.querySelector('.select-j');
	a.classList.remove('active');
}

function showContentInfo() {
	document.querySelector('.content-info').style.display = "block";
}

function hideContentInfo() {
	document.querySelector('.content-info').style.display = "none";
}