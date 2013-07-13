<?php

class Toolkit_Tools {

	function __construct() {
		add_action('init', array($this, 'init'));
	}

	function init() {
		$this->register_post_type();
		$this->acf_fields();
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
			'rewrite' => array('slug' => 'tools', 'with_front' => false),
			'menu_position' => 4
		);

		register_post_type('tool', $args);

	}

	function acf_fields() {
		/*
		 * ACF Fields
		 */
		if(function_exists("register_field_group")) {


			register_field_group(array(
				'id' => 'acf_related-tools',
				'title' => 'Related tools',
				'fields' => array (
					array (
						'post_type' => array(
							0 => 'tool',
						),
						'taxonomy' => array(
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
				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'post',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
				'options' => array(
					'position' => 'normal',
					'layout' => 'no_box',
					'hide_on_screen' => array(
					),
				),
				'menu_order' => 0,
			));

			register_field_group(array(

				'id' => 'acf_tool-references',
				'title' => __('Tool references', 'toolkit'),
				'fields' => array(
					array(
						'toolbar' => 'basic',
						'media_upload' => 'no',
						'default_value' => '',
						'key' => 'field_tool_references',
						'label' => __('References', 'toolkit'),
						'name' => 'references',
						'type' => 'wysiwyg',
						'instructions' => __('Add some links to the tool references', 'toolkit'),
					)
				),
				'location' => array(
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'tool',
							'order_no' => 0,
							'group_no' => 0,
						),
					)
				),
				'options' => array (
					'position' => 'normal',
					'layout' => 'no_box',
					'hide_on_screen' => array (
					),
				),
				'menu_order' => 0
			));

		}
	}

	function description() {

		global $post;

		if(get_post_type() != 'tool')
			return false;

		?>
		<div class="toolkit-tool-description">
			<?php if(has_post_thumbnail()) { ?>
				<div class="tool-thumbnail">
					<?php the_post_thumbnail('tool-thumbnail', array('class' => 'scale-with-grid')); ?>
				</div>
			<?php } ?>
			<?php
			$tutorials = get_posts(array(
				'meta_query' => array(
					array(
						'key' => 'tools',
						'value' => '"' . get_the_ID() . '"',
						'compare' => 'LIKE'
					)
				)
			));
			if($tutorials) { ?>
				<div class="sub-item">
					<h3><?php _e('Used in', 'toolkit'); ?></h3>
					<ul>
						<?php
						foreach($tutorials as $tutorial) {
							$post = $tutorial;
							setup_postdata($post);
							?>
							<li>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
							</li>
							<?php
							wp_reset_postdata();
						}
						?>
					</ul>
				</div>
			<?php } ?>

			<?php
			$references = get_field('references');
			if($references) { ?>
				<div class="sub-item">
					<h3><?php _e('References', 'toolkit'); ?></h3>
					<?php echo $references; ?>
				</div>
			<?php } ?>
		</div>
		<?php
	}
	
}

$toolkit_tools = new Toolkit_Tools();

function toolkit_tool_description() {
	global $toolkit_tools;
	return $toolkit_tools->description();
}

?>