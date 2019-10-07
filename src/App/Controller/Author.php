<?php
/**
 * @package inc2734/wp-ogp
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\WP_OGP\App\Controller;

class Author extends AbstractController {
	public function init() {
		$author            = get_queried_object();
		$this->title       = get_the_author_meta( 'display_name', $author->ID );
		$this->type        = 'profile';
		$this->url         = get_author_posts_url( $author->ID );
		$this->description = $this->_strip_linebreaks( wp_strip_all_tags( get_the_author_meta( 'description', $author->ID ) ) );
	}
}
