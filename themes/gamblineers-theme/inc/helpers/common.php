<?php

class CF_Helpers_Common {

  /*
   * Get Casino Feed Sesstion
   */
  public static function get_session($keys = null) {
    if (empty($keys) && isset($_SESSION['casinofeed'])) :
        return $_SESSION['casinofeed'];
    elseif(is_string($keys) && isset($_SESSION['casinofeed'][$keys])) :
      return $_SESSION['casinofeed'][$keys];
    elseif(is_array($keys)) :
      $results = [];
      foreach($keys as $key) :
        $results[$key] = self::get_session($key);
      endforeach;

      return $results;
    endif;

    return null;
  }

    /*
   * Set Casino Feed Sesstion
   */
  public static function set_session($key = null, $value = '') {
    $_SESSION['casinofeed'][$key] = $value;
  }

  /*
   * Checking for Disabled single page
   */
  public static function disable_single_page($post_id) {
    return get_post_meta( $post_id, 'disable_single', true );
  }

  /*
   * Get Post Type Currency
   */
  public static function currency($post_id = null) {
    $post_type = get_post_type($post_id);

    return [
      'symbol' => get_option( "options_{$post_type}_symbol"),
      'position' => get_option("options_{$post_type}_symbol_position")
    ];
  }

  /*
   * Get Post Type Currency
   */
  public static function set_currency_symbol($post_id, $value) {
    $currency = self::currency($post_id);

    if (empty($value))
      return '';

    if ($currency['position'] === 'front') :
      return $currency['symbol'] . $value;
    endif;

    if ($currency['position'] === 'rear') :
      return $value . $currency['symbol'];
    endif;
  }

  /*
   * Checking restricted post
   */
  public static function is_restricted($post_id) {
    $restricted = get_post_meta( $post_id,'restricted', true);
    if ( !$restricted ) return false;

    $user_country = CF_Helpers_Common::get_session('country_id');
    return in_array($user_country, $restricted);
  }

  /*
   * ACF Get Repeater
   */
  public static function acf_repeater($post_id, $field, $sub_fields, $count = null) {
    $repeater = get_post_meta( $post_id, $field, true );

    if ( ! $repeater ) return false;
    if ( $count ) $repeater = $count;

    $rows = [];
    for ( $i = 0; $i < $repeater; $i++) {
      foreach ($sub_fields as $sub_field) {
        $rows[$i][$sub_field] = get_post_meta( $post_id, $field . '_' . $i . '_' . $sub_field, true );
      }
    }

    return $rows;
  }

  /*
   * ACF Get Group
   */
  public static function acf_group($post_id, $field, $sub_fields) {
    $group = [];
    foreach ($sub_fields as $sub_field) {
      $group[$sub_field] = get_post_meta( $post_id, $field . '_' . $sub_field, true );
    }

    return $group;
  }

  /*
   * Display Title
   */
  public static function display_title($title, $classes = null, $echo = true) {
    if (empty($title['titles']))
      return;

    $tag = isset($title['tag']) ? $title['tag'] : 'h3';
    $text = '';
    $attr = '';

    foreach ($title['titles'] as $title) :
      if ($title['color'] !== '0') {
        $text .= '<span class="'. $title['color'] .'">'. $title['title'] .'</span> ';
      } else {
        $text .= $title['title'] . ' ';
      }
    endforeach;

    if ($classes) $attr = ' class="' . $classes . '"';
    if ( $echo )
      echo "<{$tag}{$attr}>{$text}</{$tag}>";
    else
      return "{$text}";
  }

  /*
   * ACF Get Button
   */
  public static function button($cta) {
    if (!$cta || (isset($cta['cta_options']) && $cta['cta_options'] === '0')) return false;

    if (!isset($cta['cta_options'])) $cta['cta_options'] = '4';

    $btn['label'] = isset($cta['label']) ? $cta['label'] : false;
    $btn['classes'] =  '';
    // $btn['disabled'] = false;

    if (isset($cta['type'])) :
      if ($cta['type'] === '1') :
        $btn['classes'] .= $cta['text_color'] . ' btn--' . $cta['btn_color'];
      elseif ($cta['type'] === '2') :
        $btn['classes'] .= $cta['text_color'] . ' btn-g--' . $cta['btn_color'];
      endif;
    endif;

    if ($cta['cta_options'] === '1') :
      $btn['action'] = $cta['page_link'];
    elseif ($cta['cta_options'] === '2') :
      $btn['action'] = $cta['enter_link'];
    elseif ($cta['cta_options'] === '3') :
      $btn['action'] = $cta['anchor_id'];
      $btn['classes'] .= ' js-anchor';
    endif;

    return $btn;
  }

  /*
   * ACF Get Button
   */
  public static function layout($layout) {
    return (isset( $layout['ld'] ) && $layout['ld'] !== '0') || (isset( $layout['lm'] ) && $layout['lm'] !== '0') ? str_replace('0', '', implode(' ', $layout)) : null;
  }

