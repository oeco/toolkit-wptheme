<?php

/* 
 * Toolkit
 * Tutorials system
 */

class Toolkit_Tutorials {

	var $post_type = 'post';

	function __construct() {

		add_action('init', array($this, 'init'));

	}

	function init() {
		$this->register_skills_taxonomy();
		$this->acf_fields();
		add_action('wp_footer', array($this, 'category_colors_css'));
	}

	function register_skills_taxonomy() {

		$labels = array(
			'name' => __('Skills', 'toolkit'),
			'singular_name' => __('Skill', 'toolkit'),
			'search_items' => __('Search skills', 'toolkit'),
			'popular_items' => __('Popular skills', 'toolkit'),
			'all_items' => __('All skills', 'toolkit'),
			'parent_item' => __('Parent skill', 'toolkit'),
			'parent_item_colon' => __('Parent skill:', 'toolkit'),
			'edit_item' => __('Edit skill', 'toolkit'),
			'update_item' => __('Update skill', 'toolkit'),
			'add_new_item' => __('Add new skill', 'toolkit'),
			'new_item_name' => __('New skill name', 'toolkit'),
			'separate_items_with_commas' => __('Separate skills with commas', 'toolkit'),
			'add_or_remove_items' => __('Add or remove skills', 'toolkit'),
			'choose_from_most_used' => __('Choose from most used skills', 'toolkit'),
			'menu_name' => __('Skills', 'toolkit')
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => true,
			'hierarchical' => false,
			'rewrite' => array('slug' => 'skill', 'with_front' => false),
			'query_var' => true,
			'show_admin_column' => true
		);

		register_taxonomy('skill', $this->post_type, $args);

	}

	function acf_fields() {
		/*
		 * ACF Fields
		 */
		if(function_exists("register_field_group")) {

			register_field_group(array (
				'id' => 'acf_category-settings',
				'title' => 'Category settings',
				'fields' => array (
					array (
						'default_value' => '',
						'key' => 'field_51dbb0c3ce0a0',
						'label' => 'Category color',
						'name' => 'category_color',
						'type' => 'color_picker',
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'ef_taxonomy',
							'operator' => '==',
							'value' => 'category',
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
				'id' => 'acf_difficulty-settings',
				'title' => 'Difficulty settings',
				'fields' => array (
					array (
						'layout' => 'vertical',
						'choices' => array (
							'easy' => 'Easy',
							'medium' => 'Medium',
							'hard' => 'Hard',
						),
						'default_value' => '',
						'key' => 'field_51dbb13ad3ce6',
						'label' => 'Difficulty',
						'name' => 'difficulty',
						'type' => 'radio',
						'instructions' => 'Define the difficulty of this tutorial',
						'required' => 1,
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => $this->post_type,
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
				'id' => 'acf_related-tools',
				'title' => 'Related tools',
				'fields' => array (
					array (
						'post_type' => array (
							0 => 'tool',
						),
						'taxonomy' => array (
							0 => 'all',
						),
						'multiple' => 1,
						'allow_null' => 1,
						'key' => 'field_51b5f253391dc',
						'label' => 'Tools',
						'name' => 'tools',
						'type' => 'post_object',
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => $this->post_type,
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
				'id' => 'acf_tutorial-files',
				'title' => 'Tutorial files',
				'fields' => array (
					array (
						'save_format' => 'url',
						'library' => 'all',
						'key' => 'field_51dbb8deb7d15',
						'label' => 'Upload file',
						'name' => 'files',
						'type' => 'file',
						'instructions' => 'Upload a compressed (zipped) file containing any external resource needed throughout the tutorial',
					),
					array (
						'default_value' => '',
						'formatting' => 'br',
						'key' => 'field_51dbba55b88ca',
						'label' => 'Files description',
						'name' => 'files_description',
						'type' => 'textarea',
						'instructions' => 'Describe the files',
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => $this->post_type,
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
				'options' => array (
					'position' => 'side',
					'layout' => 'default',
					'hide_on_screen' => array (
					),
				),
				'menu_order' => 0,
			));
			register_field_group(array (
				'id' => 'acf_tutorial-settings',
				'title' => 'Tutorial settings',
				'fields' => array (
					array (
						'toolbar' => 'basic',
						'media_upload' => 'no',
						'default_value' => '',
						'key' => 'field_51dbb7e2b2a35',
						'label' => 'Knowledge',
						'name' => 'knowledge',
						'type' => 'wysiwyg',
						'instructions' => 'Describe the necessary knowledge to start working on this tutorial',
					),
					array (
						'toolbar' => 'basic',
						'media_upload' => 'no',
						'default_value' => '',
						'key' => 'field_51dbb80bb2a36',
						'label' => 'Software',
						'name' => 'software',
						'type' => 'wysiwyg',
						'instructions' => 'Tell a bit about how the softwares are used through the activity',
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => $this->post_type,
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

	function category_colors_css() {
		$categories = get_categories(array('hide_empty' => 0));

		if($categories) { ?>
			<style type="text/css">
				<?php foreach($categories as $cat) {
					$color = get_field('category_color', 'category_' . $cat->term_id);
					if($color) { ?>
						#category-nav ul li.<?php echo $cat->slug; ?> a {
							background-color: <?php echo $color; ?>;
						}
						#category-nav ul li.<?php echo $cat->slug; ?>:hover a,
						#category-nav ul li.<?php echo $cat->slug; ?>.active a {
							background-color: #fff;
							color: <?php echo $color; ?>;
							border-color: <?php echo $color; ?>;
						}
					<?php
					}
				} ?>
			</style>
		<?php
		}
	}
}

$_GLOBALS['toolkit_tutorials'] = new Toolkit_Tutorials();