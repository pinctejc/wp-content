<?php

return [
  'slug' => 'module-type',
  'args' => [
    'labels'            => [
      'name'                  => 'Types',
      'singular_name'         => 'Module Type',
      'search_items'          => 'Search Type',
      'popular_items'         => 'Popular Type',
      'all_items'             => 'All Types',
      'parent_item'           => 'Parent Type',
      'parent_item_colon'     => 'Parent Type',
      'edit_item'             => 'Edit',
      'update_item'           => 'Update',
      'add_new_item'          => 'Add New',
      'new_item_name'         => 'New',
      'add_or_remove_items'   => 'Add or remove Type',
      'choose_from_most_used' => 'Choose from most used Type',
      'menu_name'             => 'Types',
    ],
    'public'             => true,
    'show_in_nav_menus'  => false,
    'show_admin_column'  => false,
    'hierarchical'       => true,
    'show_tagcloud'      => true,
    'show_ui'            => true,
    'show_in_quick_edit' => false,
    'query_var'          => true,
    'rewrite'            => true,
    'capabilities'       => [],
    // 'capabilities'       => array(
    //   'assign_terms' => 'manage_options',
    //   'edit_terms'   => 'god',
    //   'manage_terms' => 'god',
    // ),
  ],
  'post_types' => ['module']
];
