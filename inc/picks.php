<?php

/*
 * Toolkit
 * Picks
 */

class Toolkit_Picks {

	function __construct() {

		//add_action('init', array($this, 'register_taxonomies'));
		add_action('init', array($this, 'register_post_type'));
		//add_action('acf/register_fields', array($this, 'register_fields'));

		add_filter('query_vars', array($this, 'query_vars'));
		add_action('pre_get_posts', array($this, 'pre_get_posts'));

	}

	function register_post_type() {

		$labels = array( 
			'name' => __('Picks', 'toolkit'),
			'singular_name' => __('Pick', 'toolkit'),
			'add_new' => __('Add pick', 'toolkit'),
			'add_new_item' => __('Add new pick', 'toolkit'),
			'edit_item' => __('Edit pick', 'toolkit'),
			'new_item' => __('New pick', 'toolkit'),
			'view_item' => __('View pick', 'toolkit'),
			'search_items' => __('Search picks', 'toolkit'),
			'not_found' => __('No pick found', 'toolkit'),
			'not_found_in_trash' => __('No pick found in the trash', 'toolkit'),
			'menu_name' => __('Picks', 'toolkit')
		);

		$args = array( 
			'labels' => $labels,
			'hierarchical' => false,
			'description' => __('Toolkit picks', 'toolkit'),
			'supports' => array('title', 'editor', 'author', 'excerpt', 'thumbnail'),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'picks', 'with_front' => false),
			'menu_position' => 4
		);

		register_post_type('pick', $args);

	}

	function register_taxonomies() {

		$labels = array(
			'name' => _x('Pick types', 'Pick type general name', 'bikeit'),
			'singular_name' => _x('Pick type', 'Pick type singular name', 'bikeit'),
			'all_items' => __('All pick types', 'bikeit'),
			'edit_item' => __('Edit pick type', 'bikeit'),
			'view_item' => __('View pick type', 'bikeit'),
			'update_item' => __('Update pick type', 'bikeit'),
			'add_new_item' => __('Add new pick type', 'bikeit'),
			'new_item_name' => __('New pick type name', 'bikeit'),
			'parent_item' => __('Parent pick type', 'bikeit'),
			'parent_item_colon' => __('Parent pick type:', 'bikeit'),
			'search_items' => __('Search pick types', 'bikeit'),
			'popular_items' => __('Popular pick types', 'bikeit'),
			'separate_items_with_commas' => __('Separate pick types with commas', 'bikeit'),
			'add_or_remove_items' => __('Add or remove pick types', 'bikeit'),
			'choose_from_most_used' => __('Choose from most used pick types', 'bikeit'),
			'not_found' => __('No pick types found', 'bikeit')
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'show_admin_column' => true,
			'hierarchical' => true,
			'query_var' => 'pick-type',
			'rewrite' => array('slug' => 'picks/type', 'with_front' => false)
		);

		register_taxonomy('pick-type', 'pick', $args);

	}

	function register_fields() {
		if(function_exists("register_field_group")) {

			$translate_fields = array(
				'wysiwyg' => 'wysiwyg',
				'text' => 'text',
				'textarea' => 'textarea'
			);

			if(function_exists('qtrans_getLanguage')) {
				foreach($translate_fields as &$field) {
					$field = 'qtranslate_' . $field;
				}
			}

			register_field_group(array (
				'id' => 'acf_track-settings',
				'title' => __('Pick settings', 'toolkit'),
				'fields' => array (
					array (
						'key' => 'field_track_review',
						'label' => 'Pick review',
						'name' => 'track_review',
						'type' => $translate_fields['wysiwyg'],
						'default_value' => '',
						'toolbar' => 'basic',
					),
					array (
						'post_type' => array (
							0 => 'pick',
						),
						'taxonomy' => array (
							0 => 'all',
						),
						'multiple' => 1,
						'allow_null' => 0,
						'key' => 'field_subtracks',
						'label' => __('Subtracks', 'toolkit'),
						'name' => 'subtracks',
						'type' => 'post_object',
					),
					array (
						'default_value' => 0,
						'message' => __('Featured pick', 'toolkit'),
						'key' => 'field_featured_track',
						'label' => 'Featured',
						'name' => 'featured',
						'type' => 'true_false',
						'instructions' => 'Mark this pick as featured',
					),
				),
				'location' => array (
					array (
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

			register_field_group(array (
				'id' => 'acf_related-picks',
				'title' => __('Related picks', 'toolkit'),
				'fields' => array (
					array (
						'post_type' => array (
							0 => 'pick',
						),
						'taxonomy' => array (
							0 => 'all',
						),
						'multiple' => 1,
						'allow_null' => 0,
						'key' => 'field_related_tracks',
						'label' => __('Related picks', 'toolkit'),
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
					),
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'pick',
							'order_no' => 0,
							'group_no' => 1,
						)
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

	function query_vars($vars) {
		$vars[] = 'track_picks';
		return $vars;
	}

	function pre_get_posts($query) {
		if($query->get('track_picks')) {
			$query->set('post_type', 'pick');
			$query->set('posts_per_page', -1);
			$query->set('meta_query', array(
				array(
					'key' => 'related_tracks',
					'value' => $query->get('track_tutorials'),
					'compare' => 'LIKE'
				)
			));
		}
	}

	function get_track_picks_count($track_id = false) {

		global $post;
		$track_id = $track_id ? $track_id : $post->ID;

		$query = new WP_Query(array(
			'post_type' => 'pick',
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
					'key' => 'related_tracks',
					'value' => $track_id,
					'compare' => 'LIKE'
				)
			)
		));

		return $query->found_posts;

	}

}

$GLOBALS['toolkit_picks'] = new Toolkit_Picks();

function toolkit_get_track_picks_count($track_id = false) {
	return $GLOBALS['toolkit_picks']->get_track_tutorials_count($track_id);
}