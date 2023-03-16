<?php
 //echo '<pre>';
 //print_r($module);
 //echo '</pre>';

$params = $module['casinos'];
$params['number_of_results'] = $params['results_per_page'];
$settings['class'] = ' mt-d-sm-30';

$query_args = CF_Casinos_Args::list_casinos_args($params);
$casinos = new WP_Query($query_args);

//echo '<pre>';
//print_r($casinos);
//echo '</pre>';

cf_enqueue_module_assets($view, false);
do_action('before_module', [ 'settings' => $settings]);
?>
  <?php if ( $module['title'] ) : ?>
    <h3 class="mb-15 ta-o-xs-c"><?php echo $module['title']; ?></h3>
  <?php endif; ?>

  <?php if ( $casinos->have_posts() ) : ?>
    <div class="row-o-sm mx-u-md-0 mx-o-sm-n5">
      <?php
        $play_now = CF_Helpers_Common::button(CF_CASINO_PLAY);
        while( $casinos->have_posts() ) : $casinos->the_post();
          cf_get_template('sidebar-casino.php', CF_TEMPLATES_LOOP_DIR, ['play_now' => $play_now]);
        endwhile;
      ?>
    </div>
  <?php else: ?>
    <p><?php _e('No found results!', 'elegnace'); ?></p>
  <?php endif; wp_reset_query(); ?>
<?php
do_action('after_module');
