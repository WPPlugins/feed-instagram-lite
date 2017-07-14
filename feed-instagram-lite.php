<?php
/*
Plugin Name: Feed Instagram Lite
Plugin URI: http://www.ghozylab.com/plugins/
Description: Instagram Feed Lite - Display your Instagram feed anywhere you like. You can quickly customize your Instagram feed to look exactly the way you want them to look.
Author: GhozyLab, Inc.
Text Domain: feed-instagram-lite
Domain Path: /languages
Version: 1.0.0.1
Author URI: http://demo.ghozylab.com/plugins/instagram-feed-plugin/
*/

if ( ! defined('ABSPATH') ) {
	die( 'Please do not load this file directly!' );
}

/*-------------------------------------------------------------------------------*/
/*   All DEFINES
/*-------------------------------------------------------------------------------*/
define( 'IFLITE_ITEM_NAME', 'Instagram Feed Lite' );
define( 'IFLITE_CLIENT_ID', 'bf6c3e772f8847a2b7f053571075da4b' );

// Pro Price
if ( !defined( 'IFLITE_PRO' ) ) {
	define( 'IFLITE_PRO', '29' );
}

// Pro+
if ( !defined( 'IFLITE_PROPLUS' ) ) {
	define( 'IFLITE_PROPLUS', '35' );
}

// Pro++ Price
if ( !defined( 'IFLITE_PROPLUSPLUS' ) ) {
	define( 'IFLITE_PROPLUSPLUS', '39' );
}

// Dev Price
if ( !defined( 'IFLITE_DEV' ) ) {
	define( 'IFLITE_DEV', '99' );
}

// Plugin Version
if ( !defined( 'IFLITE_VERSION' ) ) {
	define( 'IFLITE_VERSION', '1.0.0.1' );
}

