<?php
//Hey there guy.
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

public function reg_collection_collection() {

        $labels = array( 
            'name' => _x( 'Collections', 'collections' ),
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
            'menu_name' => _x( 'Collections', 'collections' ),
        );

        $args = array( 
            'labels' => $labels,
            'public' => true,
            'show_in_nav_menus' => true,
            'show_ui' => true,
            
            'show_tagcloud' => true,
            'show_admin_column' => true,
            'hierarchical' => true,
            //'rewrite' => array('slug' => 'collections'),
            'query_var' => true
        );

        register_taxonomy( 'collections', array('collection'), $args );
    }
?>
<div class="vulgar-password">
<form method="POST">
	
</form>
	</div>