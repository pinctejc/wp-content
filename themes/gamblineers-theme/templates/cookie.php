<?php
  if ( get_field( 'cookie', 'options' ) && ! isset( $_COOKIE['wordpress_theme_cookie'] ) ) :
    cf_enqueue_asset('cookie', true);
    $cta_1 = CF_Helpers_Common::button(get_field( 'tou', 'options' ));
    $cta_2 = CF_Helpers_Common::button(get_field( 'pcp', 'options' ));
?>
  <div class="cookie ps-f br-t-10 br-b-u-sm-10 of-h bg-w">
    <button type="button" class="cookie__btn ps-a w-30 h-30"><svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 0.8L7.2 0L4 3.2L0.8 0L0 0.8L3.2 4L0 7.2L0.8 8L4 4.8L7.2 8L8 7.2L4.8 4L8 0.8Z" fill="#6B11C9"/></svg></button>
    <div class="px-10 py-10 pr-25">
      <div class="row ai-c mx-n5">
        <div class="col-auto px-5"><img width="40" height="40" src="<?php echo CF_DIST_IMAGES; ?>icons/cookie.svg" alt="cookie"></div>
        <div class="col px-5 wp-editor fs-u-sm-12 fs-o-xs-10"><p><?php echo get_field( 'cookie', 'options' ); ?></p></div>
      </div>
    </div>
    <?php if ( $cta_1 && $cta_2 ) : ?>
    <div class="row ng">
      <?php if ( $cta_1 ) : ?>
        <div class="col">
          <a href="<?php echo $cta_1['action']; ?>" class="btn w-100p h-30 fs-10 fw-m br-0 <?php echo $cta_1['classes']; ?>"><?php echo $cta_1['label']; ?></a>
        </div>
      <?php endif; ?>
      <?php if ( $cta_2 ) : ?>
        <div class="col">
          <a href="<?php echo $cta_2['action']; ?>" class="btn w-100p h-30 fs-10 fw-m br-0 <?php echo $cta_2['classes']; ?>"><?php echo $cta_2['label']; ?></a>
        </div>
      <?php endif; ?>
    </div>
    <?php endif; ?>
  </div>
<?php endif; ?>
