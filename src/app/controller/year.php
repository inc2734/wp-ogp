<?php
/**
 * @package inc2734/wp-ogp
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * OGP for year archive
 */
class Inc2734_WP_OGP_Year extends Inc2734_WP_OGP_Abstract_Controller {
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
