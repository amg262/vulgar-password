<?php
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

interface i_VulgarPasswordSettings {
    
}
/**
* PLUGIN SETTINGS PAGE
*/
class VulgarPasswordSettings {
    /**
     * Holds the values to be used in the fields callbacks
     */
    public $vulgar_password_options;
    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_vulgar_password_menu_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }
    /**
     * Add options page
     */
    public function add_vulgar_password_menu_page() {
        
        add_menu_page(
            'Vulgar Password',
            'Vulgar Password',
            'manage_options',
            'vulgar-password',
            array( $this, 'create_vulgar_password_menu_page' ),
            plugins_url('vulgar-password/assets/icon-20x20.png'), 5000
        );
    
    
       
        
    }
    
    public function create_vulgar_password_menu_page() {
        // Set class property
        $this->vulgar_password_options = get_option( 'vulgar_password_option' );
        ?>
        <div class="wrap" style="max-width:60%; width:100%; float:left;">
            <div>
            <h1>Vulgar Password</h1>
            <form method="post" action="options.php">

            <?php
                // This prints out all hidden setting fields
                settings_fields( 'vulgar_password_options_group' );
                do_settings_sections( 'vulgar-password-options-admin' );
                submit_button('Save All Options');
            ?>
            </form>
        </div>
            <?php //echo gtm_get_sidebar(); ?>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init() {
        //global $geo_mashup_options;
        register_setting(
            'vulgar_password_options_group', // Option group
            'vulgar_password_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'vulgar_password_options_section', // ID
            '', // Title
            array( $this, '' ), // Callback
            'vulgar-password-options-admin' // Page
        );

        add_settings_section(
            'vulgar_password_option', // ID
            '', // Title
            array( $this, 'vulgar_password_option_callback' ), // Callback
            'vulgar-password-options-admin', // Page
            'vulgar_password_options_section' // Section
        );
      
       
    }
    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input ) {
        $new_input = array();
        /*if( isset( $input['vulgar_password_option'] ) )
            $new_input['vulgar_password_option'] = absint( $input['vulgar_password_option'] );
        if( isset( $input['trail_story_setting'] ) )
            $new_input['trail_story_setting'] = absint( $input['trail_story_setting'] );
        */
        return $input;
    }
    /**
     * Print the Section text
     */
    public function print_option_info() { ?>
        <div id="plugin-info-header" class="plugin-info header">
            <div class="plugin-info content">
                <div class="credits">
                    <div>
                        <h4>Lead Developers</h4>
                        <a target="_blank" href="http://andrewgunn.xyz">Andrew Gunn</a>
                        &nbsp;‡&nbsp;
                        <a target="_blank" href="https:/github.com/fallen-rve">Ryan Van Ess</a>
                    </div>
                    <hr>
                    <!--<div>
                        <h4>Testing and Development</h4>
                        <a target="_blank" href="https://profiles.wordpress.org/jvalcq/">Jon Valcq</a>
                        &nbsp;‡&nbsp;
                        <a target="_blank" href="#">Josh Selk</a>
                    </div>
                    <hr>
                    <div>
                        <h4>Project Manager</h4>
                        <a target="_blank" href="http://kevinabarnes.com">Kevin Barnes</a>
                    </div>
                    <hr> -->
                    <br>
                </div>
            </div>
    <?php }

    /**
     * Get the settings option array and print one of its values
     */
    public function vulgar_password_option_callback() {
        //Get plugin options
        

        global $vulgar_password_options;
        // Enqueue Media Library Use
        wp_enqueue_media();
        
        // Get trail story options
        $vulgar_password_options = (array) get_option( 'vulgar_password_options' ); ?>
        <div style="max-width100%; width:100; height:auto;">
        <div style="max-width:60%; width:100%; float:left">
            <div id="plugin-info-header" class="plugin-info header">
            
                <h3><strong>Plugin Uninstallation</strong></h3>
                <hr>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <?php //$key = 'delete_data'; ?>
                            <th scope="row">
                                Uninstall Posts
                            </th>
                            <td>
       
                                <fieldset><?php $key = 'delete_posts'; ?>
                                    <label for="vulgar_password_options[<?php echo $key; ?>]">
                                        <input id='vulgar_password_options[<?php echo $key; ?>]' name="vulgar_password_options[<?php echo $key; ?>]" type="checkbox" value="1" <?php checked(1, $vulgar_password_options[$key], true ); ?> />
                                        Delete all posts, attachments, and plugin settings when uninstalled.
                                    </label>
                                <p class="description">Use this as a factory restore.</p>
                                
                            </td>
                        </tr>
                        <tr>
                            <?php //$key = 'delete_data'; ?>
                            <th scope="row">
                                Force Deletion
                            </th>
                            <td>
                                <fieldset><?php $key = 'delete_forced'; ?>
                                    <label for="vulgar_password_options[<?php echo $key; ?>]">
                                        <input id='vulgar_password_options[<?php echo $key; ?>]' name="vulgar_password_options[<?php echo $key; ?>]" type="checkbox" value="1" <?php checked(1, $vulgar_password_options[$key], true ); ?> />
                                        Bypass trash can and delete permanently.
                                    </label>
                                <!--<p class="description">Use this as a factory restore.</p>-->
                                
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                Uninstall Database
                            </th>
                            <td>
                                <fieldset><?php $key = 'delete_dbo'; ?>
                                    <label for="vulgar_password_options[<?php echo $key; ?>]">
                                        <input id='vulgar_password_options[<?php echo $key; ?>]' name="vulgar_password_options[<?php echo $key; ?>]" type="checkbox" value="1" <?php checked(1, $vulgar_password_options[$key], true ); ?> />
                                        Drop all database tables and plugin data when uninstalled.
                                    </label>
                                <p class="description"><span class="icon warn">&nbsp;</span>Use at your own risk. A backup is recommended beforehand.</p>
                                </fieldset>
                                
                            </td>
                        </tr>
                    </tbody>
                </table>
                    
                </p>
                <!--<p>
                    <?php //$key = 'text'; ?>
                    <label for="vulgar_password_options[text]">Text</label>
                    <input id='vulgar_password_options[text]' name="vulgar_password_options[text]" type="text"
                     value="<?php //echo $vulgar_password_options[$key]; ?>" />
                    
                </p>-->
                <?php submit_button('Save All Options'); ?>
            </div>

            <p><hr></p>
            
            <div style="clear:both;height:0;"></div>
      </div>
    <?php }
    // TODO: Input fields for KMLs
    /**
     * Get the settings option array and print one of its values
     */
    /*public function trail_story_setting_callback() {
        //Get plugin options
        global $vulgar_password_options, $geo_mashup_options;
        $vulgar_password_options = (array) get_option( 'trail_story_settings' );
        if( isset( $vulgar_password_options['vulgar_password_option'] ) ) { ?>
            <input type="checkbox" id="trail_story_settings" name="trail_story_settings[trail_story_setting]" value="1" <?php checked( 1, $vulgar_password_options['trail_story_setting'], false ); ?> />
        
        <?php } else { ?>
            <input type="checkbox" id="trail_story_settings" name="trail_story_settings[trail_story_setting]" value="1" <?php checked( 1, $vulgar_password_options['trail_story_setting'], false ); ?> />
       
        <?php }
        echo $html;
    }*/
}
if( is_admin() )
    $vulgar_password = new VulgarPasswordSettings();

