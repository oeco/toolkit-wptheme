<?php
/*
 * Plugin Name: ET Shortcodes
 * Plugin URI: http://elegantthemes.com
 * Description: ET Shortcodes plugin.
 * Version: 1.2
 * Author: Elegant Themes
 * Author URI: http://elegantthemes.com
 * License: GPLv2 or later
 */

define( 'ET_SHORTCODES_PLUGIN_VERSION', '1.2' );
define( 'ET_SHORTCODES_PLUGIN_DIR', TEMPLATEPATH . '/inc/shortcodes' );
define( 'ET_SHORTCODES_PLUGIN_URI', get_template_directory_uri() . '/inc/shortcodes' );

add_action( 'init', 'et_shortcodes_check_for_update', 9 );
function et_shortcodes_check_for_update(){
	add_filter( 'pre_set_site_transient_update_plugins', 'et_shortcodes_plugin_check_updates' );
	add_filter( 'site_transient_update_plugins', 'et_shortcodes_plugin_add_to_update_notification' );
	add_action( 'admin_init', 'et_shortcodes_plugin_remove_update_info', 11 );
}

add_action( 'init', 'et_shortcodes_main_load', 12 );
function et_shortcodes_main_load(){
	if ( function_exists( 'et_setup_theme' ) ) return;
	
	require_once( ET_SHORTCODES_PLUGIN_DIR . '/shortcodes.php' );
}

add_action( 'admin_menu', 'et_shortcodes_options_add_page' );
function et_shortcodes_options_add_page() {
	$plugin_settings_page = add_management_page( __( 'ET Shortcodes' ), __( 'ET Shortcodes' ), 'manage_options', 'et_shortcodes_plugin_options', 'et_shortcodes_options_render_page' );
}

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'et_shortcodes_plugin_add_settings_link', 10, 2 );
function et_shortcodes_plugin_add_settings_link( $links ){
	$settings = '<a href="' . esc_url( admin_url( 'tools.php?page=et_shortcodes_plugin_options' ) ) . '">' . __( 'Settings' ) . '</a>';
	array_push( $links, $settings );
	return $links;
}

add_action( 'admin_init', 'et_shortcodes_plugin_settings_init' );
function et_shortcodes_plugin_settings_init() {
	register_setting( 'et_shortcodes_options', 'et_shortcodes_plugin_settings', 'et_shortcodes_plugin_settings_validate' );

	add_settings_section( 'general', '', '__return_false', 'et_shortcodes_plugin_options' );

	add_settings_field( 'responsive_layout', __( 'Responsive layout' ), 'et_shortcodes_field_responsive_layout_html', 'et_shortcodes_plugin_options', 'general' );
}

