<script type="application/ld+json">
	{
    "@context": "http://schema.org",
    "@type": "Review",
    "datePublished": "<?php echo get_the_date('c'); ?>",
    "dateModified": "<?php echo the_modified_date('c'); ?>",
    "image": "<?php the_post_thumbnail_url('full'); ?>",
    "url": "<?php the_permalink(); ?>",
    "itemReviewed": {
       "@type": "Organization",
       "name": "<?php the_title(); ?>",
       "image": "<?php the_post_thumbnail_url('full'); ?>",
       "description": "<?php echo mb_strimwidth(get_the_excerpt(), 0, 500); ?>"
    }
    ,
    "author": {
      "@type": "Person",
      "image": "<?php the_post_thumbnail_url('full'); ?>",
      "name": "<?php echo get_bloginfo('name'); ?>"
    }
    ,
    "reviewRating": {
       "@type": "Rating",
       "ratingValue": "<?php echo $rating; ?> / 10",
       "worstRating": "1",
       "bestRating": "10"
    }
    ,
    "publisher": {
      "@type": "Organization",
      "name": "<?php echo esc_url(get_site_url()); ?>"
    }
	}
</script>
