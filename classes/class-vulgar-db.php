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
        //add_action( 'save_post')
    }

    public function install_vulgar_db() {
      //public function install_required_tables() {
        global $wpdb;
        $this->dbase = $wpdb;
        $this->tbl_name = $this->dbase->prefix . 'vpass_term';
        $charset_collate = $this->dbase->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS {$this->tbl_name} (
          id INT(200) NOT NULL AUTO_INCREMENT,
          password VARCHAR(255),
          primary_time DATETIME,
          is_active VARCHAR(20) DEFAULT 'on',
          UNIQUE KEY id (id)
        ); ";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
        $this->tbl_name = $this->dbase->prefix . 'vpass_postmeta';

        $sql = "CREATE TABLE IF NOT EXISTS {$this->tbl_name} (
          id INT(200) NOT NULL AUTO_INCREMENT,
          post_id INT(200),
          term_id INT(200),
          is_active VARCHAR(20) DEFAULT 'on',
          UNIQUE KEY id (id)
        ); ";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

    }

    public function save_vulgar_password() {

    }
  
}

$vulgar_db = new VulgarDB();


