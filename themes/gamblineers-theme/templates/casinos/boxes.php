<?php if ( $casino['boxes'] ) : ?>
  <?php
    // echo '<pre>';
    // print_r($casino['boxes']);
    // echo '</pre>';
  ?>
  <div class="ts">
  <?php foreach($casino['boxes'] as $box) { ?>
    <div <?php echo isset($box['id']) && $box['id'] ? 'id="'. $box['id'] .'"' : null; ?> class="cb mb-30 p-u-sm-20 px-o-xs-10 pt-o-xs-10 py-o-xs-20 br-8">
      <?php if ( $box['gallery'] || $box['gallery_mobile'] ) : ?>
        <div class="row-u-sm mx-u-sm-n10">
          <div class="cb__gc my-u-sm-n10 px-u-sm-10 px-o-xs-15 ta-c order-u-sm-2">
            <?php foreach ($box['gallery'] as $img) { ?>
              <figure class="my-u-sm-10 <?php echo $box['gallery_mobile'] ? 'd-o-xs-n' : 'mb-o-xs-15'; ?>"><a href="<?php echo wp_get_attachment_image_url( $img, 'full' ); ?>" data-fslightbox="desktop-box"><?php echo wp_get_attachment_image( $img, 'box', false, ['class' => 'br-8']); ?></a></figure>
            <?php } ?>

            <?php if ( $box['gallery_mobile'] ) { ?>
              <?php foreach ($box['gallery_mobile'] as $img) { ?>
                <figure class="d-u-sm-n mb-o-xs-15"><a href="<?php echo wp_get_attachment_image_url( $img, 'full' ); ?>" data-fslightbox="mobile-box"><?php echo wp_get_attachment_image( $img, 'box', false, ['class' => 'br-8']); ?></a></figure>
              <?php } ?>
            <?php } ?>
          </div>
          <div class="col-u-sm px-u-sm-10 order-u-sm-1">
      <?php endif; ?>

      <?php if ( $box['rating'] > 0 ) : ?>
        <div class="row-u-sm ai-u-lg-c ai-o-md-fe ai-o-sm-fe">
          <?php if ( $box['title'] ) : ?>
            <h2 class="col-u-sm mb-10 fw-b fs-u-md-24 fs-d-sm-22"><?php echo $box['title']; ?></h2>
          <?php endif; ?>

          <div class="col-u-sm-auto d-f ai-c mb-u-lg-5 mb-d-md-15">
            <?php cf_get_template('rating.php', CF_TEMPLATES_DIR, ['rating' => $box['rating'] * 10]) ?>
            <p class="ml-10 tc-d fs-14 fw-b"><?php echo $box['rating']; ?>/10</p>
          </div>
        </div>

        <?php if ( $box['rating_items'] ) : ?>
          <div class="mb-u-sm-18 mb-o-xs-20 p-15 br-8 bg-l">
            <div class="row mb-n15">
              <?php foreach ($box['rating_items'] as $item) { ?>
                <div class="<?php echo count($box['rating_items']) > 1 ? 'col-u-sm-6' : 'col-12'; ?> mb-15">
                  <p class="cb__ri cb__ri--<?php echo $item['rating']; ?> mb-8 pl-20 fw-b fs-14 ps-r"><?php echo $item['title']; ?></p>
                  <?php if( $item['desc'] ) : ?>
                    <div class="cb__cnt wp-editor fs-15"><?php echo wpautop( $item['desc'] ); ?></div>
                  <?php endif; ?>
                </div>
              <?php } ?>
            </div>
          </div>
        <?php endif; ?>
      <?php elseif ( $box['title'] ) : ?>
        <h2 class="mb-10 mb-10 fw-b fs-u-md-24 fs-d-sm-22"><?php echo $box['title']; ?></h2>
      <?php endif; ?>

      <?php
        if ( $box['contents'] ) :
          $layouts = [
            'ld' => $box['contents']['layout']['layout_ld'],
            'lm' => $box['contents']['layout']['layout_lm'],
          ];
          $layout = CF_Helpers_Common::layout($layouts);
          echo $layout ? '<div class="'. $layout .' ai-c">' : null;
            $i = 0;
            foreach ($box['contents']['content'] as $block) :
              $block['content'] = wpautop( $block['content'] );
              cf_get_template('text-block.php', CF_TEMPLATES_LOOP_DIR, [
                'block' => $block,
                'layout' => $layout ? 'col ' : null,
                'i' => $i
              ]);
              $i++;
            endforeach;
          echo $layout ? '</div>' : null;
        endif;
      ?>

      <?php
        if ( $box['sports'] ) :
          if ( $spots = CF_Helpers_Casino::get_casino_fields(get_the_id(), 'sports' ) ) :
            $count_sports = count($spots);
      ?>
          <p class="mt-u-sm-25 mt-o-xs-15 fw-b tc-d"><?php _e('Sports', 'elegnace'); ?></p>
          <div class="row fs-14 mx-u-sm-n5 mb-5">
            <?php $i = 0; foreach ($spots as $term) { ?>
              <div class="rd__li col-u-lg-3 col-o-md-4 col-o-sm-4 col-o-xs-6 mt-15 px-u-sm-5<?php echo $count_sports > 12 && $i > 10 ? ' d-u-lg-n' : null; echo $count_sports > 6 && $i > 4 ? ' d-d-md-n' : null; ?>">
                <p class="d-f ai-c ps-r">
                  <span class="mr-5">
                    <svg width="16" height="19" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M3.37691 15.6173L7.87691 13.8946C7.94722 13.87 8.02457 13.87 8.09839 13.8981L12.5984 15.6208C12.8058 15.6981 13.0238 15.5399 13.0132 15.3185L12.7671 10.5056C12.7636 10.4317 12.7882 10.3579 12.8339 10.2981L15.8609 6.55049C16.0015 6.37822 15.9171 6.11807 15.7027 6.06182L11.048 4.81025C10.9777 4.78916 10.9144 4.74346 10.8722 4.68018L8.24254 0.640723C8.123 0.454395 7.84879 0.454395 7.72925 0.640723L5.09957 4.67666C5.06089 4.73994 4.99761 4.78565 4.92379 4.80674L0.269097 6.0583C0.054644 6.11807 -0.029731 6.37471 0.110894 6.54697L3.14136 10.2946C3.18707 10.3544 3.21168 10.4282 3.20816 10.5021L2.96207 15.3149C2.95152 15.5364 3.16949 15.6946 3.37691 15.6173ZM13.5934 0.876018L15.0348 2.31743C15.0735 2.35961 15.0946 2.41586 15.084 2.47211C15.077 2.53188 15.0418 2.5811 14.9926 2.60922L12.0676 4.09282C12.0395 4.11039 12.0079 4.11743 11.9762 4.11743C11.9305 4.11743 11.8813 4.09985 11.8461 4.06469C11.7864 4.00493 11.7723 3.91703 11.8145 3.84321L13.3016 0.91469C13.3297 0.865472 13.3825 0.830315 13.4387 0.823284C13.495 0.816253 13.5512 0.833831 13.5934 0.876018ZM2.75473 0.918206L4.24184 3.84672C4.28051 3.91703 4.26996 4.00844 4.2102 4.07172C4.17504 4.10688 4.12934 4.12446 4.08012 4.12446C4.04848 4.12446 4.01684 4.11743 3.98871 4.09985L1.0602 2.61274C1.01098 2.58461 0.975823 2.53188 0.968792 2.47563C0.961761 2.41938 0.979339 2.36313 1.02153 2.32094L2.46293 0.879534C2.5016 0.837347 2.56137 0.819768 2.61762 0.8268C2.67739 0.833831 2.7266 0.868987 2.75473 0.918206ZM8.16879 15.1389L9.18832 18.2608C9.2059 18.317 9.19535 18.3768 9.15668 18.426C9.12152 18.4717 9.06527 18.4999 9.00902 18.4999H6.97348C6.91371 18.4999 6.86098 18.4717 6.82582 18.426C6.79067 18.3803 6.78012 18.3206 6.79418 18.2643L7.81371 15.1424C7.83832 15.0616 7.90863 15.0053 7.99301 15.0053C8.04223 15.0053 8.08793 15.0229 8.12309 15.0581C8.14418 15.0791 8.16176 15.1073 8.16879 15.1389Z" fill="#FFD469"/></svg>
                  </span>
                  <?php echo CF_Helpers_Taxonomy::get_taxonomy_linked($term, 'name', 'l-str tc-in td-u tc-h-p'); ?>
                </p>
              </div>
            <?php $i++; } ?>

            <?php if ( $count_sports > 12 ) : ?>
              <button class="rd__more d-d-md-n mt-11 mx-u-sm-5 mx-o-xs-15 fs-8 br-6 fw-b bg-l tc-h-w bg-h-p js-state" data-parent="div">+<?php echo $count_sports - 11 ?></button>
            <?php endif; ?>

            <?php if ( $count_sports > 6 ) : ?>
              <button class="rd__more d-u-lg-n mt-11 mx-u-sm-5 mx-o-xs-15 fs-8 br-6 fw-b bg-l tc-h-w bg-h-p js-state" data-parent="div">+<?php echo $count_sports - 5 ?></button>
            <?php endif; ?>
          </div>
      <?php
          endif;
        endif;
      ?>

      <?php
        if ( $box['esports'] ) :
          if ( $espots = CF_Helpers_Casino::get_casino_fields(get_the_id(), 'esports' ) ) :
            $count_esports = count($espots);
      ?>
          <p class="mt-u-sm-25 mt-o-xs-15 fw-b tc-d"><?php _e('eSports', 'elegnace'); ?></p>
          <div class="row ai-c fs-14 mx-u-sm-n5 mb-5">
            <?php $i = 0; foreach ($espots as $term) { ?>
              <div class="rd__li col-u-lg-3 col-o-md-4 col-o-sm-4 col-o-xs-6 mt-15 px-u-sm-5<?php echo $count_esports > 8 && $i > 6 ? ' d-u-lg-n' : null; echo $count_sports > 6 && $i > 4 ? ' d-d-md-n' : null; ?>">
                <p class="d-f ai-c ps-r">
                  <span class="mr-5">
                    <svg width="18" height="13" viewBox="0 0 18 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.9851 6.12668C16.2394 2.75555 15.1172 0.956252 13.4526 0.464767C13.1026 0.362128 12.7397 0.31085 12.375 0.31254C11.893 0.31254 11.4733 0.429962 11.0292 0.554415C10.4942 0.704533 9.8863 0.875041 9.00001 0.875041C8.11372 0.875041 7.50552 0.704884 6.96939 0.554767C6.52501 0.429962 6.1056 0.31254 5.62501 0.31254C5.24794 0.311233 4.87251 0.362347 4.5095 0.464415C2.85364 0.953791 1.73216 2.75238 0.975597 6.12457C0.162081 9.7534 0.562511 12.0445 2.09849 12.5761C2.30903 12.6503 2.53056 12.6886 2.7538 12.6893C3.80603 12.6893 4.64978 11.8129 5.22634 11.0953C5.87779 10.2832 6.64032 9.87118 9.00001 9.87118C11.1076 9.87118 11.9799 10.157 12.7333 11.0953C13.2068 11.6852 13.6544 12.098 14.1008 12.3578C14.6946 12.703 15.2881 12.7797 15.8643 12.5817C16.772 12.272 17.2923 11.4532 17.4111 10.1475C17.5015 9.14625 17.3623 7.83106 16.9851 6.12668ZM7.31251 5.93754H6.18751V7.06254C6.18751 7.21173 6.12825 7.3548 6.02276 7.46029C5.91727 7.56578 5.7742 7.62504 5.62501 7.62504C5.47583 7.62504 5.33275 7.56578 5.22726 7.46029C5.12178 7.3548 5.06251 7.21173 5.06251 7.06254V5.93754h2.93751C3.78833 5.93754 3.64525 5.87828 3.53976 5.77279C3.43428 5.6673 3.37501 5.52423 3.37501 5.37504C3.37501 5.22586 3.43428 5.08278 3.53976 4.97729C3.64525 4.8718 3.78833 4.81254 3.93751 4.81254H5.06251V3.68754C5.06251 3.53836 5.12178 3.39528 5.22726 3.28979C5.33275 3.1843 5.47583 3.12504 5.62501 3.12504C5.7742 3.12504 5.91727 3.1843 6.02276 3.28979C6.12825 3.39528 6.18751 3.53836 6.18751 3.68754V4.81254H7.31251C7.4617 4.81254 7.60477 4.8718 7.71026 4.97729C7.81575 5.08278 7.87501 5.22586 7.87501 5.37504C7.87501 5.52423 7.81575 5.6673 7.71026 5.77279C7.60477 5.87828 7.4617 5.93754 7.31251 5.93754ZM10.2656 6.07817C10.1266 6.07817 9.99063 6.03693 9.875 5.95967C9.75937 5.88241 9.66925 5.77259 9.61604 5.64412C9.56282 5.51564 9.54889 5.37426 9.57602 5.23787C9.60315 5.10148 9.67012 4.97619 9.76845 4.87786C9.86679 4.77952 9.99207 4.71256 10.1285 4.68543C10.2649 4.6583 10.4062 4.67222 10.5347 4.72544C10.6632 4.77866 10.773 4.86878 10.8503 4.98441C10.9275 5.10003 10.9688 5.23598 10.9688 5.37504C10.9688 5.56152 10.8947 5.74036 10.7628 5.87223C10.631 6.00409 10.4521 6.07817 10.2656 6.07817ZM11.8125 7.62504C11.6734 7.62504 11.5374 7.58376 11.4217 7.50642C11.306 7.42908 11.2159 7.31917 11.1627 7.19058C11.1096 7.062 11.0958 6.92054 11.123 6.7841C11.1503 6.64766 11.2174 6.52237 11.316 6.42411C11.4145 6.32585 11.5399 6.25902 11.6764 6.23209C11.8129 6.20516 11.9544 6.21933 12.0828 6.27282C12.2113 6.32631 12.3209 6.4167 12.398 6.53256C12.475 6.64842 12.516 6.78453 12.5156 6.92367C12.5152 7.10985 12.4409 7.28824 12.3091 7.41972C12.1773 7.5512 11.9987 7.62504 11.8125 7.62504ZM11.8125 4.53129C11.6734 4.53129 11.5375 4.49005 11.4219 4.41279C11.3062 4.33553 11.2161 4.22572 11.1629 4.09724C11.1097 3.96876 11.0958 3.82739 11.1229 3.69099C11.15 3.5546 11.217 3.42932 11.3153 3.33098C11.4137 3.23265 11.5389 3.16568 11.6753 3.13855C11.8117 3.11142 11.9531 3.12535 12.0816 3.17856C12.2101 3.23178 12.3199 3.3219 12.3971 3.43753C12.4744 3.55316 12.5156 3.6891 12.5156 3.82817C12.5156 4.01465 12.4416 4.19349 12.3097 4.32535C12.1778 4.45721 11.999 4.53129 11.8125 4.53129ZM13.3594 6.07817C13.2203 6.07817 13.0844 6.03693 12.9688 5.95967C12.8531 5.88241 12.763 5.77259 12.7098 5.64412C12.6566 5.51564 12.6426 5.37426 12.6698 5.23787C12.6969 5.10148 12.7639 4.97619 12.8622 4.87786C12.9605 4.77952 13.0858 4.71256 13.2222 4.68543C13.3586 4.6583 13.5 4.67222 13.6285 4.72544C13.7569 4.77866 13.8668 4.86878 13.944 4.98441C14.0213 5.10003 14.0625 5.23598 14.0625 5.37504C14.0625 5.56152 13.9884 5.74036 13.8566 5.87223C13.7247 6.00409 13.5459 6.07817 13.3594 6.07817Z" fill="#6B11C9"/></svg>
                  </span>
                  <?php echo CF_Helpers_Taxonomy::get_taxonomy_linked($term, 'name', 'l-str tc-in td-u tc-h-p'); ?>
                </p>
              </div>
            <?php $i++; } ?>

            <?php if ( $count_esports > 8 ) : ?>
              <button class="rd__more d-d-md-n mt-11 mx-u-sm-5 mx-o-xs-15 fs-8 br-6 fw-b bg-l tc-h-w bg-h-p js-state" data-parent="div">+<?php echo $count_esports - 7 ?></button>
            <?php endif; ?>

            <?php if ( $count_esports > 6 ) : ?>
              <button class="rd__more d-u-lg-n mt-11 mx-u-sm-5 mx-o-xs-15 fs-8 br-6 fw-b bg-l tc-h-w bg-h-p js-state" data-parent="div">+<?php echo $count_esports - 5 ?></button>
            <?php endif; ?>
          </div>
      <?php
          endif;
        endif;
      ?>

      <?php if ( $box['gallery'] || $box['gallery_mobile'] ) : ?>
        </div>
          </div>
      <?php endif; ?>
    </div>

    <?php if ($box['casino_bonuses'] ) : ?>
      <?php if ( $box['casino_bonuses_module'] ) : ?>
        <h2 class="mb-15 fw-b fs-u-md-24 fs-d-sm-22"><?php _e('Exclusive Casino Bonuses', 'elegance'); ?></h2>
        <div class="row-u-sm mb-15">

        <?php
          while($box['casino_bonuses_module']->have_posts()) : $box['casino_bonuses_module']->the_post();
            $ex_bonuses = CF_Helpers_Casino::get_casino_fields(get_the_ID(), ['color', 'affiliate_url', 'bonuses']);
            if ( $ex_bonuses['bonuses'] ) :
              foreach ( $ex_bonuses['bonuses'] as $bonus ) {
                if ( strpos( strtolower($bonus['name']), 'exclusive' ) !== false ) {
                  cf_get_template('bonus.php', CF_TEMPLATES_CASINO_DIR, [
                    'casino'   => $ex_bonuses,
                    'bonus'    => $bonus,
                    'play_now' => $play_now
                  ]);
                }
              }
            endif;
          endwhile;
        ?>
      </div>
      <?php elseif ( $casino['bonuses'] ) : ?>
        <h2 class="mb-15 fw-b fs-u-md-24 fs-d-sm-22"><?php _e('Exclusive Casino Bonuses', 'elegance'); ?></h2>
        <div class="row-u-sm mb-15">
          <?php foreach ($casino['bonuses'] as $bonus) {
            cf_get_template('bonus.php', CF_TEMPLATES_CASINO_DIR, [
              'casino'   => $casino,
              'bonus'    => $bonus,
              'play_now' => $play_now
            ]);
          } ?>
        </div>
      <?php endif; ?>
    <?php endif; ?>
<?php } ?>
  </div>
<?php endif;