<?php

class CF_Helpers_Taxonomy {

  protected static function get_external_data($fields, $term) {
    if (empty($fields))
      return [];

    if (array_key_exists('logo', $fields)) :
      if ($fields['logo'])
        $fields['logo'] = wp_get_attachment_image($fields['logo'], '46x46');
      // else
      //   $fields['logo'] = '<img width="112" height="80" src="'. CF_DIST_IMAGES . 'placeholders/placeholder.svg' .'" alt="image placeholder">';
    endif;

    if (array_key_exists('linked', $fields) && $fields['linked']) :
      $fields['linked'] = get_the_permalink( $fields['linked'] );
    endif;

    if ($term === 'language') :
      $fields['flag'] = CF_Helpers_Country::get_country_flag_by_id($fields['term_id'], true, 'CF_country', false, ['loading' => false, 'width' => '50', 'height' => '50']);
    endif;

    return $fields;
  }

  public static function get_taxonomies($taxonomy, $fields = null) {
    $terms = get_terms([
      'taxonomy'   => $taxonomy,
      'hide_empty' => false,
      'fields'     => 'id=>name',
    ]);

    if (!$terms) return;

    return self::get_taxonomy_fields($terms, $fields, $taxonomy);
  }

  public static function get_taxonomy($ids) {
    $terms = get_terms([
      'hide_empty' => false,
      'include'    => $ids,
      'fields'     => 'id=>name',
      'orderby'    => 'include'
    ]);

    if (!$terms) return;

    return $terms;
  }

  public static function get_taxonomy_fields($terms, $fields = [], $term = null) {
    if ( ! $terms ) return;

    $term_meta = [];
    foreach ($terms as $term_id => $name ) {
      $term_meta[$term_id]['term_id'] = $term_id;
      $term_meta[$term_id]['name'] = $name;

      if ( $fields ) {
        foreach ($fields as $key) {
          $term_meta[$term_id][$key] = get_term_meta($term_id, $key, true);
        }
      }

      $term_meta[$term_id] = self::get_external_data($term_meta[$term_id], $term);
    }

    return $term_meta;
  }

  public static function currency($term_id) {
    if (!$term_id)
      return;

    $term = get_term($term_id, 'currency');

    return [
      'name' => $term->name,
      'symbol' => get_term_meta( $term_id, 'symbol', true), //get_field('symbol', 'term_' . $term_id),
      'position' => get_term_meta( $term_id, 'position', true) //get_field('position', 'term_' . $term_id)
    ];
  }

  public static function set_currency_symbol($currency, $value) {
    if (empty($value))
      return;

    if (!$currency['symbol'])
      return $value . $currency['name'];

    if ($currency['position'] === 'front') :
      return $currency['symbol'] . $value;
    endif;

    if ($currency['position'] === 'rear') :
      return $value . $currency['symbol'];
    endif;
  }

  public static function get_taxonomy_linked($term, $type = 'logo', $class = false) {

    if ($type === 'logo' && empty($term['logo']))
      $type = 'name';

    return isset($term['linked']) && $term['linked'] ? '<a href="'. $term['linked'] .'" '. ($class ? 'class="'. $class .'"' : null) .'>'. $term[$type] .'</a>' : $term[$type];
  }
}
