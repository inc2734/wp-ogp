<?php
/**
 * @package inc2734/wp-ogp
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * OGP for home
 */
class Inc2734_WP_OGP_Home extends Inc2734_WP_OGP_Abstract_Controller {
	public function init() {
		$show_on_front  = get_option( 'show_on_front' );
		$page_for_posts = get_option( 'page_for_posts' );

		if ( 'page' === $show_on_front && $page_for_posts ) {
			$this->title       = get_the_title( $page_for_posts );
			$this->type        = 'blog';
			$this->url         = get_permalink( $page_for_posts );
			$this->image       = wp_get_attachment_image_url( get_post_thumbnail_id( $page_for_posts ), 'full' );
			$this->description = get_bloginfo( 'description' );
		} else {
			$this->title = get_bloginfo( 'name' );
			$this->type  = 'blog';
			$this->url   = home_url();
		}
	}
}
