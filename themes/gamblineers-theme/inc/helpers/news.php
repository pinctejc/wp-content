<?php

class CF_Helpers_News {

  protected static function get_external_data($post_id, $key, $value) {

    // if ( empty ( $value ) ) return $value;

    $taxonomies_fields = [];

    $true_false_fields = [];

    if ( array_key_exists($key, $taxonomies_fields) && $value ) {
      $terms = CF_Helpers_Taxonomy::get_taxonomy($value);

      return $terms;
    } elseif ( in_array( $key, $true_false_fields ) ) {
      return $value ? __('Yes', 'elegance') : __('No', 'elegance');
    } else if ( $key === 'casinos' ) {
      return self::get_news_fields($post_id, [
        'list_type',
        'software_providers_listing',
        'deposit_methods_listing',
        'licenses_listing',
        'results_per_page',
        'selected_casinos',
        'order_by',
        'order_by_manually',
        'allowed_in',
        'specific_country'
      ]);
    } else if ( $key === 'news_bottom' ) {
      $results = CF_Helpers_Common::acf_group($post_id, $key, ['tag', 'subtitle', 'list_type', 'news', 'categories', 'number_of_results', 'results_per_page', 'order_by', 'slider', 'show_categories']);
      $results['titles'] = CF_Helpers_Common::acf_repeater($post_id, $key . '_titles', ['title', 'color']);
      $results['load_more'] = CF_Helpers_Common::acf_group($post_id, $key . '_load_more', ['label', 'type', 'btn_color', 'text_color']);
      $results['button'] = CF_Helpers_Common::acf_group($post_id, $key . '_button', ['cta_options', 'cta_options', 'page_link', 'enter_link', 'anchor_id', 'label', 'type', 'btn_color', 'text_color']);
      return $results;
    }

    return $value;
  }

  public static function get_news_fields($post_id, $fields = null) {
    $groups = [
      'base' => [
        'subtitle',
        'quick_info',
        'title',
        'type',
        'casinos',
        'module',
        'news_bottom'
      ],
    ];

    if ( ! $fields ) :
      return self::get_news_fields($post_id, ['base']);
    elseif ( is_string($fields) ) :
      if ( array_key_exists($fields, $groups) ) :
        return self::get_news_fields($post_id, $groups[$fields]);
      else:
        return self::get_external_data($post_id, $fields, get_post_meta( $post_id, $fields, true ));
      endif;
    elseif ( is_array( $fields ) ) :
      $array['post_id'] = $post_id;
      foreach( $fields as $key ) :
        if ( array_key_exists($key, $groups) ) :
          $array = array_merge( $array, self::get_news_fields($post_id, $groups[$key]) );
        else :
          $array[$key] = self::get_news_fields($post_id, $key);
        endif;
      endforeach;

      return $array;
    endif;

    return null;
  }

  public static function the_excerpt($post_id, $legnth = 200, $more = '...', $echo = true) {
    $content = get_post_meta($post_id, 'quick_info', true) ?? get_the_excerpt($post_id);

    $excerpt = mb_strimwidth(wp_strip_all_tags($content, true), 0, $legnth, $more);

    if ($echo) echo $excerpt;
    else return $excerpt;
  }
}
