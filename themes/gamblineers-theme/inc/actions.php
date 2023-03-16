<?php

class CF_Actions {

  protected static function generate_css_value($name, $value) {
    return sprintf('--%s:%s;', $name, $value);
  }

  public static function init() {
    add_action('cf_head', ['CF_Actions', 'theme_settings_css']);
    add_action('cf_head', ['CF_Actions', 'theme_styles']);
    add_action('cf_head', ['CF_Actions', 'theme_scripts_vars']);
    add_action('before_module', ['CF_Actions', 'before_module']);
    add_action('after_module', ['CF_Actions', 'after_module']);
    add_action('create_module-type', ['CF_Actions', 'generate_module_types'], 10, 2);
    add_action('edited_module-type', ['CF_Actions', 'generate_module_types'], 10, 2);
    add_action('delete_module-type', ['CF_Actions', 'generate_module_types'], 10, 2);
    add_action('registered_taxonomy', ['CF_Actions', 'add_modulte_types'], 10, 2);
    add_action('init', ['CF_Actions', 'remove_image_size']);
    add_filter('intermediate_image_sizes', ['CF_Actions', 'intermediate_image_sizes'], 10, 1);
    add_action('admin_menu', ['CF_Actions', 'hide_sub_menus']);
    add_action('comment_form_logged_in_after', ['CF_Actions', 'additional_fields'] );
    add_action('comment_form_before_fields', ['CF_Actions', 'additional_fields'] );
    add_action('comment_post', ['CF_Actions', 'save_comment_meta_data']);
    add_action('add_meta_boxes_comment', ['CF_Actions', 'add_comment_meta_boxes']);
    add_action('pre_get_posts', ['CF_Actions', 'pre_get_posts']);
    add_action('acf/input/admin_footer', ['CF_Actions', 'change_boxes_repeater']);
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
  }

  public static function theme_settings_css() {
    echo '<style type="text/css">:root {';
    echo self::generate_css_value('primary', CF_Helpers_Settings::theme_color('primary_color'));
    echo self::generate_css_value('primary-hover', CF_Helpers_Settings::theme_color('primary_color_hover'));
    echo self::generate_css_value('primary-variant', CF_Helpers_Settings::theme_color('primary_color_v'));
    echo self::generate_css_value('primary-variant-hover', CF_Helpers_Settings::theme_color('primary_color_v_hover'));
    echo self::generate_css_value('secondary', CF_Helpers_Settings::theme_color('secondary_color'));
    echo self::generate_css_value('secondary-hover', CF_Helpers_Settings::theme_color('secondary_color_hover'));
    echo self::generate_css_value('secondary-variant', CF_Helpers_Settings::theme_color('secondary_color_v'));
    echo self::generate_css_value('secondary-variant-hover', CF_Helpers_Settings::theme_color('secondary_color_v_hover'));
    echo self::generate_css_value('neutral', CF_Helpers_Settings::theme_color('neutral_color'));
    echo self::generate_css_value('neutral-hover', CF_Helpers_Settings::theme_color('neutral_color_hover'));
    echo self::generate_css_value('dark', CF_Helpers_Settings::theme_color('dark_color'));
    echo self::generate_css_value('dark-hover', CF_Helpers_Settings::theme_color('dark_color_hover'));
    echo self::generate_css_value('light', CF_Helpers_Settings::theme_color('light_color'));
    echo self::generate_css_value('light-hover', CF_Helpers_Settings::theme_color('light_color_hover'));
    echo self::generate_css_value('text-color', CF_Helpers_Settings::theme_color('body_color'));
    echo self::generate_css_value('link-color', CF_Helpers_Settings::theme_color('link_color'));
    echo self::generate_css_value('link-hover-color', CF_Helpers_Settings::theme_color('link_hover_color'));
    echo self::generate_css_value('headings-color', CF_Helpers_Settings::theme_color('headings_color'));
    echo self::generate_css_value('font-size-desktop', get_option('options_font_size_d') . 'px');
    echo self::generate_css_value('font-size-mobile', get_option('options_font_size_m') . 'px');
    echo self::generate_css_value('h1-desktop', get_option('options_h1_font_size_d') . 'px');
    echo self::generate_css_value('h1-mobile', get_option('options_h1_font_size_m') . 'px');
    echo self::generate_css_value('h2-desktop', get_option('options_h2_font_size_d') . 'px');
    echo self::generate_css_value('h2-mobile', get_option('options_h2_font_size_m') . 'px');
    echo self::generate_css_value('h3-desktop', get_option('options_h3_font_size_d') . 'px');
    echo self::generate_css_value('h3-mobile', get_option('options_h3_font_size_m') . 'px');
    echo self::generate_css_value('h4-desktop', get_option('options_h4_font_size_d') . 'px');
    echo self::generate_css_value('h4-mobile', get_option('options_h4_font_size_m') . 'px');
    echo self::generate_css_value('h5-desktop', get_option('options_h5_font_size_d') . 'px');
    echo self::generate_css_value('h5-mobile', get_option('options_h5_font_size_m') . 'px');
    echo self::generate_css_value('h6-desktop', get_option('options_h6_font_size_d') . 'px');
    echo self::generate_css_value('h6-mobile', get_option('options_h6_font_size_m') . 'px');
    echo '}</style>';
  }

