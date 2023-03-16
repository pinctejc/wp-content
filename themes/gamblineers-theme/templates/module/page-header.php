<?php

//echo '<pre>#';
//print_r($module);
//echo '#</pre>';

$settings['class'] .= ' ph pt-u-md-50 pt-20 pb-o-xs-30 ps-r';
$first_cta = CF_Helpers_Common::button($module['first_button']);
$second_cta = CF_Helpers_Common::button($module['second_button']);

$space_bottom = ' pb-u-sm-190';

// if ( $first_cta || $second_cta || $module['box'] !== '0'  ) {
//   $space_bottom = ' pb-u-sm-170';
// }

$settings['class'] .= $space_bottom;

cf_enqueue_module_assets($view, $defer);
do_action('before_module', ['settings' => $settings]);
  if ($module['breadcrumbs']) cf_get_template('breadcrumbs.php', CF_TEMPLATES_DIR);
?>
  <div class="container">
    <div class="row-u-md">
      <div class="<?php echo $module['box'] !== '0' ? 'col-u-lg-8 col-o-md-7 pr-u-lg-80' : 'col-u-md' ?>">
        <h1 class="h1 mb-d-sm-20 ta-o-xs-c"><?php echo CF_Helpers_Common::display_title($module['title'], null, false); ?>
          <?php if ( $module['title']['subtitle'] ): ?>
            <span class="d-b tc-d ta-o-xs-c fw-m fs-u-sm-26 fs-o-xs-24 mt-u-sm-15 mt-o-xs-10"><?php echo $module['title']['subtitle']; ?></span>
          <?php endif; ?>
        </h1>

        <?php if ( $module['box'] === '4' && $module['image'] ) : ?>
          <div class="d-u-md-n">
            <?php cf_get_template('image.php', CF_TEMPLATES_BOXES_DIR, ['image' => $module['image']]); ?>
          </div>
        <?php endif; ?>

        <?php if ( $module['content'] ) : ?>
          <div class="wp-editor mt-u-sm-30 mt-o-xs-10"><?php echo $module['content']; ?></div>
        <?php endif; ?>

        <?php if ( is_404() ) : ?>
          <form action="<?php echo home_url( '/' ); ?>" class="ph__form d-f mt-30 bg-w br-p bg-w">
            <input type="text" name="s" placeholder="Search" class="h-u-sm-60 h-o-xs-46 tc-d px-u-sm-25 px-o-xs-15">
            <button class="bg-p br-c w-u-sm-60 w-o-xs-46 h-u-sm-60 h-o-xs-46"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M16.0312 9.56251C16.0312 10.412 15.8639 11.2532 15.5388 12.038C15.2137 12.8228 14.7372 13.5359 14.1366 14.1366C13.5359 14.7372 12.8228 15.2138 12.038 15.5389C11.2531 15.8639 10.412 16.0313 9.56248 16.0313C8.71299 16.0313 7.87182 15.8639 7.08699 15.5389C6.30217 15.2138 5.58906 14.7372 4.98838 14.1366C4.3877 13.5359 3.91122 12.8228 3.58613 12.038C3.26104 11.2532 3.09373 10.412 3.09373 9.56251C3.09373 7.84688 3.77525 6.20154 4.98838 4.98842C6.20151 3.77528 7.84685 3.09376 9.56248 3.09376C11.2781 3.09376 12.9234 3.77528 14.1366 4.98842C15.3497 6.20154 16.0312 7.84688 16.0312 9.56251ZM14.8525 16.3763C13.1194 17.7218 10.9387 18.3561 8.75432 18.1503C6.56994 17.9446 4.54609 16.914 3.09481 15.2685C1.64351 13.623 0.873872 11.4863 0.942555 9.29334C1.01125 7.10036 1.91311 5.01599 3.46453 3.46457C5.01597 1.91314 7.10033 1.01128 9.29331 0.942586C11.4863 0.873898 13.623 1.64354 15.2685 3.09484C16.914 4.54613 17.9446 6.56997 18.1503 8.75435C18.3561 10.9387 17.7217 13.1194 16.3762 14.8525L20.7462 19.2225C20.8522 19.3213 20.9371 19.4403 20.9961 19.5725C21.055 19.7048 21.0866 19.8475 21.0892 19.9923C21.0918 20.137 21.0651 20.2808 21.0109 20.4151C20.9567 20.5493 20.8759 20.6712 20.7736 20.7736C20.6712 20.8761 20.5493 20.9567 20.415 21.0109C20.2808 21.0651 20.137 21.0918 19.9923 21.0892C19.8475 21.0867 19.7046 21.055 19.5725 20.9961C19.4403 20.9372 19.3213 20.8522 19.2225 20.7463L14.8525 16.3763Z" fill="white"/></svg></button>
          </form>
        <?php endif; ?>

        <?php if ( $first_cta || $second_cta ) : ?>
          <div class="btn-group mt-u-sm-35 mt-o-xs-12">
            <?php if ( $first_cta ) : ?>
              <a href="<?php echo $first_cta['action']; ?>" class="btn w-u-sm-200 fs-o-xs-14 <?php echo $first_cta['classes']; ?>"><?php echo $first_cta['label']; ?></a>
            <?php endif; ?>

            <?php if ( $second_cta ) : ?>
              <a href="<?php echo $second_cta['action']; ?>" class="btn w-u-sm-200 fs-o-xs-14 <?php echo $second_cta['classes']; ?>"><?php echo $second_cta['label']; ?></a>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>

      <?php if ( $module['box'] !== '0' ) : ?>
        <div class="col-u-lg-4 col-o-md-5 mt-o-sm-40 mt-o-xs-20 <?php echo $module['box'] === '4' && $module['image'] ? 'd-d-sm-n' : null; ?>">
          <?php
            if ( $module['box'] === '1' ) :
              cf_get_template('casinos.php', CF_TEMPLATES_BOXES_DIR, [
                'title'  => $module['box_title'],
                'params' => $module['top_casinos'],
              ]);
            elseif ( $module['box'] === '2' ) :
              cf_get_template('news.php', CF_TEMPLATES_BOXES_DIR, [
                'title'  => $module['box_title'],
                'params' => $module['news'],
              ]);
            elseif ( $module['box'] === '3' ) :
              cf_get_template('crypto.php', CF_TEMPLATES_BOXES_DIR, [
                'title' => $module['box_title'],
                'coins' => $module['crypto_coins'],
              ]);
            elseif ( $module['box'] === '4' && $module['image'] ) :
              cf_get_template('image.php', CF_TEMPLATES_BOXES_DIR, ['image' => $module['image']]);
            elseif ( $module['box'] === '5' ) :
              cf_get_template('calculator.php', CF_TEMPLATES_BOXES_DIR);
            elseif ( $module['box'] === '6' ) :
              cf_get_template('white-box.php', CF_TEMPLATES_BOXES_DIR, [
                'title'  => $module['box_title'],
                'images' => $module['white_box_images'],
              ]);
            elseif ( $module['box'] === '7' ) :
              cf_get_template('newsletter.php', CF_TEMPLATES_BOXES_DIR, [
                'module'  => $module['module_type'] === '1' ? $module['newsletter'] : get_fields($module['module']),
                'settings' => $module['newsletter_settings']['settings']
              ]);
            endif;
          ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
<?php
do_action('after_module');