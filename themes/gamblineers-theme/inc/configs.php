<?php
if (!is_admin()) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}

/*
 * Defines
 */
define('CF_DIRECTORY_URI', get_template_directory_uri() . '/');

define('CF_RESOURCES_DIR', CF_THEME_DIR . '/resources/');
define('CF_DIST_DIR', CF_DIRECTORY_URI . 'resources/dist/');
define('CF_DIST_STYLES', CF_DIST_DIR . 'styles/');
define('CF_DIST_SCRIPTS', CF_DIST_DIR . 'scripts/');
define('CF_DIST_IMAGES', CF_DIST_DIR . 'images/');
define('CF_ACF_JSON_DIR', get_stylesheet_directory() . '/acf-json');

// Templates
define('CF_TEMPLATES_DIR', 'templates/');
define('CF_TEMPLATES_LOOP_DIR', CF_TEMPLATES_DIR . 'loop/');
define('CF_TEMPLATES_MODULE_DIR', CF_TEMPLATES_DIR . 'module/');
define('CF_TEMPLATES_BOXES_DIR', CF_TEMPLATES_DIR . 'boxes/');
define('CF_TEMPLATES_CASINO_DIR', CF_TEMPLATES_DIR . 'casinos/');
define('CF_TEMPLATES_NEWS_DIR', CF_TEMPLATES_DIR . 'news/');

define('CF_CASINO_PLAY', [
  'label' => get_option( 'options_play_now_label', '' ),
  'type' => get_option( 'options_play_now_type', '' ),
  'btn_color' => get_option( 'options_play_now_btn_color', '' ),
  'text_color' => get_option( 'options_play_now_text_color', '' )
]);
