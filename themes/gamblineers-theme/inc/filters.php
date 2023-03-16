<?php

class CF_Filters {

  public static function init() {
    add_filter('acf/settings/save_json', ['CF_Filters', 'acf_json_save_point'], 1);
    add_filter('acf/settings/load_json', ['CF_Filters', 'acf_json_load_point'], 20);
    add_filter('script_loader_tag', ['CF_Filters', 'add_asyncdefer_attribute'], 10, 2);
    add_filter('template_include', ['CF_Wrapping', 'wrap'], 109);
    add_filter('user_contactmethods', ['CF_Filters', 'update_contact_methods']);
    // add_filter('posts_search', ['CF_Filters', 'search_by_title_only'], 500, 2);
    add_filter('pre_get_posts', ['CF_Filters', 'searchfilter']);
    add_filter('acf-flexible-content-preview.images_path', ['CF_Filters', 'acf_preview_path']);
    add_filter('excerpt_more', ['CF_Filters','excerpt_more']);
    add_filter('intermediate_image_sizes', ['CF_Filters', 'remove_medium_size'], 10, 1);
    add_filter('manage_posts_columns',  ['CF_Filters', 'smashing_filter_posts_columns'], 10, 1);
    add_filter('comment_form_fields', ['CF_Filters', 'reorder_fields'], 10, 1);
    add_filter('wp_nav_menu_objects', ['CF_Filters', 'nav_menu_items_custom_fields'], 10, 2);
    add_filter('nav_menu_css_class', ['CF_Filters', 'nav_menu_item_classes'], 10, 3);
    add_filter('nav_menu_link_attributes', ['CF_Filters', 'add_specific_menu_atts'], 10, 3);
    add_filter('wp_lazy_loading_enabled', '__return_false');
    add_filter('option_show_avatars', '__return_false');
    // add_filter('post_type_link', ['CF_Filters', 'post_type_link'], 10, 3);
  }

  public static function acf_json_save_point($path) {
    $path = CF_ACF_JSON_DIR;
    return $path;
  }

  public static function acf_json_load_point($paths) {
    unset($paths[0]);
    $paths[] = CF_ACF_JSON_DIR;
    return $paths;
  }

  public static function add_asyncdefer_attribute($tag, $handle) {
    if(!is_admin()) :
      if (strpos($handle, 'async') !== false || strpos($handle, 'smush-lazy-load') !== false)
        return str_replace( '<script ', '<script async ', $tag );

      if (strpos($handle, 'defer') !== false)
        return str_replace( '<script ', '<script defer ', $tag );
    endif;

    return $tag;
  }

  public static function update_contact_methods($contactmethods) {
    // unset($contactmethods['facebook']);
    unset($contactmethods['instagram']);
    // unset($contactmethods['linkedin']);
    unset($contactmethods['myspace']);
    unset($contactmethods['pinterest']);
    unset($contactmethods['soundcloud']);
    unset($contactmethods['tumblr']);
    // unset($contactmethods['twitter']);
    unset($contactmethods['youtube']);
    unset($contactmethods['wikipedia']);
    return $contactmethods;
  }

  public static function search_by_title_only( $search, $wp_query) {
    global $wpdb;

    if(!$wp_query->query_vars)
      return $search;

    if (empty($search))
      return $search;

    $q = $wp_query->query_vars;
    $n = !empty($q['exact']) ? '' : '%';
    $search =
    $searchand = '';

    foreach ((array)$q['search_terms'] as $term) {
      $term = esc_sql(like_escape($term));
      $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
      $searchand = ' AND ';
    }
    if ( ! empty( $search ) ) {
      $search = " AND ({$search}) ";
      if ( ! is_user_logged_in() )
          $search .= " AND ($wpdb->posts.post_password = '') ";
    }
    return $search;
  }

  public static function searchfilter($query) {
    if ($query->is_search && !is_admin()) :
      $query->set('post_type', ['post', 'news', 'page']);
      $query->set('orderby', 'type date');
      $query->set('post_status', 'publish');
      $query->set('posts_per_page', -1);
    endif;

    return $query;
  }

  public static function acf_preview_path() {
    return 'resources/preview';
  }

  public static function excerpt_more() {
    return '...';
  }

  public static function remove_medium_size($sizes) {
    return array_diff($sizes, ['medium_large']);
  }

  public static function smashing_filter_posts_columns( $columns ) {
    unset($columns['categories']);
    unset($columns['tags']);
    return $columns;
  }

  public static function reorder_fields($fields){
    $cookie_field = $fields['cookies'];
    $comment_field = $fields['comment'];
    $author_field = $fields['author'];
    $email_field = $fields['email'];

    unset( $fields['cookies'] );
    unset( $fields['comment'] );
    unset( $fields['author'] );
    unset( $fields['email'] );
    unset( $fields['url'] );

    $fields['author'] = $author_field;
    $fields['email'] = $email_field;
    $fields['comment'] = $comment_field;
    $fields['cookies'] = $cookie_field;

    return $fields;
  }


  public static function nav_menu_items_custom_fields( $items, $args ) {
    if( $args->theme_location == 'primary_navigation' ) {
      foreach( $items as &$item ) {
        $icon = get_field('icon', $item);

        // append icon
        if( $icon ) {
          $item->title = '<span class="menu-item-icon">'. wp_get_attachment_image( $icon, 'full', true ) .'</span><span>' .  $item->title . '</span>';
        }
      }
    }
    return $items;
	}

  public static function nav_menu_item_classes( $classes, $item, $args ) {
    if ( $args->theme_location == 'primary_navigation' ) {
      if( in_array('menu-item-has-children', $classes) && ! in_array('header-sub-menu', $classes) ) {
        $classes[] = 'has-sub-menu';
      }

      $icon = get_field('icon', $item);
      if( $icon ) {
        $classes[] = 'menu-item-has-icon';
      }
    }

    return $classes;
  }

  public static function add_specific_menu_atts( $atts, $item, $args ) {
    if ( $args->theme_location == 'primary_navigation' ) {
      $atts['data-title'] = $item->post_title;
    }

    return $atts;
  }

  public static function post_type_link( $post_link, $post, $leavename ) {

    if ( 'news' != $post->post_type || 'publish' != $post->post_status ) {
      return $post_link;
    }

    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );

    return $post_link;
  }
}
