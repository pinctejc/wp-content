<?php

class CF_Theme_Setup {

  public static function init() {
    add_action('after_setup_theme', ['CF_Theme_Setup', 'setup_theme']);
    // add_action('init', ['CF_Theme_Setup', 'unregister_taxonomy']);
  }

  public static function setup_theme () {
    // Enable plugins to manage the document title
    // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
    add_theme_support('title-tag');

    // Register wp_nav_menu() menus
    // http://codex.wordpress.org/Function_Reference/register_nav_menus
    register_nav_menus([
      'primary_navigation' => __('Primary Navigation', 'elegance'),
    ]);

    // Enable post thumbnails
    // http://codex.wordpress.org/Post_Thumbnails
    // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
    // http://codex.wordpress.org/Function_Reference/add_image_size
    add_theme_support('post-thumbnails');
    add_image_size('casino', 260, 150, false);
    add_image_size('news', 738, 9999, true);
    add_image_size('46x46', 46, 46, ['center']);
    add_image_size('84x48', 84, 48, ['center']);
    add_image_size('box', 250, 140, ['center']);

    // Enable HTML5 markup support
    // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
    add_theme_support('html5', [
      'comment-form',
      'comment-list',
      'search-form'
    ]);
  }

  public static function unregister_taxonomy () {
    global $wp_taxonomies;

    $taxonomies = [
      'category',
      'post_tag'
    ];

    foreach($taxonomies as $taxonomy) :
      if (taxonomy_exists( $taxonomy)) unset( $wp_taxonomies[$taxonomy]);
    endforeach;
  }
}