  public static function theme_styles() {

    cf_enqueue_asset('fonts', false);
    echo '<link rel="preload stylesheet" href="'. CF_Assets::asset_path("styles/main.css") .'" type="text/css" as="style" media="all">';
  }

  public static function theme_scripts_vars() {
    echo '<script type="text/javascript">var vars = {"ajax_url": "'. esc_url(admin_url('admin-ajax.php')) .'", sticky: null};</script>';
  }

  public static function before_module($args = []) {
    $attr = ' ';

    if (isset($args['settings'])) :
      foreach($args['settings'] as $key => $setting) :
        if ($key === 'data') :
          $attr .= $setting;
        else :
          $attr .= $setting ? $key . '="' . $setting . '"' : '';
        endif;
      endforeach;
    endif;

    if(empty($args['tag']))
      $tag = 'div';
    else
      $tag = $args['tag'];

    echo "<{$tag}{$attr}>";
  }

  public static function after_module($args = []) {
    if(empty($args['tag']))
      $tag = 'div';
    else
      $tag = $args['tag'];

    echo "</{$tag}>";
  }

  public static function claer_modular($post_id) {
    if (in_array(get_post_type($post_id), ['post', 'page', 'game-type', 'license', 'news', 'payment', 'provider', 'slot'])) :
      global $wpdb;
      $table = $wpdb->prefix . 'postmeta';

      $wpdb->query(("DELETE FROM ". $table ." WHERE post_id = ". $post_id ." AND meta_key LIKE '%modules_%'"));
    endif;
  }

  public static function generate_module_types() {
    $get_terms = get_terms([
      'taxonomy' => 'module-type',
      'hide_empty' => false,
    ]);

    $json = [];
    foreach($get_terms as $term){
      $json[] = [
        'name' => $term->name,
        'slug' => $term->slug
      ];
    }
    file_put_contents( CF_RESOURCES_DIR . 'json/module-types.json', json_encode($json));
  }

  public static function add_modulte_types($taxonomy) {
    if ($taxonomy === 'module-type' && is_admin()) :
      $get_terms = get_terms([
        'taxonomy' => 'module-type',
        'hide_empty' => false,
      ]);

      if (!$get_terms) :
        $filename = CF_RESOURCES_DIR  . "json/module-types.json";
        if(file_exists($filename))
        $json = json_decode(file_get_contents($filename), true);

        foreach ($json as $item) :
          wp_insert_term($item['name'], 'module-type', ['slug' => $item['slug']]);
        endforeach;
      endif;
    endif;
  }

  public static function remove_image_size() {
    remove_image_size( '1536x1536' );
    remove_image_size( '2048x2048' );
  }

  public static function intermediate_image_sizes($sizes) {
    return array_diff($sizes, ['medium_large']);  // Medium Large (768 x 0)
  }

  public static function hide_sub_menus() {
    remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
    remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
    remove_meta_box( 'categorydiv','post','normal' );
    remove_meta_box( 'tagsdiv-post_tag','post','normal' );
  }

