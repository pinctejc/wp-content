<?php 


class CF_Helpers {

  private static $helpers;
  private static $path = CF_THEME_DIR . '/inc/helpers/';

  public static function init () {
    self::$helpers = array_diff(scandir(self::$path), ['.', '..', 'common.php']);

    require_once(self::$path . 'common.php');
    foreach(self::$helpers as $filepath) :
      require_once(self::$path . $filepath);
    endforeach;
  }
}