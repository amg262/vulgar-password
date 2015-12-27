<?php // Get out!
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

//if uninstall not called from WordPress exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
    exit();


interface i_VulgarUninstaller {
    
}
/**
* PLUGIN SETTINGS PAGE
*/
class VulgarUninstaller {
	    /**
	     * Holds the values to be used in the fields callbacks
	     */ 
	public $vulgar_password_options, $force_delete, $delete_dbo, $delete_posts;

	//$force_delete = true;
	public function __construct()
    {
    	//global $trail_story_options;

    	//$trail_story_options = (array) get_option( 'trail_story_options' );
    	$vulgar_password_options = get_option( 'vulgar_password_options' );
    	$this->delete_posts = $vulgar_password_options['delete_posts'];
    	$this->delete_dbo = $vulgar_password_options['delete_dbo'];

    	//delete_posts
    	//$force_delete = True;
    }

    //note in multisite looping through blogs to delete options on each blog does not scale. You'll just have to leave them.
	/*
	* Getting options groups
	*/
	public function delete_plugin_options() {
		$option_name = 'vulgar_password_options';
		delete_option( $option_name );
		delete_site_option( $option_name );
	}

	public function delete_cpts() {

		if ($this->delete_posts != null){
			$args = array(
				'numberposts' => -1,
				'post_type' => 'vulgar-term'
				//'post_status' => 'any'
			);

			$taxs = array( 'term-tags', 'term-category' );

			$posts = get_posts( $args );

			if (is_array($posts)) {

			   foreach ($posts as $post) {
			   		$temp = $post->ID;

			   		$post = get_post($temp);

				    foreach ($taxs as $tax){
				    	$term = get_term_by('slug', $post->post_name, $tax->name);
				    	wp_delete_term($term->term_id, $tax->name);

				    }
			       wp_delete_post( $post->ID, false);
			   }
			}
		}

	}

	
	/**
	*
	*/
	public function uninstall_vulgar_db() {
		if ($this->delete_dbo != null){

			global $wpdb;
			$tables = array( 'vulgar_password', 'vulgar_password_meta' );
			foreach( $tables as $table ) {
				$wpdb->query( 'DROP TABLE IF EXISTS ' . $wpdb->prefix . $table );
			}
		}
	}
}

if( is_admin() )
    $uninstaller = new VulgarUninstaller();
    $uninstaller->delete_plugin_options();
    $uninstaller->delete_cpts();
    $uninstaller->uninstall_vulgar_db();
/*
* For site options in multisite

delete_site_option( $option_name );  


$option_name_2 = 'etd_settings_option_key';
/*
* Delee options

delete_option( $option_name_2 );

/*
* For site options in multisite

delete_site_option( $option_name_2 );*/
