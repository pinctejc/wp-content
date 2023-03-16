<?php
  $settings['class'] .= 'mb-30';
  $author_id = get_the_author_meta('ID');
  $author_name = get_the_author();
  $author_name_words = explode(' ', $author_name);
  $fb = get_user_meta( $author_id, 'facebook', true );
  $tw = get_user_meta( $author_id, 'twitter', true );
  $in = get_user_meta( $author_id, 'linkedin', true );
  $role = get_field('user_role', 'user_' . $author_id);

  cf_enqueue_module_assets($view, $defer);
  do_action('before_module', [ 'settings' => $settings]);
?>

  <div class="container">
    <div class="br-16 bg-l p-u-sm-30 p-o-xs-12">
      <div class="row-u-sm mb-u-sm-20">
        <div class="col-u-sm mb-o-xs-10">
          <div class="row ai-c mx-n8">
            <div class="col-auto px-8">
              <abbr title="<?php echo $author_name; ?>" class="foc w-u-sm-60 w-o-xs-46 h-u-sm-60 h-o-xs-46 td-n tc-w fw-b tt-u fs-u-sm-20 fs-o-xs-18 br-c bg-pv">
                <?php foreach ($author_name_words as $w ) {
                  echo $w[0];
                } ?>
              </abbr>
            </div>
            <div class="col px-8">
              <p class="mb-u-sm-10 mb-o-xs-5 fs-14"><?php _e('Author', 'elegance'); ?></p>
              <p class="fs-u-sm-14 tc-d"><strong class="fs-u-sm-20 fs-o-xs-16"><?php echo $author_name; ?></strong> | <?php echo $role; ?></p>
            </div>
          </div>
        </div>
        <?php if ( $fb || $tw || $in ) : ?>
          <div class="col-u-sm-auto mx-n5 mb-o-xs-10 d-f">
            <?php if ( $fb ) : ?>
              <a href="<?php echo $fb ?>" target="_blank" rel="nofollow" class="mx-5"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 24C18.6274 24 24 18.6274 24 12C24 5.37258 18.6274 0 12 0C5.37258 0 0 5.37258 0 12C0 18.6274 5.37258 24 12 24ZM12.7459 12.387H14.5107L14.7443 9.99483H12.746V8.58566C12.746 8.0571 13.0775 7.933 13.3132 7.933H14.7503V5.60883L12.7697 5.6001C10.5715 5.6001 10.072 7.33514 10.072 8.44316V9.99261H8.80029V12.387H10.072V19.2001H12.7459V12.387Z" fill="#303030"/></svg></a>
            <?php endif; ?>

            <?php if ( $tw ) : ?>
              <a href="<?php echo $tw ?>" target="_blank" rel="nofollow" class="mx-5"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 24C18.6274 24 24 18.6274 24 12C24 5.37258 18.6274 0 12 0C5.37258 0 0 5.37258 0 12C0 18.6274 5.37258 24 12 24ZM9.34138 17.8003C7.67098 17.8003 6.11271 17.334 4.79906 16.5282C7.21644 16.8503 9.17623 15.3181 9.17623 15.3181C6.88799 15.1459 6.43586 13.3042 6.43586 13.3042C7.24436 13.4365 7.75115 13.2509 7.75115 13.2509C5.17561 12.6681 5.39469 10.3887 5.39469 10.3887C5.99113 10.7333 6.68247 10.76 6.68247 10.76C4.40822 8.82521 5.83326 6.94369 5.83326 6.94369C8.21766 9.73634 11.7226 9.92639 11.9527 9.93552C11.9022 9.72561 11.8755 9.507 11.8755 9.28239C11.8755 7.6907 13.2101 6.40031 14.8571 6.40031C15.7157 6.40031 16.4893 6.75092 17.0335 7.31265C17.1844 7.27173 17.3307 7.22757 17.4704 7.18267C18.3147 6.91035 18.9177 6.59907 18.9177 6.59907C18.7722 7.44221 17.6973 8.14984 17.6205 8.19952C17.6176 8.20149 17.616 8.20229 17.616 8.20229L17.6213 8.20191C18.4556 8.12119 19.3082 7.77854 19.3082 7.77854C19.0508 8.30169 18.001 9.11546 17.8313 9.24465C17.8358 9.35678 17.8383 9.46925 17.8383 9.58256C17.8383 14.1208 14.0342 17.8003 9.34138 17.8003Z" fill="#303030"/></svg></a>
            <?php endif; ?>

            <?php if ( $in ) : ?>
              <a href="<?php echo $in ?>" target="_blank" rel="nofollow" class="mx-5"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 24C18.6274 24 24 18.6274 24 12C24 5.37258 18.6274 0 12 0C5.37258 0 0 5.37258 0 12C0 18.6274 5.37258 24 12 24ZM13.0131 10.1666C13.623 9.54659 14.4361 9.13326 15.3508 9.13326C17.0787 9.13326 18.4 10.4766 18.4 12.2333V17.3999H15.859V12.6466C15.859 11.8199 15.2492 11.1999 14.4361 11.1999C13.623 11.1999 13.0131 11.8199 13.0131 12.6466V17.3999H10.1672V9.13326H13.0131V10.1666ZM8.74426 17.3999H6.20328V9.13326H8.74426V17.3999ZM6 6.54992C6 5.72326 6.71148 4.99992 7.52459 4.99992C8.3377 4.99992 9.04918 5.72326 9.04918 6.54992C9.04918 7.37659 8.3377 8.09992 7.52459 8.09992C6.71148 8.09992 6 7.37659 6 6.54992Z" fill="#303030"/></svg></a>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="wp-editor fs-14"><?php the_author_meta('description'); ?></div>
    </div>
  </div>
<?php do_action('after_module');
