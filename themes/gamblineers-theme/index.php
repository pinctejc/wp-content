<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part(CF_TEMPLATES_DIR . 'content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
<?php endwhile; ?>