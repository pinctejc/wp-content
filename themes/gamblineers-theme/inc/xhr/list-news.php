<?php

function list_news() {
  $data = $_GET;

  if ($data['type'] === 'args') {
    $args = json_decode(stripslashes($data['args']), true);
  }

  if ($data['type'] === 'module') {
    $args = CF_News_Args::list_news_args(json_decode(stripslashes($data['args']), true));
  }
  // echo '<pre>';
  // print_r($args);
  // echo '</pre>';
  $news = new WP_Query($args);

  $total_posts = (int)$data['total'];
  $page_posts = $args['offset'] + $news->post_count;

  $html = '';
  $results = [];

  if ($news->have_posts()) :
    while($news->have_posts()) : $news->the_post();
      ob_start();
        echo '<div class="col-u-sm-4 px-10 mb-20'. ( $data['view'] ? ' swiper-slide' : null ) .'">';
        cf_get_template('news-box.php', CF_TEMPLATES_LOOP_DIR);
        echo '</div>';
			$html .= ob_get_clean();
    endwhile;
  endif;

  if ($total_posts > 0)
    $more = $news->found_posts > $page_posts && $total_posts > $page_posts;
  else
    $more = $news->found_posts > $page_posts;

  $results = [
    'html' => $html,
    'more' => $more
  ];

  wp_reset_query();
  echo json_encode($results);

  wp_die();
}
add_action('wp_ajax_list_news', 'list_news');
add_action('wp_ajax_nopriv_list_news', 'list_news');
