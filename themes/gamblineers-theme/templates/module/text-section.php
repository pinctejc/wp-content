<?php
  $settings['class'] .= ' ts of-h my-30';
  // echo '<pre>';
  // print_r($module);
  // echo '</pre>';

  if ($module['blocks']) :

  $layout = CF_Helpers_Common::layout($module['layout']);

  cf_enqueue_module_assets($view, $defer);
  do_action('before_module', ['settings' => $settings]);
?>
    <div class="container">
      <?php echo $layout ? '<div class="'. $layout .'">' : null; ?>
        <?php
          $i = 0;
          foreach ($module['blocks'] as $block) :
            cf_get_template('text-block.php', CF_TEMPLATES_LOOP_DIR, [
              'block' => $block,
              'layout' => $layout ? 'col ' : null,
              'i' => $i
            ]);
            $i++;
          endforeach;
        ?>
      <?php echo $layout ? '</div>' : null; ?>
    </div>
<?php
  do_action('after_module');

  endif;
?>
