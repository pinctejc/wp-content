<?php
class CF_Core {

  public static function init() {
    session_start();
    self::set_session();
    session_write_close();
  }

  protected static function set_session() {
   if(function_exists('geoip_detect2_get_info_from_ip'))
   {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      $ip_address = $_SERVER['REMOTE_ADDR'];
    }

    if(!isset($_SESSION['casinofeed']) || $_SESSION['casinofeed']['geo_ip_address'] != $ip_address):
      $get_ip_info = geoip_detect2_get_info_from_ip($ip_address);
      $country_code = $get_ip_info->country->isoCode;
      $country_name = $get_ip_info->country->name;

      if ($country_code === 'GB') {
        $country_code = 'UK';
      }

      $_SESSION['casinofeed'] = [
        'geo_iso_code'   => $country_code,
        'geo_country'    => $country_name,
        'geo_ip_address' => $ip_address,
        'country_id'     => CF_Helpers_Country::get_country_id_by_code($country_code, false),
        'country_flag'   => CF_Helpers_Country::get_country_flag_by_code($country_code, false, 'CF_country', false, ['loading' => false, 'width' => '50', 'height' => '50']),
        'cookie'         => false
      ];
    endif;
   }
   else
   {
     $_SESSION['casinofeed'] = [
        'geo_iso_code'   => 'UK',
        'geo_country'    => 'UK',
        'geo_ip_address' => '2.103.1.1',
        'country_id'     => CF_Helpers_Country::get_country_id_by_code('UK', false),
        'country_flag'   => CF_Helpers_Country::get_country_flag_by_code('UK', false, 'CF_country', false, ['loading' => false, 'width' => '50', 'height' => '50']),
        'cookie'         => false
      ];
   }
  }
}
