<?php
  while(have_posts()) : the_post();
    get_template_part(CF_TEMPLATES_DIR . 'content-single', get_post_type());
  endwhile;