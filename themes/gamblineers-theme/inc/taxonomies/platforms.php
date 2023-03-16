<?php

return [
  'slug' => 'platform',
  'args' => [
    'labels'            => [
      'name'                  => 'Platforms',
      'singular_name'         => 'Platform',
      'search_items'          => 'Search Platform',
      'popular_items'         => 'Popular Platform',
      'all_items'             => 'All Platforms',
      'parent_item'           => 'Parent Platform',
      'parent_item_colon'     => 'Parent Platform',
      'edit_item'             => 'Edit',
      'update_item'           => 'Update',
      'add_new_item'          => 'Add New',
      'new_item_name'         => 'New',
      'add_or_remove_items'   => 'Add or remove Platforms',
      'choose_from_most_used' => 'Choose from most used Platforms',
      'menu_name'             => 'Platforms',
    ],
    'public'             => false,
    'show_in_nav_menus'  => false,
    'show_admin_column'  => false,
    'hierarchical'       => true,
    'show_tagcloud'      => true,
    'show_ui'            => true,
    'show_in_quick_edit' => false,
    'query_var'          => true,
    'meta_box_cb'        => false,
    'rewrite'            => true,
    'capabilities'       => [],
  ],
  'post_types' => ['post']
];
