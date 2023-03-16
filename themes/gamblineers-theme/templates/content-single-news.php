<?php
  cf_enqueue_module_assets(['news', 'sidebar-section'], false);
  $news = CF_Helpers_News::get_news_fields(get_the_ID());
?>
<article>
  <?php cf_get_template('header.php', CF_TEMPLATES_NEWS_DIR, ['news' => $news]); ?>

  <div class="container py-u-md-40 pb-d-sm-30">
    <div class="row-u-md mx-u-lg-n10">
      <div class="col-content col-u-md order-u-md-2">
        <?php if ( get_the_content( ) ) : ?>
          <div class="wp-editor"><?php the_content(); ?></div>
        <?php endif; ?>

        <?php
          if ( $modules = get_field( 'modules' ) )
            cf_get_template('modular.php', CF_TEMPLATES_DIR, [ 'modules' => $modules ]);
        ?>
      </div>
      <div class="col-sidebar px-u-lg-10 mt-d-sm-30 order-u-md-1 ps-r">
        <?php
          cf_get_template('top-casinos.php', CF_TEMPLATES_NEWS_DIR, [
            'news' => $news,
            'defer' => false
          ]);
        ?>
      </div>
    </div>
  </div>

  <?php
    if ( get_option( 'options_ab_news', false ) )
      cf_get_template('author-box.php', CF_TEMPLATES_MODULE_DIR, [
        'view' => 'author-box',
        'settings' => ['class' => 'mb-30'],
        'defer' => true
      ]);
  ?>
</article>

<?php cf_get_template('more-news.php', CF_TEMPLATES_NEWS_DIR, ['news' => $news]); ?>
