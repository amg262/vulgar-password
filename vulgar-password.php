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
include_once('classes/class-vulgar-settings.php');
include_once('classes/class-vulgar-db.php');
include_once('inc/cpt.php');
include_once('inc/script-styles.php');

function vulgar_db_sync() {
	if ( ! wp_next_scheduled( '' ) ) {
		wp_schedule_event( current_time( 'timestamp' ), 'twicedaily', '' );
	}
}
add_action( 'wp', 'vulgar_db_sync' );


function initialize() {
	return $vulgar_password_options = get_option( 'vulgar_password_options' );
}

// Register Sidebars
add_shortcode( 'the_swear', 'query_the_swear' );
function query_the_swear( ) {
	wp_reset_postdata();
	$options = initialize();

    if ($options['max_password_length'] != null) { $max = intval($options['max_password_length']); } else { $max = 18; }
    if ($options['number_digits'] != null) { $num = intval($options['number_digits']); } else { $num = 999; }
    if ($options['posts_per_page'] != null) { $int = intval($options['posts_per_page']); } else { $int = -1; }

    $post_type = 'vulgar-term';
    $end = "";
    $count = 0;
    $i = 0;
    $args = array( 'post_type' => $post_type,
                   'posts_per_page' => $int,
                   'orderby' => 'rand'
                   );
   // echo ($int);
    $loop = new WP_Query( $args );

    
    //var_dump($loop);
    while ( ($end_loop != true) && ($loop->have_posts()) ) : $loop->the_post();
        //echo the_title();
        $str = get_the_title();
        $term_str = clean_term_string( $str, $count );
        $final_str .= $term_str;

        if (strlen($final_str) >= $max) {
            //$final_str .= $term_str;
            $end_loop = true;
        } 
        
        $num = rand(0, $num);

        //echo $count ;
        $count += 1;
    endwhile;

    $id = save_term_string( $final_str );
    //save_vulgar_password( $final_str );
    return $final_str.$num;

    wp_reset_postdata();
}

function clean_term_string($str, $index) {
	$clean_str = "";
	$rand = rand(1,strlen($str));
	if ($str != null && $str != "") {


		$str2 = str_replace(" ", "", $str);
		$str3 = str_replace(",", "", $str2);
		$str4 = str_replace("'", "", $str3);
		$str5 = str_replace(".", "", $str4);
		$str6 = str_replace("-", "", $str5);


		if ($index <= 1) {
			$clean_str = ucfirst($str6);
		} elseif (is_int($rand % $index)) {
			$clean_str = ($str6);

		} else {
			$clean_str = $str6;
		}

	}

	return $clean_str;
}

function save_term_string($str) {
	$iden = get_post_id();
	$db = new VulgarDB();
	$id = $db->save_vulgar_password($str, $iden);
	return $id;
}

function save_term_meta($id, $rating) {
	$db = new VulgarDB();
	$id = $db->save_vulgar_meta($id, $rating);
	return $id;
}

//add_action( 'init', 'get_post_id' );
function get_post_id() {
	    wp_reset_postdata();

	global $post, $post_id;
	$post_id = $post->ID;
	return $post_id;
}

//add_action( 'wp_before_admin_bar_render', 'vulgar_toolbar', 999 );
//add_post_type_support( $post_type, $supports )

if ((!interface_exists('i_VulgarPassword')) && (!(class_exists('VulgarPassword')))) {

	/**
	*
	*/
	interface i_VulgarPassword {

	}

	class VulgarPassword {
		public $wpdb;
		public $vulgar;
		public $vulgar_vulgarity_options;

		private $class_dir, $class_prefix, $class_url, $class_name;
		    /**
		     * The table name where emails will be saved
		     * @since 1.0.1
		     *
		     * @access private
		     */
		    

		function __construct() {
			$this->class_dir = 'classes/class-';
			
			//include_once( 'classes/class-vulgar-db.php' );
			//include_once( 'classes/class-vulgar-post.php' );
			//include_once( 'classes/class-vulgar-settings.php' );

			//$asd = new VulgarPasswordSettings();
			//add_action( 'admin_init', '' );
			//add_action( 'init', 'register_vulgar_scripts' );
			//add_action( 'wp_enqueue_scripts', 'register_strength_js_scripts' );
			//add_filter( 'plugin_action_links', 'vulgar_settings_link', 10, 5 );

			//register_deactivation_hook( __FILE__, '' );
			//register_activation_hook( __FILE__, '' );
		}

		 function vulgar_settings_link( $actions, $plugin_file )
		{
			static $plugin;

			if (!isset($plugin))
				$plugin = plugin_basename(__FILE__);

				if ($plugin == $plugin_file) {

					$settings = array('settings' => '<a href="options-general.php?page=vulgar-password">' . __('Settings', 'General') . '</a>');

		    			$actions = array_merge($settings, $actions);
				}

				return $actions;
		}

		/*
		* Register and enqueue jQuery files to run on frontend, enqueue on admin_init
		
		 function register_vulgar_scripts() {
			wp_register_script( 'vulgar_js', plugins_url('inc/vulgar.js', __FILE__), array('jquery'));
			wp_register_style( 'vulgar_css', plugins_url('inc/vulgar.css', __FILE__));
			wp_enqueue_script( 'vulgar_js' );
			wp_enqueue_style( 'vulgar_css' );
		}

		 function register_strength_js_scripts() {
			wp_register_script( 'strength_js', plugins_url('inc/strength.js', __FILE__), array('jquery'));
			wp_register_script( 'strength_min_js', plugins_url('inc/strength.min.js', __FILE__), array('jquery'));
			wp_register_style( 'strength_css', plugins_url('inc/strength.css', __FILE__), array('jquery'));
			wp_enqueue_script( 'strength_js' );
			wp_enqueue_script( 'strength_min_js' );
			wp_enqueue_style( 'strength_css' );
		}*/


	}
}
$vulgar = new VulgarPassword();
