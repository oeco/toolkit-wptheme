(function($) {

	/*
	 * Build summary
	 */

	$(document).ready(build);

	var container;
	var hItems;

	function build() {
		var content =  $('#content .post-content');
		var tags = ['h1','h2','h3','h4','h5','h6'];
		container = $('.table-of-contents');
		hItems = content.find('.summary-item');
		container.append('<ol/>');
		$.each(tags, function(i, tag) {
			var cTag = content.find(tag);
			if(cTag.length) {
				cTag.each(function() {
					if($(this).find('.summary-item')) {
						var item = $('<li/>').addClass($(this).attr('id') + ' ' + $(this).attr('class'));
						item.append($(this).find('a').clone());
						container.find('ol').append(item);
					}
				});
			}
		});

		$('.aside-item.toolkit-summary').followScroll({
			startPadding: 40,
			stopFollow: {
				element: $('.post-content'),
				stopAtEnd: true
			}
		});

		$(window).scroll(follow).scroll();
	}

	function follow() {

		var scrollTop = $(window).scrollTop() + ($(window).height() / 3);

		hItems.each(function() {
			var next = $(this).next('.summary-item');
			if(scrollTop >= $(this).offset().top && (!next.length || scrollTop < next.offset().top)) {
	 			container.find('li').removeClass('active');
				container.find('.' + $(this).attr('id')).addClass('active');
			}
		});

	}

	/*
	 * Hashchange
	 */

	 $(document).ready(function() {
		 $(window).hashchange(update).hashchange();
		 $(window).hashchange();
	});

	 function update() {
	 	if(location.hash) {
	 		var hash = location.hash.replace('#', '');
	 		$('.summary-item').removeClass('active');
	 		$('.summary-item.' + hash + ', #' + hash).addClass('active');
	 	}
	 }

})(jQuery);