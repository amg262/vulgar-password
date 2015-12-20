<?php
/**
 * Creates the Front End form for users to create a Tail Story post
 * 
 * @package Geo Mashup Trail Story Add-On
*/
// Exit if accessed directly
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );
include_once('class-vulgar-db.php');


interface i_VulgarDB {
    
}
/**
* PLUGIN SETTINGS PAGE
*/
class VulgarDB {
      /**
       * Holds the values to be used in the fields callbacks
       */
  global $wpdb;
  global $vulgar_db;
  global $vulgar_vulgarity;
  global $vulgar_vulgarity_options;
  
  private $vulgarity, $password;
        /**
         * The table name where emails will be saved
         * @since 1.0.1
         *
         * @access private
         */
        

    public function __construct() {

      add_action( 'init', array( &$this, 'vulgar_post_init' ) );
    }
    
    public function vulgar_post_init() {
        require_once( ABSPATH . 'wp-admin/includes/image.php' );

      //add_shortcode( 'the_term', 'query_the_swear' );
            add_action( 'init', 'setup_vulgar_cpt' )

      add_action( 'admin_init', 'flush_permalinks' )

    }

    public function setup_vulgar_cpt() {
        $this->reg_vulgarity_cpt();
        $this->reg_password_cpt();
        $this->reg_vulgarity_category( array('vulgarity') );
        $this->reg_password_cat( array('password') );
        $this->reg_vulgar_collection( 
                        array('vulgarity', 'password' 'vulgarities', 'passwords' )
                        );
        $this->flush_permalinks();
        
    }
    public function flush_permalinks() {
        flush_rewrite_rules();
    }
    public function reg_vulgarity_cpt() {

        $labels = array( 
            'name' => _x( 'Vulgarity', 'vulgarity' ),
            'singular_name' => _x( 'Vulgarity', 'vulgarity' ),
            'add_new' => _x( 'Add New', 'vulgarity' ),
            'add_new_item' => _x( 'Add New Vulgarity', 'vulgarity' ),
            'edit_item' => _x( 'Edit Vulgarity', 'vulgarity' ),
            'new_item' => _x( 'New Vulgarity', 'vulgarity' ),
            'view_item' => _x( 'View Vulgarity', 'vulgarity' ),
            'search_items' => _x( 'Search Vulgarities', 'vulgarity' ),
            'not_found' => _x( 'No Vulgarities found', 'vulgarity' ),
            'not_found_in_trash' => _x( 'No Vulgarities found in Trash', 'vulgarity' ),
            'parent_item_colon' => _x( 'Parent Vulgarity:', 'vulgarity' ),
            'menu_name' => _x( 'Vulgarities', 'vulgarity' ),
        );

        $args = array( 
            'labels' => $labels,
            'hierarchical' => true,
            'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ), // 'custom-fields' , 'excerpt' 
            //'taxonomies' => array( 'vulgarities', 'post_tag' ),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => array('slug' => 'vulgarity'),
            'capability_type' => 'post'
        );

        register_post_type( 'vulgarity', $args );
    }


    /**
    * Taxonomy for vulgarity CPT categories
    */

    public function reg_vulgarity_category( $post_types ) {
        $post_types = (array)$post_types;

        $labels = array( 
            'name' => _x( 'Vulgarity Categories', 'vulgarities' ),
            'singular_name' => _x( 'Vulgarity Category', 'vulgarities' ),
            'search_items' => _x( 'Search vulgarity Categories', 'vulgarities' ),
            'popular_items' => _x( 'Popular vulgarity Categories', 'vulgarities' ),
            'all_items' => _x( 'All vulgarity Categories', 'vulgarities' ),
            'parent_item' => _x( 'Parent Vulgarity Category', 'vulgarities' ),
            'parent_item_colon' => _x( 'Parent Vulgarity Category:', 'vulgarities' ),
            'edit_item' => _x( 'Edit Vulgarity Category', 'vulgarities' ),
            'update_item' => _x( 'Update Vulgarity Category', 'vulgarities' ),
            'add_new_item' => _x( 'Add New Vulgarity Category', 'vulgarities' ),
            'new_item_name' => _x( 'New vulgarity Categories', 'vulgarities' ),
            'separate_items_with_commas' => _x( 'Separate vulgarity Categories with commas', 'vulgarities' ),
            'add_or_remove_items' => _x( 'Add or remove vulgarity Categories', 'vulgarities' ),
            'choose_from_most_used' => _x( 'Choose from the most used vulgarity Categories', 'vulgarities' ),
            'menu_name' => _x( 'Vulgarity Category', 'vulgarities' ),
        );

        $args = array( 
            'labels' => $labels,
            'public' => true,
            'show_in_nav_menus' => true,
            'show_ui' => true,
            
            'show_tagcloud' => true,
            'show_admin_column' => true,
            'hierarchical' => true,
            'rewrite' => array('slug' => 'vulgarities'),
            'query_var' => true
        );

        register_taxonomy( 'vulgarities', $post_types, $args );
    }

