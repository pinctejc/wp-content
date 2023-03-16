<?php
$settings['class'] .= ' my-u-md-40 my-d-sm-20';
$banner_settings = CF_Helpers_Settings::get_settings($module);

// echo '<pre>';
// print_r($settings);
// echo '</pre>';

cf_enqueue_module_assets($view, $defer);
do_action('before_module', [ 'settings' => $settings]);
?>
  <div class="container">
    <div class="bnr d-o-xs-f f-o-xs-c jc-o-xs-c py-u-sm-30 py-o-xs-70 px-u-lg-100 px-o-md-80 px-o-sm-30 px-o-xs-12 br-20 ta-o-xs-c <?php echo $banner_settings['class']; ?>" <?php echo $banner_settings['data']; ?>>
      <div class="row-u-sm ai-u-sm-c">
        <div class="col-u-sm">
          <?php echo CF_Helpers_Common::display_title($module['title'], 'mb-15 fs-u-sm-44 fs-o-xs-34 fw-bl'); ?>
          <?php if ( $module['title']['subtitle'] ) : ?>
            <p class="mb-15 tc-in fs-u-sm-30 fs-o-xs-24"><?php echo $module['title']['subtitle']; ?></p>
          <?php endif; ?>

          <?php if ( $module['content'] ) : ?>
            <p class="fs-18"><?php echo $module['content']; ?></p>
          <?php endif; ?>
        </div>

        <?php if ( $cta = CF_Helpers_Common::button($module['button']) ) : ?>
          <div class="col-u-sm-auto mt-o-xs-20">
            <a href="<?php echo $cta['action'] ?>" class="btn w-200 fs-20 fw-bl <?php echo $cta['classes']; ?>"><?php echo $cta['label']; ?></a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
<?php
do_action('after_module');
