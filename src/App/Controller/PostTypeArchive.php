<?php
/**
 * @package inc2734/wp-ogp
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\WP_OGP\App\Controller;

class PostTypeArchive extends AbstractController {
	public function init() {
		global $wp_query;

		$post_type   = $wp_query->get( 'post_type' );
		$this->title = post_type_archive_title( '', false );
		$this->type  = 'blog';
		$this->url   = get_post_type_archive_link( $post_type );
	}
}
