<?php
  $query_args = CF_Casinos_Args::list_casinos_args([
    'list_type' => '1',
    'results_per_page' => '3',
    'number_of_results' => '3',
    'order_by' => 'meta_value_num',
  ]);
  $casinos = new WP_Query($query_args);

  if ( $casinos ) :
?>
  <div class="ps-u-sm-st" style="top: <?php echo is_user_logged_in(  ) ? '135px' : '105px'; ?>">
    <h3 class="mt-u-md-12 mb-20"><?php _e('Top casinos', 'elegance'); ?></h3>
    <div class="row-o-sm mx-u-md-0 mx-o-sm-n5 mb-n15">
      <?php
        while( $casinos->have_posts() ) : $casinos->the_post();
          cf_get_template('aside-casino.php', CF_TEMPLATES_LOOP_DIR);
        endwhile;
      ?>
    </div>
  </div>
<?php endif; wp_reset_query();
