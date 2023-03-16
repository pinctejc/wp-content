<?php
  function cf_print_r ( $array ) {
    if ( is_user_logged_in() ) {
      echo '<pre>';
      print_r( $array );
      echo '</pre>';
    }
  }

  function cf_var_dump ( $value ) {
    if ( is_user_logged_in() ) {
      var_dump($value);
    }
  }

  function cf_get_template( $template_name, $template_path = '', $args = [], $default_path = '') {
    if(!empty( $args ) && is_array($args)) extract($args);
    $located = locate_template([
    trailingslashit( $template_path ) . $template_name,
    $template_name
    ]);


    if (!file_exists($located)) :
      // trigger_error(sprintf(__( '%s does not exist.' ), '<code>' . $template_name . '</code>' ));
      return;
    endif;

    $located = apply_filters('cf_get_template', $located, $template_name, $args, $template_path, $default_path);

    include($located);
  }

  function cf_enqueue_module_assets($assets = [], $defer = false) {
    if (!$assets) return;

    if (is_array($assets)) :
      foreach ($assets as $asset) :
        cf_enqueue_asset($asset, $defer);
      endforeach;
    else :
      cf_enqueue_asset($assets, $defer);
    endif;
  }

  function cf_enqueue_asset($view, $defer = false, $script = null) {
    global $dependencies;

    $handle = '';
    $view = str_replace('_','-', $view);

    if ( ! $script ) $handle = 'al-';

    $css_file = CF_RESOURCES_DIR  . "/dist/styles/{$view}.css";
    $js_file = CF_RESOURCES_DIR . "/dist/scripts/{$view}.js";

    if ( file_exists( $css_file ) &&  ( ! $dependencies || ! in_array( $view, $dependencies ) ) && ! wp_style_is( $view ) && ! wp_style_is( 'al-' . $view ) ) :
      $dependencies[] = $view;

      if ( $defer ) :
        echo '<link rel="preload stylesheet" as="style" id="'. $handle . $view .'-css"  class="assets-lazy-style" data-href="'. CF_Assets::asset_path("styles/{$view}.css") .'" type="text/css" media="all">';
      else :
        echo '<link rel="preload stylesheet" as="style" id="'. $handle . $view .'-css" href="'. CF_Assets::asset_path("styles/{$view}.css") .'" type="text/css" media="all">';
      endif;
    endif;

    if ( file_exists( $js_file ) && ! wp_script_is( $view . '-async' ) && ! wp_script_is( 'al-' . $view . '-async' ) ) :
      wp_enqueue_script("{$handle}{$view}-async", CF_Assets::asset_path("scripts/{$view}.js"), [], null, true);
    endif;
  }

  function comment_callback($comment, $args, $depth) {
    cf_get_template('comment.php', CF_TEMPLATES_LOOP_DIR, [
      'comment' => $comment,
      'args' => $args,
      'depth' => $depth
    ]);
  }
