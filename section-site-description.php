<section id="site-description" class="row anti-row">
	<div class="container">
		<div class="twelve columns">
			<?php
			$about_page = get_page_by_path('about');
			$url = get_permalink($about_page->ID);
			?>
			<p class="main-text"><?php printf(__('Geojournalism.org provides online resources and training for <a href="%s">journalists</a>, <a href="%s">designers</a> and <a href="%s">developers</a> to dive into the world of data visualization using geographic data.', 'toolkit'), $url . '#for-journalists', $url . '#for-designers', $url . '#for-developers'); ?></p>
			<div id="live-search">
				<input type="text" placeholder="<?php _e('Search for tutorials, case studies and concepts...', 'toolkit'); ?>" />
			</div>
		</div>
	</div>
</section>