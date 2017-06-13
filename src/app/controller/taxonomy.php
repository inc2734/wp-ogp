<?php
class Inc2734_WP_OGP_Taxonomy extends Inc2734_WP_OGP_Abstract_Controller {
	public function init() {
		$term              = get_queried_object();
		$this->title       = $term->name;
		$this->type        = 'blog';
		$this->url         = get_term_link( $term );
		$this->description = wp_strip_all_tags( term_description( $term->term_id, $term->taxonomy ) );
	}
}
