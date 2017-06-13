<?php
class Inc2734_WP_OGP_Tag extends Inc2734_WP_OGP_Abstract_Controller {
	public function init() {
		$term              = get_queried_object();
		$this->title       = single_tag_title( '', false );
		$this->type        = 'blog';
		$this->url         = get_term_link( $term );
		$this->description = wp_strip_all_tags( tag_description( $term->term_id ) );
	}
}
