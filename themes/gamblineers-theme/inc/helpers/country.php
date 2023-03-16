<?php

class CF_Helpers_Country {

   /*
   * GET Coutntry Name By Cuontry ID
   */
  public static function get_country_name_by_id($country_id, bool $echo = true) {
    $title = get_the_title($country_id);
    if ($echo) echo $title;
    else return $title;
  }

  /*
   * GET Coutntry Code By Cuontry ID
   */
  public static function get_country_code_by_id($country_id, bool $echo = true) {
    $code = get_post_meta($country_id, 'country_code', true);
    if ($echo) echo $code;
    else return $code;
  }

  /*
   * GET Coutntry Flag by Country ID
   */
  public static function get_country_flag_by_id($country_id, $echo = true, $size = 'CF_country', $icon = false, $attr = ['width' => '50', 'height' => '50']) {
    return elegance_country_flag_by_country_id($country_id, $echo, $size, $icon, $attr);
  }

  /*
   * GET Coutntry ID by Country Code
   */
  public static function get_country_id_by_code($country_code, bool $echo = true) {
    $country_id = elegance_country_id_by_country_code($country_code, false);

    if ($echo) echo $country_id;
    else return $country_id;
  }

  /*
   * GET Coutntry Flag by Country Code
   */
  public static function get_country_flag_by_code($country_code, $echo = true, $size = 'CF_country', $icon = false, $attr = ['width' => '50', 'height' => '50']) {
    
    return elegance_country_flag_by_country_code($country_code, $echo, $size, $icon, $attr);
  }
}