<?php

return [
  'slug' => 'esport',
  'args' => [
    'labels'            => [
      'name'                  => 'eSports',
      'singular_name'         => 'eSport',
      'search_items'          => 'Search eSport',
      'popular_items'         => 'Popular eSport',
      'all_items'             => 'All eSports',
      'parent_item'           => 'Parent eSport',
      'parent_item_colon'     => 'Parent eSport',
      'edit_item'             => 'Edit',
      'update_item'           => 'Update',
      'add_new_item'          => 'Add New',
      'new_item_name'         => 'New',
      'add_or_remove_items'   => 'Add or remove eSports',
      'choose_from_most_used' => 'Choose from most used eSports',
      'menu_name'             => 'eSports',
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
