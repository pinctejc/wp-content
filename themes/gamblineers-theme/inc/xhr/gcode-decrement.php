<?php

function gcode_decrement() {
  $post_id = $_GET['post_id'];
  $limit = get_post_meta( $post_id, 'gcode_limit', true );

  if( update_post_meta( $post_id, 'gcode_limit', $limit - 1, $limit ) ) {
    --$limit;
  }

  echo json_encode($limit);

  wp_die();
}
add_action('wp_ajax_gcode_decrement', 'gcode_decrement');
add_action('wp_ajax_nopriv_gcode_decrement', 'gcode_decrement');
