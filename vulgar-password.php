<?php
/*
* Plugin Name: Vulgar Password
* Plugin URI: http://andrewmgunn.com/
* Description: Random character password generators suck, display a customizable vulgar password generator on your website, because why the fuck not?
* Version: 1.0
* Author: Andrew M. Gunn
* Author URI: http://andrewmgunn.com
* Text Domain: vulgar-password
* License: GPL2
*/

defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

include_once('admin/class-vulgar-settings.php');
include_once('inc/script-styles.php');
include_once('inc/cpt-password.php');
include_once('inc/shortcode.php');


/**
* Flushing permalinks for CPTs on DEACTIVATE
*/
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );

/**
* Flushing permalinks for CPTs ON ACTIVATE
*/
register_activation_hook( __FILE__, 'vulgar_password_flush_rewrites' );

function vulgar_password_flush_rewrites() {
	register_cpt_password();
	flush_rewrite_rules();
}

/**
* Register and enqueue jQuery files to run on frontend, enqueue on admin_init
*/
add_action( 'init', 'register_vulgar_scripts' );


function register_vulgar_scripts() {
	wp_register_script( 'vulgar_js', plugins_url('inc/vulgar.js', __FILE__), array('jquery'));
	wp_register_style( 'vulgar_css', plugins_url('inc/vulgar.css', __FILE__));
	wp_enqueue_script( 'vulgar_js' );
	wp_enqueue_style( 'vulgar_css' );
}


/**
* Adding Settings link to plugin page
*/
add_filter( 'plugin_action_links', 'vulgar_settings_link', 10, 5 );

function vulgar_settings_link( $actions, $plugin_file )
{
	static $plugin;

	if (!isset($plugin))
		$plugin = plugin_basename(__FILE__);

		if ($plugin == $plugin_file) {

			$settings = array('settings' => '<a href="admin.php?page=vulgar-password">' . __('Settings', 'General') . '</a>');

    			$actions = array_merge($settings, $actions);
		}

		return $actions;
}