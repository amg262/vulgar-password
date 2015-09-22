<?php
/**
* PLUGIN SETTINGS PAGE
*/
class VulgarSettingsPage
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

        add_submenu_page(
            'tools.php',
            'Vulgar Password',
            'Vulgar Password',
            'manage_options',
            'vulgar-password',
            array( $this, 'create_vulgar_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_vulgar_page()
    {
        // Set class property
        $this->options = get_option( 'vulgar_option_name' );
        ?>
        <div class="wrap">
            <h2>Vulgar Password Generator</h2>
            <form method="post" action="options.php">

            <?php
                // This prints out all hidden setting fields
                settings_fields( 'vulgar_option_group' );
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
            'vulgar_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Vulgar Password Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'vulgar-setting-admin' // Page
        );

        add_settings_field(
            'enable_vulgar_shortcode', // ID
            '<label for="enable_vulgar_shortcode">Enable Vulgar Password Shortcode</label>', // Title
            array( $this, 'enable_vulgar_shortcode_callback' ), // Callback
            'vulgar-setting-admin', // Page
            'setting_section_id' // Section
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

        if( isset( $input['enable_vulgar_shortcode'] ) )
            $new_input['enable_vulgar_shortcode'] = absint( $input['enable_vulgar_shortcode'] );

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
    public function enable_vulgar_shortcode_callback()
    {
        //Get plugin options
        $options = get_option( 'vulgar_option_name' );

        if (isset($options['enable_vulgar_shortcode'])) {
            $html .= '<input type="checkbox" id="disable_outofstock_overlay" name="my_option_name[disable_outofstock_overlay]" value="1"' . checked( 1, $options['disable_outofstock_overlay'], false ) . '/>';
        } else {
            $html .= '<input type="checkbox" id="disable_outofstock_overlay" name="my_option_name[disable_outofstock_overlay]" value="1"' . checked( 1, $options['disable_outofstock_overlay'], false ) . '/>';
        }

        echo $html;
    }
}

if( is_admin() )
    $vulgar_settings_page = new VulgarSettingsPage();
