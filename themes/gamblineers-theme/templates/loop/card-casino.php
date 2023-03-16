<?php
  if(isset($list_type) and $list_type=='bonuses_listing'){
  	$post_id = $data['casinoID'];
  }
  else{
  	$post_id = get_the_ID();
  }
  $casino = CF_Helpers_Casino::get_casino_fields($post_id, 'base');
  if(isset($list_type) and $list_type=='bonuses_listing'){ 
  	$casino['bonus']=$data;
  }
?>
<div class="col-u-sm-4 px-10 mb-20 <?php echo $slider ? 'swiper-slide' : null; ?>">
  <div class="cc d-f f-d-sm-c p-u-md-15 p-d-sm-10 tc-d br-10 h-100p bg-l ps-r bs-h-l">
    <?php if ( get_the_post_thumbnail( $post_id, 'casino' )!='' ) : ?>
      <figure class="col-u-md-6 as-u-md-c mb-d-sm-10 px-0 br-8" >
        <a href="<?php echo $casino['affiliate_url']; ?>" target="_blank" rel="nofollow" class="h-110 foc p-10 br-8" style="background-color: <?php echo $casino['color']; ?>"><?php echo get_the_post_thumbnail( $post_id, 'casino' ); ?></a>
      </figure>
    <?php endif; ?>
    <div class="col d-f f-c pl-u-md-10 pl-d-sm-0 pr-0">
      <?php if ( $casino['bonus'] ) : ?>
        <p class="mb-10"><?php echo $casino['bonus']['type']; ?></p>
        <p class="mb-10 fs-18 fw-bl tc-d"><?php echo $casino['bonus']['bonus']; ?></p>
      <?php else: ?>
      	<p class="mb-10"></p>
        <p class="mb-10"><i><?php echo $casino['g_casino_keyword']; ?> has no available welcome crypto bonuses</i></p>
      <?php endif; ?>
      <a href="<?php echo $casino['affiliate_url']; ?>" target="_blank" rel="nofollow" class="btn w-100p h-46 mt-a fw-bl fs-u-sm-20 <?php echo $play_now['classes']; ?>"><?php echo $play_now['label']; ?></a>
    </div>
  </div>
</div>