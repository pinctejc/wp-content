<!doctype html>
<html <?php language_attributes(); ?>>
  <?php cf_get_template('head.php', CF_TEMPLATES_DIR); ?>
  <body id="scroll-top" <?php body_class(); ?>>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PLLNPWK" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <?php
      cf_get_template('header.php', CF_TEMPLATES_DIR);
      // get_search_form();
      include template_path();
      cf_get_template('footer.php', CF_TEMPLATES_DIR);
      cf_get_template('holiday.php', CF_TEMPLATES_DIR);
      cf_get_template('cookie.php', CF_TEMPLATES_DIR);
      cf_get_template('table-contents.php', CF_TEMPLATES_DIR);
      wp_footer();
    ?>
  </body>
</html>
