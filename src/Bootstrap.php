<?php
/**
 * @package inc2734/wp-ogp
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\WP_OGP;

class Bootstrap {

	/**
	 * @var Inc2734_WP_OGP_Abstract_Controller
	 */
	protected $ogp;

	public function __construct() {
		if ( is_search() || is_404() ) {
			return;
		}

		$controllers = array_filter(
			[
				'Taxonomy'        => is_tax(),
				'Attachment'      => is_attachment(),
				'Page'            => is_page() && ! is_front_page(),
				'PostTypeArchive' => is_post_type_archive(),
				'Single'          => is_single(),
				'Category'        => is_category(),
				'Tag'             => is_tag(),
				'Author'          => is_author(),
				'Day'             => is_day(),
				'Month'           => is_month(),
				'Year'            => is_year(),
				'Home'            => is_home() && ! is_front_page(),
				'FrontPage'       => is_front_page(),
			]
		);

		if ( $controllers ) {
			$class = '\Inc2734\WP_OGP\App\Controller\\' . key( $controllers );
			if ( class_exists( $class ) ) {
				$this->ogp = new $class();
			}
		}
	}

	/**
	 * Return og:title
	 *
	 * @return string
	 */
	public function get_title() {
		if ( ! $this->ogp ) {
			return;
		}

		return apply_filters( 'inc2734_wp_ogp_title', $this->ogp->get_title() );
	}

	/**
	 * Return og:type
	 *
	 * @return string
	 */
	public function get_type() {
		if ( ! $this->ogp ) {
			return;
		}

		return apply_filters( 'inc2734_wp_ogp_type', $this->ogp->get_type() );
	}

	/**
	 * Return og:url
	 *
	 * @return string
	 */
	public function get_url() {
		if ( ! $this->ogp ) {
			return;
		}

		return apply_filters( 'inc2734_wp_ogp_url', $this->ogp->get_url() );
	}

	/**
	 * Return og:image
	 *
	 * @return string
	 */
	public function get_image() {
		if ( ! $this->ogp ) {
			return;
		}

		return apply_filters( 'inc2734_wp_ogp_image', $this->ogp->get_image() );
	}

	/**
	 * Return og:description
	 *
	 * @return string
	 */
	public function get_description() {
		if ( ! $this->ogp ) {
			return;
		}

		$description = $this->ogp->get_description();

		if ( empty( $description ) ) {
			$description = wp_strip_all_tags( get_bloginfo( 'description' ) );
		}

		return apply_filters( 'inc2734_wp_ogp_description', $description );
	}

	/**
	 * Return og:site_name
	 *
	 * @return string
	 */
	public function get_site_name() {
		if ( ! $this->ogp ) {
			return;
		}

		return apply_filters( 'inc2734_wp_ogp_site_name', $this->ogp->get_site_name() );
	}

	/**
	 * Return og:locale
	 *
	 * @return string
	 */
	public function get_locale() {
		if ( ! $this->ogp ) {
			return;
		}

		return apply_filters( 'inc2734_wp_ogp_locale', $this->ogp->get_locale() );
	}

	/**
	 * Return fb:app_id
	 *
	 * @return string
	 */
	public function get_app_id() {
		if ( ! $this->ogp ) {
			return;
		}

		return apply_filters( 'inc2734_wp_ogp_app_id', $this->ogp->get_app_id() );
	}
}
