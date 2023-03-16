<?php $casino = CF_Helpers_Casino::get_casino_fields(get_the_id(), 'base'); ?>
<div class="col-o-sm px-o-sm-5 px-u-md-0 mb-15 ">
  <div class="p-8 tc-d bg-l br-12">
    <div class="row mx-n4">
      <?php if ( has_post_thumbnail() ) : ?>
        <figure class="col-auto px-4">
          <a href="<?php echo $casino['affiliate_url'] ?>" target="_blank" rel="nofollow" class="ac__thumb foc p-5 br-8 of-h" style="background-color: <?php echo $casino['color']; ?>"><?php the_post_thumbnail( 'casino' ); ?></a>
        </figure>
      <?php endif; ?>
      <div class="col px-4">
        <h3 class="mb-5 fs-13 fw-b"><a href="<?php if(get_post_status($casino['post_id'])=='publish') {the_permalink();} else { echo "javascript: void(0)";}?>"><?php echo $casino['g_casino_keyword']; ?></a></h3>

        <?php if ( $casino['bonus'] && $casino['bonus']['bonus'] ) : ?>
          <p class="fs-13"><?php echo $casino['bonus']['bonus']; ?></p>
        <?php else: ?>
        	<p class="fs-13"><i><?php echo $casino['g_casino_keyword']; ?> has no available welcome crypto bonuses</i></p>
        <?php endif; ?>
      </div>

      <div class="col-auto px-4">
        <div class="d-f ai-c pt-2">
          <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 0L7.69987 3.66032L11.7063 4.1459L8.75046 6.89368L9.52671 10.8541L6 8.892L2.47329 10.8541L3.24954 6.89368L0.293661 4.1459L4.30013 3.66032L6 0Z" fill="#FFBF00"/></svg>
          <p class="fw-b ml-2 fs-10"><?php echo $casino['rating']; ?></p>
        </div>
      </div>
    </div>
  </div>
</div>