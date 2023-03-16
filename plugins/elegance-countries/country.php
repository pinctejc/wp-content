<?php

/*
Plugin Name: Elegance Countries
Description: Import and manage a list of countries into your WordPress site as Custom Post Types.
Version: 0.0.1
Author: Elegance Team
Author URI: https://elegancedesign.net/
License: GPL2
*/

class Countries {

	public $post_type = 'country';
	
	/**
	 * Constructor
	 */
	function __construct() {	
		add_action( 'init', array( $this, 'register_post_types' ) );
		if ( is_admin() ) {
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );
			add_action( 'save_post', array( $this, 'save_details' ) );
			add_filter( 'posts_orderby', array( $this, 'countries_orderby' ), 0, 1 );
		}
	}
	
	/**
	 * Create custom post type and custom taxonomy
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	function register_post_types() {
		$labels = array(
			'name'               => _x( 'Countries', 'post type general name', 'countries' ),
			'all_items'          => __( 'All Countries', 'countries'),
			'singular_name'      => _x( 'Country', 'post type singular name', 'countries' ),
			'add_new'            => _x( 'Add New', 'Country', 'countries' ),
			'add_new_item'       => __( 'Add New Country', 'countries' ),
			'edit_item'          => __( 'Edit Country', 'countries' ),
			'new_item'           => __( 'New Country', 'countries' ),
			'view_item'          => __( 'View Country', 'countries' ),
			'search_items'       => __( 'Search Countries', 'countries' ),
			'not_found'          => __( 'No Countries found', 'countries' ),
			'not_found_in_trash' => __( 'No Countries found in Trash', 'countries' ), 
			'menu_name'          => __( 'Countries', 'countries' )
		);
		$args = array(
			'labels'               => $labels,
			'public'               => false,
			'exclude_from_search'  => true,
			'publicly_queryable'   => true,
			'show_ui'              => true,
			'show_in_nav_menus'    => false, 
			'query_var'            => true,
			'rewrite'              => true,
			'capability_type'      => 'post',
			'hierarchical'         => false,
			'show_in_nav_menus'    => false,
			'menu_position'        => 58,
			'menu_icon'            => 'dashicons-admin-site',
			'supports'             => array( 'title', 'thumbnail'),
			'visible'              => true,
			'register_meta_box_cb' => array( $this, 'add_country_meta_boxes' )
		);
		register_post_type($this->post_type, $args );
	}

	/**
	 * Add Country Meta Boxes
	 */

	function add_country_meta_boxes() {
		add_meta_box('country_meta', __( 'Country Code', 'countries' ), array( $this, 'country_code_meta' ), $this->post_type, 'normal', 'low');
	}

	/**
	 * Render Country Code Meta Box
	 */
	function country_code_meta() {
		global $post;
		$country_code = get_post_meta( $post->ID, 'country_code', true );
		?>
		<input type="text" name="country_code" value="<?php echo $country_code; ?>" />
		<?php
	}
	
	/**
	 * Countries Admin Menu
	 *
	 * Adds XML Importer admin page.
	 */
	function admin_menu() {
		add_submenu_page( 'edit.php?post_type='. $this->post_type, __( 'Countries Importer', 'countries' ), __( 'Import', 'countries' ), 'manage_options', 'countries-importer-page', array( $this, 'importer_page' ) );
	}

	
	/**
	 * Countries Import Page
	 */
	function importer_page() {
		include_once( plugin_dir_path( __FILE__ ) . 'includes/xml-parser.php' );
	?>
		<div class="wrap">
			<h2><?php _e( 'Country Importer', 'countries' ); ?></h2>
			<?php
				$xml = new Countries_XML_Parser();
				$xml->save_initial_countries();
			?>
		</div>
	<?php
	}
	
	/**
	 * Save Country Meta Box Details
	 *
	 * @param int $post_id Post ID.
	 */
	function save_details( $post_id ) {
		
		$post_vars = shortcode_atts( array(
			'country_code' => ''
		), $_POST );
		
		update_post_meta( $post_id, 'country_code', $post_vars['country_code'] );
	}
	
	
	/**
	 * Countries orderby
	 *
	 * Forces countries to default to order alphabetically in the admin rather
	 * than by publish date. Does this as priority 0 so that by default any other
	 * filters will override this.
	 *
	 * @todo Should we do this by default elsewhere, not just the admin?
	 *
	 * @param string $order The SQL order statement.
	 */
	function countries_orderby( $order ) {
		global $wpdb;
		if ( get_query_var( 'post_type' ) == $this->post_type ) {
			return "$wpdb->posts.post_title ASC";
		}
		return $order;
	}
}

new Countries();

require_once(plugin_dir_path( __FILE__ ) . 'includes/functions.php');