    public function reg_vulgar_collection( $post_types ) {
        $post_types = (array)$post_types;

        $labels = array( 
            'name' => _x( 'Collections', 'collections' ),
            'singular_name' => _x( 'Collection', 'collections' ),
            'search_items' => _x( 'Search Collections', 'collections' ),
            'popular_items' => _x( 'Popular Collections', 'collections' ),
            'all_items' => _x( 'All Collections', 'collections' ),
            'parent_item' => _x( 'Parent Collection', 'collections' ),
            'parent_item_colon' => _x( 'Parent Collection:', 'collections' ),
            'edit_item' => _x( 'Edit Collection', 'collections' ),
            'update_item' => _x( 'Update Collection', 'collections' ),
            'add_new_item' => _x( 'Add New Collection', 'collections' ),
            'new_item_name' => _x( 'New Collections', 'collections' ),
            'separate_items_with_commas' => _x( 'Separate Collections with commas', 'collections' ),
            'add_or_remove_items' => _x( 'Add or remove Collections', 'collections' ),
            'choose_from_most_used' => _x( 'Choose from the most used Collections', 'collections' ),
            'menu_name' => _x( 'Collections', 'collections' ),
        );

        $args = array( 
            'labels' => $labels,
            'public' => true,
            'show_in_nav_menus' => true,
            'show_ui' => true,
            
            'show_tagcloud' => true,
            'show_admin_column' => true,
            'hierarchical' => false,
            //'rewrite' => array('slug' => 'collections'),
            'query_var' => true
        );

        register_taxonomy( 'collections', $post_types, $args );
    }


    public function reg_password_cpt() {

    $labels = array( 
        'name' => _x( 'Password', 'password' ),
        'singular_name' => _x( 'Password', 'password' ),
        'add_new' => _x( 'Add New Password', 'password' ),
        'add_new_item' => _x( 'Add New Password', 'password' ),
        'edit_item' => _x( 'Edit Password', 'password' ),
        'new_item' => _x( 'New Password', 'password' ),
        'view_item' => _x( 'View Password', 'password' ),
        'search_items' => _x( 'Search Passwords', 'password' ),
        'not_found' => _x( 'No passwords found', 'password' ),
        'not_found_in_trash' => _x( 'No passwords found in Trash', 'password' ),
        'parent_item_colon' => _x( 'Parent Password:', 'password' ),
        'menu_name' => _x( 'Passwords', 'password' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ), // 'custom-fields' , 'excerpt' 
        'taxonomies' => array( 'passwords', 'post_tag' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array('slug' => 'password'),
        'capability_type' => 'post'
    );

    register_post_type( 'password', $args );
}

public function reg_password_cat( $post_types ) {

    $labels = array( 
        'name' => _x( 'Password Categories', 'password-category' ),
        'singular_name' => _x( 'Password Category', 'password-category' ),
        'search_items' => _x( 'Search Password Categories', 'password-category' ),
        'popular_items' => _x( 'Popular Password Categories', 'password-category' ),
        'all_items' => _x( 'All Password Categories', 'password-category' ),
        'parent_item' => _x( 'Parent Password Category', 'password-category' ),
        'parent_item_colon' => _x( 'Parent Password Category:', 'password-category' ),
        'edit_item' => _x( 'Edit Password Category', 'password-category' ),
        'update_item' => _x( 'Update Password Category', 'password-category' ),
        'add_new_item' => _x( 'Add New Password Category', 'password-category' ),
        'new_item_name' => _x( 'New Password Categories', 'password-category' ),
        'separate_items_with_commas' => _x( 'Separate Password Categories with commas', 'password-category' ),
        'add_or_remove_items' => _x( 'Add or remove Password Categories', 'password-category' ),
        'choose_from_most_used' => _x( 'Choose from the most used Password Categories', 'password-category' ),
        'menu_name' => _x( 'Password Category', 'password-category' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        
        'show_tagcloud' => true,
        'show_admin_column' => true,
        'hierarchical' => true,
        'rewrite' => array('slug' => 'password-category'),
        'query_var' => true
    );

    register_taxonomy( 'password-category', $post_types, $args );
}

     /**
    * Taxonomy for vulgarity CPT categories
    */

    function d() {
        add_shortcode( 'the_swear', 'query_the_swear' );
function query_the_swear( ) {
    $post_type = 'swear';
    $end = "";
    $count = 0;
    $args = array( 'post_type' => $post_type,
                   'posts_per_page' => -1,
                   'orderby' => 'rand'
                   );
    $loop = new WP_Query( $args );
    //var_dump($loop);
    while ( $loop->have_posts() ) : $loop->the_post();
        //echo the_title();
        $str .= get_the_title();

        if (strlen($str) <= 35) {
            $end = $str;
        }
        
        //echo $count ;
        $count += 1;
    endwhile;
    $final = str_replace(" ", "", $end);

    return $final;

    wp_reset_postdata();
}
    }
   
}

$vulgar_db = new VulgarDB();


