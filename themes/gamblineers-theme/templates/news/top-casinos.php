<?php
  if ( $news['type'] === '1' ) {
    $query_args = CF_Casinos_Args::list_casinos_args($news['casinos']);
  } else if ( $news['type'] === '2' ) {
    $news_module = get_fields($news['module']);
    $news['title'] = $news_module['title'];
    $query_args = CF_Casinos_Args::list_casinos_args($news_module['casinos']);
  }
  $casinos = new WP_Query($query_args);

  if ( $casinos ) :
    cf_enqueue_module_assets('casinos-sidebar', $defer);
?>
  <div class="ps-u-sm-st" style="top: <?php echo is_user_logged_in(  ) ? '135px' : '105px'; ?>">
    <h3><?php echo $news['title']; ?></h3>
    <div class="row-u-sm mx-o-sm-n5 mx-u-md-0">
      <?php
        $play_now = CF_Helpers_Common::button(CF_CASINO_PLAY);
        while( $casinos->have_posts() ) : $casinos->the_post();
          cf_get_template('sidebar-casino.php', CF_TEMPLATES_LOOP_DIR, ['play_now' => $play_now]);
        endwhile;
      ?>
    </div>
  </div>
<?php endif; wp_reset_query();
