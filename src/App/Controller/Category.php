<?php
/**
 * @package inc2734/wp-ogp
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\WP_OGP\App\Controller;

class Category extends AbstractController {
	public function init() {
		$term              = get_queried_object();
		$this->title       = single_cat_title( '', false );
		$this->type        = 'blog';
		$this->url         = get_term_link( $term );
		$this->description = $this->_strip_linebreaks( wp_strip_all_tags( category_description( $term->term_id ) ) );
	}
}
