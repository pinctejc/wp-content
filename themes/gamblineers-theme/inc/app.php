<?php

class CF_App {

  public static function init() {
    self::load_dependencies();
    self::instances();
  }

  protected static function load_dependencies() {
    require_once CF_THEME_DIR . '/inc/configs.php';
    require_once CF_THEME_DIR . '/inc/functions.php';
    require_once CF_THEME_DIR . '/inc/assets.php';
    require_once CF_THEME_DIR . '/inc/setup.php';
    require_once CF_THEME_DIR . '/inc/helpers.php';
    require_once CF_THEME_DIR . '/inc/query-args.php';
    require_once CF_THEME_DIR . '/inc/xhr.php';
    require_once CF_THEME_DIR . '/inc/core.php';
    require_once CF_THEME_DIR . '/inc/post-types.php';
    require_once CF_THEME_DIR . '/inc/taxonomies.php';
    require_once CF_THEME_DIR . '/inc/acf.php';
    require_once CF_THEME_DIR . '/inc/actions.php';
    require_once CF_THEME_DIR . '/inc/filters.php';
    require_once CF_THEME_DIR . '/inc/wrapper.php';
    require_once CF_THEME_DIR . '/inc/controllers.php';
  }

  protected static function instances () {
    \CF_Assets::init();
    \CF_Theme_Setup::init();
    \CF_Helpers::init();
    \CF_Query_Args::init();
    \CF_XHR::init();
//    \CF_Core::init();
    \CF_Post_types::init();
    \CF_Taxonomies::init();
    \CF_ACF::init();
    \CF_Actions::init();
    \CF_Filters::init();
    \CF_Controllers::init();
  }
}
