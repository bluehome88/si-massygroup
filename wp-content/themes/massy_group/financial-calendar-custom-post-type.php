<?php

add_action( 'init', function() {
    $labels = array(
      'name'               => _x( 'Financial Calendars', 'Financial Calendars', 'twentytwenty' ),
      'singular_name'      => _x( 'Financial Calendar', 'Financial Calendar', 'twentytwenty' ),
      'menu_name'          => _x( 'Financial Calendars', 'admin menu', 'twentytwenty' ),
      'name_admin_bar'     => _x( 'Financial Calendar', 'add new on admin bar', 'twentytwenty' ),
      'add_new'            => _x( 'Add New', 'financialcalendar', 'twentytwenty' ),
      'add_new_item'       => __( 'Add New Financial Calendar', 'twentytwenty' ),
      'new_item'           => __( 'New Financial Calendar', 'twentytwenty' ),
      'edit_item'          => __( 'Edit Financial Calendar', 'twentytwenty' ),
      'view_item'          => __( 'View Financial Calendar', 'twentytwenty' ),
      'all_items'          => __( 'All Financial Calendars', 'twentytwenty' ),
      'search_items'       => __( 'Search Financial Calendars', 'twentytwenty' ),
      'parent_item_colon'  => __( 'Parent Financial Calendars:', 'twentytwenty' ),
      'not_found'          => __( 'No Financial Calendar found.', 'twentytwenty' ),
      'not_found_in_trash' => __( 'No Financial Calendar found in Trash.', 'twentytwenty' )
    );

    $args = array(	
      'labels'             => $labels,
      'description'        => __( 'Financial Calendars', 'twentytwenty' ),
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'show_in_nav_menus'  => true,
      'show_in_admin_bar'  => true,
      'menu_position'      => 5,
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'financial-calendar' ),
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
    register_post_type( 'financialcalendar', $args );

    register_taxonomy(
        'financial_calendar_category',
        'financialcalendar',
        array(
            'label' => __( 'Category' ),
            'rewrite' => array( 'slug' => 'financial_calendar_category' ),
            'hierarchical' => true,
        )
    );
    flush_rewrite_rules(false);
});

?>