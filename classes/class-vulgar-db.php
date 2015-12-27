<?php
/**
 * Creates the Front End form for users to create a Tail Story post
 * 
 * @package Geo Mashup Trail Story Add-On
*/
// Exit if accessed directly
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );


interface i_VulgarDB {
    
}
/**
* PLUGIN SETTINGS PAGE
*/
class VulgarDB {
      /**
       * Holds the values to be used in the fields callbacks
       */
  public $wpdb;
  public $vulgar_password_options;
  
  public $dbase, $tbl_name, $wp_tbl;
  public $vulgar_password; 
  public $index;
        
        /**
         * The table name where emails will be saved
         * @since 1.0.1
         *
         * @access private
         */
        

    public function __construct() {
        global $wpdb;
        $this->dbase = $wpdb;
        $this->tbl_name = $this->dbase->prefix . 'vulgar_password';
        
        add_action( 'admin_init', array( &$this, 'install_vulgar_db' ) );
        add_action( 'admin_init', array( &$this, 'install_vulgar_db_meta' ) );

        //add_action( 'save_post')
    }

    public function install_vulgar_db() {
      //public function install_required_tables() {
        global $wpdb;
        $this->dbase = $wpdb;
        $this->tbl_name = $this->dbase->prefix . 'vulgar_password';
        $charset_collate = $this->dbase->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS {$this->tbl_name} (
          id INT(200) NOT NULL AUTO_INCREMENT,
          post_id INT(200),
          password VARCHAR(255) NOT NULL,
          primary_time DATETIME,
          is_active VARCHAR(5) DEFAULT 'off',
          UNIQUE KEY id (id) 
        ); ";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        var_dump($sql);

    }

    public function install_vulgar_db_meta() {
      //public function install_required_tables() {
      global $wpdb;
        $this->dbase = $wpdb;
       $this->tbl_name = $this->dbase->prefix . 'vulgar_password_meta';
        $charset_collate = $this->dbase->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS {$this->tbl_name} (
          id INT(200) NOT NULL AUTO_INCREMENT,
          password_id INT(200) ,
          rating DOUBLE(3,1) DEFAULT 0,
          primary_time DATETIME,
          is_active VARCHAR(5) DEFAULT 'off',
          UNIQUE KEY id (id),
        ); ";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

                var_dump($sql);


    }



    public function save_vulgar_password($password, $post_id) {
      global $wpdb, $table;
      $index = 0;
     // $tbl_name = 'gtm_postmeta';
      $table = $wpdb->prefix . 'vulgar_password';

      $wpdb->insert($table, 
          array( 
              'post_id' => $post_id,
              'primary_time' => current_time( 'mysql' ),
              'password' => esc_html( $password ),
              'is_active' => 'on'
          ));
      
      $index = $wpdb->insert_id;

    

      return $index;
    }
    
    public function save_vulgar_meta($password_id, $rating) {
      global $wpdb, $table;
      $index = 0;
     // $tbl_name = 'gtm_postmeta';
      $table = $wpdb->prefix . 'vulgar_password_meta';

      $wpdb->insert($table, 
          array( 
              'password_id' => $password_id,
              'rating' => $rating,
              'primary_time' => current_time( 'mysql' ),
                            'is_active' => 'on'

          ));
      
      $index = $wpdb->insert_id;

      return $index;
    }

}

$vulgar_db = new VulgarDB();


