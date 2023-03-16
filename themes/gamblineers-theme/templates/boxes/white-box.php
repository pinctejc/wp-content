<div class="ph__wb p-20 br-12 ta-c bg-w">
  <?php if ( $title ) : ?>
    <p class="fs-24 mb-30 fw-b tc-d"><?php echo $title; ?></p>
  <?php endif; ?>

  <?php if ( $images ) : ?>
    <div class="row ai-c mt-n20">
      <?php foreach ($images as $item) { ?>
        <div class="col-6 mt-20">
          <?php if ( $item['url'] ) ?><a href="<?php echo $item['url']; ?>" <?php echo isset($item['nofollow']) && $item['nofollow'] ? 'rel="nofollow"' : null; ?>>
          <?php echo wp_get_attachment_image( $item['image'], 'full' ); ?>
          <?php if ( $item['url'] )  ?></a>
        </div>
      <?php } ?>
    </div>
  <?php endif; ?>
</div>
