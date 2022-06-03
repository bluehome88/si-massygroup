<?php

add_action( 'init', function() {
    $labels = array(
      'name'               => _x( 'Business Products', 'Business Products', 'twentytwenty' ),
      'singular_name'      => _x( 'Business Product', 'Business Product', 'twentytwenty' ),
      'menu_name'          => _x( 'Business Products', 'admin menu', 'twentytwenty' ),
      'name_admin_bar'     => _x( 'Business Product', 'add new on admin bar', 'twentytwenty' ),
      'add_new'            => _x( 'Add New', 'businessproducts', 'twentytwenty' ),
      'add_new_item'       => __( 'Add New Business Product', 'twentytwenty' ),
      'new_item'           => __( 'New Business Product', 'twentytwenty' ),
      'edit_item'          => __( 'Edit Business Product', 'twentytwenty' ),
      'view_item'          => __( 'View Business Product', 'twentytwenty' ),
      'all_items'          => __( 'All Business Products', 'twentytwenty' ),
      'search_items'       => __( 'Search Business Products', 'twentytwenty' ),
      'parent_item_colon'  => __( 'Parent Business Products:', 'twentytwenty' ),
      'not_found'          => __( 'No Business Product found.', 'twentytwenty' ),
      'not_found_in_trash' => __( 'No Business Product found in Trash.', 'twentytwenty' )
    );

    $args = array(	
      'labels'             => $labels,
      'description'        => __( 'Business Products', 'twentytwenty' ),
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'show_in_nav_menus'  => true,
      'show_in_admin_bar'  => true,
      'menu_position'      => 5,
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'business-product' ),
      'capability_type'    => 'post',
      'has_archive'        => true,
      'exclude_from_search'=> false,
      'hierarchical'       => false,
      'menu_position'      => null,
      'can_export'         => true,
      'menu_icon'          => 'dashicons-format-aside',
      'show_in_rest'       => true,
      'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields' )
    );
    register_post_type( 'businessproducts', $args );

    register_taxonomy(
        'business_product_category',
        'businessproducts',
        array(
            'label' => __( 'Category' ),
            'rewrite' => array( 'slug' => 'business_product_category' ),
            'hierarchical' => true,
            'show_in_rest' => true,
        )
    );
    flush_rewrite_rules(false);
});

?>