<?php

return [
  'slug' => 'sport',
  'args' => [
    'labels'            => [
      'name'                  => 'Sports',
      'singular_name'         => 'Sport',
      'search_items'          => 'Search Sport',
      'popular_items'         => 'Popular Sport',
      'all_items'             => 'All Sports',
      'parent_item'           => 'Parent Sport',
      'parent_item_colon'     => 'Parent Sport',
      'edit_item'             => 'Edit',
      'update_item'           => 'Update',
      'add_new_item'          => 'Add New',
      'new_item_name'         => 'New',
      'add_or_remove_items'   => 'Add or remove Sports',
      'choose_from_most_used' => 'Choose from most used Sports',
      'menu_name'             => 'Sports',
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
