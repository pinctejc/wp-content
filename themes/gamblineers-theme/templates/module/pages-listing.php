<?php
$settings['class'] .= ' my-30';

// echo '<pre>';
// print_r($module);
// echo '</pre>';

cf_enqueue_module_assets($view, $defer);
do_action('before_module', ['settings' => $settings]);
?>
  <div class="container">
    <div class="row-u-sm mb-n20">
      <?php foreach ($module['pages'] as $page) { ?>
        <?php cf_get_template('page-card.php', CF_TEMPLATES_LOOP_DIR, ['page' => $page]); ?>
      <?php } ?>
    </div>
  </div>
<?php
do_action('after_module');
