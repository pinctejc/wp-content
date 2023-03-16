<?php $color = CF_Helpers_Casino::get_casino_fields(get_the_ID(), ['color', 'g_casino_keyword']); ?>
<div class="col-u-md-2 col-o-sm-4 col-o-xs-6 mb-u-sm-20 mb-o-xs-10 px-u-sm-10 px-o-xs-5">
  <div class="h-100p d-f f-c p-10 br-12 bg-l ps-r bs-h-l">
	<figure class="h-100 foc mb-10 p-5 br-8 of-h" style="background-color: <?php echo $color['color']; ?>"><?php the_post_thumbnail( 'casino' ); ?></figure>
	
	<p class="mb-a fs-14 tc-d fw-m">
	  <a href="<?php the_permalink() ?>" class="l-str tc-in tc-h-pv fw-b">
		<?php echo wp_sprintf( __('%s Review', 'elegance'), $color['g_casino_keyword'] ); ?>
	  </a>
	</p>

	<p class="mt-5 fs-10"><?php echo get_the_date( 'M d, Y' ); ?></p>
  </div>
</div>