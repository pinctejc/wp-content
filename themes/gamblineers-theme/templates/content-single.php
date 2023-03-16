<article>
  <header class="pb-30 bg-pv tc-w ta-c">
    <?php cf_get_template('breadcrumbs.php', CF_TEMPLATES_DIR); ?>
    <h1 class="tc-w"><?php the_title(); ?></h1>
  </header>
  <?php
    if ($modules = get_field('modules')) :
      cf_get_template('modular.php', CF_TEMPLATES_DIR, [ 'modules' => $modules ]);
    elseif ( get_the_content() ) : ?>
    <div class="container py-u-sm-50 py-o-xs-30 wp-editor">
      <?php the_content(); ?>
    </div>
  <?php
    endif;

    if ( get_option( 'options_ab_' . get_post_type(), false ) )
      cf_get_template('author-box.php', CF_TEMPLATES_MODULE_DIR, [
        'view' => 'author-box',
        'settings' => ['class' => 'bg-u-sm-sv bg-o-xs-sv'],
        'defer' => true
      ]);
  ?>
</article>
