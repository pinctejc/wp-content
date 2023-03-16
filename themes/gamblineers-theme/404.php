<?php
  if ( $modules = get_field( '404_page', 'options' ) ) :
    cf_get_template('modular.php', CF_TEMPLATES_DIR, [ 'modules' => $modules['modules'] ]);
  endif;
