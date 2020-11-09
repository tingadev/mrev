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


function FlyItem(IDcontrolFly,left, height, opacity, maxwidth,quantity) {
        var IMG = $("#" + IDcontrolFly);
        $("body #ImgSC").remove();
        var tt = IMG.attr('src');
        $("body").append("<img id=\"ImgSC\" style=\"position:fixed; z-index:999; filter:alpha(opacity=" + opacity * 100 + " ); opacity:" + opacity + "; max-width:" + maxwidth + "px ; left:" + left + "px; top:" + height + "px \"; src=\"" + tt + "\"/>");
        left += 20;
        height = MheightI - ((left * MheightI) / MwidthS) + 20;
        opacity -= 0.02;
        maxwidth -= 5;
        if (left < MwidthS) {
            var timer = setTimeout("FlyItem('" + IDcontrolFly + "'," + left + "," + height + "," + opacity + "," + maxwidth + "," + quantity + ")", 10);
        }
        else {
            $("body #ImgSC").remove();
        }
    }

    function do_AddItemFlyCart(idControlS,id,title,src,link,price,stock) {


        var comfirmBox;

        
        var quantity = 1;
        // if(quantity == '0' ) quantity = 1;
        quantity = parseInt(quantity);
       
        var mydata =  'id='+ id+'&quantity='+quantity+'&title='+title+'&src='+src+'&link='+link+'&price='+price+'&stock='+stock;

        $.ajax({
            async: true,
            dataType: 'json',
            url : "ajax_html.php?ajax=add_to_cart",
            type: 'POST',
            data: mydata ,
            success: function (data) {
                if(data.ok == 1)    {
                    
                    MwidthS = $("#ext_numcart").offset().left;
                    MheightS = $("#ext_numcart").offset().top;
                    if (typeof ($("#" + idControlS)) != 'undefined') {
                        MwidthI = $("#" + idControlS).position().left + 250;
                        MheightI = $("#" + idControlS).position().top + 200;
                        var position = $("#" + idControlS).offset();
                    }
                    FlyItem(idControlS, MwidthI, MheightI, 1, 300,quantity);
                    // $("#ext_html_cat").html(data.html_cart);
                    $("#ext_numcart").html(data.totals);
                
                }else if(data.ok==2)
                {
                    $.alert({
                        icon: 'fal fa-exclamation-triangle',
                        title: js_global['annouce'],
                        content: js_global['order_contact_note'],
                    });
                }else {
                    $.alert({
		                icon: 'fal fa-exclamation-triangle',
		                title: js_global['annouce'],
		                content: js_global['out_of_stock'],
		            });
                }

            }
        })

    }
    function do_AddItemCart(idControlS,id,title,src,link,price,stock) {


        var comfirmBox;

        var color = $('#color').val();
        var size = $('#size').val();
        var sen = $('#sen').val();
        var quantity = 1;
         if(size==0){
            $.alert({
                icon: 'fal fa-exclamation-triangle',
                title: js_global['annouce'],
                content: js_global['empty_size'],
            });
            return false;
        }
        if(sen==0){
            $.alert({
                icon: 'fal fa-exclamation-triangle',
                title: js_global['annouce'],
                content: js_global['empty_sen'],
            });
            return false;
        }
        if(color==0){
            $.alert({
                icon: 'fal fa-exclamation-triangle',
                title: js_global['annouce'],
                content: js_global['empty_color'],
            });
            return false;
        }
        // if(quantity == '0' ) quantity = 1;
        quantity = parseInt(quantity);
       
        var mydata =  'size='+size+'&color='+color+'&id='+id+'&quantity='+quantity+'&title='+title+'&src='+src+'&link='+link+'&price='+price+'&stock='+stock+'&sen='+sen;

        $.ajax({
            async: true,
            dataType: 'json',
            url : "ajax_html.php?ajax=add_to_cart",
            type: 'POST',
            data: mydata ,
            success: function (data) {
                if(data.ok == 1)    {
                    location.href = './shopping_cart';
                
                }else if(data.ok==2)
                {
                    $.alert({
                        icon: 'fal fa-exclamation-triangle',
                        title: js_global['annouce'],
                        content: js_global['order_contact_note'],
                    });
                }else {
                    $.alert({
                        icon: 'fal fa-exclamation-triangle',
                        title: js_global['annouce'],
                        content: js_global['out_of_stock'],
                    });
                }

            }
        })

    }
    function do_AddItemCartNoFly(idControlS,id,title,src,link,price,stock) {


        var comfirmBox;

        var color = $('#color').val();
        var size = $('#size').val();
        var sen = $('#sen').val();
        var quantity = 1;
         if(size==0){
            $.alert({
                icon: 'fal fa-exclamation-triangle',
                title: js_global['annouce'],
                content: js_global['empty_size'],
            });
            return false;
        }
        if(sen==0){
            $.alert({
                icon: 'fal fa-exclamation-triangle',
                title: js_global['annouce'],
                content: js_global['empty_sen'],
            });
            return false;
        }
        if(color==0){
            $.alert({
                icon: 'fal fa-exclamation-triangle',
                title: js_global['annouce'],
                content: js_global['empty_color'],
            });
            return false;
        }
        // if(quantity == '0' ) quantity = 1;
        quantity = parseInt(quantity);
       
        var mydata =  'size='+size+'&color='+color+'&id='+id+'&quantity='+quantity+'&title='+title+'&src='+src+'&link='+link+'&price='+price+'&stock='+stock+'&sen='+sen;

        $.ajax({
            async: true,
            dataType: 'json',
            url : "ajax_html.php?ajax=add_to_cart",
            type: 'POST',
            data: mydata ,
            success: function (data) {
                if(data.ok == 1)    {
                    $("#ext_numcart").html(data.totals);
                
                }else if(data.ok==2)
                {
                    $.alert({
                        icon: 'fal fa-exclamation-triangle',
                        title: js_global['annouce'],
                        content: js_global['order_contact_note'],
                    });
                }else {
                    $.alert({
                        icon: 'fal fa-exclamation-triangle',
                        title: js_global['annouce'],
                        content: js_global['out_of_stock'],
                    });
                }

            }
        })

    }
