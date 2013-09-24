<?php

class Toolkit_Glossary {

	function __construct() {
		add_action('init', array($this, 'init'));
	}

	function init() {
		$this->register_post_type();
		$this->acf_fields();
		add_action('save_post', array($this, 'save_post'));
		add_filter('the_permalink', array($this, 'post_link'));
		add_filter('post_link', array($this, 'post_link'));
		add_action('template_redirect', array($this, 'template_redirect'));
		add_shortcode('glossary', array($this, 'shortcode'));
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
				'id' => 'acf_meaning',
				'title' => 'Meaning',
				'fields' => array (
					array (
						'default_value' => '',
						'formatting' => 'html',
						'key' => 'field_51dbbda68f4eb',
						'label' => 'Word',
						'name' => 'word',
						'type' => $translate_fields['text'],
						'required' => 1,
					),
					array (
						'default_value' => '',
						'formatting' => 'br',
						'key' => 'field_51dbbd5a42203',
						'label' => 'Meaning',
						'name' => 'meaning',
						'type' => $translate_fields['wysiwyg'],
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

	function save_post($post_id) {
		if(get_post_type($post_id) == 'glossary') {
			remove_action('save_post', array($this, 'save_post'));
			wp_update_post(array('ID' => $post_id, 'post_title' => get_field('word')));
			add_action('save_post', array($this, 'save_post'));
		}
	}

	function get_permalink() {
		global $post;
		return get_post_type_archive_link('glossary') . '#' . sanitize_title(get_the_title());
	}

	function post_link($permalink) {
		$post = get_post();
		if(get_post_type($post->ID) == 'glossary')
			return $this->get_permalink();
		return $permalink;
	}

	function template_redirect() {
		if(is_singular('glossary'))
			wp_redirect($this->get_permalink(), 301);
	}

	function shortcode($atts, $content = '') {
		extract(shortcode_atts(array(
			'id' => null
		), $atts));

		if(!$id) return $content;

		global $post;
		$post = get_post($id);
		setup_postdata($post);
		$content = '<a href="' . get_permalink() . '" title="' . __('Learn more about', 'toolkit') . ' ' . get_the_title() . '" class="glossary-link">' . $content . '</a>';
		wp_reset_postdata();

		return $content;
	}

}

$_GLOBALS['toolkit_glossary'] = new Toolkit_Glossary();

?>