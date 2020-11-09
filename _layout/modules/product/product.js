$(document).ready(function (){
	$(".box_search").mnfixed({
		top: 89,
		break: 991,
		limit: '#limit',
	});
	var width = $(window).width();
    if (width < 768) {
        size_li = $("#product-container div.product-box").size();
        x = 6;
        $('#product-container div.product-box:lt(' + x + ')').fadeIn();
        $('.p-3-container .btn-view  a.btn.view-all').click(function () {
            $(".pro-lazy").addClass("loading");
            setTimeout(function () {
                x = (x + 2 <= size_li) ? x + 2 : size_li;
                $('#product-container div.product-box:lt(' + x + ')').fadeIn();
                $(".pro-lazy").removeClass("loading");
            }, 1000);


        });
    } else {
        size_li = $("#product-container div.product-box").size();
        x = 6;
        $('#product-container div.product-box:lt(' + x + ')').fadeIn();
        $('.p-3-container .btn-view  a.btn.view-all').click(function () {
            $(".pro-lazy").addClass("loading");
            setTimeout(function () {
                x = (x + 3 <= size_li) ? x + 3 : size_li;
                $('#product-container div.product-box:lt(' + x + ')').fadeIn();
                $(".pro-lazy").removeClass("loading");
            }, 1000);


        });

    }





    $("#slideOther").slick({
        slidesToShow: 5,
        autoplay: true,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 360,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });
    // PRODUCT THUMBNAIL
    $("#vnt-thumbnail-for").slick({
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        asNavFor: "#vnt-thumbnail-nav",
    });
    $("#vnt-thumbnail-nav").slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: "#vnt-thumbnail-for",
        focusOnSelect: true,
        
        responsive: [

            {

                breakpoint: 480,

                settings: {
                    slidesToShow: 5
                   
                }

        	},
            {
                breakpoint: 340,
                settings: {
                    slidesToShow: 2,
                    vertical: false
                }

        	}
        ]
    });

    $("#product-related").slick({
        infinite: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        cssEase: 'linear',
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
			{
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }

        	},
			{
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                }

        	}
            
        ]
    });

    // TAB PRODUCT

    $(".productContent .mc-tab").click(function () {
        if (!$(this).parents(".productContent").hasClass("active")) {
            $(this).parents(".productContent").addClass("active");
        } else {
            $(this).parents(".productContent").removeClass("active");
        }
    });
    $(".productContent .tab-list li a").click(function () {
        if ($(window).innerWidth() <= 991) {
            $(".productContent").removeClass("active");
        }
    });

    // $("#vnt-thumbnail-for .item a").fancybox({
    //     padding: 5,
    // });


    // SELECT P
    $(".select-p .title").click(function () {
        if (!$(this).parents(".select-p").hasClass("active")) {
            $(this).parents(".select-p").addClass("active");
            $(this).parents(".select-p").find(".content").stop().slideDown();
        } else {
            $(this).parents(".select-p").removeClass("active");
            $(this).parents(".select-p").find(".content").stop().slideUp();
        }
    });
});