function et_shortcodes_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php esc_html_e( 'ET Shortcodes Plugin Options' ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'et_shortcodes_options' );
				do_settings_sections( 'et_shortcodes_plugin_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}

function et_shortcodes_get_plugin_options() {
	$saved_options = (array) get_option( 'et_shortcodes_plugin_settings' );
	$default_settings = array(
		'responsive_layout' => 'on'
	);

	$default_settings = apply_filters( 'et_shortcodes_default_settings', $default_settings );

	$options = wp_parse_args( $saved_options, $default_settings );
	$options = array_intersect_key( $options, $default_settings );

	return $options;
}

function et_shortcodes_plugin_settings_validate( $input ) {
	$output = array();

	$output['responsive_layout'] = isset( $input['responsive_layout'] ) ? 'on' : 'off';

	return apply_filters( 'et_shortcodes_plugin_settings_validate', $output, $input );
}

function et_shortcodes_field_responsive_layout_html() {
	$options = et_shortcodes_get_plugin_options();
	?>
	<label for="responsive-layout">
		<input type="checkbox" name="et_shortcodes_plugin_settings[responsive_layout]" id="responsive-layout" <?php checked( 'on', $options['responsive_layout'] ); ?> />
		<?php _e( 'Allow shortcodes to adapt to various screen sizes' ); ?>
	</label>
	<?php
}

function et_shortcodes_plugin_check_updates( $update_transient ){
	global $wp_version;
	
	$plugin_name = 'et-shortcodes/et-shortcodes.php';
	
	if ( !isset($update_transient->checked) ) return $update_transient;
	else $plugins = $update_transient->checked;
	
	$all_plugins_info = apply_filters( 'all_plugins', get_plugins() );
	
	$plugin_version = $all_plugins_info[$plugin_name]['Version'];
	
	$send_to_api = array(
		'action' => 'check_plugin_updates',
		'single_plugin_version' => ET_SHORTCODES_PLUGIN_VERSION,
		'check_single_plugin_name' => $plugin_name
	);
	
	$options = array(
		'timeout' => ( ( defined('DOING_CRON') && DOING_CRON ) ? 30 : 3),
		'body'			=> $send_to_api,
		'user-agent'	=> 'WordPress/' . $wp_version . '; ' . home_url()
	);
	
	$plugin_request = wp_remote_post( 'http://www.elegantthemes.com/api/api.php', $options );
	if ( !is_wp_error($plugin_request) && wp_remote_retrieve_response_code($plugin_request) == 200 ){
		$plugin_response = unserialize( wp_remote_retrieve_body( $plugin_request ) );
		if ( !empty($plugin_response) ) {
			$update_transient->response = array_merge(!empty($update_transient->response) ? $update_transient->response : array(),$plugin_response);
			$last_update->checked = $plugins;
			$last_update->response = $plugin_response;
		}
	}
	
	$last_update->last_checked = time();
	set_site_transient( 'et_update_shortcodes_plugin', $last_update );
	
	return $update_transient;
}

function et_shortcodes_plugin_add_to_update_notification( $update_transient ){
	$et_update_shortcodes_plugin = get_site_transient( 'et_update_shortcodes_plugin' );
	if ( !is_object($et_update_shortcodes_plugin) || !isset($et_update_shortcodes_plugin->response) ) return $update_transient;
	$update_transient->response = array_merge(!empty($update_transient->response) ? $update_transient->response : array(), $et_update_shortcodes_plugin->response);
	
	return $update_transient;
}

function et_shortcodes_plugin_remove_update_info(){
	$plugin_name = 'et-shortcodes/et-shortcodes.php';
	$et_update_shortcodes_plugin = get_site_transient( 'et_update_shortcodes_plugin' );
	
	if ( isset( $et_update_shortcodes_plugin->response[$plugin_name] ) ){ 
		remove_action( "after_plugin_row_" . $plugin_name, 'wp_plugin_update_row', 10, 2 );
		add_action( "after_plugin_row_" . $plugin_name, 'et_shortcodes_plugin_update_information', 10, 2 );
	}
}

function et_shortcodes_plugin_update_information( $file, $plugin_data ){
	# based on wp-admin/includes/update.php
	$plugin_name = 'et-shortcodes/et-shortcodes.php';
	$current = get_site_transient( 'update_plugins' );
	if ( !isset( $current->response[ $file ] ) )
		return false;

	$r = $current->response[ $file ];

	$plugins_allowedtags = array('a' => array('href' => array(),'title' => array()),'abbr' => array('title' => array()),'acronym' => array('title' => array()),'code' => array(),'em' => array(),'strong' => array());
	$plugin_name = wp_kses( $plugin_data['Name'], $plugins_allowedtags );

	$et_update_shortcodes_plugin = get_site_transient( 'et_update_shortcodes_plugin' );
	# open the plugin changelog file in TB
	$details_url = add_query_arg( array('TB_iframe' => 'true', 'width' => 1024, 'height' => 800), $et_update_shortcodes_plugin->response['et-shortcodes/et-shortcodes.php']->url );

	$wp_list_table = _get_list_table('WP_Plugins_List_Table');

	if ( is_network_admin() || !is_multisite() ) {
		echo '<tr class="plugin-update-tr"><td colspan="' . $wp_list_table->get_column_count() . '" class="plugin-update colspanchange"><div class="update-message">';

		if ( ! current_user_can('update_plugins') )
			printf( __('There is a new version of %1$s available. <a href="%2$s" class="thickbox" title="%3$s">View version %4$s details</a>.'), $plugin_name, esc_url($details_url), esc_attr($plugin_name), $r->new_version );
		else if ( empty($r->package) )
			printf( __('There is a new version of %1$s available. <a href="%2$s" class="thickbox" title="%3$s">View version %4$s details</a>. <em>Automatic update is unavailable for this plugin.</em>'), $plugin_name, esc_url($details_url), esc_attr($plugin_name), $r->new_version );
		else
			printf( __('There is a new version of %1$s available. <a href="%2$s" class="thickbox" title="%3$s">View version %4$s details</a> or <a href="%5$s">update automatically</a>.'), $plugin_name, esc_url($details_url), esc_attr($plugin_name), $r->new_version, wp_nonce_url( self_admin_url('update.php?action=upgrade-plugin&plugin=') . $file, 'upgrade-plugin_' . $file) );

		do_action( "in_plugin_update_message-$file", $plugin_data, $r );

		echo '</div></td></tr>';
	}
}