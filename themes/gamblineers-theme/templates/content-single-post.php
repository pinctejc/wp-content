<?php
  global $post;
  $casino = CF_Helpers_Casino::get_casino_fields($post->ID, ['base', 'single', 'review_bonuses']);
  $play_now = CF_Helpers_Common::button(CF_CASINO_PLAY);
  #print_r($casino['review_bonus']);

  cf_enqueue_module_assets(['post', 'sidebar-section'], false);
?>

<article>
  <?php
    cf_get_template('header.php', CF_TEMPLATES_CASINO_DIR, [
      'casino'   => $casino,
      'play_now' => $play_now
    ]);
  ?>

  <div class="container">
    <div class="row">
      <div class="col-content col-u-md">
        <div class="title">
          <h2 class="h2 mb-20"><?php _e('Overview', 'elegace'); ?></h2>
        </div>
        <div class="co wp-editor mb-30 of-h ps-r">
          <button type="button" class="co__more d-n p-5 bg-w fst-i tc-pv ps-a js-state" data-parent=".co">
            <span class="btn__ds"><?php _e('more', 'elegance'); ?> <svg class="va-m" width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.219668 0.719703C0.512558 0.426803 0.987438 0.426803 1.28033 0.719703L5.5303 4.96967C5.8232 5.26256 5.8232 5.73744 5.5303 6.03033L1.28033 10.2803C0.987438 10.5732 0.512558 10.5732 0.219668 10.2803C-0.0732225 9.98744 -0.0732225 9.51256 0.219668 9.21967L3.93934 5.5L0.219668 1.7803C-0.0732225 1.4874 -0.0732225 1.0126 0.219668 0.719703Z" fill="var(--primary-variant)"/></svg></span>
            <span class="btn__as d-n"><svg class="va-m" width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M5.53033 0.719703C5.23744 0.426803 4.76256 0.426803 4.46967 0.719703L0.219702 4.96967C-0.0731978 5.26256 -0.0731978 5.73744 0.219702 6.03033L4.46967 10.2803C4.76256 10.5732 5.23744 10.5732 5.53033 10.2803C5.82322 9.98744 5.82322 9.51256 5.53033 9.21967L1.81066 5.5L5.53033 1.7803C5.82322 1.4874 5.82322 1.0126 5.53033 0.719703Z" fill="var(--primary-variant)"/></svg> <?php _e('less', 'elegance'); ?> </span></button>
          <?php the_content(); ?>
        </div>
      </div>

      <div class="col-sidebar pl-u-md-5 mb-30 ps-r">
        <?php cf_get_template('top-casinos.php', CF_TEMPLATES_CASINO_DIR, ['defer' => false]); ?>
      </div>
    </div>

    <div class="row">
      <div class="col-content col-u-md order-u-md-2">
        <?php
          cf_get_template('boxes.php', CF_TEMPLATES_CASINO_DIR, [
            'casino'  => $casino,
            'play_now' => $play_now
          ]);
          cf_get_template('bonus-banner.php', CF_TEMPLATES_CASINO_DIR, ['casino' => $casino]);
          cf_get_template('details.php', CF_TEMPLATES_CASINO_DIR, [ 'casino' => $casino ]);
          cf_get_template('pros-cons.php', CF_TEMPLATES_MODULE_DIR, [
            'module' => [
              'pros' => $casino['advantages'],
              'cons' => $casino['disadvantages'],
            ],
            'settings' => [
              'class' => ''
            ],
            'view' => 'pros-cons',
            'defer' => true
          ]);

          comments_template('/templates/casinos/comments.php');
        ?>
      </div>

      <div class="col-sidebar order-u-md-1 mt-d-sm-30 ps-r">
        <?php cf_get_template('new-casinos.php', CF_TEMPLATES_CASINO_DIR); ?>
      </div>
    </div>
  </div>
</article>

<?php
  cf_get_template('title.php', CF_TEMPLATES_MODULE_DIR, [
    'view'   => 'title',
    'module' => [
      'titles' => [
        [ 'color' => 'tc-pv', 'title' => __('Recent', 'elegance') ],
        [ 'color' => '', 'title' => __('articles', 'elegance') ],
      ],
      'tag'      => 'h2',
      'subtitle' => ''
    ],
    'settings' => [ 'class' => '' ],
    'defer'    => true,
  ]);

  cf_get_template('list-news.php', CF_TEMPLATES_MODULE_DIR, [
    'view'   => 'list-news',
    'module' => [
      'show_categories'   => false,
      'list_type'         => '1',
      'number_of_results' => '3',
      'results_per_page'  => '3',
      'order_by'          => 'date',
      'controls'          => '1',
      'slider'            => '1',
      'load_more'         => null,
      'button'            => null
    ],
    'settings' => [ 'class' => '', 'data' => '' ],
    'defer'    => true,
  ]);

  cf_get_template('title.php', CF_TEMPLATES_MODULE_DIR, [
    'view'   => 'title',
    'module' => [
      'titles' => [
        [ 'color' => 'tc-pv', 'title' => __('Latest', 'elegance') ],
        [ 'color' => '', 'title' => __('Reviews', 'elegance') ],
      ],
      'tag'      => 'h2',
      'subtitle' => ''
    ],
    'settings' => [ 'class' => '' ],
    'defer'    => true,
  ]);

  cf_get_template('list-casinos.php', CF_TEMPLATES_MODULE_DIR, [
    'view'   => 'list-casinos',
    'module' => [
      'list_type'         => '1',
      'number_of_results' => '6',
      'results_per_page'  => '6',
      'order_by'          => 'date',
      'allowed_in'        => '0',
      'view'              => 'sm-card',
      'ordered'           => null,
      'slider'            => null,
      'load_more'         => null,
      'button'            => null
    ],
    'settings' => [ 'class' => '', 'data' => '' ],
    'defer'    => true,
  ]);

  if ( get_option( 'options_ab_casinos', false ) )
    cf_get_template('author-box.php', CF_TEMPLATES_MODULE_DIR, [
      'view'     => 'author-box',
      'settings' => ['class' => 'mb-30'],
      'defer'    => true
    ]);

  cf_get_template('sticky-bottom.php', CF_TEMPLATES_CASINO_DIR, [
    'play_now' => $play_now,
    'casino'   => $casino
  ]);
  cf_get_template('review.php', CF_TEMPLATES_DIR . 'schema/', ['rating' => $casino['rating']]);

  // echo '<pre>';
  // print_r($casino);
  // echo '</pre>';