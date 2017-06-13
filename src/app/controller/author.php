<?php
class Inc2734_WP_OGP_Author extends Inc2734_WP_OGP_Abstract_Controller {
	public function init() {
		$author            = get_queried_object();
		$this->title       = get_the_author_meta( 'display_name', $author->ID );
		$this->type        = 'profile';
		$this->url         = get_author_posts_url( $author->ID );
		$this->description = wp_strip_all_tags( get_the_author_meta( 'description', $author->ID ) );
	}
}
