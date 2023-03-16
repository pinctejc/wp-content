<?php
  if ( $categories = get_terms(['taxonomy' => 'news-category', 'fields' => 'id=>name']) ) :
?>
  <div class="lnc d-f f-w mt-n10 mb-u-sm-40 mb-o-xs-20 mx-u-sm-n15 mx-o-xs-n10">
    <button type="button" data-term="" class="lnc__btn d-f ai-c h-46 m-10 px-18 fs-16 fw-m br-p tc-d bg-l bg-h-p tc-h-w js-cat-btn <?php echo $module['list_type'] !== '3' || ! $module['categories'] ? 'active' : null; ?>"><?php _e('All posts', 'elegance'); ?></button>
    <?php foreach ($categories as $id => $name) { ?>
      <button type="button" data-term="<?php echo $id; ?>" class="lnc__btn d-f ai-c h-46 m-10 px-18 fs-16 fw-m br-p bg-l tc-d bg-h-p tc-h-w js-cat-btn <?php echo $module['list_type'] === '3' && in_array($id, $module['categories']) ? 'active' : null; ?>"><?php echo $name; ?></a>
    <?php } ?>
  </div>
<?php endif; ?>
