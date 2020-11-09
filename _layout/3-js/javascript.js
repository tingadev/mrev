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
	
	
	
});


//FUNCTION
function getType(value) {
	//	var node = document.createElement("div"); 
	//	var a = document.querySelector('.product .content');
	//	a.appendChild(node);
	//	node.className = "loading_product";
	//			slickDots.parents(".wrapper").wrap("<div class='slick-dots-wrapper'></div>");
	var key = value;
	document.querySelector('.loading_product').style.display = 'block';
	if (value == 1) {
		setTimeout(function () {
			document.querySelector('.loading_product').style.display = 'none';
		}, 300);
		$('.item[data-type="1"]').addClass('fadeIn cBlock');
		$('.item[data-type="1"]').removeClass('cNone');
		$('.item[data-type="2"]').removeClass('fadeIn cBlock');
		$('.item[data-type="2"]').addClass('cNone');

	}
	if (value == 2) {
		setTimeout(function () {
			document.querySelector('.loading_product').style.display = 'none';
		}, 300);
		$('.item[data-type="2"]').addClass('fadeIn cBlock');
		$('.item[data-type="2"]').removeClass('cNone');
		$('.item[data-type="1"]').addClass('cNone');
		$('.item[data-type="1"]').removeClass('fadeIn cBlock');


	}

	if (value == -1) {
		setTimeout(function () {
			document.querySelector('.loading_product').style.display = 'none';
		}, 300);
		$('.content .item').addClass('fadeIn cBlock');
		$('.content .item').removeClass('cNone');


	}
}