<?php
/**
 * Creates the Front End form for users to create a Tail Story post
 * 
 * @package Geo Mashup Trail Story Add-On
*/
// Exit if accessed directly
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

add_action('init','flush_permalinks');

 function flush_permalinks() {
 		reg_term_cpt();
        flush_rewrite_rules();
    }
     function reg_term_cpt() {
        $name = 'Vulgar Term';

        $all = 'vulgarities';
        $labels = array( 
        'name'                  => _x( 'Vulgar Term', 'Vulgar Terms', 'text_domain' ),
        'singular_name'         => _x( 'Vulgar Term', 'Vulgar Term', 'text_domain' ),
        'menu_name'             => __( 'Vulgar Terms', 'text_domain' ),
        'name_admin_bar'        => __( 'Vulgar Term', 'text_domain' ),
        'archives'              => __( 'Term Archives', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Terms:', 'text_domain' ),
        'all_items'             => __( 'Vulgar Terms', 'text_domain' ),
        'add_new_item'          => __( 'Add New Term', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Item', 'text_domain' ),
        'edit_item'             => __( 'Edit Term', 'text_domain' ),
        'update_item'           => __( 'Update Term', 'text_domain' ),
        'view_item'             => __( 'View Term', 'text_domain' ),
        'search_items'          => __( 'Search Terms', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
        'items_list'            => __( 'Items list', 'text_domain' ),
        'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter items list', 'text_domain' ),

        );

        $args = array( 
            'labels' => $labels,
            'hierarchical' => true,
            //'taxonomies' => array( 'vulgarities', 'post_tag' ),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,

            'show_in_admin_bar'=> true,
            'show_in_rest'=> true,
            'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'excerpt'), // 'custom-fields' , 'excerpt' 
          //  'rewrite' => array('slug' => 'Vulgar Term'),
            'capability_type' => 'post',

        //'register_meta_box_cb'=>'add_cpt_meta',
           // 'description'=>'',
            //'menu_icon' => 'dashicons-unlock',
            'menu_icon' => plugins_url('vulgar-password/assets/icon-20x20.png'),
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'query_var' => true,
            'can_export' => true,
            
        );

        register_post_type( 'vulgar-term', $args );

        $post_types = (array)$post_types;

        $labels = array( 
            'name' => _x( 'Term Tags', 'term-tags' ),
            'singular_name' => _x( 'Collection', 'collections' ),
            'search_items' => _x( 'Search Collections', 'collections' ),
            'popular_items' => _x( 'Popular Collections', 'collections' ),
            'all_items' => _x( 'All Collections', 'collections' ),
            'parent_item' => _x( 'Parent Collection', 'collections' ),
            'parent_item_colon' => _x( 'Parent Collection:', 'collections' ),
            'edit_item' => _x( 'Edit Collection', 'collections' ),
            'update_item' => _x( 'Update Collection', 'collections' ),
            'add_new_item' => _x( 'Add New Collection', 'collections' ),
            'new_item_name' => _x( 'New Collections', 'collections' ),
            'separate_items_with_commas' => _x( 'Separate Collections with commas', 'collections' ),
            'add_or_remove_items' => _x( 'Add or remove Collections', 'collections' ),
            'choose_from_most_used' => _x( 'Choose from the most used Collections', 'collections' ),
            'menu_name' => _x( 'Term Tags', 'collections' ),
        );

        $args = array( 
            'labels' => $labels,
            'public' => true,
            'show_in_nav_menus' => true,
            'show_ui' => true,
            
            'show_tagcloud' => true,
            'show_admin_column' => true,
            'hierarchical' => false,
            'rewrite' => array('slug' => 'term-tags'),
            'query_var' => true
        );

        register_taxonomy( 'term-tags', array('vulgar-term'), $args );

        $labels = array( 
            'name' => _x( 'Categories', 'vulgarities' ),
            'singular_name' => _x( 'Term Category', 'vulgarities' ),
            'search_items' => _x( 'Search Term Category', 'vulgarities' ),
            'popular_items' => _x( 'Popular Term Category', 'vulgarities' ),
            'all_items' => _x( 'All Term Category', 'vulgarities' ),
            'parent_item' => _x( 'Parent Term Category', 'vulgarities' ),
            'parent_item_colon' => _x( 'Parent Term Category:', 'vulgarities' ),
            'edit_item' => _x( 'Edit Term Category', 'vulgarities' ),
            'update_item' => _x( 'Update Term Category', 'vulgarities' ),
            'add_new_item' => _x( 'Add New Term Category', 'vulgarities' ),
            'new_item_name' => _x( 'New Term Category', 'vulgarities' ),
            'separate_items_with_commas' => _x( 'Separate Term Category with commas', 'vulgarities' ),
            'add_or_remove_items' => _x( 'Add or remove Term Category', 'vulgarities' ),
            'choose_from_most_used' => _x( 'Choose from the most used Term Category', 'vulgarities' ),
            'menu_name' => _x( 'Categories', 'vulgarities' ),
        );

        $args = array( 
            'labels' => $labels,
            'public' => true,
            'show_in_nav_menus' => true,
            'show_ui' => true,
            
            'show_tagcloud' => true,
            'show_admin_column' => true,
            'hierarchical' => true,
           // 'rewrite' => array('slug' => 'vulgarities'),
            'query_var' => true
        );

        register_taxonomy( 'vulgarities', array('vulgar-term'), $args );
      //  add_post_type_support( 'vulgar-term', array( 'aside', 'quote' ));

        //add_post_type_support( 'vulgar-term', 'post-formats' );
    }
