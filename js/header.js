(function($) {

	$(document).ready(function() {

		var $head = $('#masthead');
		var $ghost = $head.clone();
		$ghost.removeClass('fixed');
		var $title = $head.find('h1');

		var topOffset = $title.offset().top;

		$(window).scroll(function() {

			if(topOffset - $(window).scrollTop() <= 0) {
				$ghost.insertBefore($head);
				if(!$head.hasClass('fixed'))
					$head.addClass('fixed');
			} else {
				$ghost.detach();
				if($head.hasClass('fixed'))
					$head.removeClass('fixed');
			}

		});

	});

})(jQuery);