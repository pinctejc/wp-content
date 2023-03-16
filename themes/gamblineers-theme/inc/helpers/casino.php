<?php

class CF_Helpers_Casino {

  protected static function get_external_data($post_id, $key, $value) {

    // if ( empty ( $value ) ) return $value;

    $taxonomies_fields = [
      'licenses'           => 'license',
      'platforms'          => 'platform',
      'languages'          => 'language',
      'badge'              => 'badge',
      'casino_type'        => 'casino-type',
      'currencies'         => 'currency',
      'cryptocurrencies'   => 'crypto',
      'deposit_methods'    => 'payment',
      'software_providers' => 'provider',
      'sports'             => 'sport',
      'esports'            => 'esport',
    ];

    $true_false_fields = [];

    if ( array_key_exists($key, $taxonomies_fields) && $value ) {
      $terms = CF_Helpers_Taxonomy::get_taxonomy($value);

      if ( $key === 'badge' ) {
        $value = CF_Helpers_Taxonomy::get_taxonomy_fields($terms, ['text_color', 'color'], $taxonomies_fields[$key]);
        return end($value);

      } elseif( $key === 'casino_type' ) {
        $value = CF_Helpers_Taxonomy::get_taxonomy_fields($terms, ['linked', 'color', 'logo'], $taxonomies_fields[$key]);
        return end($value);
      } elseif( $key === 'cryptocurrencies' || $key === 'currencies' || $key === 'deposit_methods' ) {
        return CF_Helpers_Taxonomy::get_taxonomy_fields($terms, ['linked', 'logo'], $taxonomies_fields[$key]);
      } elseif ( $key === 'licenses' || $key === 'languages' || $key === 'game_types' || $key === 'software_providers' || $key === 'sports' || $key === 'esports' ) {
        return CF_Helpers_Taxonomy::get_taxonomy_fields($terms, ['linked'], $taxonomies_fields[$key]);
      } else {
        return $terms;
      }
    } elseif ( in_array( $key, $true_false_fields ) ) {
      return $value ? __('Yes', 'elegance') : __('No', 'elegance');
    } else if ( $key === 'rating' ) {
      return number_format((float)$value, 1, '.', '');
    } else if ( $key === 'color' ) {
      return $value?: 'var(--light)';
    } elseif ( $key === 'gcode' && $value ) {
      return self::get_casino_fields($post_id, ['gcode_url', 'gcode_limit']);
    } elseif ( $key ===  'advantages' || $key ===  'disadvantages' ) {
      return CF_Helpers_Common::acf_repeater($post_id, $key, ['item']);
    } elseif ( $key ===  'bonus' ) {
      $bonuses = BonusController::listForCasino(new BonusListForCasino(
        $post_id,
        BonusListOrderBy::ID,
      ));

      if ( $bonuses && isset($bonuses[0]) ) {
        $bonus = $bonuses[0];
        return [
          'name' => $bonus->name,
          'bonus' => $bonus->cryptoShortDescription,
          'type' => $bonus->type
        ];
      }
    } elseif ( $key ===  'bonuses' ) {
      $bonuses = BonusController::listForCasino(new BonusListForCasino($post_id));
      $transformedBonuses = [];

      if ( $bonuses ) {
        foreach ( $bonuses as $bonus ) {
          $transformedBonus = [
            'name' => $bonus->name,
            'bonus' => $bonus->cryptoShortDescription,
            'code' => $bonus->code,
            'badges' => $bonus->badges,
            'wagering' => $bonus->wagering,
            'show_in' => $bonus->showIn,
            'type' => $bonus->type
          ];

          if ( $bonus->badges ) {
            $terms = CF_Helpers_Taxonomy::get_taxonomy($bonus->badges);
            $transformedBonus['badges'] = CF_Helpers_Taxonomy::get_taxonomy_fields($terms, ['color', 'text_color', 'logo', 'linked'], 'badge');
          }

          $transformedBonuses[] = $transformedBonus;
        }
      }
      
      return $transformedBonuses;
    } elseif ( $key ===  'review_bonus' ) {
      $bonuses = BonusController::listForCasino_review(new BonusListForCasino($post_id));
      $transformedBonuses = [];

      if ( $bonuses ) {
        foreach ( $bonuses as $bonus ) {
          $transformedBonus = [
            'name' => $bonus->name,
            'bonus' => $bonus->cryptoShortDescription,
            'code' => $bonus->code,
            'badges' => $bonus->badges,
            'wagering' => $bonus->wagering,
            'show_in' => $bonus->showIn,
            'type' => $bonus->type
          ];

          if ( $bonus->badges ) {
            $terms = CF_Helpers_Taxonomy::get_taxonomy($bonus->badges);
            $transformedBonus['badges'] = CF_Helpers_Taxonomy::get_taxonomy_fields($terms, ['color', 'text_color', 'logo', 'linked'], 'badge');
          }

          $transformedBonuses[] = $transformedBonus;
        }
      }
      
      return $transformedBonuses;
    } elseif ( $key ===  'boxes' ) {
      $boxes = CF_Helpers_Common::acf_repeater($post_id, $key, ['box_disable', 'id','title', 'header_title', 'rating', 'rating_items', 'contents', 'gallery', 'gallery_mobile', 'casino_bonuses', 'casino_bonuses_module', 'sports', 'esports']);

      if ( $boxes ) {
        $i = 0;

        foreach ($boxes as $box) {
          if( $box['box_disable'] ) {
            unset($boxes[$i]);
          } else {
            if ( $box['rating_items'] ) {
              $boxes[$i]['rating_items'] =  CF_Helpers_Common::acf_repeater($post_id, $key . '_' . $i . '_rating_items', ['rating', 'title', 'desc']);
            }


            if ( isset($box['contents']) ) {
              $boxes[$i]['contents'] = [
                'content' => CF_Helpers_Common::acf_repeater($post_id, $key . '_' . $i . '_contents_blocks', ['content']),
                'layout' => CF_Helpers_Common::acf_group($post_id, $key . '_' . $i . '_contents', ['layout_ld', 'layout_lm']),
              ];
            }

            if ( $box['casino_bonuses_module'] ) {
              $boxes[$i]['casino_bonuses_module'] = new WP_Query([
                'post_type'      => 'post',
                'post__in'       => $box['casino_bonuses_module'],
                'posts_per_page' => '-1'
              ]);
              wp_reset_query();
            }
          }

          $i++;
        }
      }

      return $boxes;
    } elseif ( $key ===  'restricted' ) {
      $flags = [];

      if ( $value ) {
        foreach ($value as $id) {
          $flags[] = [
            'name' => get_the_title($id),
            'flag' => '<img width="20" height="15" src="'. get_the_post_thumbnail_url($id, 'CF_country') .'" alt="'. get_the_title() .'">'
          ];
        }
      }
      return $flags;
    } elseif ( $key === 'bonus_terms_url' ) {
      return '<a target="_blank" rel="nofollow" href="'. $value .'" class="td-u">'. __('read more', 'elegance') .'</a>';
    } elseif ( $key === 'wagering' ) {
      return $value .= 'x';
    }

    return $value;
  }

