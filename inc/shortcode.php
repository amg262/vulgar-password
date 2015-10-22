<?php
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );
function vulgar_password_shortcode( $attributes ) {
    $attr = shortcode_atts( array(
        'foo' => 'something',
        'bar' => 'something else',
    ), $attributes );

    return '<input type="text" vulgar_password';
}

add_shortcode( 'vulgar', 'vulgar_password_shortcode' );