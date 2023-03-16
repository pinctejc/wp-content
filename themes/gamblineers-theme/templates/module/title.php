<?php
  $settings['class'] .= ' title mt-25';

  // echo '<pre>';
  // print_r($module);
  // echo '</pre>';

  cf_enqueue_module_assets($view, $defer);
  do_action('before_module', ['settings' => $settings]);
?>
  <div class="container">
    <?php CF_Helpers_Common::display_title($module, 'mb-20 ta-o-xs-c'); ?>

    <?php if ($module['subtitle']) : ?>
      <p class="wp-editor"><?php echo $module['subtitle']; ?></p>
    <?php endif; ?>
  </div>
<?php
  do_action('after_module');
?>
