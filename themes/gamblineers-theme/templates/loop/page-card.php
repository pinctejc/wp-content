<?php
  $term = get_terms([
    'taxonomy'   => ['provider', 'payment', 'license', 'casino-type', 'badge', 'crypto', 'currency'],
    'meta_key'   => 'linked',
    'meta_value' => $page,
    'number'     => 1
  ]);
?>
<div class="col-u-sm-4 px-10 mb-20">
  <div class="cc d-f f-d-sm-c ai-u-md-c p-u-md-15 p-d-sm-10 tc-d br-10 h-100p bg-l ps-r bs-h-l">
    <?php if ( has_post_thumbnail($page) ) : ?>
      <figure class="col-u-md-6 mb-d-sm-10 px-0 br-8" >
        <a href="<?php echo get_the_permalink( $page ); ?>" class="h-110 foc p-10 br-8 bg-w"><?php echo get_the_post_thumbnail( $page, 'casino' ); ?></a>
      </figure>
    <?php endif; ?>

    <div class="col d-f f-c pl-u-md-10 pl-d-sm-0 pr-0">
      <p class="mb-10 fs-20 fw-bl tc-d"><?php echo get_the_title( $page ); ?></p>
      <?php if($term) : ?>
        <p class="ta-c fs-14 mb-10"><?php echo wp_sprintf( __('%d casninos', 'elegance'), $term[0]->count ); ?></p>
      <?php endif; ?>
      <a href="<?php echo get_the_permalink( $page ); ?>" class="btn btn--p tc-w w-100p h-46 mt-a fw-bl fs-u-sm-20"><?php _e('All Casinos', 'elegance') ?></a>
    </div>
  </div>
</div>
