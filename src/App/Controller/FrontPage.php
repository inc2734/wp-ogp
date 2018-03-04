<?php
/**
 * @package inc2734/wp-ogp
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\WP_OGP\App\Controller;

class FrontPage extends AbstractController {
	public function init() {
		$show_on_front = get_option( 'show_on_front' );
		$page_on_front = get_option( 'page_on_front' );

		if ( 'page' === $show_on_front && $page_on_front ) {
			$this->type        = 'website';
			$this->url         = get_permalink( $page_on_front );
			$this->image       = wp_get_attachment_image_url( get_post_thumbnail_id( $page_on_front ), 'full' );
			$this->description = get_bloginfo( 'description' );
		} else {
			$this->type = 'blog';
			$this->url  = home_url();
		}

		$this->title = get_bloginfo( 'name' );
	}
}
