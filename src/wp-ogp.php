<?php
/**
 * @package inc2734/wp-ogp
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Output OGP tags
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Inc2734_WP_OGP {

	/**
	 * @var Inc2734_WP_OGP_Abstract_Controller
	 */
	protected $ogp;

	/**
	 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
	 */
	public function __construct() {
		$includes = array(
			'/app/abstract',
			'/app/controller',
		);
		foreach ( $includes as $include ) {
			foreach ( glob( __DIR__ . $include . '/*.php' ) as $file ) {
				require_once( $file );
			}
		}

		if ( is_tax() ) {
			$this->ogp = new Inc2734_WP_OGP_Taxonomy();
		} elseif ( is_attachment() ) {
			$this->ogp = new Inc2734_WP_OGP_Attachment();
		} elseif ( is_page() && ! is_front_page() ) {
			$this->ogp = new Inc2734_WP_OGP_Page();
		} elseif ( is_post_type_archive() ) {
			$this->ogp = new Inc2734_WP_OGP_Post_Type_Archive();
		} elseif ( is_single() ) {
			$this->ogp = new Inc2734_WP_OGP_Single();
		} elseif ( is_category() ) {
			$this->ogp = new Inc2734_WP_OGP_Category();
		} elseif ( is_tag() ) {
			$this->ogp = new Inc2734_WP_OGP_Tag();
		} elseif ( is_author() ) {
			$this->ogp = new Inc2734_WP_OGP_Author();
		} elseif ( is_day() ) {
			$this->ogp = new Inc2734_WP_OGP_Day();
		} elseif ( is_month() ) {
			$this->ogp = new Inc2734_WP_OGP_Month();
		} elseif ( is_year() ) {
			$this->ogp = new Inc2734_WP_OGP_Year();
		} elseif ( is_home() && ! is_front_page() ) {
			$this->ogp = new Inc2734_WP_OGP_Home();
		} elseif ( is_front_page() ) {
			$this->ogp = new Inc2734_WP_OGP_Front_Page();
		}
	}

	public function get_title() {
		if ( ! $this->ogp ) {
			return;
		}
		return apply_filters( 'inc2734_wp_ogp_title', $this->ogp->get_title() );
	}

	public function get_type() {
		if ( ! $this->ogp ) {
			return;
		}
		return apply_filters( 'inc2734_wp_ogp_type', $this->ogp->get_type() );
	}

	public function get_url() {
		if ( ! $this->ogp ) {
			return;
		}
		return apply_filters( 'inc2734_wp_ogp_url', $this->ogp->get_url() );
	}

	public function get_image() {
		if ( ! $this->ogp ) {
			return;
		}
		return apply_filters( 'inc2734_wp_ogp_image', $this->ogp->get_image() );
	}

	public function get_description() {
		if ( ! $this->ogp ) {
			return;
		}
		$description = $this->ogp->get_description();

		if ( empty( $description ) ) {
			$description = wp_strip_all_tags( get_bloginfo( 'description' ) );
		}

		return wp_trim_words(
			str_replace(
				array( "\r", "\n" ),
				'',
				apply_filters( 'inc2734_wp_ogp_description', $description )
			)
		);
	}

	public function get_site_name() {
		if ( ! $this->ogp ) {
			return;
		}
		return apply_filters( 'inc2734_wp_ogp_site_name', $this->ogp->get_site_name() );
	}

	public function get_locale() {
		if ( ! $this->ogp ) {
			return;
		}
		return apply_filters( 'inc2734_wp_ogp_locale', $this->ogp->get_locale() );
	}
}
