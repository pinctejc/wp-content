<?php
class CF_Post_types {
  
  private static $post_types;
  private static $init = [];
  private static $path = CF_THEME_DIR . '/inc/posttypes/';
  
  public static function init () {
    self::$post_types = array_diff(scandir(self::$path), ['.', '..']);
    foreach(self::$post_types as $filepath) :
      self::$init[] = require_once(self::$path . $filepath);
    endforeach;

    add_action('init', ['CF_Post_types', 'register_type']);
    add_action('init', ['CF_Post_types', 'change_post_object']);
    add_action('admin_menu', ['CF_Post_types', 'change_post_label']);
  }

  public static function register_type () {
    foreach(self::$init as $post_type) :
      register_post_type($post_type['slug'], $post_type['args']);
    endforeach;
  }

  public static function change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Casinos';
    $submenu['edit.php'][5][0] = 'All Casinos';
    $submenu['edit.php'][10][0] = 'Add new';
    echo '';
  }

  public static function change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Casinos';
    $labels->singular_name = 'Casino';
    $labels->add_new = 'Add New';
    $labels->add_new_item = 'Add New';
    $labels->edit_item = 'Edit Casino';
    $labels->new_item = 'Casino';
    $labels->view_item = 'View Casino';
    $labels->search_items = 'Search Casinos';
    $labels->not_found = 'No Casinos found';
    $labels->not_found_in_trash = 'No Casinos found in Trash';
    $labels->menu_name = 'Casinos';
    $labels->name_admin_bar = 'Casino';
    $labels->view_items = "View Casinos";
    $labels->all_items = 'All Casinos';
    $labels->archives = 'Casino Archives';
    $labels->attributes = 'Casino Attributes';
    $labels->attributes = 'Casino Attributes';
  }
}