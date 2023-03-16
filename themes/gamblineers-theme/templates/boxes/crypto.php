<?php $currency = get_cryptowp('currency_sign'); ?>

<div class="ph__box">
  <?php if ( count($coins) > 1 && $title ) : ?>
    <p class="ph__box__title mb-10 foc pt-4 pb-6 fw-b fs-18 ta-c tc-w br-t-20"><?php echo $title; ?></p>
  <?php endif; ?>

  <?php
    foreach ($coins as $coin) {
      cf_get_template('coin.php', CF_TEMPLATES_LOOP_DIR . 'boxes/', [
        'currency' => $currency,
        'coin'     => $coin['coin']
      ]);
    }
  ?>
</div>
