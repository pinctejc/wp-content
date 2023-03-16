<?php
  $settings['class'] .= ' py-u-sm-40 py-o-xs-30 of-h';

  // echo '<pre>';
  // print_r($module);
  // echo '</pre>';
  cf_enqueue_module_assets($view, $defer);
  do_action('before_module', ['settings' => $settings]);
?>
    <div class="container">
      <?php
        $half = ceil(count($module['faq']) / 2);
        $first = array_slice($module['faq'], 0, $half);
        $second = array_slice($module['faq'], $half);
      ?>

      <div class="row-u-md">
        <div class="col-u-md mb-d-sm-20">
          <?php
            foreach ($first as $faq) :
              cf_get_template('faq.php', CF_TEMPLATES_LOOP_DIR, ['faq' => $faq]);
            endforeach;
          ?>
        </div>

        <div class="col-u-md">
          <?php
            foreach ($second as $faq) :
              cf_get_template('faq.php', CF_TEMPLATES_LOOP_DIR, ['faq' => $faq]);
            endforeach;
          ?>
        </div>
      </div>
    </div>
<?php
  do_action('after_module');
