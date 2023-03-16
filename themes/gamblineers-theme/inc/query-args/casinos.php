<?php

class CF_Casinos_Args {

  private static $post_type = 'post';
  private static $subfix = '_listing';

  protected static function list_casino_taxonomies($params) {
    $meta_query = [];
    $taxonomies = [
      'software_providers' . self::$subfix,
      'deposit_methods' . self::$subfix,
      'withdraw_methods' . self::$subfix,
      'licenses' . self::$subfix,
      'languages' . self::$subfix,
      'cryptocurrencies' . self::$subfix,
      'currencies' . self::$subfix,
      'platforms' . self::$subfix,
      'casino_type' . self::$subfix,
    ];

    foreach($taxonomies as $taxonomy) :
      $key = str_replace(self::$subfix, '', $taxonomy);

      if (isset($params[$taxonomy]) && !empty($params[$taxonomy])) :

        $term_query = null;

        if(is_array($params[$taxonomy])) :
          foreach($params[$taxonomy] as $term_id) :
            $term_query[] = [
              'key' => $key,
              'value' => '"'. $term_id . '"',
              'compare' => 'LIKE'
            ];
          endforeach;
        else :
          $term_query[] = [
            'key' => $key,
            'value' => '"'. $params[$taxonomy] . '"',
            'compare' => 'LIKE'
          ];
        endif;

        if (count($term_query) > 1)
          $term_query = array_merge(['relation' => 'OR'], $term_query);
        else
          $term_query = $term_query[0];

        $meta_query[] = $term_query;
      endif;
    endforeach;

    if (count($meta_query) > 1)
      $meta_query = array_merge(['relation' => 'AND'], $meta_query);
    elseif (!empty($meta_query))
      $meta_query = $meta_query[0];

    return $meta_query;
  }


