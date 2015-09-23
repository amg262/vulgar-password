<?php

function vulgar_password_shortcode( $attributes ) {
    $attr = shortcode_atts( array(
        'foo' => 'something',
        'bar' => 'something else',
    ), $attributes );

    return "Vulgar Password shortcode";
}

add_shortcode( 'vulgar', 'vulgar_password_shortcode' );