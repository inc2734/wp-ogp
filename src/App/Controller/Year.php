<?php
/**
 * @package inc2734/wp-ogp
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\WP_OGP\App\Controller;

class Year extends AbstractController {
	public function init() {
		$year = get_query_var( 'year' );
		if ( ! $year ) {
			$ymd  = get_query_var( 'm' );
			$year = $ymd;
		}
		$this->title = $this->_year( $year );
		$this->type  = 'blog';
		$this->url   = get_year_link( $year );
	}
}
