<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      <?php foreach($faqs as $key => $faq) : ?>
        <?php if ($key > 0) echo ','; ?>
        {
          "@type": "Question",
          "name": "<?php echo $faq['question']; ?>",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "<?php echo wp_strip_all_tags($faq['answer']); ?>"
          }
        }
      <?php endforeach; ?>
    ]
  }
</script>