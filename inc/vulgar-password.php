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
include_once('inc/script-styles.php');




if ((!interface_exists('i_VulgarPassword')) && (!(class_exists('VulgarPassword')))) {

	/**
	*
	*/
	interface i_VulgarPassword {

	}

	class VulgarPassword {
		global $wpdb;
		global $vulgar;
		global $vulgar_vulgarity_options;

		private $class_dir, $class_prefix, $class_url, $class_name;
		    /**
		     * The table name where emails will be saved
		     * @since 1.0.1
		     *
		     * @access private
		     */
		    

		public function __construct() {
			$this->class_dir = '/classes/class-';
			
			include_once( $this->class_dir.'vulgar-db.php' );
			include_once( $this->class_dir.'vulgar-post.php' );
			include_once( $this->class_dir.'vulgar-setting.php' );


			//add_action( 'admin_init', '' );
			add_action( 'init', 'register_vulgar_scripts' );
			add_action( 'wp_enqueue_scripts', 'register_strength_js_scripts' );
			add_filter( 'plugin_action_links', 'vulgar_settings_link', 10, 5 );

			register_deactivation_hook( __FILE__, '' );
			register_activation_hook( __FILE__, '' );
		}

		public function vulgar_settings_link( $actions, $plugin_file )
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

		/**
		* Register and enqueue jQuery files to run on frontend, enqueue on admin_init
		*/
		public function register_vulgar_scripts() {
			wp_register_script( 'vulgar_js', plugins_url('inc/vulgar.js', __FILE__), array('jquery'));
			wp_register_style( 'vulgar_css', plugins_url('inc/vulgar.css', __FILE__));
			wp_enqueue_script( 'vulgar_js' );
			wp_enqueue_style( 'vulgar_css' );
		}

		public function register_strength_js_scripts(){
			wp_register_script( 'strength_js', plugins_url('inc/strength.js', __FILE__), array('jquery'));
			wp_register_script( 'strength_min_js', plugins_url('inc/strength.min.js', __FILE__), array('jquery'));
			wp_register_style( 'strength_css', plugins_url('inc/strength.css', __FILE__), array('jquery'));
			wp_enqueue_script( 'strength_js' );
			wp_enqueue_script( 'strength_min_js' );
			wp_enqueue_style( 'strength_css' );
		}


	}
}
$vulgar = new VulgarPassword();
}