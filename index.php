<?php

get_header();

toolkit_category_nav();

if(is_front_page()) {

	toolkit_home_slider();

} elseif(is_category()) {

	toolkit_category_header();

}

get_template_part('loop');

get_footer();

?>