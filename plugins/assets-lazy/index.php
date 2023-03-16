<?php

/*
Plugin Name: Assets Lazy
Description: Elegance Team lazyload scripts and styles.
Version: 0.0.1
Author: Elegance Team
Author URI: https://elegancedesign.net/
License: GPL2
*/

class AssetsLazy {

  /**
	 * Constructor
	 */
  function __construct() {
    if(!is_admin()) {
      add_action('wp_enqueue_scripts', array( $this, 'assets_enqueue') );
      add_filter('script_loader_tag', array( $this, 'add_scripts_data_attribute'), 10, 2);
      add_filter('style_loader_tag', array( $this, 'add_scripts_styles_attribute'), 10, 2);
    }
  }

  /**
	 * Load Assets
	 */
  function assets_enqueue() {
    wp_enqueue_script('async-assets-lazy', plugin_dir_url( __FILE__ ) . 'js/assets-lazy.js', [], null, true);
  }


  /**
  * Load Assets
  */
  function add_scripts_data_attribute($tag, $handle) {
    $jquery = wp_script_is('al-jquery') || wp_script_is('assets-lazy-jquery') || wp_script_is('jquery');
    if (strpos($handle, 'al-') !== false || strpos($handle, 'assets-lazy-') !== false) :
      return str_replace( ' src', ' class="assets-lazy-script" data-jquery="'. $jquery. '" data-src', $tag );
    endif;
      
    return $tag;
  }

  /**
  * Load Assets
  */
  function add_scripts_styles_attribute($tag, $handle) {
    if (strpos($handle, 'al-') !== false || strpos($handle, 'assets-lazy-') !== false)
      return str_replace( ' href', ' class="assets-lazy-style" data-href', $tag );
      
    return $tag;
  }
}

new AssetsLazy();
