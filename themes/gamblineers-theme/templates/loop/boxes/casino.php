<?php $casino = CF_Helpers_Casino::get_casino_fields(get_the_ID(), ['affiliate_url', 'rating', 'color', 'bonus']); ?>

<div class="ph__item py-u-sm-15 px-u-sm-20 p-o-xs-8 bg-w br-10">
  <div class="row ai-c mx-n5">
    <?php if ( has_post_thumbnail() ) : ?>
      <figure class="col-auto ta-c px-5">
        <a href="<?php echo $casino['affiliate_url']; ?>" target="_blank" rel="nofollow" class="ph__item__thumb foc p-5 br-10 mb-o-xs-n10" style="background-color: <?php echo $casino['color']; ?> ">
          <?php the_post_thumbnail( 'casino' ); ?>
        </a>
        <div class="d-u-sm-n d-o-xs-if ai-o-xs-c jc-o-xs-c bg-w br-4 p-2 mt-n10">
          <svg width="10" height="9" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.82237 0.578799C8.18076 -0.192933 9.2779 -0.192933 9.6363 0.578799L11.4698 4.52681C11.6155 4.84056 11.913 5.05672 12.2564 5.09834L16.5778 5.62208C17.4225 5.72446 17.7615 6.7679 17.1383 7.34723L13.9501 10.311C13.6967 10.5465 13.5831 10.8963 13.6496 11.2357L14.4869 15.5074C14.6506 16.3424 13.763 16.9873 13.0194 16.5736L9.21551 14.4573C8.91321 14.2891 8.54546 14.2891 8.24316 14.4573L4.43926 16.5736C3.6957 16.9873 2.8081 16.3424 2.97176 15.5074L3.80903 11.2357C3.87556 10.8963 3.76192 10.5465 3.50855 10.311L0.32035 7.34723C-0.30286 6.7679 0.0361753 5.72446 0.880887 5.62208L5.20224 5.09834C5.54566 5.05672 5.84318 4.84056 5.98889 4.52681L7.82237 0.578799Z" fill="#FFBF00"/></svg>
          <p class="ml-4 fw-bl fs-10 tc-d"><?php echo $casino['rating']; ?></p>
        </div>
      </figure>
    <?php endif; ?>

    <div class="col px-5">
      <p class="fw-bl fs-14 tc-d"><a href="<?php the_permalink(); ?>" class="tc-in"><?php the_title(); ?></a></p>
      <?php if (  $casino['bonus'] && $casino['bonus']['bonus'] ) : ?>
        <p class="fs-14 mt-5"><?php echo $casino['bonus']['bonus']; ?></p>
      <?php endif; ?>
    </div>
    <div class="col-auto d-o-xs-n px-5 d-f ai-c">
      <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.82237 0.578799C8.18076 -0.192933 9.2779 -0.192933 9.6363 0.578799L11.4698 4.52681C11.6155 4.84056 11.913 5.05672 12.2564 5.09834L16.5778 5.62208C17.4225 5.72446 17.7615 6.7679 17.1383 7.34723L13.9501 10.311C13.6967 10.5465 13.5831 10.8963 13.6496 11.2357L14.4869 15.5074C14.6506 16.3424 13.763 16.9873 13.0194 16.5736L9.21551 14.4573C8.91321 14.2891 8.54546 14.2891 8.24316 14.4573L4.43926 16.5736C3.6957 16.9873 2.8081 16.3424 2.97176 15.5074L3.80903 11.2357C3.87556 10.8963 3.76192 10.5465 3.50855 10.311L0.32035 7.34723C-0.30286 6.7679 0.0361753 5.72446 0.880887 5.62208L5.20224 5.09834C5.54566 5.05672 5.84318 4.84056 5.98889 4.52681L7.82237 0.578799Z" fill="#FFBF00"/></svg>
      <p class="mx-4 fw-bl fs-14 tc-d"><?php echo $casino['rating']; ?></p>
    </div>
    <div class="col-auto px-5">
      <a href="<?php echo $casino['affiliate_url']; ?>" target="_blank" rel="nofollow" class="btn <?php echo $play['classes']; ?> h-u-sm-40 h-o-xs-30 px-u-sm-30 px-o-xs-20 fs-14 fw-bl br-10"><?php _e('Play', 'elegance'); ?></a>
    </div>
  </div>
</div>

<?php
  // echo '<pre>';
  // print_r($casino);
  // echo '</pre>';
?>
