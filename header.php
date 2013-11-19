<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<title><?php
	global $page, $paged;

	wp_title( '|', true, 'right' );

	bloginfo( 'name' );

	$site_description = get_bloginfo('description', 'display');
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . __('Page', 'toolkit') . max($paged, $page);

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/favicon.ico">
<link rel="apple-touch-icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('stylesheet_directory'); ?>/img/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('stylesheet_directory'); ?>/img/apple-touch-icon-114x114.png">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
	<header id="masthead" class="row">
		<div class="container">
			<div class="four columns">
				<?php if(function_exists('qtrans_getLanguage') && qtrans_getLanguage() == 'pt') : ?>
					<h1><a href="<?php echo home_url('/pt/'); ?>"><?php bloginfo('name'); ?><img src="<?php echo get_template_directory_uri(); ?>/img/logo_pt.png" /></a></h1>
				<?php else : ?>
					<h1><a href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?><img src="<?php echo get_template_directory_uri(); ?>/img/logo_en.png" /></a></h1>
				<?php endif; ?>
			</div>
			<div class="four columns">
				<nav id="mastnav">
					<?php wp_nav_menu(array('theme_location' => 'header_menu')); ?>
				</nav>
			</div>
            <div class="three columns">
                <div class="share">
                    <ul>
                        <li>
                            <div class="fb-like" data-href="<?php echo home_url(); ?>" data-layout="button_count" data-show-faces="false" data-send="false"></div>
                        </li>
                        <li>
                            <a href="https://twitter.com/geojournalism" class="twitter-follow-button" data-show-count="true" data-show-screen-name="false" data-lang="en">Follow us</a>
                        </li>
                    </ul>
                </div>
            </div>
			<?php if(function_exists('qtrans_getLanguage')) : ?>
				<div class="one columns">
					<nav id="lang">
						<?php echo qtrans_generateLanguageSelectCode('text'); ?>
					</nav>
				</div>
			<?php endif; ?>
		</div>
	</header>
