$(document).ready(function (){
      $(".box_search").mnfixed({
            top: -95,
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
     var $fly = $('#vnt-thumbnail-for');
        $fly.on('init', function (event, slick) {
            addFly($fly);
            
        });
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
   

    
    $fly.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
    var remove = slick.$slides[currentSlide];
    $(remove).find("img").attr("id",'hehe');
    var add = slick.$slides[nextSlide];
    $(add).find("img").attr("id",'helo');

    
   
    
    
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

    $("#vnt-thumbnail-for .item a").fancybox({
        padding: 5,
    });


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

function addFly($fly) {
        var $id = $fly.find('.slick-current img');
        $id.attr("id","helo");       
    }
function showAddCart(id)
    {
        $.fancybox.open({
            padding     : 0,
            type: 'iframe',
            src         :  ROOT_MOD+'/popup/addcart.html/?id='+id ,
            opts:{
        iframe:{
            css:{
                width:500,
                height:200
            }
        },
        fullScreen:false,
    }
        });
    }

    function showCart ()
    {
        $.fancybox({
            'padding'       : 0,
            'width' : 750,
            'height' : 400,
            'autoSize': false,
            'href'          :  ROOT_MOD+'/popup/showcart.html',
            'transitionIn'  : 'elastic',
            'transitionOut' : 'elastic',
            'overlayShow'    :    false,
            'type': 'iframe'
        });
    }

    function doAddCart(id)
    {

        var quantity = 1 ;
        var ok_add = 1 ;
        var err = '';
        if($("#quantity_"+id).length){
            quantity =  parseInt ($("#quantity_"+id).val());
        }
        if(quantity == 0 ) quantity = 1;

        if(ok_add){
            var mydata =  'id='+ id+'&quantity='+quantity ;
            $.ajax({
                async: true,
                dataType: 'json',
                url:  ROOT_MOD+"/ajax/add_cart.html" ,
                type: 'POST',
                data: mydata ,
                success: function (data) {
                    if(data.ok == 1)    {
                        $("#ext_numcart").html(data.num_item);
                        vnTOrder.showAddCart(id);
                    }   else {
                        $.alert({

                            icon : 'fa fa-warning',
                            title: js_lang['error'],
                            content : data.mess,

                        });
                        
                    }
                }
            });
        }else{
            $.alert({

                            icon : 'fa fa-warning',
                            title: js_lang['error'],
                            content : data.mess,

                        });
            
        }


        return false;
    }



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

    function changeQuantity(obj,type,id_cart)
    {
        
        var cur_quantity    =   parseInt( $("#"+obj).val() );

        if( type=="decrease" ) {
            if(cur_quantity>1){
                $("#"+obj).val(cur_quantity-1);
            }
        }else{
            $("#"+obj).val(cur_quantity+1);
        }

        if(id_cart>0){
            updateQuantity(id_cart);
        }
    }

    function updateQuantity(id)
    {
        var quantity    =   parseInt( $("#quantity_"+id).val() );
        if( $.isNumeric( quantity ) ) {
            
            if(quantity < 1){
                $("#quantity_"+id).val(1);
            }
            
            // else{
            //     var mydata = 'id='+id+'&quantity='+quantity ;
            //     $.ajax({
            //         async: true,
            //         dataType: 'json',
            //         url:  ROOT_MOD+"/ajax/update_quantity.html" ,
            //         type: 'POST',
            //         data: mydata ,
            //         success: function (data) {
            //             $("#ext_total_"+id).html(data.total);
            //             $("#ext_cart_total").html(data.cart_total);
            //             $("#ext_total_price").html(data.total_price);

            //             $("#ext_promotion_price").html(data.promotion_price);
            //             $("#ext_surcharges_price").html(data.surcharges_price);
            //             $("#total_surcharges").val(data.total_surcharges);
            //             $("#total_weight").val(data.total_weight);

            //         }
            //     });
            // }

        }
        else{

                $("#quantity_"+id).val(1);
            
        }
    }
    function setFinished(){
        finished = 1;

        return finished;
    }