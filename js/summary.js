(function($) {

	/*
	 * Build summary
	 */

	$(document).ready(build);

	function build() {
		var container = $('.table-of-contents');
		var content =  $('#content .post-content');
		var tags = ['h1','h2','h3','h4','h5','h6'];
		container.append('<ol/>');
		$.each(tags, function(i, tag) {
			var cTag = content.find(tag);
			if(cTag.length) {
				cTag.each(function() {
					if($(this).find('.summary-item')) {
						var item = $('<li/>').addClass($(this).attr('id')).addClass($(this).attr('class'));
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
	}

	/*
	 * Hashchange
	 */

	 $(document).ready(function() {
		 $(window).hashchange(update);
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