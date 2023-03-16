<?php
class CF_Taxonomies {
  
  private static $init = [];
  private static $path = CF_THEME_DIR . '/inc/taxonomies/';
  private static $taxonomies;
  
  public static function init () {
    self::$taxonomies = array_diff(scandir(self::$path), ['.', '..']);
    foreach(self::$taxonomies as $filepath) :
      self::$init[] = require_once(self::$path . $filepath);
    endforeach;

    add_action('init', ['CF_Taxonomies', 'register_taxonomy']);
  }

  public static function register_taxonomy () {
    foreach(self::$init as $term) :
      register_taxonomy($term['slug'], $term['post_types'], $term['args']);
    endforeach;
  }
}