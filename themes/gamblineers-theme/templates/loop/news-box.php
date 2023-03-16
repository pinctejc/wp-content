<article class="ln__box h-100p d-f f-c br-12 bg-l fs-14 ps-r bs-h-l">
  <figure class="ln__thumb of-h h-0 br-t-12 of-h ps-r">
    <?php
      if ( has_post_thumbnail() ) {
        the_post_thumbnail('news');
      } else if ($logo = get_option( 'options_h_logo' )) {
        echo wp_get_attachment_image($logo, 'full');
      }
    ?>
    <span class="ln__date py-8 px-12 ps-a fw-m fs-12 bg-pv tc-w br-8"><?php echo get_the_date('M d, Y') ?></span>
  </figure>
  <div class="p-u-sm-20 p-o-xs-15">
    <h3 class="h4 mb-u-sm-20 mb-o-xs-15 fw-bl"><?php the_title(); ?></h3>
    <div class="wp-editor tc-n">
      <p>
        <?php CF_Helpers_News::the_excerpt(get_the_id()); ?>
        <a href="<?php the_permalink(); ?>" class="l-str tc-pv fw-m fst-i"><?php _e('more', 'elegance'); ?><svg class="ml-5" width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.219668 0.219703C0.512558 -0.0731974 0.987438 -0.0731974 1.28033 0.219703L5.5303 4.46967C5.8232 4.76256 5.8232 5.23744 5.5303 5.53033L1.28033 9.78033C0.987438 10.0732 0.512558 10.0732 0.219668 9.78033C-0.0732225 9.48744 -0.0732225 9.01256 0.219668 8.71967L3.93934 5L0.219668 1.2803C-0.0732225 0.987403 -0.0732225 0.512603 0.219668 0.219703Z" fill="var(--primary-variant)"/></svg></a>
      </p>
    </div>
  </div>
</article>
