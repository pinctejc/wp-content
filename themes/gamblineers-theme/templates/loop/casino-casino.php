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
  	$casino = CF_Helpers_Casino::get_casino_fields($post_id, ['casino'], $custom_key_1, $custom_key_2, $custom_key_3);}
  else{
  	$casino = CF_Helpers_Casino::get_casino_fields($post_id, ['casino']);}

  if(isset($list_type) and $list_type=='bonuses_listing'){ 
  	$casino['bonuses'][0]=$data;
  }

?>




<div class="bg-tr cl-wh cl mb-20 p-u-md-20 p-d-sm-12 br-14 bg-l ps-r">

<div class="container-casino">
	
    	<div class="left">
        <div class="ps-r h-100">
          <?php if ( $casino['badge'] ) : ?>
            <p class="cl__badge px-12 py-5 fw-b fs-12 br-p ps-a" style="color: <?php echo $casino['badge']['text_color']; ?>; background-color: <?php echo $casino['badge']['color']; ?>"><?php echo $casino['badge']['name']; ?></p>
          <?php endif; ?>
          <a href="<?php echo $casino['affiliate_url']; ?>" target="_blank" rel="nofollow" class="foc p-10 br-12 h-100" style="background-color: <?php echo $casino['color']; ?>"><?php echo get_the_post_thumbnail( $post_id, 'casino' ); ?></a>
          <?php if ( $casino['casino_type'] ) : ?>
            <p class="cl__type foc w-22 h-22 br-c br-p ps-a g_bottom" style="background-color: <?php echo $casino['casino_type']['color']; ?>"><?php echo CF_Helpers_Taxonomy::get_taxonomy_linked($casino['casino_type']); ?></p>
          <?php endif; ?>
      </div>
    </div>
    
    <div class="playnow">
    	<div class="mt-15 col d-f f-c ai-c order-u-md-2">
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
    
    <div class="middle mt-20">
    <div class="wp-editor mt-5 mb-10 fs-16 lh-16"><?php echo $casino['g_casino_description']; ?></div>
    </div>
    
    <div class="g_casino_title">
      	<h3 class="fs-32"><?php if(get_post_status($casino['post_id'])=='publish') {echo '<a href="'.get_permalink($post_id).'">';}?><?php echo $casino['g_casino_keyword']; ?></a></h3>
        <div class="d-f ai-c f-e">
          <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11 0L14.1164 6.71059L21.4616 7.60081L16.0425 12.6384L17.4656 19.8992L11 16.302L4.53436 19.8992L5.9575 12.6384L0.538379 7.60081L7.88356 6.71059L11 0Z" fill="#FFBF00"/></svg>
          <p class="ml-u-md-8 ml-d-sm-5 fs-32 fw-b tc-d"><?php echo $casino['rating']; ?></p>
        </div>
    </div>
    
    <div class="right d-f br-12">
    	<div class="w-100">
          <?php if ( $casino['bonuses'] ) : ?>
            <div class="my-n5">
              <?php
                $i = 0;
                foreach ($casino['bonuses'] as $bonus) {
                    if ( ! $bonus['show_in'] ) {
              ?>
                <div class="cl__bonus__item <?php echo $i > 0 ? 'of-h' : null; ?>">
                  <p class="mt-5 mb-10 fs-14"><?php echo $bonus['type']; ?></p>
                  <p class="mb-5 fs-20 fw-bl tc-d tt-u"><?php echo $bonus['bonus']; ?></p>
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
            <?php if ( $casino['bonuses'] && $casino['bonuses'][0]['code'] ) : ?>
              <p class="mt-10 fs-12 code">
                <?php _e('Bonus Code:', 'elegance') ?><br>
                <strong class="cl__code ml-10 d-ib pt-4 pb-6 px-8 tc-pv ps-r"><?php echo $casino['bonuses'][0]['code']; ?></strong>
              </p>
              <?php endif; ?>
          <?php else: ?>
            <div class="col-o-sm col-o-md mb-o-xs-15 px-u-md-8 order-u-md-1 ">
              <p><i><?php echo $casino['g_casino_keyword']; ?> has no available welcome crypto bonuses</i></p>
            </div>
          <?php endif; ?>
        </div>
    
    </div>
    
    <div class="features d-f d-features">
            
    <div class="features_content">
        <div class="<?php echo ! $casino['advantages'] ? 'd-d-sm-n' : null; ?>">
          <?php if ( $casino['advantages'] ) : ?>
            <ul class="pc__pros">
              <?php foreach (array_slice($casino['advantages'], 0, 3) as $item) : ?>
                <li class="pc__item ps-r mt-15 pl-u-sm-35 "><?php echo $item['item']; ?></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
        
        <div class="<?php echo ! $casino['disadvantages'] ? 'd-d-sm-n' : null; ?>">
          <?php if ( $casino['disadvantages'] ) : ?>
            <ul class="pc__cons">
              <?php foreach (array_slice($casino['disadvantages'], 0, 3) as $item) : ?>
                <li class="pc__item ps-r mt-15 pl-u-sm-35 "><?php echo $item['item']; ?></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
     </div>
  </div>
</div>
</div>