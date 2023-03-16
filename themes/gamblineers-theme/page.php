<?php while (have_posts()) : the_post(); ?>
  <?php cf_get_template('content-page.php', CF_TEMPLATES_DIR); ?>
<?php endwhile; ?>