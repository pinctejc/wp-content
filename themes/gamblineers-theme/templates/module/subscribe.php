<?php

//echo '<pre>';
//print_r($module);
//echo '</pre>';

$settings['class'] .= ' subscribe foc py-u-sm-30 py-o-xs-50 mb-50';

cf_enqueue_module_assets($view, $defer);
do_action('before_module', ['settings' => $settings]);
?>
  <div class="container">
    <div class="col-u-md-8 px-0 mx-u-md-a ta-c">
      <?php echo CF_Helpers_Common::display_title($module['title'], 'h2 mb-25 fw-bl') ?>
      <?php if ( $module['title']['subtitle'] ) : ?>
        <p class="wp-editor fs-u-sm-18 tc-w"><?php echo $module['title']['subtitle']; ?></p>
      <?php endif; ?>

      <?php echo do_shortcode( $module['form_shortcode'] ); ?>
    </div>
  </div>
<?php
do_action('after_module');