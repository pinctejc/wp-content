<?php

function list_casinos() {
  $data = $_GET;
  //print_r($data);
  if ($data['type'] === 'args') {
    $args = json_decode(stripslashes($data['args']), true);
  }

  if ($data['type'] === 'module') {
    $args = CF_Casinos_Args::list_casinos_args(json_decode(stripslashes($data['args']), true));
  }
	
  if($args['list_content']=='casinos'){
    $casinos = new WP_Query($args);

    $total_posts = (int)$data['total'];
    $page_posts = $args['offset'] + $casinos->post_count;
    $html = '';
    $results = [];

    if ($casinos->have_posts()) :
      $casino_list_enabled_bonus=$args['isset_casino_list_enabled_bonus'] == 1 ? array (0 => 'casino_list_enabled_bonus') : array();
      $casino_list_enabled_features=$args['isset_casino_list_enabled_features'] == 1 ? array (0 => 'casino_list_enabled_features') : array();
      $casino_list_enabled_rating=$args['isset_casino_list_enabled_rating'] == 1 ? array (0 => 'casino_list_enabled_rating') : array();
      
      $play_now = CF_Helpers_Common::button(CF_CASINO_PLAY);
      while($casinos->have_posts()) : $casinos->the_post();
        ob_start();
        cf_get_template( $data['view'] . '-casino.php', CF_TEMPLATES_LOOP_DIR, [
        'casino_list_custom_1' => $args['casino_list_custom_1'],
          'casino_list_custom_2' => $args['casino_list_custom_2'],
          'casino_list_custom_3' => $args['casino_list_custom_3'],
          'casino_list_enabled_bonus' => $casino_list_enabled_bonus,
          'casino_list_enabled_features' => $casino_list_enabled_features,
          'casino_list_enabled_rating' => $casino_list_enabled_rating,
          'ordered'  => $data['ordered'],
          'play_now' => $play_now,
          'slider'   => $data['view'] === 'card' && $data['slider'] ? true : false
        ]);
              $html .= ob_get_clean();
      endwhile;
    else:
      $html .= '<p class="ta-c fw-b w-100p">'. __("Sorry! Looks like we couldn't find any results matching your search. How about trying something else?", "elegance") . '</p>';
    endif;

    if ($total_posts > 0)
        $more = $casinos->found_posts > $page_posts && $total_posts > $page_posts;
    else
        $more = $casinos->found_posts > $page_posts;
  }
  else{
    $total_posts = $data['total'];


    $bonuses = BonusController::list(new BonusListRequest(
        $args['offset'],
		$args['posts_per_page']+1,
        BonusListOrderBy::MetaKey,
       	$args['meta_key']
    ));


    if ( $bonuses ) {
        foreach ( $bonuses as $bonus ) {
        $transformedBonus = (array) [
            'casinoID' => $bonus->casinoID,
            'name' => $bonus->name,
            'bonus' => $bonus->cryptoShortDescription,
            'code' => $bonus->code,
            'badges' => $bonus->badges,
            'wagering' => $bonus->wagering,
            'show_in' => $bonus->showIn,
            'type' => $bonus->type,
        ];

        if ( $bonus->badges ) {
            $terms = CF_Helpers_Taxonomy::get_taxonomy($bonus->badges);
            $transformedBonus['badges'] = CF_Helpers_Taxonomy::get_taxonomy_fields($terms, ['color', 'text_color', 'logo', 'linked'], 'badge');
        }

        $transformedBonuses[] = $transformedBonus;
        }
    }
        
    if(!isset($transformedBonuses)){
        $transformedBonuses=array();
    }
    
    $cnt_returned=count($transformedBonuses);


    $html = '';
    $results = [];
    
    $play_now = CF_Helpers_Common::button(CF_CASINO_PLAY);
    $counter=0;

    $casino_list_enabled_bonus=$args['isset_casino_list_enabled_bonus'] == 1 ? array (0 => 'casino_list_enabled_bonus') : array();
    $casino_list_enabled_features=$args['isset_casino_list_enabled_features'] == 1 ? array (0 => 'casino_list_enabled_features') : array();
    $casino_list_enabled_rating=$args['isset_casino_list_enabled_rating'] == 1 ? array (0 => 'casino_list_enabled_rating') : array();
    
    if ($cnt_returned>0) :
        foreach($transformedBonuses as $bonus) :
            if($counter>=$args['posts_per_page']){
                break;
            }
            ob_start();
                cf_get_template( $data['view'] . '-casino.php', CF_TEMPLATES_LOOP_DIR, [
                    'list_type' => 'bonuses_listing',
                    'data' => $bonus,
                    'casino_list_custom_1' => $args['casino_list_custom_1'],
                    'casino_list_custom_2' => $args['casino_list_custom_2'],
                    'casino_list_custom_3' => $args['casino_list_custom_3'],
                    'casino_list_enabled_bonus' => $casino_list_enabled_bonus,
                    'casino_list_enabled_features' => $casino_list_enabled_features,
                    'casino_list_enabled_rating' => $casino_list_enabled_rating,
                    'ordered'  => $data['ordered'],
                    'play_now' => $play_now,
                    'slider'   => $data['view'] === 'card' && $data['slider'] ? true : false
                    ]);
            $html .= ob_get_clean();
            $counter+=1;
        endforeach;
    else:
      
      $html .= '<p class="ta-c fw-b w-100p">'. __("Sorry! Looks like we couldn't find any results matching your search. How about trying something else?", "elegance") . '</p>';
    endif;

    $page_posts = $args['offset'] + $counter;
    if ($total_posts > 0)
        $more = $cnt_returned > $counter && $total_posts > $page_posts;
    else
        $more = $cnt_returned > $counter;
  }


  $results = [
    'html' => $html,
    'more' => $more
  ];



  wp_reset_query();

  echo json_encode($results);

  wp_die();
}
add_action('wp_ajax_list_casinos', 'list_casinos');
add_action('wp_ajax_nopriv_list_casinos', 'list_casinos');

function quick_info() {
  $post_id = $_GET['post_id'];

  $html = '';
  $casino = CF_Helpers_Casino::get_casino_fields($post_id, 'more_info');

  ob_start();
  cf_get_template('quick-info.php', CF_TEMPLATES_CASINO_DIR , [
    'casino' => $casino,
  ]);
  $html .= ob_get_clean();
  wp_reset_query();
  echo json_encode($html);

  wp_die();
}
add_action('wp_ajax_quick_info', 'quick_info');
add_action('wp_ajax_nopriv_quick_info', 'quick_info');