  /*
  * Display Pagination
  */
  public static function pagination($wp_query) {
    $big = 999999999;
    $paged = get_query_var('paged');
    $max_page = $wp_query->max_num_pages;

    $links = paginate_links([
      'base'       => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
      'format'     => '?paged=%#%',
      'current'    => max(1, $paged),
      'total'      => $max_page,
      'mid_size'   => 1,
      'prev_text'  => __('Prev', 'elegnace'),
      'next_text'  => __('Next', 'elegance')
    ]);

    $links = str_replace('<a class="prev', '<a rel="prev"  class="prev', $links);
    $links = str_replace('<a class="next', '<a rel="next"  class="next', $links);

    echo $links;
  }

  /*
  *  Casino Comments Callback
  */
  public static function casino_comments_callback($comment, $args) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
    if ( 'div' == $args['style'] ) {
      $tag = 'blockquote';
    } else {
      $tag = 'li';
    }

    $comment_id = $comment->comment_ID;
    $comment_author = get_comment_author();
    $rating = get_comment_meta($comment_id, 'rating', true);

    preg_match_all('/(\S)\S*/i', $comment_author, $abbr);
  ?>

  <<?php echo $tag; ?> id="comment-<?php echo $comment_id; ?>" class="cb p-u-sm-20 p-o-xs-15 mb-25 br-16">
    <div class="row ai-c mb-15 mx-n5">
      <div class="col-auto px-5">
        <abbr title="<?php echo $comment_author; ?>" class="foc w-60 h-60 td-n br-c bg-pv tc-w fw-b fs-20 tt-u"><?php echo implode('', $abbr[1]); ?></abbr>
      </div>
      <div class="col px-5">
        <p class="mb-10 fs-20 tc-d fw-b"><?php echo $comment_author; ?></p>
        <p class="fs-14"><?php echo get_comment_date( 'g:i A / M d, Y', $comment ); ?></p>
      </div>
      <div class="col-auto px-5">
        <?php if ( $rating === '1' ) : ?>
          <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="20" fill="#32BA02"/><path fill-rule="evenodd" clip-rule="evenodd" d="M20.7738 8.82557C19.3273 8.72325 18.2146 9.92069 18.2146 11.2769L18.2146 12.4464C18.2146 15.4093 16.2003 16.6521 15.1318 17.1126C14.9607 17.1863 14.7681 17.2332 14.5513 17.2588C14.4844 16.2456 13.6413 15.4444 12.6111 15.4444H10.9444C9.87056 15.4444 9 16.315 9 17.3889V29.0555C9 30.1294 9.87056 31 10.9444 31H12.6111C13.6211 31 14.4513 30.2299 14.5465 29.2448C15.4781 29.3119 16.399 29.573 17.5366 29.8955C17.7511 29.9563 17.9733 30.0193 18.2047 30.0836C19.8317 30.5355 21.775 31 24.364 31C26.7957 31 28.4682 30.7733 29.4569 29.4756C29.9258 28.8602 30.1781 28.0808 30.3629 27.1975C30.5273 26.4112 30.6543 25.4528 30.803 24.3308L30.8605 23.8975C31.214 21.2468 31.2246 19.2531 30.6117 17.9049C30.2863 17.1889 29.7863 16.654 29.107 16.314C28.4501 15.9852 27.6804 15.8659 26.8448 15.8659H24.5661C24.5853 15.7149 24.6067 15.5558 24.6291 15.3891C24.6562 15.1879 24.6847 14.9754 24.7128 14.7528C24.7804 14.2167 24.8429 13.6356 24.8429 13.1552C24.8429 11.7725 24.5967 10.6522 23.8208 9.88725C23.0607 9.13789 21.9677 8.91001 20.7738 8.82557ZM14.5556 27.5757C15.7321 27.6467 16.8653 27.97 18.0198 28.2993C18.2293 28.3591 18.4395 28.419 18.6508 28.4777C20.2134 28.9118 21.9914 29.3333 24.364 29.3333C26.894 29.3333 27.7023 29.0285 28.1312 28.4655C28.3711 28.1506 28.5618 27.6675 28.7315 26.8562C28.8823 26.1352 29.0005 25.2446 29.1516 24.1048L29.2085 23.6772C29.5639 21.0118 29.4886 19.4615 29.0945 18.5946C28.9165 18.2031 28.6774 17.9627 28.361 17.8044C28.0222 17.6348 27.5395 17.5326 26.8448 17.5326H24.2107C23.4538 17.5326 22.7743 16.8984 22.8651 16.0564C22.8943 15.786 22.9379 15.4602 22.9822 15.1302C23.0087 14.9328 23.0353 14.7338 23.0592 14.5443C23.1267 14.0092 23.1763 13.5205 23.1763 13.1552C23.1763 11.9056 22.9397 11.3591 22.6507 11.0741C22.3458 10.7736 21.7915 10.5684 20.6562 10.4881C20.2664 10.4605 19.8813 10.7923 19.8812 11.277L19.8812 12.4464C19.8812 16.3903 17.1166 18.072 15.7915 18.6431C15.3784 18.8212 14.9549 18.9014 14.5556 18.9328V27.5757ZM10.9444 29.3333C10.791 29.3333 10.6667 29.2089 10.6667 29.0555V17.3889C10.6667 17.2354 10.791 17.1111 10.9444 17.1111H12.6111C12.7645 17.1111 12.8889 17.2354 12.8889 17.3889V29.0555C12.8889 29.2089 12.7645 29.3333 12.6111 29.3333H10.9444Z" fill="white"/></svg>
        <?php elseif ( $rating === '0' ) : ?>
          <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="20" fill="#DE2810"/><path fill-rule="evenodd" clip-rule="evenodd" d="M20.7738 31.1744C19.3273 31.2767 18.2146 30.0793 18.2146 28.7231L18.2146 27.5536C18.2146 24.5907 16.2003 23.3479 15.1318 22.8874C14.9607 22.8137 14.7681 22.7668 14.5513 22.7412C14.4844 23.7544 13.6413 24.5556 12.6111 24.5556H10.9444C9.87056 24.5556 9 23.685 9 22.6111V10.9445C9 9.87059 9.87056 9.00003 10.9444 9.00003H12.6111C13.6211 9.00003 14.4513 9.77014 14.5465 10.7552C15.4781 10.6881 16.399 10.427 17.5366 10.1045C17.7511 10.0437 17.9733 9.9807 18.2047 9.91642C19.8317 9.46447 21.775 9 24.364 9C26.7957 9 28.4682 9.22673 29.4569 10.5244C29.9258 11.1398 30.1781 11.9192 30.3629 12.8025C30.5273 13.5888 30.6543 14.5472 30.803 15.6692L30.8605 16.1025C31.214 18.7532 31.2246 20.7469 30.6117 22.0951C30.2863 22.8111 29.7863 23.346 29.107 23.686C28.4501 24.0148 27.6804 24.1341 26.8448 24.1341H24.5661C24.5853 24.2851 24.6067 24.4442 24.6291 24.6109C24.6562 24.8121 24.6847 25.0246 24.7128 25.2472C24.7804 25.7833 24.8429 26.3644 24.8429 26.8448C24.8429 28.2275 24.5967 29.3478 23.8208 30.1127C23.0607 30.8621 21.9677 31.09 20.7738 31.1744ZM14.5556 12.4243C15.7321 12.3533 16.8653 12.03 18.0198 11.7007C18.2293 11.6409 18.4395 11.581 18.6508 11.5223C20.2134 11.0882 21.9914 10.6667 24.364 10.6667C26.894 10.6667 27.7023 10.9715 28.1312 11.5345C28.3711 11.8494 28.5618 12.3325 28.7315 13.1438C28.8823 13.8648 29.0005 14.7554 29.1516 15.8952L29.2085 16.3228C29.5639 18.9882 29.4886 20.5385 29.0945 21.4054C28.9165 21.7969 28.6774 22.0373 28.361 22.1956C28.0222 22.3652 27.5395 22.4674 26.8448 22.4674H24.2107C23.4538 22.4674 22.7743 23.1016 22.8651 23.9436C22.8943 24.214 22.9379 24.5398 22.9822 24.8698C23.0087 25.0672 23.0353 25.2662 23.0592 25.4557C23.1267 25.9908 23.1763 26.4795 23.1763 26.8448C23.1763 28.0944 22.9397 28.6409 22.6507 28.9259C22.3458 29.2264 21.7915 29.4316 20.6562 29.5119C20.2664 29.5395 19.8813 29.2077 19.8812 28.723L19.8812 27.5536C19.8812 23.6097 17.1166 21.928 15.7915 21.3569C15.3784 21.1788 14.9549 21.0986 14.5556 21.0672V12.4243ZM10.9444 10.6667C10.791 10.6667 10.6667 10.7911 10.6667 10.9445V22.6111C10.6667 22.7646 10.791 22.8889 10.9444 22.8889H12.6111C12.7645 22.8889 12.8889 22.7646 12.8889 22.6111V10.9445C12.8889 10.7911 12.7645 10.6667 12.6111 10.6667H10.9444Z" fill="white"/></svg>
        <?php endif; ?>
      </div>
    </div>

    <div class="wp-editor"><?php echo get_comment_text( $comment ); ?></div>
  <?php }
  /*
  *  Casino Comments Callback
  */
  public static function comments_end_callback($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ( 'div' == $args['style'] ) :
      $tag = '</blockquote>';
    else :
      $tag = '</li>';
    endif;

    echo $tag;
  }
}