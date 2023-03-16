<?php

function elegance_country_name_by_country_id($country_id, bool $echo = true) {
	global $wpdb;

	$result = $wpdb->get_var("SELECT post_title FROM $wpdb->posts WHERE ID = $country_id");
  if ( $echo ) {
    echo $result;
  } else {
    return $result;
  }
}

function elegance_country_code_by_country_id($country_id, bool $echo = true) {
	global $wpdb;

	$result = $wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE post_id = $country_id AND meta_key = 'country_code'");

	if ( $echo ) {
    echo $result;
  } else {
    return $result;
  }
}

function elegance_country_flag_by_country_id($country_id, bool $echo = true, $size = 'full', $icon = false, $attr = '') {
	if ($attr === '') 
		$attr = ['class' => 'coutry-flag'];

  $html = get_the_post_thumbnail($country_id, $size, $icon, $attr);
  
  if ( $echo ) {
    echo $html;
  } else {
    return $html;
  }
}

function elegance_country_id_by_country_code($country_code, bool $echo = true) {
  global $wpdb;

	$result = $wpdb->get_var("SELECT p.ID FROM $wpdb->posts as p LEFT JOIN $wpdb->postmeta as pm ON p.ID = pm.post_id WHERE p.post_type = 'country' AND p.post_status = 'publish' AND pm.meta_key = 'country_code' AND pm.meta_value = '$country_code'");

	if ( $echo ) {
    echo $result;
  } else {
    return $result;
  }
}

function elegance_country_name_by_country_code($country_code, bool $echo = true) {
  global $wpdb;

	$result = $wpdb->get_var("SELECT p.post_title FROM $wpdb->posts as p INNER JOIN $wpdb->postmeta as pm ON p.ID = pm.post_id WHERE p.post_type = 'country' AND p.post_status = 'publish' AND pm.meta_key = 'country_code' AND pm.meta_value = '$country_code'");

	if ( $echo ) {
    echo $result;
  } else {
    return $result;
  }
}

function elegance_country_flag_by_country_code($country_code, bool $echo = true, $size = 'full', $icon = false, $attr = '') {
  global $wpdb;

  $country_id = $result = $wpdb->get_var("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = '$country_code' AND meta_key = 'country_code'");

  $html = get_the_post_thumbnail($country_id, $size, $icon, $attr);

	if ( $echo ) {
    echo $html;
  } else {
    return $html;
  }
}