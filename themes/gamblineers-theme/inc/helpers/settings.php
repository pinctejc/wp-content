<?php

class CF_Helpers_Settings {
  public static $classes = [];
  public static $styles = [];
  public static $data = [];

  protected static function set_settings($settings) {
    if (!isset($settings['section_id'])) $settings['section_id'] = null;
    if (!isset($settings['css_classes'])) $settings['css_classes'] = null;
    if (!isset($settings['text_color'])) $settings['text_color'] = null;
    if (!isset($settings['align'])) $settings['align'] = null;
    if (!isset($settings['background'])) $settings['background'] = null;
    if (!isset($settings['background_two'])) $settings['background_two'] = null;
    if (!isset($settings['visibility'])) $settings['visibility'] = null;

    return $settings;
  }

  protected static function ID($id) {

    if (empty($id))
      return null;

    return $id;
  }

  protected static function class($classes) {

    if (empty($classes))
      return null;

    if (is_array($classes))
      $classes = implode(' ', $classes);

    return $classes;
  }

  protected static function style($styles) {

    if (empty($styles))
      return null;

    if (is_array($styles))
      $styles = implode(' ', $styles);

    return $styles;
  }

  protected static function data($data) {

    if (empty($data))
      return null;

    if (is_array($data))
      $data = implode(' ', $data);

    return $data;
  }

  public static function hex2rgb($hexCode) {
    $hexCode = ltrim($hexCode, '#');

    if (strlen($hexCode) == 3) {
      $hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
    }

    $hexCode = array_map('hexdec', str_split($hexCode, 2));

    return implode(',', $hexCode);
  }

  public static function theme_color($name) {

    if (empty($name))
      return null;

    return get_option('options_' . $name );
  }

  public static function margins($margin) {
    if (empty($margin))
      return null;

    $arr = [];
    $md = $margin['md'];
    $mm = $margin['mm'];

    if ($md['mt'] !== '0') :
      $arr[] = $md['mt'];
    elseif($mm['mt'] !== '0'):
      $arr[] = 'mt-sm-0';
    endif;

    if ($md['mb'] !== '0') :
      $arr[] = $md['mb'];
    elseif($mm['mb'] !== '0'):
      $arr[] = 'mb-sm-0';
    endif;

    if ($mm['mt'] !== '0') $arr[] = $mm['mt'];
    if ($mm['mb'] !== '0') $arr[] = $mm['mb'];

    self::$classes = array_merge(self::$classes, $arr);

    return implode(' ', $arr);
  }

  public static function paddings($padding) {
    if (empty($padding))
      return null;

    $arr = [];
    $pd = $padding['pd'];
    $pm = $padding['pm'];

    if ($pd['pt'] !== '0') :
      $arr[] = $pd['pt'];
    elseif($pm['pt'] !== '0'):
      $arr[] = 'pt-sm-0';
    endif;

    if ($pd['pb'] !== '0') :
      $arr[] = $pd['pb'];
    elseif($pm['pb'] !== '0'):
      $arr[] = 'pb-sm-0';
    endif;

    if ($pm['pt'] !== '0') $arr[] = $pm['pt'];
    if ($pm['pb'] !== '0') $arr[] = $pm['pb'];

    self::$classes = array_merge(self::$classes, $arr);

    return implode(' ', $arr);
  }

  public static function text_color($color, $echo = true) {
    if (empty($color))
		  return null;

    if ($color['type'] === '1' && $color['theme'] !== '0') :

      if ($echo)
        self::$classes[] = $color['theme'];

      return $color['theme'];
    elseif ($color['type'] === '2') :

      if ($echo)
        self::$styles[] = 'color:' . $color['picker'] . ';';

      return $color['picker'];
    endif;

    return null;
  }

  public static function text_alignment($alignment) {
    if (empty($alignment))
		  return null;

    $arr = [];
    $tad = $alignment['tad'];
    $tam = $alignment['tam'];

    if ($tad !== '0') $arr[] = $tad;
    if ($tam !== '0') $arr[] = $tam;

    self::$classes = array_merge(self::$classes, $arr);
    return implode(' ', $arr);
  }

  public static function background($backgrounds) {
    $results = [];
    foreach ($backgrounds as $device => $bg) :
      if ( $bg['theme'] !== '0' ) :
        self::$classes[] = $bg['theme'];
        $results['classes'] = self::$classes;
      endif;

      if ($bg['type'] === '2'):
        self::$data[] = 'data-bg_' . $device . '="url('. wp_get_attachment_image_url($bg['image'], 'CF_'. $device .'_bg') . ')"';
        self::$data[] = 'data-bg_pos_' . $device . '="'. str_replace('-', ' ', $bg['position']) .'"';
        $results['data'] = self::$data;
      endif;
    endforeach;

    return $results;
  }

  public static function background_two($backgrounds) {
    if ($backgrounds['start'] !== '0' && $backgrounds['end'] !== '0') :
      self::$styles[] = 'background-image: linear-gradient(to bottom, '. $backgrounds['start'] .' 50%, '. $backgrounds['end'] .' 50%);';
    elseif($backgrounds['start'] !== '0'):
      self::$styles[] = 'background-image: linear-gradient(to bottom, '. $backgrounds['start'] .' 50%, transparent 50%);';
    elseif($backgrounds['end'] !== '0'):
      self::$styles[] = 'background-image: linear-gradient(to bottom, transparent 50%, '. $backgrounds['end'] .' 50%);';
    endif;
  }

  public static function visibility($visibility) {

    if (empty($visibility) || $visibility === '0')
      return null;

    self::$classes[] = $visibility;

    return $visibility;
  }

  public static function rules($rules) {
    if (empty($rules))
      return null;

    $user_country = CF_Helpers_Common::get_session('country_id');

    foreach($rules as $rule) :
      if($user_country === $rule['country']) :
        return $rule['operator'] === 'true' ? true : false;
      endif;
    endforeach;

    return null;
  }

  public static function get_settings($settings) {
    // $settings = self::set_settings($settings);
    self::$classes = isset($settings['css_classes']) ? [$settings['css_classes']] : [];
    self::$styles = [];
    self::$data = [];

    // if (isset($settings['margin']))
      // self::margins($settings['margin']);

    // if (isset($settings['padding']))
        // self::paddings($settings['padding']);

    if (isset($settings['text_color']))
      self::text_color($settings['text_color']);

    if (isset($settings['text_align']))
      self::text_alignment($settings['text_align']);

    if (isset($settings['background']))
      self::background($settings['background']);

    if (isset($settings['background_two']))
      self::background_two($settings['background_two']);

    if (isset($settings['visibility']))
      self::visibility($settings['visibility']);

    return [
      'id' => isset($settings['section_id']) ? self::ID($settings['section_id']) : null,
      'class' => self::class(self::$classes),
      'style' => self::style(self::$styles),
      'data' => self::data(self::$data)
    ];
  }

  public static function get_module($module) {

    if (isset($module['type']))
      return $module['type'] === '1' ? $module['manually'] : get_fields($module['module']);
    elseif(isset($module['manually']))
      return $module['manually'];
  }
}
