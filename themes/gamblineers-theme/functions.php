<?php
define('CF_THEME_DIR', __DIR__);
/**
 * Casino Feed Application
 */
require_once CF_THEME_DIR . '/inc/app.php';

\CF_App::init();

add_filter( 'posts_where', 'extend_wp_query_where', 10, 2 );
function extend_wp_query_where( $where, $wp_query ) {
    if ( $extend_where = $wp_query->get( 'extend_where' ) ) {
        $where .= " AND " . $extend_where;
    }
    if ( $extend_where = $wp_query->get( 'search_post_title' ) ) {
        $where .= " AND wp_posts.post_title LIKE '%" . $extend_where."%'";
    }
    if ( $extend_where = $wp_query->get( 'ignore_posts' ) ) {
        $where .= " AND wp_posts.ID NOT IN (" . $extend_where.")";
    }
    if ( $extend_where = $wp_query->get( 'meta_key_compare' ) ) {
        $value_compare=$wp_query->get( 'value_compare' );
        $where .= " AND wp_postmeta.meta_key LIKE '" . $extend_where."' AND wp_postmeta.meta_value LIKE '%".$value_compare."%'";
    }
    return $where;
}