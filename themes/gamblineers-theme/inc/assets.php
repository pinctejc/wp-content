<?php

class CF_Assets {

  public static function init() {
    add_action('wp_enqueue_scripts', ['CF_Assets', 'scripts_styles_enqueue']);
  }

  public static function asset_path($filename) {
    $dist_path = CF_DIST_DIR;
    $directory = dirname($filename) . '/';
    $file = basename($filename);
    static $manifest;

    return $dist_path . $directory . $file;
  }

  public static function scripts_styles_enqueue() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_script('contact-form-7');
    wp_dequeue_style('contact-form-7');
    wp_dequeue_style('cryptowp');
    wp_deregister_script('wp-embed');
    wp_dequeue_style('dashicons');
    wp_dequeue_style('classic-theme-styles');
    wp_dequeue_style('global-styles');

    wp_enqueue_script("module-settings-async", CF_Assets::asset_path("scripts/module-settings.js"), [], null, true);
    wp_enqueue_script('al-main', self::asset_path('scripts/main.js'), [], null, true);
    wp_enqueue_script('al-main-menu', self::asset_path('scripts/main-menu.js'), [], null, true);
    wp_enqueue_script('al-search', self::asset_path('scripts/search.js'), [], null, true);
    wp_enqueue_style('table-of-contents', self::asset_path('styles/table-contents.css'), [], null);
    wp_enqueue_script('table-of-contents-async', self::asset_path('scripts/table-contents.js'), [], null, true);

    if (is_single() && comments_open() && get_option('thread_comments')) {
      wp_enqueue_script('al-comment-reply');
    }
  }
}
