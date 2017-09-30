<?php
/**
 * @package inc2734/wp-ogp
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * OGP for category archive
 */
class Inc2734_WP_OGP_Category extends Inc2734_WP_OGP_Abstract_Controller {
	public function init() {
		$term              = get_queried_object();
		$this->title       = single_cat_title( '', false );
		$this->type        = 'blog';
		$this->url         = get_term_link( $term );
		$this->description = wp_strip_all_tags( category_description( $term->term_id ) );
	}
}
