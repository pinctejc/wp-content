<?php
 if(isset($list_type) and $list_type=='bonuses_listing'){
  	$post_id = $data['casinoID'];
  }
  else{
  	$post_id = get_the_ID();
  }
  $custom_key=$casino_list_custom_1;
  if ($custom_key!=''){
  	$casino = CF_Helpers_Casino::get_casino_fields($post_id, ['base', 'bonuses', 'gcode', 'custom_bonus'], $custom_key);
  }
  else{
  	$casino = CF_Helpers_Casino::get_casino_fields($post_id, ['base', 'bonuses', 'gcode']);
  }
  
  if(isset($list_type) and $list_type=='bonuses_listing'){ 
  	$casino['bonuses'][0]=$data;
  }
  
  
  //echo '<pre>';
  //print_r($casino['bonuses']);
  //print_r($casino);
  //echo '</pre>';
?>
<div class="col-u-lg-3 col-o-md-6 col-o-sm-6 px-10 mb-20 <?php echo $slider ? 'swiper-slide' : null; ?>">
  <div class="bc d-f f-c p-15 br-12 h-100p bg-l ps-r">
    <?php if ( get_the_post_thumbnail( $post_id, 'casino' )!='' ) : ?>
      <a href="<?php echo $casino['affiliate_url']; ?>" target="_blank" rel="nofollow" class="h-150 foc mb-10 p-10 br-8" style="background-color: <?php echo $casino['color']; ?>"><?php echo get_the_post_thumbnail( $post_id, 'casino' ); ?></a>
    <?php endif; ?>

    <div class="row ai-c mb-10 mx-n5">
      <p class="col px-5 h4 tc-d"><?php echo $casino['g_casino_keyword']; ?></p>
      <div class="col-auto px-5 d-f ai-c">
        <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.0001 0L12.8332 6.10054L19.5106 6.90983L14.5842 11.4895L15.8779 18.0902L10.0001 14.82L4.12221 18.0902L5.41597 11.4895L0.489502 6.90983L7.16694 6.10054L10.0001 0Z" fill="#FFBF00"/></svg>
        <p class="ml-u-md-8 ml-d-sm-5 fs-18 fw-bl tc-d"><?php echo $casino['rating']; ?></p>
      </div>
    </div>

    <?php
      if ( $casino['bonuses'] ) :
        $count = 0;
        foreach ($casino['bonuses'] as $bonus) {
          if ( ! $bonus['show_in'] ) {
            $count++;
          }
        }
    ?>
      <div class="bc__bonuses pt-10 mb-20">
        <?php if ( $count > 1 ) : ?>
          <div class="js-tabs">
            <div class="bc__btns d-f mb-15 f-w br-6">
              <?php
                $i = 0; foreach ($casino['bonuses'] as $bonus) {
                  if ( ! $bonus['show_in'] ) {
              ?>
                <button data-tab=".bonus-<?php echo $i; ?>" class="bc__btn p-5 fs-14 fw-m tc-h-w tc-h-u-sm-pv br-6 js-tab-btn <?php echo $i === 0 ? 'active' : null; ?>"><?php echo $bonus['type']; ?></button>
              <?php $i++; } } ?>
            </div>

            <?php
              $i = 0; foreach ($casino['bonuses'] as $bonus) {
                if ( ! $bonus['show_in'] ) {
            ?>
              <div class="tab bonus-<?php echo $i; echo $i === 0 ? ' active': null; ?> js-tab"">
                <?php if ( $bonus['bonus'] ) : ?>
                  <p class="bc__bonus tc-d fw-bl fs-20"><?php echo $bonus['bonus']; ?></p>
                <?php endif; ?>

                <?php if ( $bonus['wagering'] || $bonus['code']) : ?>
                  <ul class="bc__bonuses__more fs-14">
                    <?php if ( $bonus['wagering'] ) : ?>
                      <li class="mt-10 pl-15 ps-r"><?php _e('Wagering', 'elegance');?>: <?php echo $bonus['wagering']; ?></li>
                    <?php endif; ?>
                    <?php if ( $bonus['code'] ) : ?>
                      <li class="mt-10 pl-15 ps-r"><?php _e('Bonus code', 'elegance');?>: <strong class="cl__code d-ib pt-4 pb-5 px-8 tc-pv ps-r"><?php echo $bonus['code']; ?></strong></li>
                    <?php endif; ?>
                  </ul>
                <?php endif; ?>
              </div>
            <?php $i++; } } ?>
          </div>
        <?php else: ?>
          <?php if ( $casino['bonuses'][0]['type'] ) : ?>
            <p class="mb-15 py-5 tc-d fs-16"><?php echo $casino['bonuses'][0]['type']; ?></p>
          <?php endif; ?>

          <?php if ( $casino['bonuses'][0]['bonus'] ) : ?>
            <p class="bc__bonus tc-d fw-bl fs-20"><?php echo $casino['bonuses'][0]['bonus']; ?></p>
          <?php endif; ?>

          <?php if ( $casino['bonuses'][0]['wagering'] || $casino['bonuses'][0]['code']) : ?>
            <ul class="bc__bonuses__more fs-14">
              <?php if ( $casino['bonuses'][0]['wagering'] ) : ?>
                <li class="mt-10 pl-15 ps-r"><?php _e('Wagering', 'elegance');?>: <?php echo $casino['bonuses'][0]['wagering']; ?></li>
              <?php endif; ?>
              <?php if ( $casino['bonuses'][0]['code'] ) : ?>
                <li class="mt-10 pl-15 ps-r"><?php _e('Bonus code', 'elegance');?>: <strong class="cl__code d-ib pt-4 pb-5 px-8 tc-pv ps-r"><?php echo $casino['bonuses'][0]['code']; ?></strong></li>
              <?php endif; ?>
            </ul>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    <?php else: ?>
        <div class="bc__bonuses pt-10 mb-20">
			<p class="mb-15 py-5 tc-d fs-16"><i><?php echo $casino['g_casino_keyword']; ?> has no available welcome crypto bonuses</i></p>
        </div>
    <?php endif; ?>

    <div class="mt-a ta-c">
      <?php
        if ( $casino['gcode'] && $casino['gcode']['gcode_limit'] ) :
          cf_get_template('gcode-btn.php', CF_TEMPLATES_CASINO_DIR, ['gcode' => $casino['gcode']]);
        endif;
      ?>

      <a href="<?php echo $casino['affiliate_url']; ?>" target="_blank" rel="nofollow" class="btn w-100p mb-10 fw-bl fs-u-sm-20 <?php echo $play_now['classes']; ?>"><?php echo $play_now['label']; ?></a>

      <a href="<?php the_permalink($post_id); ?>" class="w-100p fw-m fst-i fs-14 ta-c td-u tc-d tc-h-p td-u"><?php _e($casino['g_casino_keyword'].' review', 'elegance'); ?></a>
    </div>
  </div>
</div>