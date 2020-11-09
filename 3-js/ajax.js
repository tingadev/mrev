$(function () {
	var $container = $('#results');
	var viewMoreButton = document.querySelector('.view-more-button');
	$container.infiniteScroll({
		// options
		path: function () {
			if (this.loadCount < 3) {
				var pageNumber = this.loadCount + 2;
				return pageNumber + '.html';
			}

		},
		append: '.item',
		button: '.view-more-button',
		 scrollThreshold: false,
		status: '.page-load-status',

	});
	$container.on( 'append.infiniteScroll', function( event, response, path, items ) {
 $("html").getNiceScroll().resize();
});




});