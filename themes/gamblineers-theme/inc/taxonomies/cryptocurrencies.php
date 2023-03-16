<?php

return [
  'slug' => 'crypto',
  'args' => [
    'labels'            => [
      'name'                  => 'Cryptocurrencies',
      'singular_name'         => 'Cryptocurrency',
      'search_items'          => 'Search Crypto',
      'popular_items'         => 'Popular Crypto',
      'all_items'             => 'All Cryptocurrencies',
      'parent_item'           => 'Parent Crypto',
      'parent_item_colon'     => 'Parent Crypto',
      'edit_item'             => 'Edit',
      'update_item'           => 'Update',
      'add_new_item'          => 'Add New',
      'new_item_name'         => 'New',
      'add_or_remove_items'   => 'Add or remove Cryptocurrencies',
      'choose_from_most_used' => 'Choose from most used Cryptocurrencies',
      'menu_name'             => 'Cryptocurrencies',
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
