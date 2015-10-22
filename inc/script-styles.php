<?php

/**
 * Enqueue scripts and styles
 */
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

function vulgar_password_script_styles() { ?>
    <script type="text/javascript">
      jQuery(document).ready(function($){
    		$('#myPassword').strength({
        strengthClass: 'strength',
        strengthMeterClass: 'strength_meter',
        strengthButtonClass: 'button_strength',
        strengthButtonText: 'Show password',
        strengthButtonTextToggle: 'Hide Password'
    }); 
      });

    </script>
<?php }

add_action('wp_footer','vulgar_password_script_styles',10);