  /**
   * @todo list_type: string required - 1 | 2 | 3
   * @todo results_per_page: number required
   * @todo number_of_results: number required
   * @todo order_by: string required - When list_type is equal 1 or 3
   * @todo order_by_manually: string required - When list_type is equal 2
   * @todo meta_query: WP_Meta_Query - optional https://developer.wordpress.org/reference/classes/wp_meta_query/
   * @return WP_Query_parameters - https://developer.wordpress.org/reference/classes/wp_query/#parameters
	 * @static
	 */
  public static function list_casinos_args(array $params) {
  	//echo '<div><b>List type: ';
    //echo $params['list_type'];
    //echo '</b></div>';
	
    //echo '<pre>';
	//print_r($params);
	//echo '</pre>';
    $isset_casino_list_enabled_bonus=0;
    if(isset($params['casino_list_enabled_bonus'][0])){$isset_casino_list_enabled_bonus=1;}
    
    $isset_casino_list_enabled_features=0;
    if(isset($params['casino_list_enabled_features'][0])){$isset_casino_list_enabled_features=1;}
    
    $isset_casino_list_enabled_rating=0;
    if(isset($params['casino_list_enabled_rating'][0])){$isset_casino_list_enabled_rating=1;}

    $args = [
      'post_type' => self::$post_type,
	  'post_status' => ['publish', 'private']
    ];
    
    if(isset($params['list_content'])){
    	$args['list_content']=$params['list_content'];
    }
    
	
	if(isset($params['view']) and $params['view']!='sm-card'){
		$args['post_status'] = ['publish', 'private'];
	}
	
    $page_posts = (int)$params['results_per_page'];
    $total_posts = isset( $params['number_of_results'] ) ? (int)$params['number_of_results'] : $page_posts;

    if (isset($params['meta_query'])) {
      $meta_query = $params['meta_query'];
    }
    
	/*
    if ($params['list_type'] === '1') {
    	$args['extend_where'] = "(meta_value is not null)";
	}
	*/
    
    if ($params['list_type'] === '1') {
    	if(isset($params['casino_list_custom_1'])) {$args['casino_list_custom_1'] = $params['casino_list_custom_1'];}
        if(isset($params['casino_list_custom_2'])) {$args['casino_list_custom_2'] = $params['casino_list_custom_2'];}
        if(isset($params['casino_list_custom_3'])) {$args['casino_list_custom_3'] = $params['casino_list_custom_3'];}
        $args['isset_casino_list_enabled_bonus'] = $isset_casino_list_enabled_bonus;
        $args['isset_casino_list_enabled_features'] = $isset_casino_list_enabled_features;
        $args['isset_casino_list_enabled_rating'] = $isset_casino_list_enabled_rating;
	}
    
    if ($params['list_type'] === '4') {
    	$args['extend_where'] = "(meta_value is not null)";
		$args['order'] = 'ASC';
        if(isset($params['casino_list_custom_1'])) {$args['casino_list_custom_1'] = $params['casino_list_custom_1'];}
        if(isset($params['casino_list_custom_2'])) {$args['casino_list_custom_2'] = $params['casino_list_custom_2'];}
        if(isset($params['casino_list_custom_3'])) {$args['casino_list_custom_3'] = $params['casino_list_custom_3'];}
        $args['isset_casino_list_enabled_bonus'] = $isset_casino_list_enabled_bonus;
        $args['isset_casino_list_enabled_features'] = $isset_casino_list_enabled_features;
        $args['isset_casino_list_enabled_rating'] = $isset_casino_list_enabled_rating;
	}
	
	if ($params['list_type'] === '3') {
        if(isset($params['casino_list_custom_1'])) {$args['casino_list_custom_1'] = $params['casino_list_custom_1'];}
        if(isset($params['casino_list_custom_2'])) {$args['casino_list_custom_2'] = $params['casino_list_custom_2'];}
        if(isset($params['casino_list_custom_3'])) {$args['casino_list_custom_3'] = $params['casino_list_custom_3'];}
        $args['isset_casino_list_enabled_bonus'] = $isset_casino_list_enabled_bonus;
        $args['isset_casino_list_enabled_features'] = $isset_casino_list_enabled_features;
        $args['isset_casino_list_enabled_rating'] = $isset_casino_list_enabled_rating;
	}
	
	/*
    if ($params['list_type'] === '2') :
      $args['extend_where'] = "(meta_value is not null)";
      $args['post__in'] = $params['selected_casinos'];
      $args['orderby'] = $params['order_by_manually'];
      $args['casino_list_custom_1'] = $params['casino_list_custom_1'];
      $args['isset_casino_list_enabled_bonus'] = $isset_casino_list_enabled_bonus;
      $args['isset_casino_list_enabled_features'] = $isset_casino_list_enabled_features;
      $args['isset_casino_list_enabled_rating'] = $isset_casino_list_enabled_rating;
    else :
      $args['orderby'] = $params['order_by'];
    endif;
	
	*/
	
	if ($params['list_type'] === '2') :
      if ( isset( $params['casinos'] ) ) :
        $args['post__in'] = $params['casinos'];
      else :
        $args['post__in'] = $params['selected_casinos'];
      endif;
      $args['orderby'] = $params['order_by_manually'];
    else :
      $args['orderby'] = $params['order_by'];
    endif;
	
	
	if ($args['orderby'] === 'title') :
      $args['order'] = 'ASC';
    elseif ($args['orderby'] === 'meta_value_num') :
      $args['orderby'] = 'meta_value_num date';
	  if ($params['list_type'] === '4'){
		  $args['meta_key'] = $params['order_by_meta_key'];
		}
		else{
			$args['meta_key'] = 'rating';
		}
    else:
      $args['order'] = 'DESC';
    endif;
	
	/*
    if ($args['orderby'] === 'title') :
      $args['order'] = 'ASC';
    elseif ($args['orderby'] === 'meta_value_num') :
      $args['orderby'] = 'meta_value_num date';
      $args['meta_key'] = $params['order_by_meta_key'];
      //$args['meta_key'] = 'rating';
    //elseif ($args['orderby'] === 'meta_value_custom') :
      //$args['orderby'] = 'meta_value_num date';
      //$args['meta_key'] = 'test_rating';
    else:
      $args['order'] = 'DESC';
    endif;
	*/

    if ($params['list_type'] === '3') :
      if ($taxonomies = self::list_casino_taxonomies($params)) {
        $meta_query[] = $taxonomies;
      }
    endif;

    if (isset($params['offset']))
      $args['offset'] = $params['offset'];

    if (isset($params['allowed_in'])) :
      if ($params['allowed_in'] === '1') :
        $meta_query[] = [
          'key' => 'restricted',
          'value' => CF_Helpers_Common::get_session('country_id'),
          'compare' => 'NOT LIKE'
        ];
      elseif ($params['allowed_in'] === '2') :
        $meta_query[] = [
          'key' => 'restricted',
          'value' => $params['specific_country'],
          'compare' => 'NOT LIKE'
        ];
      endif;
    endif;

    if (isset($meta_query)) :

      if (count($meta_query) > 1)
        $meta_query = array_merge(['relation' => 'AND'], $meta_query);

      $args['meta_query'] = $meta_query;
    endif;

    if (is_singular('post'))
      $args['post__not_in'] = [get_the_ID()];

    $args['posts_per_page'] = ($total_posts > $page_posts && $page_posts > 0 || $total_posts < 0) ? $page_posts : $total_posts;

    return $args;
  }
}