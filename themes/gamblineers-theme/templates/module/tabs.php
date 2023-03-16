<?php
  $settings['class'] .= ' my-50';

  // echo '<pre>';
  // print_r($module);
  // echo '</pre>';

  cf_enqueue_module_assets($view, $defer);
  do_action('before_module', ['settings' => $settings]);
?>
  <div class="container px-o-xs-0 js-tabs">
    <div class="tabs__btns d-f f-w fw-b br-t-u-sm-14 fs-u-sm-14 fs-o-xs-12">
      <?php
        $i = 0;
        foreach ($module['tabs'] as $tab) {
      ?>
        <button type="button" data-tab=".tap-<?php echo $i; ?>" class="tabs__btn p-u-sm-20 py-o-xs-15 px-o-xs-5 ps-r tc-h-u-sm-w bg-h-u-sm-n br-t-o-xs-8 js-tab-btn <?php echo $i === 0 ? 'active': null; ?>"><?php echo $tab['name']; ?></button>
      <?php
          $i++;
        }
      ?>
    </div>

    <?php
      $i = 0;
      foreach ($module['tabs'] as $tab) {
    ?>
      <div class="tab tap-<?php echo $i; ?> wp-editor p-20 pb-25 br-b-14 bg-l <?php echo $i === 0 ? 'active': null; ?> js-tab"><?php echo $tab['content']; ?></div>
    <?php
        $i++;
      }
    ?>
  </div>
<?php
  do_action('after_module');
