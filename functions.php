<?php

/*
 * Toolkit functionalities
 */

require_once(TEMPLATEPATH . '/inc/tutorials.php'); // Tutorials
require_once(TEMPLATEPATH . '/inc/tools.php'); // Tools
require_once(TEMPLATEPATH . '/inc/glossary.php'); // Glossary
require_once(TEMPLATEPATH . '/inc/slider.php'); // Featured slider

/*
 * Toolkit theme setup
 */

function toolkit_setup() {
	// text domain
	//load_theme_textdomain('toolkit', get_template_directory() . '/languages');

	add_theme_support('post-thumbnails');

	add_image_size('featured-image', 1160, 296, true);
	add_image_size('tool-thumbnail', 260, 260, true);

	register_nav_menus(array(
		'header_menu' => __('Header menu', 'mappress'),
		'footer_menu' => __('Footer menu', 'mappress')
	));

	//sidebars
	register_sidebar(array(
		'name' => __('General sidebar', 'mappress'),
		'id' => 'general',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
	));

}
add_action('after_setup_theme', 'toolkit_setup');

/*
 * Styles
 */

function toolkit_styles() {

	wp_register_style('base', get_template_directory_uri() . '/css/base.css');
	wp_register_style('skeleton', get_template_directory_uri() . '/css/skeleton.css', array('base'));
	wp_register_style('webfonts', 'http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic|Open+Sans:300italic,400italic,600italic,400,300,600,700,800');

	wp_enqueue_style('main', get_template_directory_uri() . '/css/main.css', array('skeleton', 'webfonts'));
	wp_enqueue_style('print', get_template_directory_uri() . '/css/print.css', array('main'), '0.1', 'print');

}
add_action('wp_enqueue_scripts', 'toolkit_styles');

/*
 * Advanced Custom Fields
 */

function toolkit_acf_path() {
	return get_template_directory_uri() . '/inc/acf/';
}
add_filter('acf/helpers/get_dir', 'toolkit_acf_path');

define('ACF_LITE', false);
require_once(TEMPLATEPATH . '/inc/acf/acf.php');
include_once(TEMPLATEPATH . '/inc/acf/add-ons/acf-qtranslate/acf-qtranslate.php');

/*
 * Shortcodes
 */

require_once(TEMPLATEPATH . '/inc/shortcodes/et-shortcodes.php');

/*
 * Templates
 */

function toolkit_category_nav() {

	$categories = get_terms('category', array('hide_empty' => false));
	if($categories) {
		?>
		<div class="row">
			<nav id="category-nav">
				<ul>
					<?php foreach($categories as $cat) : ?>
						<li class="<?php echo $cat->slug; ?> <?php if(is_category($cat->term_id)) echo 'active'; ?>">
							<a href="<?php echo get_term_link($cat, 'category'); ?>" title="<?php _e('View all content on', 'toolkit'); echo $cat->name; ?>"><?php echo $cat->name; ?></a>
						</li>
					<?php endforeach; ?>
					<li class="all <?php if(is_front_page()) echo 'active'; ?>">
						<a href="<?php echo home_url('/'); ?>" title="<?php _e('View all content', 'toolkit'); ?>"><?php _e('All', 'toolkit'); ?></a>
					</li>
				</ul>
			</nav>
		</div>
		<?php
	}

}

function toolkit_home_slider() {
	query_posts(array('post_type' => 'slider'));
	if(!have_posts())
		return false;
	wp_enqueue_script('toolkit-slider', get_template_directory_uri() . '/js/carousel.js', array('jquery'));
	?>
	<div class="home-slider eyecandy">
		<?php get_template_part('section', 'slider'); ?>
	</div>
	<?php
	wp_reset_query();
}

function toolkit_category_header() {
	?>
	<div class="cat-header eyecandy">
		<div class="container">
			<div class="twelve columns">
				<h2><?php single_cat_title(); ?></h2>
				<?php echo category_description(); ?>
			</div>
		</div>
	</div>
	<?php
}

function toolkit_archive_header() {
	?>
	<div class="archive-header eyecandy">
		<div class="container">
			<div class="twelve columns">
				<?php if(is_post_type_archive()) { ?>
					<h2><?php post_type_archive_title(); ?></h2>
				<?php } elseif(is_tax()) { ?>
					<h2><?php single_term_title(); ?></h2>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php
}

function toolkit_category_list() {
	$categories = get_the_terms($post->ID, 'category');
	if($categories) { ?>
		<span class="categories category-circles">
			<?php foreach($categories as $cat) { ?>
				<span class="balloon-container">
					<a href="<?php echo get_term_link($cat, 'category'); ?>" class="category <?php echo $cat->slug; ?>"><?php echo $cat->name; ?></a>
					<span class="balloon balloon-bottom">
						<span class="content">
							<span class="center"><a href="<?php echo get_term_link($cat, 'category'); ?>" title="<?php echo $cat->title; ?>"><?php echo $cat->name; ?></a></span>
						</span>
					</span>
				</span>
			<?php } ?>
		</span>
	<?php
	}
}