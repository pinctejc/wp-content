<?php

class CF_ACF {

  private static $options_page_list = [
    'theme_settings' => [
      'parent' => [
        'page_title' 	=> 'Theme Settings',
        'menu_title'	=> 'Theme Settings',
        'menu_slug' 	=> 'theme-settings',
        'parent_slug' => '',
        'position'   	=> 58,
        'redirect'		=> true
      ],
      'subpages' => []
    ],
    'casino_settings' => [
      'parent' => [
        'page_title' 	=> 'Casino Settings',
        'menu_title'	=> 'Settings',
        'menu_slug' 	=> 'post-settings',
        'parent_slug' => 'edit.php',
      ],
      'subpages' => []
    ]
  ];

  public static function init () {
    self::theme_settings();
  }

  protected static function theme_settings() {
    foreach (self::$options_page_list as $page) :
      if( function_exists('acf_add_options_page') ) :
        acf_add_options_page($page['parent']);

        foreach ($page['subpages'] as $subpages) :
          acf_add_options_page($subpages);
        endforeach;
      endif;
    endforeach;
  }
}
