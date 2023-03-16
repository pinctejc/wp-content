<?php

return [
  'slug' => 'language',
  'args' => [
    'labels'            => [
      'name'                  => 'Languages',
      'singular_name'         => 'Language',
      'search_items'          => 'Search Language',
      'popular_items'         => 'Popular Language',
      'all_items'             => 'All Languages',
      'parent_item'           => 'Parent Language',
      'parent_item_colon'     => 'Parent Language',
      'edit_item'             => 'Edit',
      'update_item'           => 'Update',
      'add_new_item'          => 'Add New',
      'new_item_name'         => 'New',
      'add_or_remove_items'   => 'Add or remove Languages',
      'choose_from_most_used' => 'Choose from most used Languages',
      'menu_name'             => 'Languages',
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
