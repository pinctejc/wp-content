<?php

return [
  'slug' => 'currency',
  'args' => [
    'labels'            => [
      'name'                  => 'Currencies',
      'singular_name'         => 'Currency',
      'search_items'          => 'Search Currency',
      'popular_items'         => 'Popular Currency',
      'all_items'             => 'All Currencies',
      'parent_item'           => 'Parent Currency',
      'parent_item_colon'     => 'Parent Currency',
      'edit_item'             => 'Edit',
      'update_item'           => 'Update',
      'add_new_item'          => 'Add New',
      'new_item_name'         => 'New',
      'add_or_remove_items'   => 'Add or remove Currencies',
      'choose_from_most_used' => 'Choose from most used Currencies',
      'menu_name'             => 'Currencies',
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