<?php $coin = get_cryptowp( 'coins', $coin ); ?>
<div class="ph__item py-u-sm-15 px-u-sm-20 py-o-xs-8 pl-o-xs-8 pr-o-xs-15 bg-w br-10 ps-r">
  <div class="row ai-c mx-n5">
    <?php if ( $coin['icon'] ) : ?>
      <div class="col-auto px-5">
        <figure class="ph__item__thumb foc br-10">
          <img src="<?php echo $coin['icon'] ?>" alt="<?php echo $coin['name']; ?>">
        </figure>
      </div>
    <?php endif; ?>

    <div class="col px-5">
      <p class="fw-bl fs-14 tc-d">
        <?php if ( $coin['url'] ) : ?>
          <a href="<?php echo $coin['url']; ?>" class="tc-in l-str"><?php echo $coin['name']; ?></a>
        <?php else : ?>
          <?php echo $coin['name']; ?>
        <?php endif; ?>
      </p>
    </div>

    <div class="col-auto px-5">
      <p class="fw-bl fs-14 tc-d"><?php echo $currency . $coin['price'] ?> <span class="ph__item__percent ph__item__percent--<?php echo $coin['value']; ?> pl-5"><?php echo $coin['percent']; ?>%</span></p>
    </div>
  </div>
</div>

