<?php
/*
Plugin Name: Responsive Social-Share Sidebar
Plugin URI: http://www.wpfruits.com
Description: This plugin adds social share sidebar to WordPress post and page.
Author: Nishant Jain, rahulbrilliant2004, tikendramaitry
Version: 1.0.0
Author URI: http://www.wpfruits.com
*/
//--------------------------------------------------------------------------

//plugins admin interface
require_once('rsss_admin.php');

//This function will create new database fields with default values
function rsss_defaults(){
	    $default = array(
		'showonpage' => 1,
		'showonpost' => 1,
        'showonposition' => 1,
	    'show_twitter_icon' => 1,
	    'show_facebook_share' => 1,
	    'show_facebook_like' => 1,
	    'show_digg_icon' => 1,
	    'show_stumble_icon' => 1,
	    'show_pinterest_icon' => 1,
	    'show_email_icon' => 1
    );
return $default;
}

// Runs when plugin is activated and creates new database field
register_activation_hook(__FILE__,'rsss_plugin_install');
function rsss_plugin_install() {
    add_option('rsss_options', rsss_defaults());
}

// update the rsss options
if(isset($_POST['rsss_submit'])){
	update_option('rsss_options', rsss_optionUpdates());
	$rsss_savemsg='<div class="rsss_savemsg">Settings Saved.</div>';
}

function rsss_optionUpdates() {
	$options = $_POST['rsss_options'];
	    $update_val = array(
		'showonpage' => $options['showonpage'],
		'showonpost' => $options['showonpost'],
        'showonposition' => $options['showonposition'],
	    'show_twitter_icon' => $options['show_twitter_icon'],
	    'show_facebook_share' => $options['show_facebook_share'],
	    'show_facebook_like' => $options['show_facebook_like'],
	    'show_digg_icon' => $options['show_digg_icon'],
	    'show_stumble_icon' => $options['show_stumble_icon'],
	    'show_pinterest_icon' => $options['show_pinterest_icon'],
	    'show_email_icon' => $options['show_email_icon']
    );
return $update_val;
}

// get rsss version
function rsss_get_version(){
	if (!function_exists( 'get_plugins' ) )
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
	$plugin_file = basename( ( __FILE__ ) );
	return $plugin_folder[$plugin_file]['Version'];
}

//plugins front interface
require_once('rsss_front.php');

?>