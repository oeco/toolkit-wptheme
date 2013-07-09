<?php

class Toolkit_Tools {

	function __construct() {
		add_action('init', array($this, 'init'));
	}

	function init() {
		$this->register_post_type();
	}

	function register_post_type() {

		$labels = array( 
			'name' => __('Tools', 'toolkit'),
			'singular_name' => __('Tool', 'toolkit'),
			'add_new' => __('Add tool', 'toolkit'),
			'add_new_item' => __('Add new tool', 'toolkit'),
			'edit_item' => __('Edit tool', 'toolkit'),
			'new_item' => __('New tool', 'toolkit'),
			'view_item' => __('View tool', 'toolkit'),
			'search_items' => __('Search tools', 'toolkit'),
			'not_found' => __('No tool found', 'toolkit'),
			'not_found_in_trash' => __('No tool found in the trash', 'toolkit'),
			'menu_name' => __('Tools', 'toolkit')
		);

		$args = array( 
			'labels' => $labels,
			'hierarchical' => false,
			'description' => __('Toolkit tools', 'toolkit'),
			'supports' => array('title', 'editor', 'author', 'excerpt', 'thumbnail'),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'tool', 'with_front' => false),
			'menu_position' => 4
		);

		register_post_type('tool', $args);

	}
	
}

$_GLOBALS['toolkit_tools'] = new Toolkit_Tools();

?>