<?php
class Inc2734_WP_OGP_Day extends Inc2734_WP_OGP_Abstract_Controller {
	public function init() {
		$year = get_query_var( 'year' );
		if ( $year ) {
			$month = get_query_var( 'monthnum' );
			$day   = get_query_var( 'day' );
		} else {
			$ymd   = get_query_var( 'm' );
			$year  = substr( $ymd, 0, 4 );
			$month = substr( $ymd, 4, 2 );
			$day   = substr( $ymd, -2 );
		}
		$this->title = $this->_year( $year ) . $this->_month( $month ) . $this->_day( $day );
		$this->type  = 'blog';
		$this->url   = get_day_link( $year, $month, $day );
	}
}
