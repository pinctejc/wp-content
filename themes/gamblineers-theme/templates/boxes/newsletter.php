<?php

$layout = null;
$defer = false;

if (isset($settings)) :
  $defer    = $settings['defer'];
  $settings = CF_Helpers_Settings::get_settings($settings);
endif;

$settings['class'] .= ' subscribe foc py-u-sm-30 py-o-xs-50 mb-50 br-12 ta-c';

cf_enqueue_module_assets('subscribe', $defer);
do_action('before_module', ['settings' => $settings]);
?>
  <div class="container">
    <div class="g_hdr-sub col-u-md-8 px-0 mx-u-md-a">
      <?php echo CF_Helpers_Common::display_title($module['title'], 'h2 mb-25 fw-bl') ?>
      <?php if ( $module['title']['subtitle'] ) : ?>
        <p class="wp-editor fs-u-sm-18 pb-10 tc-w"><?php echo $module['title']['subtitle']; ?></p>
      <?php endif; ?>

      <?php echo do_shortcode( $module['form_shortcode'] ); ?>
    </div>
  </div>
<?php
do_action('after_module');