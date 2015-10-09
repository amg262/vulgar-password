<?php
/*
* Custom Post Type for Vulgar passwords
*/
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

add_action( 'init', 'register_cpt_password' );

function register_cpt_password() {

    $labels = array( 
        'name' => _x( 'Password', 'password' ),
        'singular_name' => _x( 'Password', 'password' ),
        'add_new' => _x( 'Add New Password', 'password' ),
        'add_new_item' => _x( 'Add New Password', 'password' ),
        'edit_item' => _x( 'Edit Password', 'password' ),
        'new_item' => _x( 'New Password', 'password' ),
        'view_item' => _x( 'View Password', 'password' ),
        'search_items' => _x( 'Search Passwords', 'password' ),
        'not_found' => _x( 'No passwords found', 'password' ),
        'not_found_in_trash' => _x( 'No passwords found in Trash', 'password' ),
        'parent_item_colon' => _x( 'Parent Password:', 'password' ),
        'menu_name' => _x( 'Passwords', 'password' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ), // 'custom-fields' , 'excerpt' 
        'taxonomies' => array( 'passwords', 'post_tag' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => false,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array('slug' => 'password'),
        'capability_type' => 'post'
    );

    register_post_type( 'password', $args );
}


/**
* Taxonomy for Password CPT categories
*/
add_action( 'init', 'register_txn_password_Category' );

function register_txn_password_Category() {

    $labels = array( 
        'name' => _x( 'Password Categories', 'password-category' ),
        'singular_name' => _x( 'Password Category', 'password-category' ),
        'search_items' => _x( 'Search Password Categories', 'password-category' ),
        'popular_items' => _x( 'Popular Password Categories', 'password-category' ),
        'all_items' => _x( 'All Password Categories', 'password-category' ),
        'parent_item' => _x( 'Parent Password Category', 'password-category' ),
        'parent_item_colon' => _x( 'Parent Password Category:', 'password-category' ),
        'edit_item' => _x( 'Edit Password Category', 'password-category' ),
        'update_item' => _x( 'Update Password Category', 'password-category' ),
        'add_new_item' => _x( 'Add New Password Category', 'password-category' ),
        'new_item_name' => _x( 'New Password Categories', 'password-category' ),
        'separate_items_with_commas' => _x( 'Separate Password Categories with commas', 'password-category' ),
        'add_or_remove_items' => _x( 'Add or remove Password Categories', 'password-category' ),
        'choose_from_most_used' => _x( 'Choose from the most used Password Categories', 'password-category' ),
        'menu_name' => _x( 'Password Category', 'password-category' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        
        'show_tagcloud' => true,
        'show_admin_column' => false,
        'hierarchical' => true,
        'rewrite' => array('slug' => 'password-category'),
        'query_var' => true
    );

    register_taxonomy( 'password-category', array('password'), $args );
}