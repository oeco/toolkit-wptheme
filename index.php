<?php

get_header();

if(is_front_page() || is_category()) {

	toolkit_category_nav();

}

if(is_front_page()) {

	toolkit_home_slider();

} elseif(is_category()) {

	toolkit_category_header();

} elseif(is_archive()) {

	toolkit_archive_header();

}

get_template_part('loop');

get_footer();

?>