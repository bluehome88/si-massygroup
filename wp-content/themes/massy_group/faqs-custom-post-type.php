<?php

add_action( 'init', function() {
    $labels = array(
      'name'               => _x( 'FAQs', 'FAQs', 'twentytwenty' ),
      'singular_name'      => _x( 'FAQ', 'FAQ', 'twentytwenty' ),
      'menu_name'          => _x( 'FAQs', 'admin menu', 'twentytwenty' ),
      'name_admin_bar'     => _x( 'FAQ', 'add new on admin bar', 'twentytwenty' ),
      'add_new'            => _x( 'Add New', 'faqsandenquiries', 'twentytwenty' ),
      'add_new_item'       => __( 'Add New FAQ', 'twentytwenty' ),
      'new_item'           => __( 'New FAQ', 'twentytwenty' ),
      'edit_item'          => __( 'Edit FAQ', 'twentytwenty' ),
      'view_item'          => __( 'View FAQ', 'twentytwenty' ),
      'all_items'          => __( 'All FAQs', 'twentytwenty' ),
      'search_items'       => __( 'Search FAQs', 'twentytwenty' ),
      'parent_item_colon'  => __( 'Parent FAQs:', 'twentytwenty' ),
      'not_found'          => __( 'No FAQ found.', 'twentytwenty' ),
      'not_found_in_trash' => __( 'No FAQ found in Trash.', 'twentytwenty' )
    );

    $args = array(  
      'labels'             => $labels,
      'description'        => __( 'FAQs', 'twentytwenty' ),
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'show_in_nav_menus'  => true,
      'show_in_admin_bar'  => true,
      'menu_position'      => 5,
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'faqs-and-enquiries' ),
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
    register_post_type( 'faqsandenquiries', $args );

    register_taxonomy(
        'faqs_and_enquiries_category',
        'faqsandenquiries',
        array(
            'label' => __( 'Category' ),
            'rewrite' => array( 'slug' => 'faqs_and_enquiries_category' ),
            'hierarchical' => true,
        )
    );
    flush_rewrite_rules(false);
});

?>