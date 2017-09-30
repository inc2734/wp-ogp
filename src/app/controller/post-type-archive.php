<?php
/**
 * @package inc2734/wp-ogp
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * OGP for post type archive
 */
class Inc2734_WP_OGP_Post_Type_Archive extends Inc2734_WP_OGP_Abstract_Controller {
	public function init() {
		global $wp_query;

		$post_type   = $wp_query->get( 'post_type' );
		$this->title = post_type_archive_title( '', false );
		$this->type  = 'blog';
		$this->url   = get_post_type_archive_link( $post_type );
	}
}