  public static function get_casino_fields($post_id, $fields = null, $custom_key_1=null, $custom_key_2=null, $custom_key_3=null) {
    $groups = [
      'base' => [
		'g_casino_keyword',
        'rating',
        'color',
        'affiliate_url',
        'gcode',
        'bonus',
        'is_restricted',
      ],
      'list' => [
		'g_casino_keyword',
        'rating',
        'color',
        'affiliate_url',
        'gcode',
        'bonuses',
        'badge',
        'casino_type',
        'advantages',
      ],
      'single' => [
        'claim_bonus_url',
        'g_casino_keyword',
        'askgamblers_rating',
        'trustpilot_rating',
        'boxes',
        'year_founded',
        'casino_type',
        'licenses',
        'casino_games',
        'minimum_deposit',
        'maximum_deposit',
        'minimum_withdrawal',
        'maximum_withdrawal',
        'platforms',
        'support',
        'software_providers',
        'languages',
        'restricted',
        'cryptocurrencies',
        'currencies',
        'deposit_methods',
        'bonuses',
        'advantages',
        'disadvantages'
      ],	
      'custom' => [
        'g_casino_keyword',
        'rating',	
        'color',	
        'affiliate_url',	
        'gcode',	
        'bonuses',	
        'badge',	
        'casino_type',	
        'advantages',	
      ],
      'review_bonuses' => [	
        'review_bonus'
      ],
      'casino' => [	
        'g_casino_keyword',
        'rating',
        'color',
        'affiliate_url',
        'gcode',
        'bonuses',
        'badge',
        'casino_type',
        'advantages',
        'disadvantages',
        'cryptocurrencies',
        'deposit_methods',
        'g_casino_description',
      ],
    ];

    if($custom_key_1!=null) array_push($groups['custom'], $custom_key_1);	
    if($custom_key_2!=null) array_push($groups['custom'], $custom_key_2);	
    if($custom_key_3!=null) array_push($groups['custom'], $custom_key_3);

    if ( ! $fields ) :
      return self::get_casino_fields($post_id, ['base', 'single']);
    elseif ( is_string($fields) ) :
      if ( array_key_exists($fields, $groups) ) :
        return self::get_casino_fields($post_id, $groups[$fields]);
      // elseif ($fields === 'bonuses') :
      //   return self::get_casino_bonus($post_id);
      elseif ($fields === 'is_restricted') :
        return CF_Helpers_Common::is_restricted($post_id);
      else:
        return self::get_external_data($post_id, $fields, get_post_meta( $post_id, $fields, true ));
      endif;
    elseif ( is_array( $fields ) ) :
      $array['post_id'] = $post_id;
      foreach( $fields as $key ) :
        if ( array_key_exists($key, $groups) ) :
          $array = array_merge( $array, self::get_casino_fields($post_id, $groups[$key]) );
        else :
          $array[$key] = self::get_casino_fields($post_id, $key);
        endif;
      endforeach;

      return $array;
    endif;

    return null;
  }
}