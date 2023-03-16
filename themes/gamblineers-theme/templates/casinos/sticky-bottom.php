<div class="cs ps-f bg-pv py-10">
  <div class="container">
    <div class="row ai-c mx-n5">
      <div class="col-u-md-4 col-d-sm d-f ai-c px-5">
        <?php if ( has_post_thumbnail() ) : ?>
          <a href="<?php echo $casino['affiliate_url']; ?>" target="_blank" rel="nofollow" class="foc w-u-sm-35 w-o-xs-30 h-u-sm-35 h-o-xs-30 p-5 br-6" style="background-color: <?php echo $casino["color"]; ?>"><?php the_post_thumbnail( 'casino' ); ?></a>
        <?php endif; ?>
        <p class="col px-10 tc-w fw-bl fs-u-sm-16 fs-o-xs-12"><?php echo $casino['g_casino_keyword']; ?></p>
      </div>
      <div class="col-u-md-4 col-d-sm-auto ta-c px-5">
        <div class="d-f jc-u-md-c jc-d-sm-fe mx-n5">
          <?php if ( $casino['bonuses'] ) : ?>
            <a href="<?php echo $casino['affiliate_url'] ?>" target="_blank" rel="nofollow" class="btn btn--w w-u-sm-130 w-o-xs-85 h-u-sm-30 h-o-xs-25 mx-5 px-5 fs-u-sm-12 fs-o-xs-10 tc-p tc-h-w bg-h-b fw-bl"><?php _e('Claim bonus', 'elegnace'); ?></a>
          <?php endif; ?>
          <a href="<?php echo $casino['affiliate_url']; ?>" target="_blank" rel="nofollow" class="btn w-u-sm-130 w-o-xs-85 h-u-sm-30 h-o-xs-25 mx-5 px-5 fs-u-sm-12 fs-o-xs-10 fw-bl tc-h-p bg-h-w <?php echo $play_now['classes']; ?>"><?php echo $play_now['label']; ?></a>
        </div>
      </div>
    </div>
  </div>
</div>
