<?php

get_header();

if(is_front_page() || is_category()) {

	//toolkit_category_nav();

}

if(is_front_page()) {

	get_template_part('section', 'site-description');

	?>
	<div class="clearfix">
		<?php
		toolkit_home_slider();
		get_template_part('section', 'editors-pick');
		?>
	</div>
	<?php

	get_template_part('section', 'tracks');

} elseif(is_category()) {

	toolkit_category_header();

} elseif(is_archive()) {

	toolkit_archive_header();

}

get_template_part('loop');

get_footer();

?>