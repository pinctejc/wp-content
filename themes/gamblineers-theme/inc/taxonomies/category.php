<?php

return [
  'slug' => 'news-category',
  'args' => [
    'labels'            => [
      'name'                  => 'Category',
      'singular_name'         => 'Category',
      'search_items'          => 'Search Category',
      'popular_items'         => 'Popular Category',
      'all_items'             => 'All Category',
      'parent_item'           => 'Parent Category',
      'parent_item_colon'     => 'Parent Category',
      'edit_item'             => 'Edit',
      'update_item'           => 'Update',
      'add_new_item'          => 'Add New',
      'new_item_name'         => 'New',
      'add_or_remove_items'   => 'Add or remove Category',
      'choose_from_most_used' => 'Choose from most used Category',
      'menu_name'             => 'Category',
    ],
    'public'             => false,
    'show_in_nav_menus'  => false,
    'show_admin_column'  => false,
    'hierarchical'       => true,
    'show_tagcloud'      => true,
    'show_ui'            => true,
    'show_in_quick_edit' => false,
    'query_var'          => true,
    'rewrite'            => true,
    'capabilities'       => [],
  ],
  'post_types' => ['news']
];
