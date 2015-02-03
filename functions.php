<?php

/*
 * Toolkit functionalities
 */

require_once(TEMPLATEPATH . '/inc/tracks.php'); // Tracks
require_once(TEMPLATEPATH . '/inc/picks.php'); // Picks
require_once(TEMPLATEPATH . '/inc/tutorials.php'); // Tutorials
require_once(TEMPLATEPATH . '/inc/tools.php'); // Tools
require_once(TEMPLATEPATH . '/inc/glossary.php'); // Glossary
require_once(TEMPLATEPATH . '/inc/slider.php'); // Featured slider
require_once(TEMPLATEPATH . '/inc/live-search/live-search.php'); // Live search

/*
 * Toolkit theme setup
 */

function toolkit_setup() {
	// text domain
	load_theme_textdomain('toolkit', get_template_directory() . '/lang');

	add_theme_support('post-thumbnails');

	add_image_size('featured-image', 1160, 296, true);
	add_image_size('tool-thumbnail', 260, 260, true);

	register_nav_menus(array(
		'header_menu' => __('Header menu', 'toolkit'),
		'footer_menu' => __('Footer menu', 'toolkit')
	));

	//sidebars
	register_sidebar(array(
		'name' => __('General sidebar', 'toolkit'),
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

	wp_enqueue_script('jquery');
	wp_enqueue_script('toolkit-header', get_template_directory_uri() . '/js/header.js', array('jquery'));

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
	wp_enqueue_script('toolkit-slider', get_template_directory_uri() . '/js/carousel.js', array('jquery'), '1.0');
	?>
	<div class="home-slider eyecandy">
		<?php get_template_part('section', 'slider'); ?>
	</div>
	<?php
	wp_reset_query();
}

function toolkit_category_header() {
	?>
	<div class="cat-header sub-header">
		<div class="container">
			<div class="twelve columns">
				<h1><?php _e('Tutorials covering', 'toolkit'); ?> <?php single_term_title(); ?></h1>
				<?php echo category_description(); ?>
			</div>
		</div>
	</div>
	<?php
}

function toolkit_archive_header() {
	?>
	<div class="archive-header sub-header">
		<div class="container">
			<div class="twelve columns">
				<?php if(is_post_type_archive()) { ?>
					<h1><?php post_type_archive_title(); ?></h1>
				<?php } elseif(is_category() || is_tag()) { ?>
					<h1><?php _e('Tutorials covering', 'toolkit'); ?> <?php single_term_title(); ?></h1>
				<?php } elseif(is_tax()) { ?>
					<h1><?php single_term_title(); ?></h1>
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

function toolkit_qtranslate_edit_taxonomies() {
	$args = array(
		'public' => true ,
		'_builtin' => false
	);

	$output = 'object'; // or objects
	$operator = 'and'; // 'and' or 'or'

	$taxonomies = get_taxonomies($args,$output,$operator);

	if($taxonomies) {
		foreach ($taxonomies  as $taxonomy ) {
			add_action($taxonomy->name.'_add_form', 'qtrans_modifyTermFormFor');
			add_action($taxonomy->name.'_edit_form', 'qtrans_modifyTermFormFor');
		}
	}

}
add_action('admin_init', 'toolkit_qtranslate_edit_taxonomies');

function toolkit_before_colophon_widget() {

	$lang_widgets = array();

	if(function_exists('qtrans_getLanguage')) {
		global $q_config;
		$lang_widgets = $q_config['enabled_languages'];
	}

	if(empty($lang_widgets)) {
		register_sidebar( array(
			'name' => __('Footer form', 'toolkit'),
			'id' => 'toolkit_footer_form',
			'before_widget' => '<div>',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widgettitle">',
			'after_title' => '</h2>',
		));
	} else {
		foreach($lang_widgets as $lang_widget) {

			register_sidebar( array(
				'name' => __('Footer form', 'toolkit') . ' (' . $lang_widget . ')',
				'id' => 'toolkit_footer_form_' . $lang_widget,
				'before_widget' => '<div>',
				'after_widget' => '</div>',
				'before_title' => '<h2 class="widgettitle">',
				'after_title' => '</h2>',
			));

		}
	}
}
//add_action('widgets_init', 'toolkit_before_colophon_widget');

function toolkit_before_colophon() {
	?>
	<div class="footer-form-container">
		<div class="container">
			<div class="twelve columns">
				<div id="footer-form">
					<?php
					if(function_exists('qtrans_getLanguage'))
						dynamic_sidebar('toolkit_footer_form_' . qtrans_getLanguage());
					else
						dynamic_sidebar('toolkit_footer_form');
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
//add_action('toolkit_before_colophon', 'toolkit_before_colophon');

function toolkit_social_apis() {

	// Facebook
	?>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=1413694808863403";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<?php

	// Twitter
	?>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	<?php

	// Google Plus
	?>
	<script type="text/javascript">
	  (function() {
	    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	    po.src = 'https://apis.google.com/js/plusone.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	  })();
	</script>
	<?php
}
add_action('wp_footer', 'toolkit_social_apis');

function toolkit_get_content_type($post_type) {
	$types = array(
		'post' => __('Tutorial', 'toolkit'),
		'track' => __('Track', 'toolkit'),
		'pick' => __('Editor pick', 'toolkit')
	);
	return $types[$post_type];
}

// add qtrans filter to get_permalink
if(function_exists('qtrans_convertURL')) {
	add_filter('post_type_link', 'qtrans_convertURL');
	add_filter('post_type_archive_link', 'qtrans_convertURL');
}
