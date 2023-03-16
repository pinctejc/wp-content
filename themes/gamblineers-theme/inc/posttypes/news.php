<?php

return [
  'slug' => 'news',
  'args' => [
    'labels'              => [
      'name'               => 'News',
      'all_items'          => 'All News',
      'singular_name'      => 'Article',
      'add_new'            => 'Add New',
      'add_new_item'       => 'Add New',
      'edit_item'          => 'Edit Article',
      'new_item'           => 'New Article',
      'view_item'          => 'View Article',
      'search_items'       => 'Search Article',
      'not_found'          => 'No News found',
      'not_found_in_trash' => 'No News found in Trash',
      'parent_item_colon'  => 'Parent Article',
      'menu_name'          => 'News'
    ],
    'hierarchical'        => false,
    'description'         => 'description',
    'taxonomies'          => ['news-category'],
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => null,
    'menu_icon'           => null,
    'show_in_nav_menus'   => true,
    'publicly_queryable'  => true,
    'exclude_from_search' => false,
    'has_archive'         => false,
    'query_var'           => true,
    'can_export'          => true,
    'rewrite'             => true,
    'capability_type'     => 'post',
    'supports'            => [
      'title',
      'editor',
      'thumbnail',
      'excerpt',
      'revisions',
      'page-attributes',
      'author'
    ],
  ]
];

