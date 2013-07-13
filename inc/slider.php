<?php

/*
 * Toolkit
 * Slider
 */

class Toolkit_Slider {


	function __construct() {
		add_action('init', array($this, 'init'));
	}

	function init() {

		$this->register_post_type();

	}

	function register_post_type() {

		$labels = array( 
			'name' => __('Slider', 'toolkit'),
			'singular_name' => __('Item', 'toolkit'),
			'add_new' => __('Add item', 'toolkit'),
			'add_new_item' => __('Add new item', 'toolkit'),
			'edit_item' => __('Edit item', 'toolkit'),
			'new_item' => __('New item', 'toolkit'),
			'view_item' => __('View item', 'toolkit'),
			'search_items' => __('Search slider items', 'toolkit'),
			'not_found' => __('No item found', 'toolkit'),
			'not_found_in_trash' => __('No item found in the trash', 'toolkit'),
			'menu_name' => __('Featured slider', 'toolkit')
		);

		$args = array( 
			'labels' => $labels,
			'hierarchical' => false,
			'description' => __('Toolkit slider', 'toolkit'),
			'supports' => array('title', 'editor', 'thumbnail'),
			'public' => false,
			'show_ui' => true,
			'show_in_menu' => true,
			'has_archive' => false,
			'menu_position' => 2
		);

		register_post_type('slider', $args);

	}

}

$toolkit_slider = new Toolkit_Slider();