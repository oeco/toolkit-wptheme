(function($) {

	/*
	 * Slider
	 */

	$(document).ready(function() {

		var container = $('.featured-slider');
		var items = container.find('.slider-items li');
		var controllers = container.find('.slider-controllers li');

		var current = items.first();

		current.addClass('active');

		function slide() {

			if(current.next().is('li:last')) { 
				var toGo = items.first();
			} else {
				var toGo = current.next('li');
			}

			show(toGo);

		}

		function show(item) {

			// change active controller
			controllers.removeClass('active');
			container.find('.slider-controllers li[data-sliderid="' + item.data('sliderid') + '"]').addClass('active');

			items.removeClass('active');
			item.addClass('active');

			current = item;

			clearInterval(run);
			run = setInterval(slide, 8000);

		}

		// bind controls

		controllers.click(function() {

			var toGo = container.find('.slider-items li[data-sliderid="' + $(this).data('sliderid') + '"]');

			show(toGo);

			return false;

		});

		var run = setInterval(slide, 8000);

	});
		

})(jQuery);