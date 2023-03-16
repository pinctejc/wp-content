<?php
  $custom_key_1='';
  $custom_key_2='';
  $custom_key_3='';
  
  if(isset($casino_list_enabled_bonus[0])==False and $casino_list_custom_1!="") $custom_key_1=$casino_list_custom_1;
  if(isset($casino_list_enabled_features[0])==False and $casino_list_custom_2!="") $custom_key_2=$casino_list_custom_2;
  if(isset($casino_list_enabled_rating[0])==False and $casino_list_custom_3!="") $custom_key_3=$casino_list_custom_3;
  
  if(isset($list_type) and $list_type=='bonuses_listing'){
  	$post_id = $data['casinoID'];
  }
  else{
  	$post_id = get_the_ID();
  }

  if ($custom_key_1!='' or $custom_key_2!='' or $custom_key_3!=''){
  	$casino = CF_Helpers_Casino::get_casino_fields($post_id, ['custom'], $custom_key_1, $custom_key_2, $custom_key_3);}
  else{
  	$casino = CF_Helpers_Casino::get_casino_fields($post_id, ['list']);}

  if(isset($list_type) and $list_type=='bonuses_listing'){ 
  	$casino['bonuses'][0]=$data;
  }
  
  #echo '<pre>';
  #print_r($casino);
  #echo '</pre>';
?>

