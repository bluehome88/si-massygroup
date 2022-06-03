<?php

add_action( 'init', function() {
    $labels = array(
      'name'               => _x( 'Massy Sliders', 'Massy Sliders', 'twentytwenty' ),
      'singular_name'      => _x( 'Massy Slider', 'Massy Slider', 'twentytwenty' ),
      'menu_name'          => _x( 'Massy Sliders', 'admin menu', 'twentytwenty' ),
      'name_admin_bar'     => _x( 'Massy Slider', 'add new on admin bar', 'twentytwenty' ),
      'add_new'            => _x( 'Add New', 'massysliders', 'twentytwenty' ),
      'add_new_item'       => __( 'Add New Massy Slider', 'twentytwenty' ),
      'new_item'           => __( 'New Massy Slider', 'twentytwenty' ),
      'edit_item'          => __( 'Edit Massy Slider', 'twentytwenty' ),
      'view_item'          => __( 'View Massy Slider', 'twentytwenty' ),
      'all_items'          => __( 'All Massy Sliders', 'twentytwenty' ),
      'search_items'       => __( 'Search Massy Sliders', 'twentytwenty' ),
      'parent_item_colon'  => __( 'Parent Massy Sliders:', 'twentytwenty' ),
      'not_found'          => __( 'No Massy Slider found.', 'twentytwenty' ),
      'not_found_in_trash' => __( 'No Massy Slider found in Trash.', 'twentytwenty' )
    );

    $args = array(	
      'labels'             => $labels,
      'description'        => __( 'Massy Sliders', 'twentytwenty' ),
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'show_in_nav_menus'  => true,
      'show_in_admin_bar'  => true,
      'menu_position'      => 5,
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'massy-slider' ),
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
    register_post_type( 'massysliders', $args );

    register_taxonomy(
        'massy_slider_category',
        'massysliders',
        array(
            'label' => __( 'Category' ),
            'rewrite' => array( 'slug' => 'massy_slider_category' ),
            'hierarchical' => true,
            'show_in_rest' => true,
        )
    );
    flush_rewrite_rules(false);
});

?>