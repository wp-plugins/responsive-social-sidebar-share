<?php
//admin menu hook
add_action( 'admin_menu', 'rsss_add_menu' );

//add menu page 
function rsss_add_menu() {
	add_menu_page( 'Responsive Social-Share Sidebar Page', 'Responsive SSS', 'administrator','rsss_page', 'rsss_appearance', plugins_url( 'images/icon.png' , __FILE__ ) );
}

function rsss_appearance() {
//plugins admin interface
require_once( 'rsss_appearance.php' );
}

// ADD Styles and Script in head section
add_action( 'admin_init', 'rsss_backend_scripts' );
function rsss_backend_scripts() {
	if(is_admin()){
		if(isset($_REQUEST['page']) && $_REQUEST['page']=="rsss_page"){
			wp_enqueue_script ('jquery');
			wp_enqueue_script('rsss_admin_script',plugins_url('js/rsss_admin.js',__FILE__), array('jquery'));
			wp_enqueue_style('rsss_admin_style',plugins_url('css/rsss_admin.css',__FILE__), false, '1.0.0' );
		}
	}
}

?>