<?php

/*
 * Toolkit
 * Tracks
 */

class Toolkit_Tracks {

	function __construct() {

		add_action('init', array($this, 'register_taxonomies'));
		add_action('init', array($this, 'register_post_type'));
		add_action('acf/register_fields', array($this, 'register_fields'));

	}

	function register_post_type() {

		$labels = array( 
			'name' => __('Tracks', 'toolkit'),
			'singular_name' => __('Track', 'toolkit'),
			'add_new' => __('Add track', 'toolkit'),
			'add_new_item' => __('Add new track', 'toolkit'),
			'edit_item' => __('Edit track', 'toolkit'),
			'new_item' => __('New track', 'toolkit'),
			'view_item' => __('View track', 'toolkit'),
			'search_items' => __('Search tracks', 'toolkit'),
			'not_found' => __('No track found', 'toolkit'),
			'not_found_in_trash' => __('No track found in the trash', 'toolkit'),
			'menu_name' => __('Tracks', 'toolkit')
		);

		$args = array( 
			'labels' => $labels,
			'hierarchical' => false,
			'description' => __('Toolkit tracks', 'toolkit'),
			'supports' => array('title', 'editor', 'author', 'excerpt', 'thumbnail'),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'tracks', 'with_front' => false),
			'menu_position' => 4
		);

		register_post_type('track', $args);

	}

	function register_taxonomies() {

		$labels = array(
			'name' => _x('Track types', 'Track type general name', 'bikeit'),
			'singular_name' => _x('Track type', 'Track type singular name', 'bikeit'),
			'all_items' => __('All track types', 'bikeit'),
			'edit_item' => __('Edit track type', 'bikeit'),
			'view_item' => __('View track type', 'bikeit'),
			'update_item' => __('Update track type', 'bikeit'),
			'add_new_item' => __('Add new track type', 'bikeit'),
			'new_item_name' => __('New track type name', 'bikeit'),
			'parent_item' => __('Parent track type', 'bikeit'),
			'parent_item_colon' => __('Parent track type:', 'bikeit'),
			'search_items' => __('Search track types', 'bikeit'),
			'popular_items' => __('Popular track types', 'bikeit'),
			'separate_items_with_commas' => __('Separate track types with commas', 'bikeit'),
			'add_or_remove_items' => __('Add or remove track types', 'bikeit'),
			'choose_from_most_used' => __('Choose from most used track types', 'bikeit'),
			'not_found' => __('No track types found', 'bikeit')
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'show_admin_column' => true,
			'hierarchical' => true,
			'query_var' => 'track-type',
			'rewrite' => array('slug' => 'tracks/type', 'with_front' => false)
		);

		register_taxonomy('track-type', 'track', $args);

	}

	function register_fields() {
		if(function_exists("register_field_group")) {
			register_field_group(array (
				'id' => 'acf_related-tracks',
				'title' => __('Related tracks', 'toolkit'),
				'fields' => array (
					array (
						'post_type' => array (
							0 => 'track',
						),
						'taxonomy' => array (
							0 => 'all',
						),
						'multiple' => 1,
						'allow_null' => 0,
						'key' => 'field_related_tracks',
						'label' => __('Related tracks', 'toolkit'),
						'name' => 'related_tracks',
						'type' => 'post_object',
						'required' => 1,
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'post',
							'order_no' => 0,
							'group_no' => 0,
						),
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'pick',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
				'options' => array (
					'position' => 'normal',
					'layout' => 'no_box',
					'hide_on_screen' => array (
					),
				),
				'menu_order' => 0,
			));
		}
	}

	function get_track_tutorials_count($track_id = false) {

		global $post;
		$track_id = $track_id ? $track_id : $post->ID;

		$query = new WP_Query(array(
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
					'key' => 'tutorial_tracks',
					'value' => $track_id,
					'compare' => 'LIKE'
				)
			)
		));

		return $query->found_posts;

	}

}

$GLOBALS['toolkit_tracks'] = new Toolkit_Tracks();

function toolkit_get_track_tutorials_count($track_id = false) {
	return $GLOBALS['toolkit_tracks']->get_track_tutorials_count($track_id);
}