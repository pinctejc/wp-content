<?php

return [
  'slug' => 'casino-type',
  'args' => [
    'labels'            => [
      'name'                  => 'Casino Types',
      'singular_name'         => 'Casino Type',
      'search_items'          => 'Search Casino Type',
      'popular_items'         => 'Popular Casino Type',
      'all_items'             => 'All Casino Types',
      'parent_item'           => 'Parent Casino Type',
      'parent_item_colon'     => 'Parent Casino Type',
      'edit_item'             => 'Edit',
      'update_item'           => 'Update',
      'add_new_item'          => 'Add New',
      'new_item_name'         => 'New',
      'add_or_remove_items'   => 'Add or remove Casino Types',
      'choose_from_most_used' => 'Choose from most used Casino Types',
      'menu_name'             => 'Casino Types',
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
