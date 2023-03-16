<div class="ph__item py-u-sm-15 px-u-sm-20 p-o-xs-8 bg-w br-10">
  <div class="row ai-c mx-n5">
    <?php if ( has_post_thumbnail() ) : ?>
      <figure class="col-auto px-5">
        <a href="<?php the_permalink(); ?>" class="d-b">
          <?php the_post_thumbnail( '84x48', ['class' => 'br-5 g_news-is'] ); ?>
        </a>
      </figure>
    <?php endif; ?>

    <div class="col pl-10">
      <p class="fw-bl fs-14 tc-d"><a href="<?php the_permalink(); ?>" class="tc-in lh-125"><?php the_title(); ?></a></p>
    </div>
    
  </div> 
</div>