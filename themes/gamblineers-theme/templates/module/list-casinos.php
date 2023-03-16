<?php
$settings['class'] .= ' lc my-45';
$module['list_content']='casinos';
#echo '<pre>';
#print_r($module);
#echo '</pre>';

cf_enqueue_module_assets($view, $defer);
if ( ($module['view'] === 'card' || $module['view'] === 'bonus') && $module['slider'] ) :
  cf_enqueue_module_assets('swiper', $defer);
  $settings['class'] .= ' lc-slider';
endif;

if ( $module['view'] === 'bonus' ) :
  cf_enqueue_module_assets('tabs', $defer);
endif;

$ordered = ($module['view'] === 'list' || $module['view'] === 'bonus' || $module['view'] === 'casino') && $module['ordered'] ? 'lc--ordered ' : null;

$view = $module['view'] !== 'list' && $module['view'] !== 'casino' ? 'row-u-sm mx-n10' : null;
$view .= $module['view'] === 'sm-card' ? 'row-o-xs mx-o-xs-n5' : null;
$settings['class'] .= ' js-list-casinos';

$page_posts = (int)$module['results_per_page'];
$total_posts = (int)$module['number_of_results'];

$query_args = CF_Casinos_Args::list_casinos_args($module);
//echo '<pre>';
//print_r($query_args);
//echo '</pre>';
$casinos = new WP_Query($query_args);

//echo '<pre>';
//print_r($casinos);
//echo '</pre>';

$has_more = $casinos->found_posts > $page_posts && $page_posts > 0 && ($total_posts > $page_posts  || $total_posts < 0);

if (!isset($module['ordered'])) $module['ordered'] = null;

$settings['data'] .= " data-view='". $module['view'] . "' data-slider='". $module['slider'] . "' data-ordered='". $module['ordered'] . "' data-page_posts='". $page_posts . "' data-total_posts='". $total_posts . "' data-args='". json_encode($query_args) . "'";


do_action('before_module', [ 'settings' => $settings]); ?>
  <div class="container">
    <?php
      if ($casinos->have_posts()) :
        if ($casinos->found_posts < $total_posts) $total_posts = $casinos->found_posts;

        if ( $module['view'] === 'list' && $module['header'] ) : cf_get_template('list-casino-head.php', CF_TEMPLATES_CASINO_DIR, [
        		'casino_list_enabled_bonus' => $module['casino_list_enabled_bonus'],
                'casino_list_enabled_features' => $module['casino_list_enabled_features'],
                'casino_list_enabled_rating' => $module['casino_list_enabled_rating'],
          		'casino_list_custom_1' => $module['casino_list_custom_1'],
                'casino_list_custom_2' => $module['casino_list_custom_2'],
                'casino_list_custom_3' => $module['casino_list_custom_3']
          ]);
        endif;
      ?>

      <?php if ( $module['view'] === 'card' || $module['view'] === 'bonus' && $module['slider'] ) : ?>
        <div class="swiper mx-n15 px-5 js-casinos-slider">
          <div class="swiper-wrapper mb-n20 f-u-sm-w <?php echo $ordered; ?> js-append-casinos">
      <?php else : ?>
        <div class="<?php echo $ordered . $view; ?> js-append-casinos">
      <?php endif; ?>
          <?php
            $play_now = CF_Helpers_Common::button(CF_CASINO_PLAY);
            while($casinos->have_posts()) : $casinos->the_post();
              if(isset($module['casino_list_enabled_bonus'])==True){
              	cf_get_template( $module['view'] . '-casino.php', CF_TEMPLATES_LOOP_DIR, [
                'ordered'  => $module['ordered'],
                'play_now' => $play_now,
                'slider'   => $module['view'] === 'card' || $module['view'] === 'bonus' && $module['slider'] ? true : false,
                'casino_list_enabled_bonus' => $module['casino_list_enabled_bonus'],
                'casino_list_enabled_features' => $module['casino_list_enabled_features'],
                'casino_list_enabled_rating' => $module['casino_list_enabled_rating'],
                'casino_list_custom_1' => $module['casino_list_custom_1'],
                'casino_list_custom_2' => $module['casino_list_custom_2'],
                'casino_list_custom_3' => $module['casino_list_custom_3']
              ]);
              }
              else{
                  cf_get_template( $module['view'] . '-casino.php', CF_TEMPLATES_LOOP_DIR, [
                    'ordered'  => $module['ordered'],
                    'play_now' => $play_now,
                    'slider'   => $module['view'] === 'card' || $module['view'] === 'bonus' && $module['slider'] ? true : false,
                  ]);
              }
            endwhile;
          ?>
        <?php if ( $module['view'] === 'card' || $module['view'] === 'bonus' && $module['slider'] ) : ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="ta-c">
        <?php cf_get_template( 'loader.php', CF_TEMPLATES_DIR ); ?>
        <button class="btn btn--p tc-w w-200 js-casinos-loadmore" <?php echo !$has_more ? 'style="display: none;"' : null; ?>><?php _e('Load more', 'elegance'); ?></button>

        <?php if ($cta = CF_Helpers_Common::button($module['button'])) : ?>
          <a href="<?php echo $cta['action'] ?>" class="btn w-200 js-list-cta <?php echo $cta['classes']; ?>" <?php echo $has_more ? 'style="display: none;"' : null; ?>><?php echo $cta['label']; ?></a>
        <?php endif;?>
      </div>

    <?php else: echo '<p class="ta-c fw-b">'. __('No results were found!', 'elegance') .'</p>'; endif; ?>
  </div>
<?php do_action('after_module');
wp_reset_query();