// Plugin Folder Path
if ( ! defined( 'IFLITE_PLUGIN_DIR' ) ) {
	define( 'IFLITE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
	}
	
// plugin url
if ( ! defined( 'IFLITE_URL' ) ) {
	$gifeed_plugin_url = substr( plugin_dir_url( __FILE__ ), 0, -1 );
	define( 'IFLITE_URL', $gifeed_plugin_url );
	}
	
// All Filters & Actions
add_filter( 'widget_text', 'do_shortcode', 11 );
add_filter( 'the_excerpt', 'shortcode_unautop' );
add_filter( 'the_excerpt', 'do_shortcode');
add_filter( 'plugin_action_links', 'gifeed_settings_link', 10, 2 );
add_action( 'init', 'gifeed_global_init' );
add_action( 'init', 'gifeed_create_custom_post', 3 );
add_action( 'init', 'gifeed_vc_integration', 4 );
add_action( 'admin_init', 'gifeed_plugin_updater', 0 );
add_action( 'admin_init', 'gifeed_on_startup' );
register_activation_hook( __FILE__, 'gifeed_plugin_activate' );
register_deactivation_hook( __FILE__, 'gifeed_clear_scheduled_hook' );


/*-------------------------------------------------------------------------------*/
/*  Plugin Settings Link @since 1.0.0.15
/*-------------------------------------------------------------------------------*/
function gifeed_settings_link( $link, $file ) {
	
	static $this_plugin;
	
	if ( !$this_plugin )
		$this_plugin = plugin_basename( __FILE__ );

	if ( $file == $this_plugin ) {
		$settings_link = '<a href="' . admin_url( 'edit.php?post_type=ginstagramfeed&page=ghozylab-instagram-settings' ) . '"><span class="dashicons dashicons-admin-generic"></span>&nbsp;' . __( 'Settings', 'feed-instagram-lite' ) . '</a>';
		array_unshift( $link, $settings_link );
	}
	
	return $link;
}


/*-------------------------------------------------------------------------------*/
/*   Includes
/*-------------------------------------------------------------------------------*/
function gifeed_global_init() {
	
	//  I18N - LOCALIZATION
	load_plugin_textdomain( 'feed-instagram-lite', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	
	include dirname( __FILE__ ) .'/inc/admin/functions/gifeed-admin-functions.php';
	include dirname( __FILE__ ) .'/inc/functions/gifeed-functions.php';
	include dirname( __FILE__ ) .'/inc/admin/gifeed-custom-post.php';
	include dirname( __FILE__ ) .'/inc/frontend/gifeed-script-loader.php';
	include dirname( __FILE__ ) .'/inc/frontend/gifeed-shortcode.php';
	include dirname( __FILE__ ) .'/inc/frontend/gifeed-opt-loader.php';
	include dirname( __FILE__ ) .'/inc/frontend/gifeed-template-helper.php';

	if ( is_admin() ) {
		
		include dirname( __FILE__ ) .'/inc/admin/gifeed-script-loader.php';
		include dirname( __FILE__ ) .'/inc/admin/gifeed-settings.php';
		include dirname( __FILE__ ) .'/inc/admin/gifeed-metaboxes.php';
		include dirname( __FILE__ ) .'/inc/admin/gifeed-tinymce.php';
		include dirname( __FILE__ ) .'/inc/admin/functions/gifeed-preview.php';
		include dirname( __FILE__ ) .'/inc/admin/pages/gifeed-docs-page.php';
		include dirname( __FILE__ ) .'/inc/admin/pages/gifeed-pricing.php';
		include dirname( __FILE__ ) .'/inc/admin/pages/gifeed-freeplugins.php';
		include dirname( __FILE__ ) .'/inc/admin/pages/gifeed-premiumplugins.php';
		
	}
		
	// Load WP jQuery library on frontend
	if( ! is_admin() ) {
		
		wp_enqueue_script( 'jquery' );
		
		}
	
	//Register Custom Post -> /inc/admin/gifeed-custom-post.php		
	gifeed_register_custom_post();	
		
}


/*-------------------------------------------------------------------------------*/
/*   Create Custom Post
/*-------------------------------------------------------------------------------*/
function gifeed_create_custom_post() {
	
	if( is_admin() && current_user_can( 'manage_options' ) ) {
		
		add_action( 'admin_menu', 'gifeed_instagram_menu' );
		add_action( 'admin_menu', 'gifeed_rename_submenu' );
	
	}
	
}


/*-------------------------------------------------------------------------------*/
/* Add custom shortcodes to the visual composer plugin
/*-------------------------------------------------------------------------------*/
function gifeed_vc_integration() {
	
	if ( is_admin() ) {

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		
		if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
			
			include_once dirname( __FILE__ ) .'/inc/admin/vc/vc-shortcode.php';
			
		}
	
	}
		
}


/*-------------------------------------------------------------------------------*/
/*   Plugin Configurations Init
/*-------------------------------------------------------------------------------*/
function gifeed_on_startup() {
	
	// Check Compatibility with Wordpress Version
	global $wp_version;
	$plugin = plugin_basename( __FILE__ );

	if ( $wp_version <= '3.8' ) {
		if ( is_plugin_active( $plugin ) ) {
			deactivate_plugins( $plugin );
			wp_die( "This plugin requires WordPress 3.5 or higher, and has been deactivated! Please upgrade WordPress and try again.<br /><br />Back to <a href='".admin_url()."'>WordPress admin</a>" );
		}
	}

    if ( is_admin() && get_option( 'gifeed_activation_init' ) == 'activate' ) {
		
		delete_option( 'gifeed_activation_init' );
		
		gifeed_def_opt();
		 
    }
	
}


/*-------------------------------------------------------------------------------*/
/*   Plugin Update
/*-------------------------------------------------------------------------------*/
function gifeed_plugin_updater() {	

	$gifeed_auto_updt = gifeed_opt( "gif_instagram_opt_autoupdate" );
	
	switch ( $gifeed_auto_updt ) {
		
		case 'active':
			if ( !wp_next_scheduled( "gifeed_auto_update" ) ) {
				wp_schedule_event( time(), "daily", "gifeed_auto_update" );
				}
			add_action( "gifeed_auto_update", "plugin_gifeed_auto_update" );
		break;
		
		case 'inactive':
			wp_clear_scheduled_hook( "gifeed_auto_update" );
		break;	
		
		case '':
			wp_clear_scheduled_hook( "gifeed_auto_update" );
			$opt = get_option( 'ghozylab_instagram_feed_options' );
			$opt['gif_instagram_opt_autoupdate'] = 'active';
			update_option( 'ghozylab_instagram_feed_options', $opt );
		break;
						
	}

}

function plugin_gifeed_auto_update() {
	
	try
	{
		require_once( ABSPATH . "wp-admin/includes/class-wp-upgrader.php" );
		require_once( ABSPATH . "wp-admin/includes/misc.php" );
		define( "FS_METHOD", "direct" );
		require_once( ABSPATH . "wp-includes/update.php" );
		require_once( ABSPATH . "wp-admin/includes/file.php" );
		wp_update_plugins();
		ob_start();
		$plugin_upg = new Plugin_Upgrader();
		$plugin_upg->upgrade( "feed-instagram-lite/feed-instagram-lite.php" );
		$output = @ob_get_contents();
		@ob_end_clean();
	}
	catch(Exception $e)
	{
	}
	
}


/*-------------------------------------------------------------------------------*/
/* Activate & Deactivate Plugin Hook
/*-------------------------------------------------------------------------------*/
function gifeed_plugin_activate() {
	
	add_option( 'gifeed_activation_init', 'activate' );

}

function gifeed_clear_scheduled_hook() {
	
	wp_clear_scheduled_hook( 'gifeed_auto_update' );
	
	}