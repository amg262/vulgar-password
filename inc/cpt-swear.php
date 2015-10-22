<?php
/*
* Custom Post Type for Vulgar Swears
*/
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

add_action( 'init', 'register_cpt_swear' );

function register_cpt_swear() {

    $labels = array( 
        'name' => _x( 'Swear', 'swear' ),
        'singular_name' => _x( 'Swear', 'swear' ),
        'add_new' => _x( 'Add New Swear', 'swear' ),
        'add_new_item' => _x( 'Add New Swear', 'swear' ),
        'edit_item' => _x( 'Edit Swear', 'swear' ),
        'new_item' => _x( 'New Swear', 'swear' ),
        'view_item' => _x( 'View Swear', 'swear' ),
        'search_items' => _x( 'Search Swears', 'swear' ),
        'not_found' => _x( 'No Swears found', 'swear' ),
        'not_found_in_trash' => _x( 'No Swears found in Trash', 'swear' ),
        'parent_item_colon' => _x( 'Parent Swear:', 'swear' ),
        'menu_name' => _x( 'Swears', 'swear' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ), // 'custom-fields' , 'excerpt' 
        'taxonomies' => array( 'Swears', 'post_tag' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array('slug' => 'swear'),
        'capability_type' => 'post'
    );

    register_post_type( 'swear', $args );
}


/**
* Taxonomy for Swear CPT categories
*/
add_action( 'init', 'register_txn_swear_category' );

function register_txn_swear_category() {

    $labels = array( 
        'name' => _x( 'Swear Category', 'swear-category' ),
        'singular_name' => _x( 'Swear Category', 'swear-category' ),
        'search_items' => _x( 'Search Swear Categories', 'swear-category' ),
        'popular_items' => _x( 'Popular Swear Categories', 'swear-category' ),
        'all_items' => _x( 'All Swear Categories', 'swear-category' ),
        'parent_item' => _x( 'Parent Swear Category', 'swear-category' ),
        'parent_item_colon' => _x( 'Parent Swear Category:', 'swear-category' ),
        'edit_item' => _x( 'Edit Swear Category', 'swear-category' ),
        'update_item' => _x( 'Update Swear Category', 'swear-category' ),
        'add_new_item' => _x( 'Add New Swear Category', 'swear-category' ),
        'new_item_name' => _x( 'New Swear Categories', 'swear-category' ),
        'separate_items_with_commas' => _x( 'Separate Swear Categories with commas', 'swear-category' ),
        'add_or_remove_items' => _x( 'Add or remove Swear Categories', 'swear-category' ),
        'choose_from_most_used' => _x( 'Choose from the most used Swear Categories', 'swear-category' ),
        'menu_name' => _x( 'Swear Category', 'swear-category' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        
        'show_tagcloud' => true,
        'show_admin_column' => false,
        'hierarchical' => true,
        'rewrite' => array('slug' => 'swear-category'),
        'query_var' => true
    );

    register_taxonomy( 'swear-category', array('swear'), $args );
}