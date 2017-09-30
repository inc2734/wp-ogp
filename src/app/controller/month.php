<?php
/**
 * @package inc2734/wp-ogp
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * OGP for month archive
 */
class Inc2734_WP_OGP_Month extends Inc2734_WP_OGP_Abstract_Controller {
	public function init() {
		$year = get_query_var( 'year' );
		if ( $year ) {
			$month = get_query_var( 'monthnum' );
		} else {
			$ymd   = get_query_var( 'm' );
			$year  = substr( $ymd, 0, 4 );
			$month = substr( $ymd, -2 );
		}
		$this->title = $this->_year( $year ) . $this->_month( $month );
		$this->type  = 'blog';
		$this->url   = get_month_link( $year, $month );
	}
}
