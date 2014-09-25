<?php

class Toolkit_LiveSearch {

	var $ajax_action = 'live_search';

	function __construct() {
		add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
		add_action('wp_ajax_nopriv_' . $this->ajax_action, array($this, 'query'));
		add_action('wp_ajax_' . $this->ajax_action, array($this, 'query'));
	}

	function enqueue_scripts() {
		wp_enqueue_script('toolkit-live-search', get_template_directory_uri() . '/inc/live-search/live-search.js', array('jquery', 'underscore'));
		wp_localize_script('toolkit-live-search', 'livesearch', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'action' => $this->ajax_action,
			'labels' => array(
				'post' => __('Tutorial', 'toolkit'),
				'track' => __('Track', 'toolkit'),
				'tool' => __('Tool', 'toolkit')
			)
		));
	}

	function query() {

		if(isset($_REQUEST['s']) && $_REQUEST['s']) {
			$query = new WP_Query(array(
				's' => $_REQUEST['s'],
				'post_type' => array('post', 'pick', 'tool', 'track'),
				'posts_per_page' => 7
			));
			$response = array();
			if($query->have_posts()) {
				while($query->have_posts()) {
					$query->the_post();
					$response[] = array(
						'title' => get_the_title(),
						'excerpt' => get_the_excerpt(),
						'post_type' => get_post_type($post->ID),
						'url' => get_permalink()
					);
					wp_reset_postdata();
				}
				wp_reset_query();
			}
		}

		header('Content-Type: application/json;charset=UTF-8');
		echo json_encode($response);
		exit;

	}

}

$GLOBALS['toolkit_livesearch'] = new Toolkit_LiveSearch();