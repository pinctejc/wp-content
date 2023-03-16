<?php

return [
  'slug' => 'badge',
  'args' => [
    'labels'            => [
      'name'                  => 'Badges',
      'singular_name'         => 'Badge',
      'search_items'          => 'Search Badge',
      'popular_items'         => 'Popular Badge',
      'all_items'             => 'All Badges',
      'parent_item'           => 'Parent Badge',
      'parent_item_colon'     => 'Parent Badge',
      'edit_item'             => 'Edit',
      'update_item'           => 'Update',
      'add_new_item'          => 'Add New',
      'new_item_name'         => 'New',
      'add_or_remove_items'   => 'Add or remove Badges',
      'choose_from_most_used' => 'Choose from most used Badges',
      'menu_name'             => 'Badges',
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
