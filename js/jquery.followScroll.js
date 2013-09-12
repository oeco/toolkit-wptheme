(function($) {

	$.fn.followScroll = function(options) {

		var settings = $.extend({

			startPadding: 0,
			stopFollow: {
				element: this.parent(),
				stopAtEnd: true
			}

		}, options);

		var stop = settings.stopFollow;

		if(typeof stop === 'object' && typeof stop.element !== 'undefined') {

			var elStop = stop.element.offset().top;

			if(typeof stop.stopAtEnd === 'boolean') {
				if(stop.stopAtEnd) {
					var elStop = elStop + stop.element.height();
				}
			}

			stop = elStop;

		}

		this.each(function() {

			var ghostEl = $(this).clone();

			var offset = $(this).offset();
			var width = $(this).width();
			var height = $(this).height();
			var position = $(this).css('position');

			var start = offset.top - settings.startPadding;

			ghostEl
				.css({
					visibility: 'hidden',
					display: 'none'
				})
				.addClass('follow-scroll-ghost')
				.insertBefore($(this));

			var self = $(this);

			$(window).scroll(function() {

				if($(window).scrollTop() >= start) {

					ghostEl.css({display: 'block'});

					if(typeof stop !== 'undefined' && $(window).scrollTop() <= (stop - self.height())) {

						self.css({
							position: 'fixed',
							top: settings.startPadding,
							width: width,
							height: height
						});

					} else {

						ghostEl.css({display: 'none'});
						self.css({position: position});

					}

				} else {

					ghostEl.css({display: 'none'});
					self.css({position: position});

				}

			});

		});

	}

})(jQuery);