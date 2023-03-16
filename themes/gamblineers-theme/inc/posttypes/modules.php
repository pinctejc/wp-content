<?php

return [
  'slug' => 'module',
  'args' => [
    'labels'              => [
      'name'               => 'Modules',
      'all_items'          => 'All Modules',
      'singular_name'      => 'Module',
      'add_new'            => 'Add New',
      'add_new_item'       => 'Add New',
      'edit_item'          => 'Edit Module',
      'new_item'           => 'New Module',
      'view_item'          => 'View Module',
      'search_items'       => 'Search Module',
      'not_found'          => 'No Modules found',
      'not_found_in_trash' => 'No Modules found in Trash',
      'parent_item_colon'  => 'Parent Module',
      'menu_name'          => 'Modules'
    ],
    'hierarchical'        => false,
    'description'         => 'description',
    'taxonomies'          => [],
    'public'              => false,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_admin_bar'   => false,
    'menu_position'       => 56,
    'menu_icon'           => "dashicons-layout",
    'show_in_nav_menus'   => false,
    'publicly_queryable'  => false,
    'exclude_from_search' => true,
    'has_archive'         => false,
    'query_var'           => true,
    'can_export'          => true,
    'rewrite'             => true,
    'capability_type'     => 'post',
    'supports'            => [
      'title',
      'revisions',
    ],
  ]
];

