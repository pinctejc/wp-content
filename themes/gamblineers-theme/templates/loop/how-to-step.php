<div class="mb-30 pr-u-sm-15 bg-l br-14 ps-r">
  <span class="ht__index ml-u-sm-20 ml-o-xs-12 mt-u-sm-n5 mt-o-xs-n15 py-10 px-u-sm-25 px-o-xs-10 tt-u tc-w fw-bl fs-u-sm-13 fs-o-xs-12 br-p ps-a <?php echo $index === 1 ? 'bg-p' : ($index === 2 ? 'bg-s' : 'bg-pv') ; ?>"><?php echo wp_sprintf( __('Step %d', 'elegance'), $index ); ?></span>
  <div class="row-u-sm ai-u-sm-c mx-o-xs-0">
    <?php if ($step['graphic']) : ?>
      <figure class="ht__img col-u-md-2 col-o-sm-3 px-o-xs-0 ta-c ps-o-xs-a of-h">
        <?php echo wp_get_attachment_image($step['graphic'], 'full', false, ['class' => 'mt-o-xs-n20']); ?>
      </figure>
    <?php endif; ?>

    <div class="col-u-sm py-u-sm-30 py-o-xs-25 px-o-xs-12">
      <?php if ($step['title']) : ?>
        <?php CF_Helpers_Common::display_title($step['title'], 'h3 mb-15 pl-o-xs-25 pr-o-xs-50 fw-u-sm-bl fw-o-xs-b'); ?>
      <?php endif; ?>

      <?php if ($step['content']) : ?>
        <div class="wp-editor"><?php echo $step['content']; ?></div>
      <?php endif; ?>
    </div>
  </div>
</div>
