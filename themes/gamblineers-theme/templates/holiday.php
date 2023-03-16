<?php
  if ( get_field( 'holiday', 'options' ) ) :
    cf_enqueue_asset('holiday', true);
?>
  <div class="holiday w-40 h-40 ps-f">
    <?php if ( $link = CF_Helpers_Common::button(get_field( 'holiday_link', 'options' )) ) : ?>
      <a href="<?php echo $link['action']; ?>" class="<?php echo $link['classes']; ?>">
    <?php endif; ?>
    <?php echo wp_get_attachment_image( get_field( 'holiday_icon', 'options' ), 'full' ); ?>
    <?php if ( $link ) : ?></a><?php endif; ?>
  </div>
<?php endif; ?>