  public static function additional_fields () {

    echo '<p class="comment-form-rating"><label for="rating">'. __('Review rating', 'elegance') . ' <span class="required">*</span></label>';
    echo '<span class="d-f ai-c"><label><input type="radio" name="rating" id="thumb-up" value="1"  /><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="20" fill="#32BA02"/><path fill-rule="evenodd" clip-rule="evenodd" d="M20.7738 8.82557C19.3273 8.72325 18.2146 9.92069 18.2146 11.2769L18.2146 12.4464C18.2146 15.4093 16.2003 16.6521 15.1318 17.1126C14.9607 17.1863 14.7681 17.2332 14.5513 17.2588C14.4844 16.2456 13.6413 15.4444 12.6111 15.4444H10.9444C9.87056 15.4444 9 16.315 9 17.3889V29.0555C9 30.1294 9.87056 31 10.9444 31H12.6111C13.6211 31 14.4513 30.2299 14.5465 29.2448C15.4781 29.3119 16.399 29.573 17.5366 29.8955C17.7511 29.9563 17.9733 30.0193 18.2047 30.0836C19.8317 30.5355 21.775 31 24.364 31C26.7957 31 28.4682 30.7733 29.4569 29.4756C29.9258 28.8602 30.1781 28.0808 30.3629 27.1975C30.5273 26.4112 30.6543 25.4528 30.803 24.3308L30.8605 23.8975C31.214 21.2468 31.2246 19.2531 30.6117 17.9049C30.2863 17.1889 29.7863 16.654 29.107 16.314C28.4501 15.9852 27.6804 15.8659 26.8448 15.8659H24.5661C24.5853 15.7149 24.6067 15.5558 24.6291 15.3891C24.6562 15.1879 24.6847 14.9754 24.7128 14.7528C24.7804 14.2167 24.8429 13.6356 24.8429 13.1552C24.8429 11.7725 24.5967 10.6522 23.8208 9.88725C23.0607 9.13789 21.9677 8.91001 20.7738 8.82557ZM14.5556 27.5757C15.7321 27.6467 16.8653 27.97 18.0198 28.2993C18.2293 28.3591 18.4395 28.419 18.6508 28.4777C20.2134 28.9118 21.9914 29.3333 24.364 29.3333C26.894 29.3333 27.7023 29.0285 28.1312 28.4655C28.3711 28.1506 28.5618 27.6675 28.7315 26.8562C28.8823 26.1352 29.0005 25.2446 29.1516 24.1048L29.2085 23.6772C29.5639 21.0118 29.4886 19.4615 29.0945 18.5946C28.9165 18.2031 28.6774 17.9627 28.361 17.8044C28.0222 17.6348 27.5395 17.5326 26.8448 17.5326H24.2107C23.4538 17.5326 22.7743 16.8984 22.8651 16.0564C22.8943 15.786 22.9379 15.4602 22.9822 15.1302C23.0087 14.9328 23.0353 14.7338 23.0592 14.5443C23.1267 14.0092 23.1763 13.5205 23.1763 13.1552C23.1763 11.9056 22.9397 11.3591 22.6507 11.0741C22.3458 10.7736 21.7915 10.5684 20.6562 10.4881C20.2664 10.4605 19.8813 10.7923 19.8812 11.277L19.8812 12.4464C19.8812 16.3903 17.1166 18.072 15.7915 18.6431C15.3784 18.8212 14.9549 18.9014 14.5556 18.9328V27.5757ZM10.9444 29.3333C10.791 29.3333 10.6667 29.2089 10.6667 29.0555V17.3889C10.6667 17.2354 10.791 17.1111 10.9444 17.1111H12.6111C12.7645 17.1111 12.8889 17.2354 12.8889 17.3889V29.0555C12.8889 29.2089 12.7645 29.3333 12.6111 29.3333H10.9444Z" fill="white"/></svg></label>';
    echo '<label><input type="radio" name="rating" id="thumb-down" value="0" /><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="20" fill="#DE2810"/><path fill-rule="evenodd" clip-rule="evenodd" d="M20.7738 31.1744C19.3273 31.2767 18.2146 30.0793 18.2146 28.7231L18.2146 27.5536C18.2146 24.5907 16.2003 23.3479 15.1318 22.8874C14.9607 22.8137 14.7681 22.7668 14.5513 22.7412C14.4844 23.7544 13.6413 24.5556 12.6111 24.5556H10.9444C9.87056 24.5556 9 23.685 9 22.6111V10.9445C9 9.87059 9.87056 9.00003 10.9444 9.00003H12.6111C13.6211 9.00003 14.4513 9.77014 14.5465 10.7552C15.4781 10.6881 16.399 10.427 17.5366 10.1045C17.7511 10.0437 17.9733 9.9807 18.2047 9.91642C19.8317 9.46447 21.775 9 24.364 9C26.7957 9 28.4682 9.22673 29.4569 10.5244C29.9258 11.1398 30.1781 11.9192 30.3629 12.8025C30.5273 13.5888 30.6543 14.5472 30.803 15.6692L30.8605 16.1025C31.214 18.7532 31.2246 20.7469 30.6117 22.0951C30.2863 22.8111 29.7863 23.346 29.107 23.686C28.4501 24.0148 27.6804 24.1341 26.8448 24.1341H24.5661C24.5853 24.2851 24.6067 24.4442 24.6291 24.6109C24.6562 24.8121 24.6847 25.0246 24.7128 25.2472C24.7804 25.7833 24.8429 26.3644 24.8429 26.8448C24.8429 28.2275 24.5967 29.3478 23.8208 30.1127C23.0607 30.8621 21.9677 31.09 20.7738 31.1744ZM14.5556 12.4243C15.7321 12.3533 16.8653 12.03 18.0198 11.7007C18.2293 11.6409 18.4395 11.581 18.6508 11.5223C20.2134 11.0882 21.9914 10.6667 24.364 10.6667C26.894 10.6667 27.7023 10.9715 28.1312 11.5345C28.3711 11.8494 28.5618 12.3325 28.7315 13.1438C28.8823 13.8648 29.0005 14.7554 29.1516 15.8952L29.2085 16.3228C29.5639 18.9882 29.4886 20.5385 29.0945 21.4054C28.9165 21.7969 28.6774 22.0373 28.361 22.1956C28.0222 22.3652 27.5395 22.4674 26.8448 22.4674H24.2107C23.4538 22.4674 22.7743 23.1016 22.8651 23.9436C22.8943 24.214 22.9379 24.5398 22.9822 24.8698C23.0087 25.0672 23.0353 25.2662 23.0592 25.4557C23.1267 25.9908 23.1763 26.4795 23.1763 26.8448C23.1763 28.0944 22.9397 28.6409 22.6507 28.9259C22.3458 29.2264 21.7915 29.4316 20.6562 29.5119C20.2664 29.5395 19.8813 29.2077 19.8812 28.723L19.8812 27.5536C19.8812 23.6097 17.1166 21.928 15.7915 21.3569C15.3784 21.1788 14.9549 21.0986 14.5556 21.0672V12.4243ZM10.9444 10.6667C10.791 10.6667 10.6667 10.7911 10.6667 10.9445V22.6111C10.6667 22.7646 10.791 22.8889 10.9444 22.8889H12.6111C12.7645 22.8889 12.8889 22.7646 12.8889 22.6111V10.9445C12.8889 10.7911 12.7645 10.6667 12.6111 10.6667H10.9444Z" fill="white"/></svg></label></span></p>';
  }

