<?php if ( $casino['bonuses'] ) : ?>
  <div class="bb foc f-c mb-30 min-h2 py-30 px-o-xs-10 ta-c bg-pv br-20" data-bg_desktop="url(<?php echo CF_DIST_IMAGES; ?>/backgrounds/casino-bnr-desktop-bg.svg)" data-bg_pos_desktop="center center" data-bg_mobile="url(<?php echo CF_DIST_IMAGES; ?>/backgrounds/casino-bnr-mobile-bg.svg)" data-bg_pos_mobile="center center">
    <div class="col-u-lg-9">
      <p class="mb-30 fw-bl fs-u-sm-36 fs-o-xs-34 tt-u tc-w"><?php echo $casino['bonuses'][0]['bonus']; ?></p>
      <a href="<?php echo $casino['affiliate_url'] ?>" target="_blank" rel="nofollow" class="btn btn--p w-250 h-60 fs-22 tc-w fw-bl bg-h-s"><?php echo _e('Claim bonus', 'elegance'); ?></a>
    </div>
  </div>
<?php endif; ?>
