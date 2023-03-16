<footer class="footer fw-m fs-14 bg-l">
  <div class="container py-u-md-70 py-d-sm-25">
    <div class="row-u-md">
      <div class="col-u-md-5">
        <?php if ($logo = get_option( 'options_f_logo' )) : ?>
          <a href="<?php echo esc_url(home_url('/')); ?>" class="d-ib mb-25"><?php echo wp_get_attachment_image($logo, 'full', false, ['class' => 'wa mh-100p']); ?></a>
        <?php endif; ?>

        <?php if ($text = get_option( 'options_f_text' )) : ?>
          <div class="wp-editor mb-25"><?php echo $text; ?></div>
        <?php endif; ?>

        <?php
          if ($count_socials = get_option( 'options_social_media' )) :
            $socials = [];
            for ($i = 0; $i < $count_socials; $i++) {
              $socials[] = [
                'icon' => get_option( 'options_social_media_'. $i .'_icon' ),
                'url' => get_option( 'options_social_media_'. $i .'_url' ),
              ];
            }
        ?>
          <div class="socials d-f mb-d-sm-25 ai-c mx-n5">
            <p class="mx-5"><?php _e('Find us:', 'elegance'); ?></p>
            <?php foreach($socials as $media) : ?>
              <a href="<?php echo $media['url']; ?>" target="_blank" rel="nofollow noopener noreferrer" class="mx-5"><?php echo wp_get_attachment_image($media['icon'], 'CF_social', true); ?></a>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

      <?php if ($menu_1 = get_option( 'options_f_menu_1' )) : $menu_1 = wp_get_nav_menu_object($menu_1); ?>
        <div class="col-u-md">
          <button type="button" data-parent=".col-u-md" class="f-menu-title d-b mb-u-md-25 py-d-sm-10 w-100p fs-u-md-18 fs-d-sm-16 tc-d fw-b ta-l js-state"><?php echo $menu_1->name; ?></button>
          <?php
            wp_nav_menu([
              'menu' => $menu_1,
              'container' => null,
              'menu_id' => 'f-menu-1',
              'menu_class' => 'f-menu'
            ]);
          ?>
        </div>
      <?php endif; ?>

      <?php if ($menu_2 = get_option( 'options_f_menu_2' )) : $menu_2 = wp_get_nav_menu_object($menu_2); ?>
        <div class="col-u-md">
          <button type="button" data-parent=".col-u-md" class="f-menu-title d-b mb-u-md-25 py-d-sm-10 w-100p fs-u-md-18 fs-d-sm-16 tc-d fw-b ta-l js-state"><?php echo $menu_2->name; ?></button>
          <?php
            wp_nav_menu([
              'menu' => $menu_2,
              'container' => null,
              'menu_id' => 'f-menu-2',
              'menu_class' => 'f-menu'
            ]);
          ?>
        </div>
      <?php endif; ?>

      <?php if ($menu_3 = get_option( 'options_f_menu_3' )) : $menu_3 = wp_get_nav_menu_object($menu_3); ?>
        <div class="col-u-md">
          <button type="button" data-parent=".col-u-md" class="f-menu-title d-b mb-u-md-25 py-d-sm-10 w-100p fs-u-md-18 fs-d-sm-16 tc-d fw-b ta-l js-state"><?php echo $menu_3->name; ?></button>
          <?php
            wp_nav_menu([
              'menu' => $menu_3,
              'container' => null,
              'menu_id' => 'f-menu-3',
              'menu_class' => 'f-menu'
            ]);
          ?>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <div class="copyrights py-o-xs-5 fs-14 fw-n bg-pv tc-w ta-o-xs-c">
    <div class="container">
      <div class="row-u-sm ai-u-sm-c">
        <?php
          if ($count_recoms = get_option( 'options_recommendations' )) :
            for ($i = 0; $i < $count_recoms; $i++) {
              $recoms[] = [
                'icon' => get_option( 'options_recommendations_'. $i .'_icon' ),
                'url' => get_option( 'options_recommendations_'. $i .'_url' ),
              ];
            }
        ?>
          <div class="col-u-sm d-f ai-c jc-o-xs-c f-w py-u-sm-12 py-o-xs-8">
            <?php foreach ($recoms as $item) : ?>
              <div class="mx-5">
                <?php if ($item['url']) : ?>
                  <a href="<?php echo $item['url']; ?>" target="_blank" rel="nofollow noopener noreferrer">
                    <?php echo wp_get_attachment_image($item['icon'], 'full', true); ?>
                  </a>
                <?php else: ?>
                  <?php echo wp_get_attachment_image($item['icon'], 'full', true); ?>
                <?php endif; ?>
              </div>
            <?php endforeach ?>
          </div>
        <?php endif; ?>
        <p class="col-u-sm ta-c py-u-sm-12 py-o-xs-8"><?php the_field( 'copyrights', 'options' ); ?></p>
        <p class="col-u-sm ta-u-sm-r py-u-sm-12 py-o-xs-8">Made with <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.655 14.4159C7.65523 14.4161 7.65543 14.4162 8 13.75C8.34457 14.4162 8.34477 14.4161 8.34501 14.4159C8.12889 14.5277 7.87111 14.5277 7.655 14.4159ZM7.655 14.4159L8 13.75L8.34501 14.4159L8.34731 14.4147L8.35269 14.4119L8.37117 14.4022C8.38687 14.3939 8.40926 14.382 8.4379 14.3665C8.49516 14.3356 8.57746 14.2904 8.6812 14.2317C8.8886 14.1142 9.18229 13.942 9.53358 13.7199C10.2346 13.2767 11.1728 12.63 12.1147 11.8181C13.9554 10.2312 16 7.85031 16 5C16 2.33579 13.9142 0.5 11.75 0.5C10.2026 0.5 8.84711 1.30151 8 2.51995C7.15289 1.30151 5.79736 0.5 4.25 0.5C2.08579 0.5 0 2.33579 0 5C0 7.85031 2.04459 10.2312 3.8853 11.8181C4.82717 12.63 5.76538 13.2767 6.46642 13.7199C6.81771 13.942 7.1114 14.1142 7.3188 14.2317C7.42254 14.2904 7.50484 14.3356 7.5621 14.3665C7.59074 14.382 7.61313 14.3939 7.62883 14.4022L7.64731 14.4119L7.65269 14.4147L7.655 14.4159Z" fill="#FF51B0"/></svg> by <a href="https://elegancedesign.net/" target="_blank" rel="nofollow" class="fw-b tc-in"> E-legance.net</a></p>
      </div>
    </div>
  </div>
</footer>
