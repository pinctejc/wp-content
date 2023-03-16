<?php

return [
  'slug' => 'provider',
  'args' => [
    'labels'            => [
      'name'                  => 'Software Providers',
      'singular_name'         => 'Software Provider',
      'search_items'          => 'Search Software Provider',
      'popular_items'         => 'Popular Software Provider',
      'all_items'             => 'All Software Providers',
      'parent_item'           => 'Parent Software Provider',
      'parent_item_colon'     => 'Parent Software Provider',
      'edit_item'             => 'Edit',
      'update_item'           => 'Update',
      'add_new_item'          => 'Add New',
      'new_item_name'         => 'New',
      'add_or_remove_items'   => 'Add or remove Software Providers',
      'choose_from_most_used' => 'Choose from most used Software Providers',
      'menu_name'             => 'Software Providers',
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
  'post_types' => ['post', 'slot']
];
