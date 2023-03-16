<div class="col-u-sm-4 px-10 mb-20">
  <div class="cc d-f ai-o-xs-c f-o-md-c p-u-md-15 p-d-sm-10 tc-d br-10 of-h h-100p bg-l ps-r">
    <?php if ( has_post_thumbnail() ) : ?>
      <figure class="col-u-lg-6 col-d-sm-5 h-u-lg-100p h-d-sm-100p as-u-sm-c mb-o-md-10 px-0 br-8" >
        <a href="<?php echo $casino['affiliate_url']; ?>" target="_blank" rel="nofollow" class="h-100p h-o-md-75 foc p-10 br-8" style="background-color: <?php echo $casino['color']; ?>"><?php the_post_thumbnail( 'casino' ); ?></a>
      </figure>
    <?php endif; ?>
    <div class="col d-u-sm-f f-u-sm-c pl-10 pl-o-md-0 pr-0">
      <p class="mb-10 fs-12"><?php echo $bonus['type']; ?></p>
      <p class="mb-10 fs-14 fw-bl tc-d"><?php echo $bonus['bonus']; ?></p>
      <a href="<?php echo $casino['affiliate_url']; ?>" target="_blank" rel="nofollow" class="btn w-100p h-30 mt-u-sm-a fw-bl fs-16 <?php echo $play_now['classes']; ?>"><?php echo $play_now['label']; ?></a>
    </div>
  </div>
</div>