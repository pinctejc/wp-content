<?php global $wp_query, $post; ?>

<main>
  <header class="mb-40 py-u-sm-60 py-u-sm-30 tc-w ta-c bg-pv">
    <h1 class="tc-w"><?php echo __('Search results for:', 'elegance') . ' '; the_search_query(); ?></h1>
  </header>

  <div class="container">
    <?php
      if (have_posts()) :
        $search = ['post'=> [], 'news' => [], 'page' => []];
        foreach($wp_query->posts as $post) :
          $search[$post->post_type][] = $post;
        endforeach;
    ?>

    <?php
      if ($search['post']) :
        cf_enqueue_module_assets('list-casinos', false);
    ?>
      <div class="mb-40">
        <h4 class="h2 pb-40 ta-c tc-pv"><? _e('Casinos', 'elegance'); ?></h4>

        <?php
          $index = 0;
          $customer = CF_Helpers_Common::get_session(['geo_iso_code', 'country_id', 'country_flag']);
          $play_now = CF_Helpers_Common::button(CF_CASINO_PLAY);
          foreach ($search['post'] as $post) :
            setup_postdata( $post );
            cf_get_template( 'list-casino.php', CF_TEMPLATES_LOOP_DIR, [
              'ordered' => '',
              'customer' => $customer,
              'play_now' => $play_now,
              'index' => $index,
              'casino_list_custom_1' => "",
              'casino_list_custom_2' => "",
              'casino_list_custom_3' => "",
              'casino_list_enabled_bonus' => array(True),
              'casino_list_enabled_features' => array(True),
              'casino_list_enabled_rating' => array(True)
            ]);
            $index++;
          endforeach;
          wp_reset_postdata();
        ?>
      </div>
    <?php endif; ?>

    <?php
      if ($search['news']) :
        cf_enqueue_module_assets('list-news', false);
    ?>
      <div class="pb-20">
        <h4 class="h2 pb-40 ta-c tc-pv"><? _e('News', 'elegance'); ?></h4>

        <div class="row-u-sm mx-d-sm-n10">
          <?php
            foreach ($search['news'] as $post) :
              setup_postdata( $post );
          ?>
              <div class="col-u-sm-4 px-d-sm-10 mb-20">
                <?php cf_get_template('news-box.php', CF_TEMPLATES_LOOP_DIR); ?>
              </div>
          <?php
            endforeach;
            wp_reset_postdata();
          ?>
        </div>
      </div>
    <?php endif; ?>

    <?php
      if ($search['page']) :
        cf_enqueue_module_assets('list-news', false);
    ?>
      <div class="pb-20">
        <h4 class="h2 pb-40 ta-c tc-pv"><? _e('Pages', 'elegance'); ?></h4>

        <div class="row-u-sm mx-d-sm-n10">
          <?php
            foreach ($search['page'] as $post) :
              setup_postdata( $post );
          ?>
              <div class="col-u-sm-4 px-d-sm-10 mb-20">
                <?php cf_get_template('page-box.php', CF_TEMPLATES_LOOP_DIR); ?>
              </div>
          <?php
            endforeach;
            wp_reset_postdata();
          ?>
        </div>
      </div>
    <?php endif; ?>

    <?php else: ?>
      <p class="ta-c py-30 fw-sb fs-u-sm-20"><?php _e('Not found results!', 'elegance'); ?></p>
    <?php endif; ?>
  </div>
</main>