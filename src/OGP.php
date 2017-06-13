<?php
namespace Inc2734\WP_OGP;

class OGP {

	/**
	 * $WP_OGP
	 * @var Inc2734_WP_OGP
	 */
	protected $WP_OGP;

	public function __construct() {
		include_once( __DIR__ . '/wp-ogp.php' );
		$this->WP_OGP = new \Inc2734_WP_OGP();
	}

	public function get_title() {
		return $this->WP_OGP->get_title();
	}

	public function get_type() {
		return $this->WP_OGP->get_type();
	}

	public function get_url() {
		return $this->WP_OGP->get_url();
	}

	public function get_image() {
		return $this->WP_OGP->get_image();
	}

	public function get_description() {
		return $this->WP_OGP->get_description();
	}

	public function get_site_name() {
		return $this->WP_OGP->get_site_name();
	}

	public function get_locale() {
		return $this->WP_OGP->get_locale();
	}
}
