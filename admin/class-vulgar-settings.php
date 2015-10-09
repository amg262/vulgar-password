<?php
/**
* PLUGIN SETTINGS PAGE
*/
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

interface iVulgarSettings {
    public function __construct();
    public function add_vulgar_page();
    public function create_vulgar_options_page();
    public function create_vulgar_settings_page();
    public function page_init();
    public function sanitize( $input );
    public function print_section_info();
    public function disable_vulgar_password_callback();
}

class VulgarSettings implements iVulgarSettings
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_vulgar_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_vulgar_page()
    {
        // This page will be under "Settings"add_submenu_page( 'tools.php', 'SEO Image Tags', 'SEO Image Tags', 'manage_options', 'seo_image_tags', 'seo_image_tags_options_page' );
        
        add_menu_page(
            'Vulgar Password',
            'Vulgar Password',
            'manage_options',
            'vulgar-password',
            array( $this, 'create_vulgar_options_page' ),
            plugins_url('vulgar-password/assets/icons/data-protection-20.png'), 100
        );

        add_submenu_page(
            'vulgar-password',
            'Passwords',
            'Passwords',
            'manage_options',
            'edit.php?post_type=password'//,
            //array( $this, 'create_vulgar_options_page' )
        );

        add_submenu_page(
            'vulgar-password',
            'New Password',
            'New Password',
            'manage_options',
            'post-new.php?post_type=password'//,
            //array( $this, 'create_vulgar_options_page' )
        );

        /*add_submenu_page(
            'vulgar-password',
            'Categories',
            'Categories',
            'manage_options',
            'edit-tags.php?taxonomy=passwords&post_type=password'//,
            //array( $this, 'create_vulgar_options_page' )
        );

        /*add_submenu_page(
            'vulgar-password',
            'Tags',
            'Tags',
            'manage_options',
            'edit-tags.php?taxonomy=post_tag&post_type=password'//,
            //array( $this, 'create_vulgar_options_page' )
        );*/

        add_submenu_page(
            'vulgar-password',
            'Settings',
            'Settings',
            'manage_options',
            'vulgar-setting-admin',
            array( $this, 'create_vulgar_settings_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_vulgar_options_page()
    {
        // Set class property
        $this->options = get_option( 'vulgar_password_option' );
        ?>
        <div class="wrap">
            <h2>Vulgar Password</h2>
            <form method="post" action="options.php">

            <?php
                // This prints out all hidden setting fields
                settings_fields( 'vulgar_password_option' );
                do_settings_sections( 'vulgar-setting-admin' );
                submit_button('Save Options');
            ?>
            </form>
        </div>
        <?php
    }

     /**
     * Options page callback
     */
    public function create_vulgar_settings_page()
    {
        // Set class property
        $this->options = get_option( 'vulgar_settings_option' );
        ?>
        <div class="wrap">
            <h2>Vulgar Password Settings</h2>
            <form method="post" action="options.php">

            <?php
                // This prints out all hidden setting fields
                settings_fields( 'vulgar_settings_section' );
                do_settings_sections( 'vulgar-setting-admin' );
                submit_button('Save Options');
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {
        register_setting(
            'vulgar_option_group', // Option group
            'vulgar_password_option', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        register_setting(
            'vulgar_settings_group', // Option group
            'vulgar_settings_option', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'vulgar_options_section', // ID
            'Options', // Title
            array( $this, 'print_options_section_info' ), // Callback
            'vulgar-options-admin' // Page
        );

        add_settings_section(
            'vulgar_settings_section', // ID
            'Settings', // Title
            array( $this, 'print_settings_section_info' ), // Callback
            'vulgar-settings-admin' // Page
        );

        add_settings_field(
            'vulgar_option', // ID
            'Vulgar Option', // Title
            array( $this, 'vulgar_option_callback' ), // Callback
            'vulgar-options-admin', // Page
            'vulgar_options_section' // Section
        );

        add_settings_field(
            'vulgar_setting', // ID
            'Vulgar Setting', // Title
            array( $this, 'vulgar_setting_callback' ), // Callback
            'vulgar-settings-admin', // Page
            'vulgar_settings_section' // Section
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();

        if( isset( $input['vulgar_option'] ) )
            $new_input['vulgar_option'] = absint( $input['vulgar_option'] );
        if( isset( $input['vulgar_setting'] ) )
            $new_input['vulgar_setting'] = absint( $input['vulgar_setting'] );

        return $new_input;
    }

    /**
     * Print the Section text
     */
    public function print_options_section_info()
    {
        print '<br/><p style="font-size:14px; margin:0 25% 0 0;"><strong>Options coming soon!</strong>';
    }

    /**
     * Print the Section text
     */
    public function print_settings_section_info()
    {
        print '<br/><p style="font-size:14px; margin:0 25% 0 0;"><strong>Settings coming soon!</strong>';
    }
    /**
     * Get the settings option array and print one of its values
     */
    public function vulgar_option_callback()
    {
        //Get plugin options
        $options = get_option( 'vulgar_password_option' );

        if (isset($options['vulgar_option'])) {
            $html .= '<input type="checkbox" id="vulgar_option"
             name="vulgar_password_option[vulgar_option]" value="1"' . checked( 1, $options['vulgar_option'], false ) . '/>';
        } else {
            $html .= '<input type="checkbox" id="vulgar_option"
             name="vulgar_password_option[vulgar_option]" value="1"' . checked( 1, $options['vulgar_option'], false ) . '/>';
        }

        echo $html;
    }
    /**
     * Get the settings option array and print one of its values
     */
    public function vulgar_setting_callback()
    {
        //Get plugin options
        $options = get_option( 'vulgar_settings_option' );

        if (isset($options['vulgar_setting'])) {
            $html .= '<input type="checkbox" id="vulgar_setting"
             name="vulgar_settings_option[vulgar_setting]" value="1"' . checked( 1, $options['vulgar_setting'], false ) . '/>';
        } else {
            $html .= '<input type="checkbox" id="vulgar_setting"
             name="vulgar_settings_option[vulgar_setting]" value="1"' . checked( 1, $options['vulgar_setting'], false ) . '/>';
        }

        echo $html;
    }
}

if( is_admin() )
    $vulgar_pass = new VulgarSettings();
