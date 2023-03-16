<?php
$settings['class'] .= ' py-u-sm-30 py-o-xs-20';

cf_enqueue_module_assets($view, $defer);
do_action('before_module', ['settings' => $settings]);
?>
  <div class="container">
    <div class="title col-u-lg-7 mb-30 mx-u-lg-a ta-c">
      <?php CF_Helpers_Common::display_title($module['ht_title'], 'h2'); ?>

      <?php if ($module['ht_title']['subtitle']) : ?>
        <p class="wp-editor mt-15"><?php echo $module['ht_title']['subtitle']; ?></p>
      <?php endif; ?>
    </div>

    <div class="mb-n30">
      <?php
        $i = 1;

        foreach ($module['ht_steps'] as $step) :
          cf_get_template('how-to-step.php', CF_TEMPLATES_LOOP_DIR, [
            'step' => $step,
            'index' => $i
          ]);
          $i++;
        endforeach
      ?>
    </div>
  </div>
<?php
do_action('after_module');
cf_get_template('how-to.php', CF_TEMPLATES_DIR . 'schema/', ['module' => $module]);