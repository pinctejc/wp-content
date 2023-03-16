<?php 

class CF_Controllers {
  private static $files;
  private static $path = CF_THEME_DIR . '/inc/controllers/';

  public static function init () {
    self::$files = array_diff(scandir(self::$path), ['.', '..']);

    foreach(self::$files as $file) :
      require_once(self::$path . $file);
    endforeach;
  }
}