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
		add_action('the_content', array($this, 'content_with_hashed_headings'));
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
						'type' => $translate_fields['textarea'],
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
						'type' => $translate_fields['wysiwyg'],
						'instructions' => 'Describe the necessary knowledge to start working on this tutorial',
					),
					array (
						'toolbar' => 'basic',
						'media_upload' => 'no',
						'default_value' => '',
						'key' => 'field_51dbb80bb2a36',
						'label' => 'Software',
						'name' => 'software',
						'type' => $translate_fields['wysiwyg'],
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
						#category-nav ul li.<?php echo $cat->slug; ?> a,
						.post-header .categories .<?php echo $cat->slug; ?> {
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

	/*
	 * Inject content titles with hash link
	 */
	function content_with_hashed_headings($content) {

		if(get_post_type() == 'post') {

			$dom = new domDocument;
			$dom->loadHTML($content);

			$tags = array('h1','h2','h3','h4','h5','h6');

			foreach($tags as $tag) {

				$elements = $dom->getElementsByTagname($tag);

				if($elements) {

					foreach($elements as $el) {

						if($el->getElementsByTagname('a')->length)
							continue;

						$name = utf8_decode($el->nodeValue);

						$el->setAttribute('id', sanitize_title($name));
						$el->setAttribute('class', 'summary-item');

						$link = $dom->createElement('a');
						$link->setAttribute('href', '#' . sanitize_title($name));
						$link->nodeValue = $name;

						$el->nodeValue = '';
						$el->appendChild($link);

					}

				}

			}

			$content = utf8_encode($dom->saveHTML());

		}

		return $content;

	}

	function summary() {
		wp_register_script('hashchange', get_template_directory_uri() . '/js/jquery.hashchange.min.js', array('jquery'));
		wp_enqueue_script('toolkit-summary', get_template_directory_uri() . '/js/summary.js', array('jquery', 'hashchange'));
		?>
		<div class="toolkit-summary">
			<h3><?php _e('Table of Contents', 'toolkit'); ?></h3>
			<div class="table-of-contents">
			</div>
		</div>
		<?php
	}

	function knowledge() {
		global $post;
		$knowledge = get_field('knowledge');
		if(!$knowledge)
			return false;
		?>
		<div class="toolkit-knowledge">
			<h3><?php _e('Knowledge', 'toolkit'); ?></h3>
			<?php echo $knowledge; ?>
		</div>
		<?php
	}

	function software() {
		global $post;
		$software = get_field('software');
		if(!$software)
			return false;
		?>
		<div class="toolkit-software">
			<h3><?php _e('Software', 'toolkit'); ?></h3>
			<?php echo $software; ?>
		</div>
		<?php
	}

	function tools() {
		global $post;
		$tools = get_field('tools');
		if(!$tools)
			return false;
		?>
		<div class="toolkit-tools">
			<h3><?php _e('Tools', 'toolkit'); ?></h3>
			<ul>
				<?php foreach($tools as $tool) {
					$post = $tool;
					setup_postdata($post);
					?>
					<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
					<?php
					wp_reset_postdata();
				} ?>
			</ul>
		</div>
		<?php
	}

	function files() {
		global $post;
		$files = get_field('files');
		if(!$files)
			return false;
		?>
		<div class="toolkit-files">
			<h3><?php _e('Files', 'toolkit'); ?></h3>
			<p class="download"><a href="<?php echo $files; ?>"><?php _e('Click here to download necessary files for this tutorial', 'toolkit'); ?></a></p>
			<?php
			$files_description = get_field('files_description');
			if($files_description) { ?>
				<p><?php echo $files_description; ?></p>	
			<?php } ?>
		</div>
		<?php
	}

}

$toolkit_tutorials = new Toolkit_Tutorials();

function toolkit_summary() {
	global $toolkit_tutorials;
	return $toolkit_tutorials->summary();
}

function toolkit_knowledge() {
	global $toolkit_tutorials;
	return $toolkit_tutorials->knowledge();
}

function toolkit_software() {
	global $toolkit_tutorials;
	return $toolkit_tutorials->software();
}

function toolkit_tools() {
	global $toolkit_tutorials;
	return $toolkit_tutorials->tools();
}

function toolkit_files() {
	global $toolkit_tutorials;
	return $toolkit_tutorials->files();
}