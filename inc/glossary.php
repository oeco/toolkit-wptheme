<?php

class Toolkit_Glossary {

	function __construct() {
		add_action('init', array($this, 'init'));
	}

	function init() {
		$this->register_post_type();
		$this->acf_fields();
	}

	function register_post_type() {

		$labels = array( 
			'name' => __('Glossary', 'toolkit'),
			'singular_name' => __('Meaning', 'toolkit'),
			'add_new' => __('Add meaning', 'toolkit'),
			'add_new_item' => __('Add new meaning', 'toolkit'),
			'edit_item' => __('Edit meaning', 'toolkit'),
			'new_item' => __('New meaning', 'toolkit'),
			'view_item' => __('View meaning', 'toolkit'),
			'search_items' => __('Search glossary', 'toolkit'),
			'not_found' => __('No meaning found', 'toolkit'),
			'not_found_in_trash' => __('No meaning found in the trash', 'toolkit'),
			'menu_name' => __('Glossary', 'toolkit')
		);

		$args = array( 
			'labels' => $labels,
			'hierarchical' => false,
			'description' => __('Toolkit glossary', 'toolkit'),
			'supports' => array('author'),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'glossary', 'with_front' => false),
			'menu_position' => 4
		);

		register_post_type('glossary', $args);

	}

	function acf_fields() {
		if(function_exists("register_field_group")) {
			register_field_group(array (
				'id' => 'acf_meaning',
				'title' => 'Meaning',
				'fields' => array (
					array (
						'default_value' => '',
						'formatting' => 'html',
						'key' => 'field_51dbbda68f4eb',
						'label' => 'Word',
						'name' => 'word',
						'type' => 'text',
						'required' => 1,
					),
					array (
						'default_value' => '',
						'formatting' => 'br',
						'key' => 'field_51dbbd5a42203',
						'label' => 'Meaning',
						'name' => 'meaning',
						'type' => 'textarea',
						'required' => 1,
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'glossary',
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

}

$_GLOBALS['toolkit_glossary'] = new Toolkit_Glossary();

?>