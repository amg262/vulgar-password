<?php
/*
* Custom Post Type for Vulgar passwords
*/
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
add_action( 'init', 'register_txn_password_group' );

function register_txn_password_group() {

    $labels = array( 
        'name' => _x( 'Password Groups', 'passwords' ),
        'singular_name' => _x( 'Password Group', 'passwords' ),
        'search_items' => _x( 'Search Password Groups', 'passwords' ),
        'popular_items' => _x( 'Popular Password Groups', 'passwords' ),
        'all_items' => _x( 'All Password Groups', 'passwords' ),
        'parent_item' => _x( 'Parent Password Group', 'passwords' ),
        'parent_item_colon' => _x( 'Parent Password Group:', 'passwords' ),
        'edit_item' => _x( 'Edit Password Group', 'passwords' ),
        'update_item' => _x( 'Update Password Group', 'passwords' ),
        'add_new_item' => _x( 'Add New Password Group', 'passwords' ),
        'new_item_name' => _x( 'New Password Groups', 'passwords' ),
        'separate_items_with_commas' => _x( 'Separate Password Groups with commas', 'passwords' ),
        'add_or_remove_items' => _x( 'Add or remove Password Groups', 'passwords' ),
        'choose_from_most_used' => _x( 'Choose from the most used Password Groups', 'passwords' ),
        'menu_name' => _x( 'Password Group', 'passwords' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        
        'show_tagcloud' => true,
        'show_admin_column' => false,
        'hierarchical' => true,
        'rewrite' => array('slug' => 'passwords'),
        'query_var' => true
    );

    register_taxonomy( 'passwords', array('password'), $args );
}