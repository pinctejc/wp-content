<?php
  $page_query = new WP_Query([
    'post_type' => 'page',
    'pagename' => get_post_type(),
    'posts_per_page' => 1
  ]);

  if ($page_query->have_posts()) :
    while($page_query->have_posts()) : $page_query->the_post();
      if ( $modules = get_field( 'modules' ) )
        cf_get_template('modular.php', CF_TEMPLATES_DIR, [ 'modules' => $modules ]);
    endwhile;
  endif;  wp_reset_query();