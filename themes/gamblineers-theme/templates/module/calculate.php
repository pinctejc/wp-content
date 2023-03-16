<?php
  $settings['class'] .= ' calc my-10 of-h';

  // echo '<pre>';
  // print_r($module);
  // echo '</pre>';

  cf_enqueue_module_assets($view, $defer);
  do_action('before_module', ['settings' => $settings]);
?>
  <div class="container">
    <div class="px-u-sm-25 px-o-xs-12 br-14 bg-l">
      <div class="row mx-n5 ai-c">
        <?php if ( $module['image'] ) : ?>
          <figure class="col-u-md-2 col-o-sm-3 col-o-xs-auto ta-u-lg-c px-5"><?php echo wp_get_attachment_image( $module['image'], 'full' ); ?></figure>
        <?php endif; ?>
        <div class="col pt-u-sm-15 pb-u-sm-20 py-10 px-5">
          <?php if ( $module['text'] ) : ?>
            <p class="mb-10 fs-18"><?php echo $module['text']; ?></p>
          <?php endif; ?>
          <?php if ( $module['formula'] ) : ?>
            <p class="fs-u-sm-44 fs-o-xs-30">$$<?php echo $module['formula']; ?>$$</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
<?php
  do_action('after_module');
?>
<script async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-svg.js"></script>
<script>
  MathJax = {
    // tex: {inlineMath: [['$', '$'], ['\\(', '\\)']]},
    svg: {fontCache: 'global'},
    renderMathML(math, doc) {
      math.typesetRoot = document.createElement('mjx-container');
      math.typesetRoot.innerHTML = MathJax.startup.toMML(math.root);
      math.display && math.typesetRoot.setAttribute('display', 'block');
    }
  };
</script>