<div id="details" class="rd mx-o-xs-n15 p-20 br-8 title">
  <h2 class="h3 mb-10 ta-o-xs-c"><?php _e('Review Details', 'elegance'); ?></h2>

  <div class="row-u-sm mx-u-sm-n10">
    <div class="col-u-lg-4 mb-d-md-20 px-u-sm-10">
      <div class="h-u-sm-100p px-15 py-5 fs-14 br-6 bg-l">
        <div class="rd__it row mx-0 py-12">
          <p class="col-auto pl-0 pr-5"><?php _e('Established', 'elegance'); ?>:</p>
          <?php if ( $casino['year_founded'] ) : ?>
            <p class="col pl-5 pr-5 tc-d fw-b ta-r"><?php echo $casino['year_founded']; ?></p>
          <?php endif; ?>
        </div>

        <div class="rd__it row mx-0 py-12">
          <p class="col-auto pl-0 pr-5"><?php _e('Casino type', 'elegance'); ?>:</p>
          <?php if ( $casino['casino_type'] ) : ?>
            <p class="col pl-5 pr-5 tc-d fw-b ta-r"><?php  echo CF_Helpers_Taxonomy::get_taxonomy_linked($casino['casino_type'], 'name'); ?></p>
          <?php endif; ?>
        </div>

        <div class="rd__it row mx-0 py-12">
          <p class="col-auto pl-0 pr-5"><?php _e('Casino licence', 'elegance'); ?>:</p>
          <?php if ( $casino['licenses'] ) : ?>
            <p class="col pl-5 pr-5 tc-d fw-b ta-r">
              <?php
                $i = 0;
                foreach ($casino['licenses'] as $term) {
                  echo ($i > 0 ? ', ' : null) . CF_Helpers_Taxonomy::get_taxonomy_linked($term, 'name');
                  $i++;
                }
              ?>
            </p>
          <?php endif; ?>
        </div>

        <div class="rd__it row mx-0 py-12">
          <p class="col-auto pl-0 pr-5"><?php _e('Number of games', 'elegance'); ?>:</p>
          <?php if ( $casino['casino_games'] ) : ?>
            <p class="col pl-5 pr-5 tc-d fw-b ta-r"><?php echo $casino['casino_games']; ?></p>
          <?php endif; ?>
        </div>

        <div class="rd__it row mx-0 py-12">
          <p class="col-auto pl-0 pr-5"><?php _e('Min. Deposit', 'elegance'); ?>:</p>
          <?php if ( $casino['minimum_deposit'] ) : ?>
            <p class="col pl-5 pr-5 tc-d fw-b ta-r"><?php echo $casino['minimum_deposit']; ?></p>
          <?php endif; ?>
        </div>

        <div class="rd__it row mx-0 py-12">
          <p class="col-auto pl-0 pr-5"><?php _e('Max. Deposit', 'elegance'); ?>:</p>
          <?php if ( $casino['maximum_deposit'] ) : ?>
            <p class="col pl-5 pr-5 tc-d fw-b ta-r"><?php echo $casino['maximum_deposit']; ?></p>
          <?php endif; ?>
        </div>

        <div class="rd__it row mx-0 py-12">
          <p class="col-auto pl-0 pr-5"><?php _e('Min. Withdrawal', 'elegance'); ?>:</p>
          <?php if ( $casino['minimum_withdrawal'] ) : ?>
            <p class="col pl-5 pr-5 tc-d fw-b ta-r"><?php echo $casino['minimum_withdrawal']; ?></p>
          <?php endif; ?>
        </div>

        <div class="rd__it row mx-0 py-12">
          <p class="col-auto pl-0 pr-5"><?php _e('Max. Withdrawal', 'elegance'); ?>:</p>
          <?php if ( $casino['maximum_withdrawal'] ) : ?>
            <p class="col pl-5 pr-5 tc-d fw-b ta-r"><?php echo $casino['maximum_withdrawal']; ?></p>
          <?php endif; ?>
        </div>

        <div class="rd__it row mx-0 py-12">
          <p class="col-auto pl-0 pr-5"><?php _e('Platforms', 'elegance'); ?>:</p>
          <?php if ( $casino['platforms'] ) : ?>
            <p class="col pl-5 pr-5 tc-d fw-b ta-r"><?php echo implode(', ', $casino['platforms']); ?></p>
          <?php endif; ?>
        </div>

        <div class="rd__it row mx-0 py-12">
          <p class="col-auto pl-0 pr-5"><?php _e('Support', 'elegance'); ?>:</p>
          <?php if ( $casino['support'] ) : ?>
            <p class="col pl-5 pr-5 tc-d fw-b ta-r"><?php echo $casino['support']; ?></p>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="col-u-lg-8 my-u-sm-n15 px-u-sm-10 fs-13">
      <div class="rd__it row-u-sm mx-0">
        <div class="rd__it__vd col-u-sm-6 my-u-sm-15 py-o-xs-15 pl-u-sm-0 pr-u-sm-15 px-o-xs-0">
          <p class="mb-15 fs-16 tc-d fw-b"><?php _e('Software (game) providers', 'elegance'); ?>:</p>
          <?php if ( $casino['software_providers'] ) : ?>
            <div class="row mx-n5 my-n8 ai-c">
              <?php $i = 0; foreach ($casino['software_providers'] as $term) { ?>
                <div class="rd__li col-4 my-8 px-5 <?php echo $i > 7 && count($casino['software_providers']) > 9 ? 'd-n' : null; ?>"><?php echo CF_Helpers_Taxonomy::get_taxonomy_linked($term, 'name'); ?></div>
              <?php $i++; } ?>
              <?php if ( $i > 9 ) : ?>
                <button class="rd__more fs-8 br-6 mx-5 fw-b bg-l tc-h-w bg-h-p js-state" data-parent="div">+<?php echo count($casino['software_providers']) - 8; ?></button>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>

        <div class="col-u-sm-6 my-u-sm-15 py-o-xs-15 pl-u-sm-15 pr-u-sm-0 px-o-xs-0">
          <p class="mb-15 fs-16 tc-d fw-b"><?php _e('Languages', 'elegance'); ?>:</p>
          <?php if ( $casino['languages'] ) : ?>
            <div class="row mx-n5 my-n8 ai-c">
              <?php $i = 0; foreach ($casino['languages'] as $term) { ?>
                <div class="rd__li col-4 my-8 px-5 <?php echo $i > 7 && count($casino['languages']) > 9 ? 'd-n' : null; ?>"><?php echo CF_Helpers_Taxonomy::get_taxonomy_linked($term, 'name'); ?></div>
              <?php $i++; } ?>
              <?php if ( $i > 9 ) : ?>
                <button class="rd__more fs-8 br-6 mx-5 fw-b bg-l tc-h-w bg-h-p js-state" data-parent="div">+<?php echo count($casino['languages']) - 8; ?></button>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="rd__it row-u-sm mx-0">
        <div class="rd__it__vd col-u-sm-6 my-u-sm-15 py-o-xs-15 pl-u-sm-0 pr-u-sm-15 px-o-xs-0">
          <p class="mb-15 fs-16 tc-d fw-b"><?php _e('Accepted Cryptocurrencies', 'elegance'); ?>:</p>
          <?php if ( $casino['cryptocurrencies'] ) : ?>
            <div class="row mx-n5 my-n8 ai-c">
              <?php $i = 0; foreach ($casino['cryptocurrencies'] as $term) { ?>
                <div class="rd__li col-4 my-8 px-5 <?php echo $i > 7 && count($casino['cryptocurrencies']) > 9 ? 'd-n' : null; ?>">
                  <div class="d-f ai-c">
                    <?php if ( $term['logo'] ) : ?>
                      <span class="mr-5">
                        <span class="rd__ci foc w-20 h-20 br-c of-h ps-r"><?php echo $term['logo']; ?></span>
                      </span>
                    <?php endif; ?>
                    <?php echo CF_Helpers_Taxonomy::get_taxonomy_linked($term, 'name'); ?>
                  </div>
                </div>
              <?php $i++; } ?>
              <?php if ( $i > 9 ) : ?>
                <button class="rd__more fs-8 br-6 mx-5 fw-b bg-l tc-h-w bg-h-p js-state" data-parent="div">+<?php echo count($casino['cryptocurrencies']) - 8; ?></button>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>

        <div class="col-u-sm-6 my-u-sm-15 py-o-xs-15 pl-u-sm-15 pr-u-sm-0 px-o-xs-0">
          <p class="mb-15 fs-16 fw-b tc-d"><?php _e('Restricted Countries', 'elegance'); ?>:</p>
          <?php if ( $casino['restricted'] ) : ?>
            <div class="row mx-n5 my-n8 ai-c">
              <?php $i = 0; foreach ($casino['restricted'] as $country) { ?>
                <div class="rd__li col-6 my-8 px-5 <?php echo $i > 4 && count($casino['restricted']) > 6 ? 'd-n' : null; ?>">
                  <div class="d-f ai-c">
                    <span class="mr-5">
                      <span class="rd__ci foc w-20 h-20 br-c of-h ps-r"><?php echo $country['flag']; ?></span>
                    </span>
                    <?php echo $country['name']; ?>
                  </div>
                </div>
              <?php $i++; } ?>
              <?php if ( $i > 6 ) : ?>
                <button class="rd__more fs-8 br-6 mx-5 fw-b bg-l tc-h-w bg-h-p js-state" data-parent="div">+<?php echo count($casino['restricted']) - 5; ?></button>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="rd__it row-u-sm mx-0">
        <div class="rd__it__vd col-u-sm-6 my-u-sm-15 py-o-xs-15 pl-u-sm-0 pr-u-sm-15 px-o-xs-0">
          <p class="mb-15 fs-16 tc-d fw-b"><?php _e('Accepted fiat currencies', 'elegance'); ?>:</p>
          <?php if ( $casino['currencies'] ) : ?>
            <div class="row mx-n5 my-n8 ai-c">
              <?php $i = 0; foreach ($casino['currencies'] as $term) { ?>
                <div class="rd__li col-4 my-8 px-5 <?php echo $i > 7 && count($casino['currencies']) > 9 ? 'd-n' : null; ?>">
                  <div class="d-f ai-c">
                    <?php if ( $term['logo'] ) : ?>
                      <span class="mr-5">
                        <span class="rd__ci foc w-20 h-20 br-c of-h ps-r"><?php echo $term['logo']; ?></span>
                      </span>
                    <?php endif; ?>
                    <?php echo CF_Helpers_Taxonomy::get_taxonomy_linked($term, 'name'); ?>
                  </div>
                </div>
              <?php $i++; } ?>
              <?php if ( $i > 9 ) : ?>
                <button class="rd__more fs-8 br-6 mx-5 fw-b bg-l tc-h-w bg-h-p js-state" data-parent="div">+<?php echo count($casino['currencies']) - 8; ?></button>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>

        <div class="col-u-sm-6 my-u-sm-15 py-o-xs-15 pl-u-sm-15 pr-u-sm-0 px-o-xs-0">
          <p class="mb-15 fs-16 fw-b tc-d"><?php _e('Other payment methods', 'elegance'); ?>:</p>
          <?php if ( $casino['deposit_methods'] ) : ?>
            <div class="row mx-n5 my-n8 ai-c">
              <?php $i = 0; foreach ($casino['deposit_methods'] as $term) { ?>
                <div class="rd__li col-6 my-8 px-5 <?php echo $i > 4 && count($casino['deposit_methods']) > 6 ? 'd-n' : null; ?>">
                  <div class="d-f ai-c">
                    <?php if ( $term['logo'] ) : ?>
                      <span class="mr-5">
                        <span class="rd__pi foc w-35 h-22 of-h ps-r"><?php echo $term['logo']; ?></span>
                      </span>
                    <?php endif; ?>
                    <?php echo CF_Helpers_Taxonomy::get_taxonomy_linked($term, 'name'); ?>
                  </div>
                </div>
              <?php $i++; } ?>
              <?php if ( $i > 6 ) : ?>
                <button class="rd__more fs-8 br-6 mx-5 fw-b bg-l tc-h-w bg-h-p js-state" data-parent="div">+<?php echo count($casino['deposit_methods']) - 5; ?></button>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <?php if( $casino['review_bonus']) : ?>
    <p class="my-15 fs-16 fw-b tc-d"><?php _e('Current bonuses', 'elegance'); ?>:</p>
    <ul class="row my-n8 mx-0 fs-14">
      <?php foreach ($casino['review_bonus'] as $bonus) { ?>
        <li class="rd__bi <?php echo count($casino['review_bonus']) > 1 ? 'col-u-sm-6' : 'col'; ?> pl-25 py-8"><?php echo wp_sprintf( '%1$s: %2$s', $bonus['name'], $bonus['bonus'] ); ?></li>
      <?php } ?>
    </ul>
  <?php endif; ?>
</div>