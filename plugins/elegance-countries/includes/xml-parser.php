<?php

class Countries_XML_Parser {

	public $the_content = '';
	
	// Loads countries from xml file
	function load_countries_from_xml() {
		$doc = new DOMDocument();
		$doc->load( plugin_dir_path( dirname( __FILE__ ) ) . 'xml/countrylist.xml' );
		$rootnode = $doc->getElementsByTagName( 'countries' )->item( 0 );
		
		$countries = array();
		$key = 0;
		foreach ( $rootnode->getElementsByTagName( 'country' ) as $countryitem ) {
			
			$attributes = array();
			if ( $countryitem->hasAttributes() ) {
				$xmlattributes = $countryitem->attributes;
				if ( ! is_null( $xmlattributes ) ) {
					foreach ( $xmlattributes as $attr ) {
						$attributes[$attr->name] = $attr->value;
					}
				}
			}
			$countries[$key][0] = $attributes;
			$key++;
		}
		
		return $countries;
	}
	
	function get_post_by_title( $page_title, $output = OBJECT ) {
		global $wpdb;
		$post = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type='country' AND post_status='publish'", $page_title ) );
		
		if ( $post )
			return get_post( $post, $output );
		
		return null;
	}
	
	// Writing countires to the DB
	function save_initial_countries() {
		$import_count = 0;
		$countries = $this->load_countries_from_xml();
		for ( $key = 0; $key <= count( $countries ) - 1; $key++ ) {
			$country_name = $countries[$key][0]['countryname'];
			$country_code = $countries[$key][0]['countrycode'];
			$post = $this->get_post_by_title( $country_name, ARRAY_A );
			
			if ( empty( $post ) ) {
				if ( $import_count == 0 ) {
					$this->the_content .= '<p><strong>' . __( 'Importing...', 'countries' ) . '</strong></p>';
				}
				
				$post_id = $this->insert_county($country_name, $country_code);
				$image_url = plugin_dir_path( dirname( __FILE__ ) ) . 'flags/' . mb_strtolower($country_code) . '.svg';

				$meta_boxes = [
					'country_code' => $country_code
				];

				foreach($meta_boxes as $meta_key => $meta_value) {
					$this->update_post_meta_box($post_id, $meta_key, $meta_value);
				}

				$this->generate_featured_image($image_url, $post_id);

				$import_count++;
			}
		}
		
		if ( $import_count > 0 ) {
			$this->the_content .= '<p><strong>' . sprintf( __( '%s countries updated.', 'countries' ), $import_count ) . '</strong></p>';
		} else {
			$this->the_content .= '<p>' . __( 'No countries require updating.', 'countries' ) . '</p>';
		}
		
		echo $this->the_content;
	}
	
	function insert_county($country_name, $country_code) {
		$insert = array();
		$insert['post_title'] = $country_name;
		$insert['post_name'] = $country_code;
		$insert['post_status'] = 'publish';
		$insert['post_author'] = 1;
		$insert['post_type'] = 'country';

		$this->the_content .= '<div>' . $country_name . ' (' . $country_code . ') - <em>' . __( 'Imported', 'countries' ) . '</em></div>';
		
		return wp_insert_post( $insert );
	}

	function update_post_meta_box($post_id, $meta_key, $meta_value) {
		update_post_meta($post_id, $meta_key, $meta_value);
	}

	function generate_featured_image($image_url, $post_id){
    $upload_dir = wp_upload_dir();
		$image_data = file_get_contents($image_url);
    $filename = basename($image_url);
		$unique_file_name = wp_unique_filename( $upload_dir['path'], $filename);
		$filename = basename($unique_file_name);
    if(wp_mkdir_p($upload_dir['path']))
      $file = $upload_dir['path'] . '/' . $filename;
    else
      $file = $upload_dir['basedir'] . '/' . $filename;
    file_put_contents($file, $image_data);

    $wp_filetype = wp_check_filetype($filename, null );
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    $res1= wp_update_attachment_metadata( $attach_id, $attach_data );
    $res2= set_post_thumbnail( $post_id, $attach_id );
	}
}

?>