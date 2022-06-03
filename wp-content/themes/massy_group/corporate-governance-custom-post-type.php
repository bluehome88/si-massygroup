<?php

add_action( 'init', function() {
    $labels = array(
      'name'               => _x( 'Corporate Governance', 'Corporate Governance', 'twentytwenty' ),
      'singular_name'      => _x( 'Corporate Governance', 'Corporate Governance', 'twentytwenty' ),
      'menu_name'          => _x( 'Corporate Governance', 'admin menu', 'twentytwenty' ),
      'name_admin_bar'     => _x( 'Corporate Governance', 'add new on admin bar', 'twentytwenty' ),
      'add_new'            => _x( 'Add New', 'corporategovernance', 'twentytwenty' ),
      'add_new_item'       => __( 'Add New Corporate Governance', 'twentytwenty' ),
      'new_item'           => __( 'New Corporate Governance', 'twentytwenty' ),
      'edit_item'          => __( 'Edit Corporate Governance', 'twentytwenty' ),
      'view_item'          => __( 'View Corporate Governance', 'twentytwenty' ),
      'all_items'          => __( 'All Corporate Governance', 'twentytwenty' ),
      'search_items'       => __( 'Search Corporate Governance', 'twentytwenty' ),
      'parent_item_colon'  => __( 'Parent Corporate Governance:', 'twentytwenty' ),
      'not_found'          => __( 'No Corporate Governance found.', 'twentytwenty' ),
      'not_found_in_trash' => __( 'No Corporate Governance found in Trash.', 'twentytwenty' )
    );

    $args = array(	
      'labels'             => $labels,
      'description'        => __( 'Corporate Governance', 'twentytwenty' ),
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'show_in_nav_menus'  => true,
      'show_in_admin_bar'  => true,
      'menu_position'      => 5,
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'corporate_governance' ),
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
    register_post_type( 'corporategovernance', $args );

    register_taxonomy(
        'corporate_governance_category',
        'corporategovernance',
        array(
            'label' => __( 'Category' ),
            'rewrite' => array( 'slug' => 'corporate_governance_category' ),
            'hierarchical' => true,
        )
    );
    flush_rewrite_rules(false);
});

?>