<?php
$settings['class'] .= ' ln my-30 js-list-news';
$settings['class'] .= $module['slider'] ? ' ln--slider ' : null;

// if ( is_user_logged_in() ) {
//   echo '<pre>';
//   print_r($module);
//   echo '</pre>';
// }

if ($module['list_type'] === '2' and $module['news']!=NULL) :
  $total_posts = count($module['news']);
else:
  $total_posts = (int)$module['number_of_results'];
endif;

// if (!isset($module['controls'])) $module['controls'] = '1';

$page_posts = (int)$module['results_per_page'];

// if ( $module['show_categories'] && isset($_GET['category']) && ( ! $module['slider'] || $module['controls'] == '2' ) ):
//   $module['list_type'] = '3';
//   $module['number_of_results'] = '-1';
//   $module['categories'] = $_GET['category'];
// endif;

$query_args = CF_News_Args::list_news_args($module);
// if ( is_user_logged_in() ) {
//   echo '<pre>';
//   print_r($query_args);
//   echo '</pre>';
// }
$news = new WP_Query($query_args);

$has_more = $news->found_posts > $page_posts && $page_posts > 0 && ($total_posts > $page_posts  || $total_posts < 0);

$settings['data'] .=  "data-page_posts='". $page_posts . "' data-total_posts='". $total_posts . "' data-args='". json_encode($query_args) . "' data-view='". $module['slider'] . "'";

cf_enqueue_module_assets($view, $defer);
if ( $module['slider'] ) :
  cf_enqueue_module_assets('swiper', true);
endif;
do_action('before_module', ['settings' => $settings]); ?>
  <div class="container">
    <?php
      if ( $module['show_categories'] && ! $module['slider'] ) :
        cf_get_template('news-categories.php', CF_TEMPLATES_NEWS_DIR, ['module' => $module]);
      endif;
    ?>

    <?php  if ( $news->have_posts() ): ?>

      <?php if ( $news->found_posts < $total_posts ) $total_posts = $news->found_posts; ?>

      <?php if ( $module['slider'] ) : ?>
        <div class="swiper mx-n15 px-5 js-news-slider">
          <div class="swiper-wrapper mb-n20 f-u-sm-w js-append-news">
      <?php else: ?>
        <div class="row-u-sm mb-n20 mx-n10 js-append-news">
      <?php endif; ?>

        <?php while($news->have_posts()) : $news->the_post(); ?>
          <div class="col-u-sm-4 px-10 mb-20 <?php echo $module['slider'] ? 'swiper-slide' : null; ?>">
            <?php cf_get_template('news-box.php', CF_TEMPLATES_LOOP_DIR); ?>
          </div>
        <?php endwhile; ?>
        <?php if ( $module['slider'] ) : ?>
          </div>
        <?php endif; ?>
      </div>
    <?php else: echo '<p class="ta-c fw-b">'. __('No results were found!', 'elegance') .'</p>'; endif; ?>

    <div class="ta-c">
      <?php cf_get_template( 'loader.php', CF_TEMPLATES_DIR ); ?>
      <?php if( $load_more = CF_Helpers_Common::button($module['load_more']) ) : ?>
        <button class="btn w-200 mt-30 js-news-loadmore <?php echo $load_more['classes'] ?>" <?php echo !$has_more ? 'style="display: none;"' : null; ?>><?php echo $load_more['label'] ?></button>
      <?php endif; ?>

      <?php if ($cta = CF_Helpers_Common::button($module['button'])) : ?>
        <a href="<?php echo $cta['action'] ?>" class="btn w-200 mt-30 js-list-cta <?php echo $cta['classes']; ?>" <?php echo $has_more ? 'style="display: none;"' : null; ?>><?php echo $cta['label']; ?></a>
      <?php endif; ?>
    </div>
  </div>
<?php do_action('after_module');
wp_reset_query();

// echo '<pre>';
// print_r($module);
// echo '</pre>';