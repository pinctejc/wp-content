<?php

return [
  'slug' => 'license',
  'args' => [
    'labels'            => [  
      'name'                  => 'Licenses',
      'singular_name'         => 'License',
      'search_items'          => 'Search License',
      'popular_items'         => 'Popular License',
      'all_items'             => 'All Licenses',
      'parent_item'           => 'Parent License',
      'parent_item_colon'     => 'Parent License',
      'edit_item'             => 'Edit',
      'update_item'           => 'Update',
      'add_new_item'          => 'Add New',
      'new_item_name'         => 'New',
      'add_or_remove_items'   => 'Add or remove Licenses',
      'choose_from_most_used' => 'Choose from most used Licenses',
      'menu_name'             => 'Licenses',
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
