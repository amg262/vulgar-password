<?php

/**
 * Enqueue scripts and styles
 */
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );
function outofstock_script_styles() { ?>
    <script type="text/javascript">
      jQuery(document).ready(function($){
          $(document).foundation();


      });
    </script>
<?php }

add_action('wp_header','outofstock_script_styles',30);
