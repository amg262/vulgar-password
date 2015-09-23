<?php
/**
* PLUGIN SETTINGS PAGE
*/
class VulgarSettings
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
            array( $this, 'create_vulgar_menu_page' ),
            plugins_url('vulgar-password/assets/icons/data-protection-20.png'), 100
        );

        add_submenu_page(
            'vulgar-password',
            'Passwords',
            'Passwords',
            'manage_options',
            'edit.php?post_type=password'//,
            //array( $this, 'create_vulgar_menu_page' )
        );

        add_submenu_page(
            'vulgar-password',
            'New Password',
            'New Password',
            'manage_options',
            'post-new.php?post_type=password'//,
            //array( $this, 'create_vulgar_menu_page' )
        );

        /*add_submenu_page(
            'vulgar-password',
            'Categories',
            'Categories',
            'manage_options',
            'edit-tags.php?taxonomy=passwords&post_type=password'//,
            //array( $this, 'create_vulgar_menu_page' )
        );

        /*add_submenu_page(
            'vulgar-password',
            'Tags',
            'Tags',
            'manage_options',
            'edit-tags.php?taxonomy=post_tag&post_type=password'//,
            //array( $this, 'create_vulgar_menu_page' )
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
    public function create_vulgar_menu_page()
    {
        // Set class property
        $this->options = get_option( 'vulgar_password_option' );
        ?>
        <div class="wrap">
            <h2>Vulgar Password</h2>
            <form method="post" action="options.php">

            <?php
                // This prints out all hidden setting fields
                settings_fields( 'vulgar_password_option_group' );
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
                settings_fields( 'vulgar_settings_option_group' );
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
            'vulgar_password_option_group', // Option group
            'vulgar_password_option', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        register_setting(
            'vulgar_settings_option_group', // Option group
            'vulgar_settings_option', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'vulgar_menu_section', // ID
            'Vulgar Password Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'vulgar-setting-admin' // Page
        );

        add_settings_field(
            'disable_vulgar_password', // ID
            'Disable Vulgar Password', // Title
            array( $this, 'disable_vulgar_password_callback' ), // Callback
            'vulgar-setting-admin', // Page
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

        if( isset( $input['disable_vulgar_password'] ) )
            $new_input['disable_vulgar_password'] = absint( $input['disable_vulgar_password'] );

        return $new_input;
    }

    /**
     * Print the Section text
     */
    public function print_section_info()
    {
        print '<br/><p style="font-size:14px; margin:0 25% 0 0;"><strong>Options coming soon!</strong>';
    }
    /**
     * Get the settings option array and print one of its values
     */
    public function disable_vulgar_password_callback()
    {
        //Get plugin options
        $options = get_option( 'vulgar_settings_option' );

        if (isset($options['disable_vulgar_password'])) {
            $html .= '<input type="checkbox" id="disable_vulgar_password"
             name="vulgar_settings_option[disable_vulgar_password]" value="1"' . checked( 1, $options['disable_vulgar_password'], false ) . '/>';
        } else {
            $html .= '<input type="checkbox" id="disable_vulgar_password"
             name="vulgar_settings_option[disable_vulgar_password]" value="1"' . checked( 1, $options['disable_vulgar_password'], false ) . '/>';
        }

        echo $html;
    }
}

if( is_admin() )
    $vulgar_pass = new VulgarSettings();
