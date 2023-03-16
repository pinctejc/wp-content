<?php 


class CF_Query_Args {
  private static $queries;
  private static $path = CF_THEME_DIR . '/inc/query-args/';

  public static function init () {
    self::$queries = array_diff(scandir(self::$path), ['.', '..']);

    foreach(self::$queries as $filepath) :
      require_once(self::$path . $filepath);
    endforeach;
  }
}