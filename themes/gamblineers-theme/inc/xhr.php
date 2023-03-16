<?php 


class CF_XHR {

  private static $xhr;
  private static $path = CF_THEME_DIR . '/inc/xhr/';

  public static function init () {
    self::$xhr = array_diff(scandir(self::$path), ['.', '..']);

    foreach(self::$xhr as $filepath) :
      require_once(self::$path . $filepath);
    endforeach;
  }
}