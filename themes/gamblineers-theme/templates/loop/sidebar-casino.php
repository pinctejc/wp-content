<?php

if(isset($bonus_sidebar) and $bonus_sidebar==True){
    $post_id = $bonus['casinoID'];
    $casino = CF_Helpers_Casino::get_casino_fields($post_id, 'base');
    $casino['bonus']=$bonus;
}
else{
	$post_id = get_the_id();
	$casino = CF_Helpers_Casino::get_casino_fields($post_id, 'base');

}

//echo '<pre>';
//print_r($casino);
//echo '</pre>';

?>
<div class="col-o-sm px-o-sm-5 px-u-md-0 mt-15">
  <div class="h-o-sm-100p p-8 tc-d bg-l br-12">
    <div class="row f-o-sm-c mx-n4">
      <?php if ( get_the_post_thumbnail( $post_id, 'casino' )!='' ) : ?>
        <figure class="col-auto w-o-sm-100p px-4 mb-o-sm-10">
          <a href="<?php echo $casino['affiliate_url'] ?>" target="_blank" rel="nofollow" class="sc__thumb foc p-5 br-8 of-h" style="background-color: <?php echo $casino['color']; ?>"><?php echo get_the_post_thumbnail($post_id, 'casino'); ?></a>
        </figure>
      <?php endif; ?>

      <div class="col px-4 d-o-sm-f f-o-sm-c">
        <div class="row mb-5 mx-n5 ai-fs">
          <h3 class="col px-5 fs-13 fw-b"><?php if(get_post_status($casino['post_id'])=='publish') {echo '<a href="'.get_permalink($post_id).'">';}?><?php echo $casino['g_casino_keyword']; ?></a></h3>
          <div class="col-auto px-4 pt-3 d-f ai-c">
            <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 0L7.69987 3.66032L11.7063 4.1459L8.75046 6.89368L9.52671 10.8541L6 8.892L2.47329 10.8541L3.24954 6.89368L0.293661 4.1459L4.30013 3.66032L6 0Z" fill="#FFBF00"/></svg>
            <p class="fw-b ml-2 fs-10"><?php echo $casino['rating']; ?></p>
          </div>
        </div>

        <?php if ( $casino['bonus'] && $casino['bonus']['bonus'] ) : ?>
          <p class="mb-u-md-5 mb-o-sm-10 mb-o-xs-5 fs-13"><?php echo $casino['bonus']['bonus']; ?></p>
        <?php else: ?>
        	<p class="mb-u-md-5 mb-o-sm-10 mb-o-xs-5 fs-13"><i><?php echo $casino['g_casino_keyword']; ?> has no available welcome crypto bonuses</i></p>
        <?php endif; ?>
      </div>
    </div>

    <div class="row ai-c mt-o-sm-t mx-n4 ta-c">

      <div class="col-u-md-auto col-o-sm-12 col-o-xs-auto px-4 order-o-sm-2">
          <?php if(get_post_status($casino['post_id'])=='publish'): ?>
            <a href="<?php the_permalink($post_id); ?>" class="d-b w-u-sm-100 w-o-xs-125 mx-a fs-12 fw-m tc-in td-u"><?php if(get_post_status($casino['post_id'])=='publish') {_e('Read review', 'elegance');} ?></a>
          <?php else: ?>
          <a class="d-b w-u-sm-100 w-o-xs-125 mx-a fs-12 fw-m tc-in td-u"><?php if(get_post_status($casino['post_id'])=='publish') {_e('Read review', 'elegance');} ?></a>
          <?php endif; ?>
	  </div>

      <div class="col-u-md col-o-sm-12 col-o-xs px-4 order-o-sm-1">
        <a href="<?php echo $casino['affiliate_url']; ?>" target="_blank" rel="nofollow" class="btn w-100p h-30 mt-o-sm-a mb-5 fw-bl fs-u-sm-12 <?php echo $play_now['classes']; ?>"><?php echo $play_now['label']; ?></a>
      </div>
    </div>
  </div>
</div>