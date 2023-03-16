<?php
$settings['class'] .= ' my-30';

cf_enqueue_module_assets($view, $defer);
do_action('before_module', [ 'settings' => $settings]);
?>
  <div class="container">
    <div class="row-u-md mx-u-md-n10">
      <div class="col-content col-u-md px-u-md-10 order-u-md-2">
        <?php
          if ( $module['modules'] )
            cf_get_template('modular.php', CF_TEMPLATES_DIR, ['modules' => $module['modules']]);
        ?>
      </div>
      <div class="col-sidebar px-u-md-10 order-u-md-1 ps-r">
        <div class="ps-u-sm-st" style="top: <?php echo is_user_logged_in(  ) ? '135px' : '105px'; ?>">
          <?php
            if ( $module['sidebar'] )
              cf_get_template('modular.php', CF_TEMPLATES_DIR, ['modules' => $module['sidebar']]);
          ?>
        </div>
      </div>
    </div>
  </div>
<?php
do_action('after_module');
