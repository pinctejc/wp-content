<?php
global $dependencies;

$faq_index = 0;
$faqs = [];


foreach ($modules as $module) :
  $settings = null;
  $layout = null;
  $defer = false;

  $view = str_replace("_","-", $module['acf_fc_layout']);

  if (isset($module['settings'])) :
    $settings = CF_Helpers_Settings::get_settings($module['settings']);
    $defer = $module['settings']['defer'];
  endif;

  $module = CF_Helpers_Settings::get_module($module);

  cf_get_template($view . '.php', CF_TEMPLATES_MODULE_DIR, [
    'view'         => $view,
    'module'       => $module,
    'settings'     => $settings,
    'defer'        => $defer
  ]);

  if ( $view === 'faq' ) :
    $faqs = array_merge($faqs, $module['faq']);
    $faq_index ++;
  endif;
endforeach;

if ($faq_index > 0) :
  add_action('wp_footer', function() use ($faqs) {
    cf_get_template('faq.php', CF_TEMPLATES_DIR . '/schema/', ['faqs' => $faqs ]);
  });
endif;
