<?php
/**
 * @package inc2734/wp-ogp
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * OGP for page
 */
class Inc2734_WP_OGP_Page extends Inc2734_WP_OGP_Abstract_Controller {
	public function init() {
		$this->title       = get_the_title();
		$this->type        = 'article';
		$this->url         = get_permalink();
		$this->image       = wp_get_attachment_image_url( get_post_thumbnail_id(), 'full' );
		$this->description = $this->_get_description();
	}
}
