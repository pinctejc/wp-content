<?php $customer = CF_Helpers_Common::get_session(['geo_iso_code', 'country_flag']); ?>
<header class="ch pt-o-xs-10 mb-30">
  <div class="container">
    <?php cf_get_template('breadcrumbs.php', CF_TEMPLATES_DIR); ?>

    <div class="ch__cnt mt-u-sm-10 p-u-sm-20 p-o-xs-15 ta-o-xs-c bg-w br-10">
      <div class="row-u-sm mx-o-sm-n5">
        <?php if ( has_post_thumbnail() ) : ?>
          <figure class="col-u-sm-auto mb-o-xs-10 px-o-sm-5">
            <a href="<?php echo $casino['affiliate_url'] ?>" target="_blank" rel="nofollow" style="background-color: <?php echo $casino['color']; ?>" class="ch__thumb foc p-10 mx-o-xs-a br-10"><?php the_post_thumbnail( 'casino' ); ?></a>
          </figure>
        <?php endif; ?>

        <div class="col-u-sm as-u-sm-c px-o-sm-5">
          <div class="row-u-sm ai-u-sm-c">
            <div class="col-u-lg-8 col-o-md col-o-sm mb-o-xs-15 order-u-sm-1">
              <h1 class="mb-10 fs-o-sm-34 fs-o-xs-24"><?php the_title(); ?></h1>
              <div class="d-u-sm-f ai-u-sm-c">
                <div class="d-f ai-c jc-o-xs-c mb-o-xs-10">
                  <p class="d-f ai-c mr-8 fw-bl fs-24 tc-d">
                    <svg class="mr-8" width="24" height="23" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 0.5L15.3997 7.82065L23.4127 8.7918L17.5009 14.2874L19.0534 22.2082L12 18.284L4.94658 22.2082L6.49909 14.2874L0.587322 8.7918L8.60025 7.82065L12 0.5Z" fill="#FFBF00"/></svg>
                    <?php echo $casino['rating']; ?>
                  </p>

                  <button type="button" class="ch__sr js-show-ratings js-state"><svg width="18" height="9" viewBox="0 0 18 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.0574 0.30764C1.11545 0.249436 1.18442 0.203258 1.26035 0.171749C1.33629 0.140241 1.41769 0.124023 1.4999 0.124023C1.58211 0.124023 1.66351 0.140241 1.73944 0.171749C1.81537 0.203258 1.88434 0.249436 1.9424 0.30764L8.9999 7.36639L16.0574 0.30764C16.1155 0.24953 16.1845 0.203435 16.2604 0.171986C16.3363 0.140537 16.4177 0.124351 16.4999 0.124351C16.5821 0.124351 16.6634 0.140537 16.7394 0.171986C16.8153 0.203435 16.8843 0.24953 16.9424 0.30764C17.0005 0.36575 17.0466 0.434737 17.078 0.510661C17.1095 0.586585 17.1257 0.667961 17.1257 0.75014C17.1257 0.83232 17.1095 0.913696 17.078 0.98962C17.0466 1.06554 17.0005 1.13453 16.9424 1.19264L9.4424 8.69264C9.38434 8.75084 9.31537 8.79702 9.23944 8.82853C9.1635 8.86004 9.0821 8.87626 8.9999 8.87626C8.91769 8.87626 8.83628 8.86004 8.76035 8.82853C8.68442 8.79702 8.61545 8.75084 8.55739 8.69264L1.0574 1.19264C0.999193 1.13458 0.953014 1.06561 0.921506 0.989683C0.889998 0.913751 0.873779 0.83235 0.873779 0.75014C0.873779 0.667931 0.889998 0.58653 0.921506 0.510598C0.953014 0.434667 0.999193 0.365697 1.0574 0.30764Z" fill="#303030"/></svg></button>
                </div>

                <!--p class="d-f ai-c jc-o-xs-c ml-u-sm-20 fw-n fs-12">
                  <span class="ch__flag mr-8"><?php echo $customer['country_flag']; ?></span>
                  <?php if ( !$casino['is_restricted'] ) : ?>
                    <?php echo wp_sprintf( __('Players from %s accepted', 'elegance'), $customer['geo_iso_code'] ); ?>
                    <span class="ml-5"><svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.0006 2.50849L5.62498 10.1551C5.40371 10.3845 5.11324 10.5 4.82278 10.5C4.53231 10.5 4.24185 10.3845 4.02057 10.1551L0.332849 6.33181C-0.11095 5.87191 -0.11095 5.12831 0.332849 4.66841C0.77644 4.20829 1.49346 4.20829 1.93726 4.66841L4.82278 7.66003L11.3962 0.845088C11.8398 0.384971 12.5568 0.384971 13.0006 0.845088C13.4442 1.30499 13.4442 2.04837 13.0006 2.50849Z" fill="#2BC253"/></svg></span>
                  <?php else : ?>
                    <?php echo wp_sprintf( __('Players from %s not accepted', 'elegance'), $customer['geo_iso_code'] ); ?>
                    <span class="ml-5"><svg width="10" height="11" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.39849 5.50001L9.71035 2.18815C10.0965 1.80198 10.0965 1.17586 9.71035 0.789644C9.32419 0.403427 8.69807 0.403477 8.31185 0.789644L4.99999 4.10151L1.68813 0.789644C1.30196 0.403477 0.675842 0.403477 0.289625 0.789644C-0.0965416 1.17581 -0.0965416 1.80193 0.289625 2.18815L3.60149 5.50001L0.289625 8.81187C-0.0965416 9.19804 -0.0965416 9.82416 0.289625 10.2104C0.482708 10.4035 0.735805 10.5 0.988851 10.5C1.24195 10.5 1.49499 10.4035 1.68808 10.2104L4.99994 6.89851L8.3118 10.2104C8.50488 10.4035 8.75793 10.5 9.01103 10.5C9.26412 10.5 9.51717 10.4035 9.71025 10.2104C10.0964 9.82421 10.0964 9.19809 9.71025 8.81187L6.39849 5.50001Z" fill="#DA4A54"/></svg></span>
                  <?php endif; ?>
                </p-->
              </div>
            </div>

            <div class="col-u-lg-3 col-o-md-4 col-o-sm-4 d-u-sm-f d-o-xs-n f-u-sm-c ai-u-sm-c order-u-sm-2">
              <a href="<?php echo $casino['affiliate_url'] ?>" target="_blank" rel="nofollow" class="btn fw-bl w-u-sm-100p fs-20 <?php echo $play_now['classes']; ?>"><?php echo $play_now['label']; ?></a>

              <?php
                if ( $casino['gcode'] && $casino['gcode']['gcode_limit'] ) :
                  cf_get_template('gcode-btn.php', CF_TEMPLATES_CASINO_DIR, ['gcode' => $casino['gcode']]);
                endif;
              ?>
            </div>
          </div>
        </div>
      </div>

      <div class="ch__ratings mt-o-sm-10 mt-o-xs-15 h-0 order-u-sm-3 fw-b tc-d of-h">
        <?php if ( $casino['boxes'] ) : ?>
          <div class="row mb-u-sm-n30 mb-o-xs-n15">
            <?php
              foreach ($casino['boxes'] as $box ) {
                if ( $box['rating'] > 0 ) :
            ?>
                  <h3 class="col-u-md-4 col-o-sm-6 mb-u-sm-30 mb-o-xs-15">
                    <?php if ( $box['title'] ) : ?>
                    	<a href="#<?php echo $box['id'];?>" >
                      		<p class="mb-u-sm-10 mb-o-xs-20 fs-u-sm-18 ta-l"><?php echo $box['header_title'] ?: $box['title']; ?></p>
                        </a>
                    <?php endif; ?>

                    <div class="d-f ai-c">
                      <div class="col-o-xs px-0">
                        <?php cf_get_template('rating.php', CF_TEMPLATES_DIR, ['rating' => $box['rating'] * 10]) ?>
                      </div>
                      <p class="ch__ratings__val ml-10 tc-d fs-14 fw-b"><?php echo $box['rating']; ?>/10</p>
                    </div>
                  </h3>
            <?php
                endif;
              }
            ?>
          </div>
        <?php endif; ?>

        <div class="d-u-sm-f ai-u-sm-c jc-u-sm-c mt-30 mb-o-xs-10 mx-u-sm-n20 fw-b fs-16">
        
          <?php if($casino['askgamblers_rating']!='-1'): ?>
              <p class="d-f ai-c jc-o-xs-sb mb-o-xs-15 px-u-sm-20">
                <span class="pb-3"><?php _e('Rating from Askgamblers', 'elegance'); ?></span>
                <span class="ml-5 ps-r fs-0">
                  <span class="ps-a w-100p h-100p foc fs-12"><?php echo $casino['askgamblers_rating']; ?>/10</span>
                  <svg width="46" height="46" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50" enable-background="new 0 0 0 0" xml:space="preserve">
                    <circle fill="none" stroke="#D7D7D7" stroke-width="3" cx="25" cy="25" r="22"></circle>
                    <circle fill="none" stroke="#0BA25B" stroke-width="3" cx="25" cy="25" r="22" stroke-dasharray="138" stroke-dashoffset="<?php echo 138 - (13.8 * $casino['askgamblers_rating']); ?>" transform="rotate(-90, 25,25)">
                    </circle>
                  </svg>
                </span>
              </p>
          <?php endif; ?>

          <?php if($casino['trustpilot_rating']!='-1'): ?>
              <p class="d-f ai-c jc-o-xs-sb mb-o-xs-25 px-u-sm-20">
                <span class="pb-3"><?php _e('Rating from Trustpilot', 'elegance'); ?></span>
                <span class="ml-5 ps-r fs-0">
                  <span class="ps-a w-100p h-100p foc fs-12"><?php echo $casino['trustpilot_rating']; ?>/5</span>
                  <svg width="46" height="46" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50" enable-background="new 0 0 0 0" xml:space="preserve">
                    <circle fill="none" stroke="#D7D7D7" stroke-width="3" cx="25" cy="25" r="22"></circle>
                    <circle fill="none" stroke="#0BA25B" stroke-width="3" cx="25" cy="25" r="22" stroke-dasharray="138" stroke-dashoffset="<?php echo 138 - (27.6 * $casino['trustpilot_rating']); ?>" transform="rotate(-90, 25,25)">
                    </circle>
                  </svg>
                </span>
              </p>
          <?php endif; ?>
        </div>
        
      </div>

      <div class="d-u-sm-n d-o-xs-f f-o-xs-c ai-o-xs-c">
        <a href="<?php echo $casino['affiliate_url'] ?>" target="_blank" rel="nofollow" class="btn fw-bl w-u-sm-100p fs-20 <?php echo $play_now['classes']; ?>"><?php echo $play_now['label']; ?></a>

        <?php
          if ( $casino['gcode'] && $casino['gcode']['gcode_limit'] ) :
            cf_get_template('gcode-btn.php', CF_TEMPLATES_CASINO_DIR, ['gcode' => $casino['gcode']]);
          endif;
        ?>
      </div>
    </div>
  </div>
</header>
