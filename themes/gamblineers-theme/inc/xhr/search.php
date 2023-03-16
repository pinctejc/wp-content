<?php

function seach_suggestions() {
  $html = '';
  $results = [];
  ob_start();
  
  $search = $_GET['s'];
  
 

  if(strlen($search)>=3)
  {
    $posts_number=0;
    
    $search_results = new WP_Query([
      'post_type' => ['post', 'news', 'page'],
      'orderby' => 'type date',
      'post_status' => 'publish',
      'posts_per_page' => 5, 
      'search_post_title'=>$search,
      
    ]);

    $posts_number+=$search_results->post_count;
   
    
    if($posts_number<5)
    {
      $search_results_h1 = new WP_Query([
        'post_type' => ['post', 'news', 'page'],
        'orderby' => 'type date',
        'post_status' => 'publish',
        'posts_per_page' => 5-$posts_number, 
        'ignore_posts'=>implode(wp_list_pluck( $search_results->posts, 'ID' ),","),
          'meta_query'=>array(
            array(
            'key'=>'modules_0_title_titles_0_title',
            'value'=>$search,
            'compare'=>'LIKE')),  
      ]);


      $posts_number+=$search_results_h1->post_count;
      
  	  $stev=sizeof($search_results->posts);
    
      foreach($search_results_h1->posts as $key=>$value)
      {
        $search_results->posts[$stev]=$value;
        $stev++;
      }
      $search_results->found_posts=$posts_number;
      $search_results->post_count=$posts_number;


    if($posts_number<5)
    {
      $search_results_all_h = new WP_Query([
        'post_type' => ['post', 'news', 'page'],
        'orderby' => 'type date',
        'post_status' => 'publish',
        'posts_per_page' => 5-$posts_number, 
        'ignore_posts'=>implode(wp_list_pluck( $search_results->posts, 'ID' ),","),
        'meta_key_compare'=>'modules_%_title_titles_%_title',
        'value_compare'=>$search,
        'meta_query'=>array(
          array('value'=>1,
                'compare'=>'!=',
               ),),
        ]);


      $stev=sizeof($search_results->posts);

      foreach($search_results_all_h->posts as $key=>$value)
      {
        $search_results->posts[$stev]=$value;
        $stev++;
      }

      $search_results->found_posts=$posts_number;
      $search_results->post_count=$posts_number;

    }



    }
    
  }
  if ( $search_results->have_posts() ) :
    ob_start();
?>
    <ul>
      <?php while( $search_results->have_posts() ) : $search_results->the_post(); ?>
        <li><a href="<?php the_permalink(); ?>" class="d-ib py-10 tc-n tc-h-p td-h-u fw-m"><?php the_title(); ?></a></li>
      <?php endwhile; ?>
    </ul>
<?php
    $html .= ob_get_clean();
  else:
    $html .= '<p class="mb-5 tc-d fs-14 fw-b">'. __('We found no results', 'elegance') .'</p>';
    $html .= '<p class="fs-12 tc-n">'. __('Please double-check your spelling or check our top searches and best casino picks', 'elegance') .'</p>';
  endif;

  $results = [
    'html' => $html
  ];

  wp_reset_query();

  echo json_encode($results);
  wp_die();
}
add_action('wp_ajax_seach_suggestions', 'seach_suggestions');
add_action('wp_ajax_nopriv_seach_suggestions', 'seach_suggestions');