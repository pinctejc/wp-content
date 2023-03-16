<?php

class CF_News_Args {

  /**
   * @todo list_type: string required - 1 | 2 | 3
   * @todo results_per_page: number required
   * @todo number_of_results: number required
   * @todo order_by: string required - When list_type is equal 1 or 3
   * @todo categories: (string | int) array - optional
   * @todo casino: int | string - optional
   * @return WP_Query_parameters - https://developer.wordpress.org/reference/classes/wp_query/#parameters
	 * @static
	 */
  public static function list_news_args($params) {
    $args = [
      'post_type' => 'news',
      'post_status' => 'publish',
    ];

    if ( isset( $params['post_type'] ) && $params['list_type'] !== '3' ) {
      if ( $params['post_type'] !== 'both' ) {
        $args['post_type'] = $params['post_type'];
      } else {
        $args['post_type'] = ['news', 'page'];
      }
    }

    $page_posts = (int)$params['results_per_page'];
    $paged = get_query_var('paged');

    if ($paged)
      $args['paged'] = $paged;

    if ($params['list_type'] === '2') :
      if ( $args['post_type'] === 'news' ) {
        $total_posts = count($params['news']);
        $args['post__in'] = $params['news'];
      } elseif ( $args['post_type'] === 'page' ) {
        $total_posts = count($params['pages']);
        $args['post__in'] = $params['pages'];
      } else {
        $total_posts = count($params['news_pages']);
        $args['post__in'] = $params['news_pages'];
      }
      $args['orderby'] = 'post__in';
      $args['posts_per_page'] = -1;
    else :
      $total_posts = (int)$params['number_of_results'];
      $args['orderby'] = $params['order_by'];

      if ($args['orderby'] === 'title')
        $args['order'] = 'ASC';
    endif;

    if ($params['list_type'] === '3') :
      if (isset($params['categories']) && $params['categories']) :
        $args['tax_query'] = [
          [
            'taxonomy' => 'news-category',
            'field'    => 'term_id',
            'terms'    => $params['categories']
          ]
        ];
      endif;

      if (isset($params['casino']) && $params['casino']) :
        $args['meta_query'] = [
          [
            'key' => 'casino',
            'value' => $params['casino'],
            'compare' => 'LIKE'
          ]
        ];
      endif;
    endif;

    if (isset($params['post__not_in'])) :
      $args['post__not_id'] = $params['post__not_in'];
    endif;

    if (isset($params['offset']))
      $args['offset'] = $params['offset'];

    if (is_singular('news'))
      $args['post__not_in'] = [get_the_ID()];

    $args['posts_per_page'] = ($total_posts > $page_posts && $page_posts > 0 || $total_posts < 0) ? $page_posts : $total_posts;

    return $args;
  }
}
