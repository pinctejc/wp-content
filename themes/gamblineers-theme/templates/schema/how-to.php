<?php
$permalink = get_the_permalink();
if(substr($permalink, -1) == '/') {
  $permalink = substr($permalink, 0, -1);
}
if(has_post_thumbnail()) :
  $post_thumbnail = get_the_post_thumbnail_url(get_the_ID());
else :
  $post_thumbnail = wp_get_attachment_image_url( get_option( 'options_logo' ), 'full');
endif;

if ( $module['ht_title']['titles']  ) {
  $name = '';
  foreach ($module['ht_title']['titles'] as $title) {
    $name .= $title['title'] . ' ';
  }
} else {
  $name = get_the_title();
}
?>
<script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "HowTo",
    "image": {
      "@type": "ImageObject",
      "url": "<?php echo $post_thumbnail; ?>"
    },
    "name": "<?php echo $name; ?>",
    "description": "<?php if ($module['ht_title']['subtitle']) : echo $module['ht_title']['subtitle']; else: the_excerpt(); endif; ?>",
    "totalTime": "PT2M",
    "supply": [
      {
        "@type": "HowToSupply",
        "name": "Computer or smartphone"
      }
    ],
    "tool": [
      {
        "@type": "HowToTool",
        "name": "Credit card or other payment method"
      }
    ],
    "step": [
      <?php
        $i = 0;
        foreach($module['ht_steps'] as $step) :
          $name = '';

          foreach($step['title']['titles'] as $title) :
            $name .= $title['title'] . ' ';
          endforeach;
      ?>
        <?php if ($i > 0) echo ','; $i++; ?>
        {
          "@type": "HowToStep",
          "name": "<?php echo $name; ?>",
          "text": "<?php echo wp_strip_all_tags($step['content']); ?>",
          "image": "<?php echo wp_get_attachment_url($step['graphic']); ?>",
          "url": "<?php echo $permalink . '#step' . $i; ?>"
        }
      <?php endforeach; ?>
    ]
  }
</script>