<div class="cl mb-20 p-u-md-20 p-d-sm-12 br-14 bg-l ps-r">
  <div class="row ai-c">
    <div class="col-thumb col-o-sm-2 col-o-xs-auto mb-o-xs-15 pr-u-sm-8 pr-o-xs-0 ps-r order-u-md-1">
      <?php if ( $casino['badge'] ) : ?>
        <p class="cl__badge px-12 py-5 fw-b fs-12 br-p ps-a" style="color: <?php echo $casino['badge']['text_color']; ?>; background-color: <?php echo $casino['badge']['color']; ?>"><?php echo $casino['badge']['name']; ?></p>
      <?php endif; ?>
      <a href="<?php echo $casino['affiliate_url']; ?>" target="_blank" rel="nofollow" class="cl__thumb foc p-10 br-12" style="background-color: <?php echo $casino['color']; ?>"><?php echo get_the_post_thumbnail( $post_id, 'casino' ); ?></a>
      <?php if ( $casino['casino_type'] ) : ?>
        <p class="cl__type foc w-22 h-22 br-c br-p ps-a" style="background-color: <?php echo $casino['casino_type']['color']; ?>"><?php echo CF_Helpers_Taxonomy::get_taxonomy_linked($casino['casino_type']); ?></p>
      <?php endif; ?>
    </div>

    <div class="col-casino col-o-sm-2 col-o-xs mb-o-xs-15 px-u-sm-8 order-u-md-1">
      <h3 class="fs-20"><?php if(get_post_status($casino['post_id'])=='publish') {echo '<a href="'.get_permalink($post_id).'">';}?><?php echo $casino['g_casino_keyword']; ?></a></h3>
      <?php if ( $casino['bonuses'] && $casino['bonuses'][0]['code'] ) : ?>
      <p class="mt-5 fs-12">
        <?php _e('Bonus Code:', 'elegance') ?><br>
        <strong class="cl__code d-ib mt-5 pt-4 pb-6 px-8 tc-pv ps-r"><?php echo $casino['bonuses'][0]['code']; ?></strong>
      </p>
      <?php endif; ?>
    </div>

    <?php if (isset($casino_list_enabled_rating[0])): ?>
    <div class="col-rating col-o-sm-auto mb-o-xs-15 px-u-sm-8 d-f ai-c order-u-md-2">
      <p class="d-u-sm-n mr-d-sm-5 fw-bl"><?php _e('Rating', 'elegance'); ?></p>
      <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11 0L14.1164 6.71059L21.4616 7.60081L16.0425 12.6384L17.4656 19.8992L11 16.302L4.53436 19.8992L5.9575 12.6384L0.538379 7.60081L7.88356 6.71059L11 0Z" fill="#FFBF00"/></svg>
      <p class="ml-u-md-8 ml-d-sm-5 fs-22 fw-bl tc-d"><?php echo $casino['rating']; ?></p>
    </div>
    <?php else: ?>
        <?php if($casino_list_custom_3!=""): ?>
            <div class="col-rating col-o-sm-auto mb-o-xs-15 px-u-sm-8 d-f ai-c order-u-md-2">
                <?php echo $casino[$custom_key_3]; ?>	
            </div>
        <?php endif; ?>
    <?php endif; ?>


	<?php if(!isset($list_type)): ?>
        <?php if (isset($casino_list_enabled_bonus[0])): ?>
        <div class="col-bonus col-o-sm col-o-md mb-o-xs-15 px-u-md-8 order-u-md-1 <?php echo ! $casino['bonuses'] ? 'd-d-sm-n' : null; ?>">
          <?php if ( $casino['bonuses'] ) : ?>
            <div class="my-n5">
              <?php
                $i = 0;
                foreach ($casino['bonuses'] as $bonus) {
                    if ( ! $bonus['show_in'] ) {
              ?>
                <div class="cl__bonus__item <?php echo $i > 0 ? 'of-h' : null; ?>">
                  <p class="mt-5 mb-10 fs-14"><?php echo $bonus['type']; ?></p>
                  <p class="mb-5 fs-u-md-20 fs-d-sm-18 fw-bl tc-d tt-u"><?php echo $bonus['bonus']; ?></p>
                  <?php if ( $bonus['badges'] ) : ?>
                    <ul class="d-f f-w mx-n2 pt-5 mb-5">
                      <?php foreach ($bonus['badges'] as $badge) { ?>
                        <li
                          class="mx-2 py-4 px-10 br-p fw-b fs-12"
                          style="
                            background-color: <?php echo $badge['color'] ?>;
                            color: <?php echo $badge['text_color']; ?>;
                          "
                        ><?php echo CF_Helpers_Taxonomy::get_taxonomy_linked($badge); ?></li>
                      <?php } ?>
                    </ul>
                  <?php endif; ?>
                </div>
                <?php $i++; }} ?>
            </div>

            <?php if ( $i > 1 ) : ?>
              <button class="fs-14 fw-m fst-i tc-d tc-u-md-h-pv mt-10 js-show-bonuses">
                <svg fill="var(--dark)" class="va-tb" xmlns="http://www.w3.org/2000/svg" width="16.938" height="16.938" viewBox="0 0 16.938 16.938"><path class="cls-1" d="M9.507,16.982A8.473,8.473,0,1,1,17.98,8.509,8.473,8.473,0,0,1,9.507,16.982Zm0-15.791a7.318,7.318,0,1,0,7.318,7.318A7.318,7.318,0,0,0,9.507,1.192Zm1.026,7.2-0.113.095a3.345,3.345,0,0,0-.335.315V9.857a0.578,0.578,0,1,1-1.155,0V8.722A0.918,0.918,0,0,1,9.12,8.156a3.828,3.828,0,0,1,.553-0.55l0.141-.118h0c0.132-.11.249-0.208,0.362-0.317a1.155,1.155,0,0,0,.438-0.875A0.734,0.734,0,0,0,10.3,5.674a1.361,1.361,0,0,0-.8-0.246,1.385,1.385,0,0,0-.793.2,1.112,1.112,0,0,0-.375.44,0.578,0.578,0,0,1-1.033-.517,2.267,2.267,0,0,1,.768-0.884A2.667,2.667,0,0,1,11,4.749a1.888,1.888,0,0,1,.773,1.545A2.3,2.3,0,0,1,10.979,8C10.833,8.142,10.672,8.276,10.533,8.392Zm-1.026,3.2a0.77,0.77,0,1,1-.77.77A0.77,0.77,0,0,1,9.507,11.59Z" transform="translate(-1.031 -0.031)"/></svg>
                <span class="btn__ds"><?php _e('Show more', 'elegance'); ?></span>
                <span class="btn__as d-n"><?php _e('Show less', 'elegance'); ?></span>
              </button>
            <?php endif; ?>
          <?php else: ?>
            <div class="col-o-sm col-o-md mb-o-xs-15 px-u-md-8 order-u-md-1 ">
              <p><i><?php echo $casino['g_casino_keyword']; ?> has no available welcome crypto bonuses</i></p>
            </div>
          <?php endif; ?>
        </div>
        <?php else: ?>
            <?php if($casino_list_custom_1!=""): ?>
                <div class="col-bonus col-o-sm col-o-md mb-o-xs-15 px-u-md-8 order-u-md-1">
                    <?php echo $casino[$custom_key_1]; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
    
   <?php if(isset($list_type) and $list_type=='bonuses_listing'): ?>
        <?php if (isset($casino_list_enabled_bonus[0])): ?>
        <div class="col-bonus col-o-sm col-o-md mb-o-xs-15 px-u-md-8 order-u-md-1 <?php echo ! $data ? 'd-d-sm-n' : null; ?>">
          <?php if ( $data ) : ?>
            <div class="my-n5">
              <?php
                $i = 0;
                if ( ! $data['show_in'] ) {
              ?>
                <div class="cl__bonus__item <?php echo $i > 0 ? 'of-h' : null; ?>">
                  <p class="mt-5 mb-10 fs-14"><?php echo $data['type']; ?></p>
                  <p class="mb-5 fs-u-md-20 fs-d-sm-18 fw-bl tc-d tt-u"><?php echo $data['bonus']; ?></p>
                  <?php if ( $data['badges'] ) : ?>
                    <ul class="d-f f-w mx-n2 pt-5 mb-5">
                      <?php foreach ($data['badges'] as $badge) { ?>
                        <li
                          class="mx-2 py-4 px-10 br-p fw-b fs-12"
                          style="
                            background-color: <?php echo $badge['color'] ?>;
                            color: <?php echo $badge['text_color']; ?>;
                          "
                        ><?php echo CF_Helpers_Taxonomy::get_taxonomy_linked($badge); ?></li>
                      <?php } ?>
                    </ul>
                  <?php endif; ?>
                </div>
                <?php $i++;} ?>
            </div>

            <?php if ( $i > 1 ) : ?>
              <button class="fs-14 fw-m fst-i tc-d tc-u-md-h-pv mt-10 js-show-bonuses">
                <svg fill="var(--dark)" class="va-tb" xmlns="http://www.w3.org/2000/svg" width="16.938" height="16.938" viewBox="0 0 16.938 16.938"><path class="cls-1" d="M9.507,16.982A8.473,8.473,0,1,1,17.98,8.509,8.473,8.473,0,0,1,9.507,16.982Zm0-15.791a7.318,7.318,0,1,0,7.318,7.318A7.318,7.318,0,0,0,9.507,1.192Zm1.026,7.2-0.113.095a3.345,3.345,0,0,0-.335.315V9.857a0.578,0.578,0,1,1-1.155,0V8.722A0.918,0.918,0,0,1,9.12,8.156a3.828,3.828,0,0,1,.553-0.55l0.141-.118h0c0.132-.11.249-0.208,0.362-0.317a1.155,1.155,0,0,0,.438-0.875A0.734,0.734,0,0,0,10.3,5.674a1.361,1.361,0,0,0-.8-0.246,1.385,1.385,0,0,0-.793.2,1.112,1.112,0,0,0-.375.44,0.578,0.578,0,0,1-1.033-.517,2.267,2.267,0,0,1,.768-0.884A2.667,2.667,0,0,1,11,4.749a1.888,1.888,0,0,1,.773,1.545A2.3,2.3,0,0,1,10.979,8C10.833,8.142,10.672,8.276,10.533,8.392Zm-1.026,3.2a0.77,0.77,0,1,1-.77.77A0.77,0.77,0,0,1,9.507,11.59Z" transform="translate(-1.031 -0.031)"/></svg>
                <span class="btn__ds"><?php _e('Show more', 'elegance'); ?></span>
                <span class="btn__as d-n"><?php _e('Show less', 'elegance'); ?></span>
              </button>
            <?php endif; ?>
          <?php else: ?>
            <div class="col-o-sm col-o-md mb-o-xs-15 px-u-md-8 order-u-md-1 ">
              <p><i><?php echo $casino['g_casino_keyword']; ?> has no available welcome crypto bonuses</i></p>
            </div>
          <?php endif; ?>
        </div>
        <?php else: ?>
            <?php if($casino_list_custom_1!=""): ?>
                <div class="col-bonus col-o-sm col-o-md mb-o-xs-15 px-u-md-8 order-u-md-1">
                <?php echo $casino[$custom_key_1]; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
   <?php endif; ?>
   
   <?php if (isset($casino_list_enabled_features[0])): ?>
    <div class="col-features d-o-sm-n d-o-md-n mb-d-sm-15 px-u-md-8 order-u-md-1 <?php echo ! $casino['advantages'] ? 'd-d-sm-n' : null; ?>">
      <?php if ( $casino['advantages'] ) : ?>
        <ul>
          <?php foreach (array_slice($casino['advantages'], 0, 3) as $item) { ?>
            <li class="cl__benefit pl-30 fw-m fs-14 ps-r"><?php echo $item['item']; ?></li>
          <?php } ?>
        </ul>
      <?php endif; ?>
    </div>
    <?php else: ?>
        <?php if($casino_list_custom_2!=""): ?>
            <div class="col-features d-o-sm-n d-o-md-n mb-d-sm-15 px-u-md-8 order-u-md-1">
                <?php echo $casino[$custom_key_2]; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="col d-f f-c ai-c order-u-md-2">
      <a href="<?php echo $casino['affiliate_url']; ?>" target="_blank" rel="nofollow" class="btn w-100p mb-10 fw-bl fs-u-sm-20 <?php echo $play_now['classes']; ?>"><?php echo $play_now['label']; ?></a>
      <?php
        if ( $casino['gcode'] && $casino['gcode']['gcode_limit'] ) :
          cf_get_template('gcode-btn.php', CF_TEMPLATES_CASINO_DIR, ['gcode' => $casino['gcode']]);
        endif;
      ?>
      <?php if(get_post_status($casino['post_id'])=='publish'):?>
      	<a href="<?php the_permalink($post_id); ?>" class="tc-d tc-h-p td-u"><?php if(get_post_status($casino['post_id'])=='publish') {_e('Read review', 'elegance');} ?></a>
      <?php endif; ?>
    
    </div>
  </div>
</div>