<?php

add_action( 'init', function() {
    $labels = array(
      'name'               => _x( 'Top Ten Shareholders', 'Top Ten Shareholders', 'twentytwenty' ),
      'singular_name'      => _x( 'Top Ten Shareholder', 'Top Ten Shareholder', 'twentytwenty' ),
      'menu_name'          => _x( 'Top Ten Shareholders', 'admin menu', 'twentytwenty' ),
      'name_admin_bar'     => _x( 'Top Ten Shareholder', 'add new on admin bar', 'twentytwenty' ),
      'add_new'            => _x( 'Add New', 'toptenshareholder', 'twentytwenty' ),
      'add_new_item'       => __( 'Add New Top Ten Shareholder', 'twentytwenty' ),
      'new_item'           => __( 'New Top Ten Shareholder', 'twentytwenty' ),
      'edit_item'          => __( 'Edit Top Ten Shareholder', 'twentytwenty' ),
      'view_item'          => __( 'View Top Ten Shareholder', 'twentytwenty' ),
      'all_items'          => __( 'All Top Ten Shareholders', 'twentytwenty' ),
      'search_items'       => __( 'Search Top Ten Shareholders', 'twentytwenty' ),
      'parent_item_colon'  => __( 'Parent Top Ten Shareholders:', 'twentytwenty' ),
      'not_found'          => __( 'No Top Ten Shareholder found.', 'twentytwenty' ),
      'not_found_in_trash' => __( 'No Top Ten Shareholder found in Trash.', 'twentytwenty' )
    );

    $args = array(  
      'labels'             => $labels,
      'description'        => __( 'Top Ten Shareholders', 'twentytwenty' ),
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'show_in_nav_menus'  => true,
      'show_in_admin_bar'  => true,
      'menu_position'      => 5,
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'top-ten-shareholders' ),
      'capability_type'    => 'post',
      'has_archive'        => true,
      'exclude_from_search'=> false,
      'hierarchical'       => false,
      'menu_position'      => null,
      'can_export'         => true,
      'menu_icon'          => 'dashicons-format-aside',
      'show_in_rest'       => true,
      'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );
    register_post_type( 'toptenshareholder', $args );

    register_taxonomy(
        'top_ten_shareholders_category',
        'toptenshareholder',
        array(
            'label' => __( 'Category' ),
            'rewrite' => array( 'slug' => 'top_ten_shareholders_category' ),
            'hierarchical' => true,
        )
    );
    flush_rewrite_rules(false);
});

?>