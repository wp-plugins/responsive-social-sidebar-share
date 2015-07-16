<?php
/*
Plugin Name: Responsive Social-Share Sidebar
Plugin URI: http://www.wpfruits.com
Description: This plugin adds social share sidebar to WordPress post and page.
Author: rahulbrilliant2004, tikendramaitry,gunjan-rai
Version: 1.1.3
Author URI: http://www.wpfruits.com
*/
//--------------------------------------------------------------------------

//plugins admin interface
require_once( 'rsss_admin.php' );

//This function will create new database fields with default values
function rsss_defaults() {
		$default = array(
		'showonpage' => 1,
		'showonpost' => 1,
		'showonposition' => 1,
		'show_twitter_icon' => 1,
		'show_facebook_share' => 1,
		'show_facebook_like' => 1,
		'show_google_plus' => 1,
		'show_digg_icon' => 1,
		'show_stumble_icon' => 1,
		'show_pinterest_icon' => 1,
		'show_linkedin_icon' => 1,
		'show_reddit_icon' => 1,
		'show_email_icon' => 1
	);
	return $default;
}

add_action( 'admin_init', 'rsss_main_init' );

function rsss_main_init() {
	register_setting( 'rsss_plugin_options', 'rsss_options', 'rsss_validate_options' );
}

// Runs when plugin is activated and creates new database field
register_activation_hook( __FILE__, 'rsss_plugin_install' );

add_action( 'admin_init', 'rsss_plugin_redirect' );
function rsss_plugin_activate() {
	add_option( 'rsss_plugin_do_activation_redirect', true );
}

function rsss_plugin_redirect() {
	if ( get_option( 'rsss_plugin_do_activation_redirect', false ) ) {
		delete_option( 'rsss_plugin_do_activation_redirect' );
		wp_redirect( 'admin.php?page=rsss_page' );
	}
}

function rsss_plugin_install() {
	add_option( 'rsss_options', rsss_defaults() );
	rsss_plugin_activate();
}


function rsss_validate_options($rsss_input) {
	if( !isset($rsss_input['showonpage']) ) { $rsss_input['showonpage']=0; }
	if( !isset($rsss_input['showonpost']) ) { $rsss_input['showonpost']=0; }
	if( !isset($rsss_input['show_twitter_icon']) ) { $rsss_input['show_twitter_icon']=0; }
	if( !isset($rsss_input['show_facebook_share']) ) { $rsss_input['show_facebook_share']=0; }
	if( !isset($rsss_input['show_facebook_like']) ) { $rsss_input['show_facebook_like']=0; }
	if( !isset($rsss_input['show_google_plus']) ) { $rsss_input['show_google_plus']=0; }
	if( !isset($rsss_input['show_digg_icon']) ) { $rsss_input['show_digg_icon']=0; }
	if( !isset($rsss_input['show_stumble_icon']) ) { $rsss_input['show_stumble_icon']=0; }
	if( !isset($rsss_input['show_pinterest_icon']) ) { $rsss_input['show_pinterest_icon']=0; }
	if( !isset($rsss_input['show_linkedin_icon']) ) { $rsss_input['show_linkedin_icon']=0; }
	if( !isset($rsss_input['show_reddit_icon']) ) { $rsss_input['show_reddit_icon']=0; }
	if( !isset($rsss_input['show_tumblr_icon']) ) { $rsss_input['show_tumblr_icon']=0; }
	if( !isset($rsss_input['show_email_icon']) ) { $rsss_input['show_email_icon']=0; }
	return $rsss_input;
}

add_action( 'init', 'rsss_addVersion' );
function rsss_addVersion() {
	$rsss_version = get_option( 'rsss_version' ); 
	if( !$rsss_version )
		add_option( 'rsss_version', rsss_get_version() );
	else {
		update_option( 'rsss_version', rsss_get_version() );
	}
}

// update the rsss options
if( isset($_GET['settings-updated']) && $_GET['settings-updated']==true ) {
	$rsss_savemsg='<div class="rsss_savemsg">Settings Saved.</div>';
}

// get rsss version
function rsss_get_version() {
	if ( !function_exists( 'get_plugins' ) )
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
	$plugin_file = basename( ( __FILE__ ) );
	return $plugin_folder[$plugin_file]['Version'];
}

//plugins front interface
require_once('rsss_front.php');

?>