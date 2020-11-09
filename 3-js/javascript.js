$(document).ready(function(){
	
	if ($(window).innerWidth() > 1025) {
        $("html").niceScroll({
            cursorborder: 0,
            cursorborderradius: 5,
            cursorcolor: 'rgba(248, 174, 65,0.5)',
            cursorwidth: 10,
            horizrailenabled: false,
            mousescrollstep: 40,
            scrollspeed: 88,
            background: 'rgba(222, 222, 222, .75)',
        });
    }
	
	$('.scroll').click(function () { // When arrow is clicked
            $('body,html').animate({
                scrollTop: $(".product").offset().top - 100
            }, 500);
        });

 if($('.menu_list li ul').hasClass('uk-nav-sub')){
    var dom = $('.menu_list li ul').parent();
    dom.addClass('ok');
 }
 $('.menu_list li.ok span').click(function(){
    $(this).parent().toggleClass('active');
    // if($(this).hasClass('active')){
        
    // }
    // if(!($(this).hasClass('active'))){
    //     $(this).addClass('active');
    // }
 });


});

function showModal($id,$lang,$title,$price,$param,$add_cart,$buy_now,$link,$stock,$src,$color,$size,$sen,$color_title,$size_title,$sen_title) {
	
		var mydata = "order_contact="+js_global['order_contact']+"&color_title="+$color_title+"&size_title="+$size_title+"&sen_title="+$sen_title+"&color="+$color+"&sen="+$sen+"&size="+$size+"&src="+$src+"&stock="+$stock+"&link="+$link+"&id="+$id+"&lang="+$lang+"&title="+$title+"&price="+$price+"&param="+$param+"&add_cart="+$add_cart+"&buy_now="+$buy_now;
		$.ajax({
			async: true,
            dataType: 'text',
            url : "ajax_html.php?ajax=show_modal",  
            type: 'POST',
            data: mydata ,
            success: function (response) {
                $('#modal-center'+$id).html(response);
            }
		});
	}

function getCatSubProducts(value,lang) {
	if(value == -1){
		$('#step_p').val(step_reset);
	}
	$('#temp_s').val(0);
    var title_brand = js_global['title_brand'];
	var mydata = "id="+value+"&lang="+lang+"&title_brand="+title_brand;
		$.ajax({
			async: true,
            dataType: 'text',
            url : "ajax_html.php?ajax=getCatSub",  
            type: 'POST',
            data: mydata ,
            success: function (response) {
                $('#cat_id_c').html(response);
            }
		});
}
function getListProducts(value,$limit,lang,$param,$add_cart,$buy_now,$unit,$color_title,$size_title,$sen_title) {
	$('#step_p').val(step_reset);
    $('#temp_s').val(0);
	$('#button_more').css('opacity','1');
	var step_p = 0;
	var mydata = "order_contact="+js_global['order_contact']+"&color_title="+$color_title+"&size_title="+$size_title+"&sen_title="+$sen_title+"&id="+value+"&step="+step_p+"&limit="+$limit+"&lang="+lang+"&param="+$param+"&add_cart="+$add_cart+"&buy_now="+$buy_now+"&unit="+$unit;
		$.ajax({
			async: true,
            dataType: 'json',
            url : "ajax_html.php?ajax=get_list_product",  
            type: 'POST',
            data: mydata ,
            success: function (response) {
                $('#results').html(response.text);
                if(response.hide==1){
                	$('#button_more').css('opacity','0');
                }
                $("html").getNiceScroll().resize();

            }

		});
}
function getListProductsKeys(value,$limit,lang,$param,$add_cart,$buy_now,$unit,$color_title,$size_title,$sen_title) {
	$('#step_p').val(step_reset);
    $('#temp_s').val(0);
	value = -1;
	var keywords = $('#keywords').val();
	if(keywords==''){
		$("#keywords").focus();
            $.alert({
                icon: 'fas fa-exclamation-triangle',
                title: js_global['annouce'],
                content: js_global['empty_keywords'],
            });
            
			
            return false;
	}
	$('#button_more').css('opacity','1');
	var step_p = 0;
	var mydata = "order_contact="+js_global['order_contact']+"&color_title="+$color_title+"&size_title="+$size_title+"&sen_title="+$sen_title+"&keywords="+keywords+"&id="+value+"&step="+step_p+"&limit="+$limit+"&lang="+lang+"&param="+$param+"&add_cart="+$add_cart+"&buy_now="+$buy_now+"&unit="+$unit;
		$.ajax({
			async: true,
            dataType: 'json',
            url : "ajax_html.php?ajax=get_list_product",  
            type: 'POST',
            data: mydata ,
            success: function (response) {
                $('#results').html(response.text);
                if(response.hide==1){
                	$('#button_more').css('opacity','0');
                }
                $("html").getNiceScroll().resize();

            }
            
		});
}
function getCatListProducts(value,$limit,lang,$param,$add_cart,$buy_now,$unit,$color_title,$size_title,$sen_title) {
	// if(value == -1 || value == 87){
		$('#button_more').css('opacity','1');
		var step_p = 0;

		var mydata = "order_contact="+js_global['order_contact']+"&color_title="+$color_title+"&size_title="+$size_title+"&sen_title="+$sen_title+"&id="+value+"&step="+step_p+"&limit="+$limit+"&lang="+lang+"&param="+$param+"&add_cart="+$add_cart+"&buy_now="+$buy_now+"&unit="+$unit;
		$.ajax({
			async: true,
            dataType: 'json',
            url : "ajax_html.php?ajax=get_list_product",  
            type: 'POST',
            data: mydata ,
            success: function (response) {
                $('#results').html(response.text);
                if(response.hide==1){
                	$('#button_more').css('opacity','0');
                }
                $("html").getNiceScroll().resize();
            }
		});
	// }
	
}
function getListProductsMore(value,$limit,lang,$param,$add_cart,$buy_now,$unit,$color_title,$size_title,$sen_title) {
		var step_p = $('#step_p').val();
        var step_m = $('#step').val();
        var temp_s = $('#temp_s').val();
		value = id_global;
		var mydata = "order_contact="+js_global['order_contact']+"&color_title="+$color_title+"&size_title="+$size_title+"&sen_title="+$sen_title+"&temp_s="+temp_s+"&step_m="+step_m+"&id="+value+"&step="+step_p+"&limit="+$limit+"&lang="+lang+"&param="+$param+"&add_cart="+$add_cart+"&buy_now="+$buy_now+"&unit="+$unit;
		$.ajax({
			async: true,
            dataType: 'json',
            url : "ajax_html.php?ajax=get_list_product_more",  
            type: 'POST',
            data: mydata ,
            success: function (response) {
                $('#results').append(response.text);
                $('#step_p').val(response.step);
                $('#temp_s').val(response.step);
                if(response.hide==1){
                	$('#button_more').css('opacity','0');
                }
                $("html").getNiceScroll().resize();

            }
		});
	
	
}

function passCatId(id){
	id_global = id;
	return id_global;
}
function getColor(id){
    $('#color').val(id);
}
function getSize(id){
    $('#size').val(id);
}
function getSen(id){
    $('#sen').val(id);
}