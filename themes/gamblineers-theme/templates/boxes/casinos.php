<?php
  $params['results_per_page'] = 4;
  $params['number_of_results'] = 4;
  $query_args = CF_Casinos_Args::list_casinos_args($params);
  $casinos = new WP_Query($query_args);
?>
<div class="ph__box">
  <?php if ( $title ) : ?>
    <p class="ph__box__title mb-10 foc pt-4 pb-6 fw-b fs-18 ta-c tc-w br-t-20"><?php echo $title; ?></p>
  <?php endif; ?>

  <?php
    if ( $casinos->have_posts() ) :
      $play = CF_Helpers_Common::button(CF_CASINO_PLAY);
      while( $casinos->have_posts() ) : $casinos->the_post();
        cf_get_template('casino.php', CF_TEMPLATES_LOOP_DIR . 'boxes/', ['play' => $play]);
      endwhile;
    else:
  ?>
    <p><?php _e('No found results!', 'elegnace'); ?></p>
  <?php endif; wp_reset_query(); ?>
</div>
