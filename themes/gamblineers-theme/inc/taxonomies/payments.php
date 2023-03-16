<?php

return [
  'slug' => 'payment',
  'args' => [
    'labels'            => [
      'name'                  => 'Payment Methods',
      'singular_name'         => 'Payment Method',
      'search_items'          => 'Search Payment Method',
      'popular_items'         => 'Popular Payment Method',
      'all_items'             => 'All Payment Methods',
      'parent_item'           => 'Parent Payment Method',
      'parent_item_colon'     => 'Parent Payment Method',
      'edit_item'             => 'Edit',
      'update_item'           => 'Update',
      'add_new_item'          => 'Add New',
      'new_item_name'         => 'New',
      'add_or_remove_items'   => 'Add or remove Payment Methods',
      'choose_from_most_used' => 'Choose from most used Payment Methods',
      'menu_name'             => 'Payment Methods',
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