  public static function save_comment_meta_data( $comment_id ) {
    add_comment_meta($comment_id, 'rating', $_POST['rating']);
  }

  public static function add_comment_meta_boxes() {
    add_meta_box('comment-fields', __('Comment Meta'), ['CF_Actions', 'add_comment_meta_boxes_callback'], 'comment', 'normal', 'high');
  }

  public static function add_comment_meta_boxes_callback($comment) {
    $rating = get_comment_meta($comment->comment_ID, 'rating', true);

    wp_nonce_field( 'comment_update', 'comment_update', false);

    echo
      '<fieldset>' .
        '<legend class="screen-reader-text">Comment Rating</legend>' .
        '<table class="form-table editcomment" role="presentation">' .
          '<tbody>' .
          '<tr>' .
            '<td class="first" style="width: 10px; text-align: left; padding-left: 0;"><label for="rating">'. __('Review rating', 'elegance' ) .'</label></td>' .
            '<td style="padding-right: 0"><input type="text" name="rating" size="30" value="'. $rating .'" id="rating" style="width: 100%"></td>' .
          '</tr>' .
          '</tbody>' .
        '</table>' .
      '</fieldset>';
  }

  public static function pre_get_posts( $query ) {
    if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
      return;
    }

    if ( ! empty( $query->query['name'] ) ) {
      $query->set( 'post_type', array( 'post', 'news', 'page' ) );
    }
  }

  public static function change_boxes_repeater() {
    ?>
      <script type="text/javascript">
        (function($) {
          isAdmin = <?php echo current_user_can('administrator') ?: 0; ?>;
          if ( ! isAdmin && typeof acf !== 'undefined') {
            var boxes = acf.getField('field_62821c07e10e1');
            if ( boxes ) {
              boxes.$el.find('.acf-row-handle').removeClass('order');
              boxes.$el.find('a[data-event="add-row"]').remove();
              boxes.$el.find('a[data-event="remove-row"]').remove();
            }
          }
        })(jQuery);
      </script>
    <?php
  }
}
