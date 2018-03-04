<?php
class OGPTest extends WP_UnitTestCase {

	public function setup() {
		global $wp_rewrite;
		parent::setup();

		$wp_rewrite->init();
		$wp_rewrite->set_permalink_structure( '/%year%/%monthnum%/%day%/%postname%/' );

		$this->author_id     = $this->factory->user->create();
		$this->post_ids      = $this->factory->post->create_many( 20, [ 'post_author' => $this->author_id ] );
		$this->front_page_id = $this->factory->post->create( [ 'post_type' => 'page', 'post_title' => 'HOME' ] );
		$this->blog_page_id  = $this->factory->post->create( [ 'post_type' => 'page', 'post_title' => 'BLOG' ] );
		$this->tag_id        = $this->factory->term->create( array( 'taxonomy' => 'post_tag' ) );
		$this->post_type     = rand_str( 12 );
		$this->taxonomy      = rand_str( 12 );

		register_post_type(
			$this->post_type,
			[
				'public'      => true ,
				'taxonomies'  => ['category'],
				'has_archive' => true
			]
		);

		register_taxonomy(
			$this->taxonomy,
			$this->post_type,
			[
				'public' => true,
			]
		);

		foreach( $this->post_ids as $post_id ) {
			wp_set_object_terms( $post_id, get_term( $this->tag_id, 'post_tag' )->slug, 'post_tag' );
		}

		create_initial_taxonomies();
		$wp_rewrite->flush_rules();
	}

	public function tearDown() {
		parent::tearDown();

		update_option( 'show_on_front', 'posts' );
		update_option( 'page_on_front', 0 );
		update_option( 'page_for_posts', 0 );
		_unregister_post_type( $this->post_type );
		_unregister_taxonomy( $this->taxonomy, $this->post_type );
	}

	public function test_front_page() {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $this->front_page_id );
		update_option( 'page_for_posts', $this->blog_page_id );

		$this->go_to( home_url() );
		$ogp = new \Inc2734\WP_OGP\OGP();
		$this->assertEquals( get_bloginfo( 'name' ), $ogp->get_title() );
		$this->assertEquals( 'website', $ogp->get_type() );
		$this->assertEquals( home_url( '/' ), $ogp->get_url() );
		$this->assertEquals( '', $ogp->get_image() );
		$this->assertEquals( get_bloginfo( 'description' ), $ogp->get_description() );
		$this->assertEquals( get_bloginfo( 'name' ), $ogp->get_site_name() );
		$this->assertEquals( get_locale(), $ogp->get_locale() );
	}

	public function test_blog() {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $this->front_page_id );
		update_option( 'page_for_posts', $this->blog_page_id );

		$this->go_to( get_permalink( $this->blog_page_id ) );
		$ogp = new \Inc2734\WP_OGP\OGP();
		$this->assertEquals( get_the_title( $this->blog_page_id ), $ogp->get_title() );
		$this->assertEquals( 'blog', $ogp->get_type() );
		$this->assertEquals( get_permalink( $this->blog_page_id ), $ogp->get_url() );
		$this->assertEquals( '', $ogp->get_image() );
		$this->assertEquals( get_bloginfo( 'description' ), $ogp->get_description() );
		$this->assertEquals( get_bloginfo( 'name' ), $ogp->get_site_name() );
		$this->assertEquals( get_locale(), $ogp->get_locale() );
	}

	public function test_category() {
		$category = get_terms( 'post_tag' )[0];
		$this->go_to( get_term_link( $category ) );
		$ogp = new \Inc2734\WP_OGP\OGP();
		$this->assertEquals( $category->name, $ogp->get_title() );
		$this->assertEquals( 'blog', $ogp->get_type() );
		$this->assertEquals( get_term_link( $category ), $ogp->get_url() );
		$this->assertEquals( '', $ogp->get_image() );
		$this->assertEquals( $category->description, $ogp->get_description() );
		$this->assertEquals( get_bloginfo( 'name' ), $ogp->get_site_name() );
		$this->assertEquals( get_locale(), $ogp->get_locale() );
	}

	public function test_post_tag() {
		$post_tag = get_terms( 'post_tag' )[0];
		$this->go_to( get_term_link( $post_tag ) );
		$ogp = new \Inc2734\WP_OGP\OGP();
		$this->assertEquals( $post_tag->name, $ogp->get_title() );
		$this->assertEquals( 'blog', $ogp->get_type() );
		$this->assertEquals( get_term_link( $post_tag ), $ogp->get_url() );
		$this->assertEquals( '', $ogp->get_image() );
		$this->assertEquals( $post_tag->description, $ogp->get_description() );
		$this->assertEquals( get_bloginfo( 'name' ), $ogp->get_site_name() );
		$this->assertEquals( get_locale(), $ogp->get_locale() );
	}

	public function test_year() {
		$newest_post = get_post( $this->post_ids[0] );
		$year = date( 'Y', strtotime( $newest_post->post_date ) );
		$this->go_to( get_year_link( $year ) );
		$ogp = new \Inc2734\WP_OGP\OGP();
		$ogp_year = new Inc2734\WP_OGP\App\Controller\Year();
		$this->assertEquals( $ogp_year->get_title(), $ogp->get_title() );
		$this->assertEquals( 'blog', $ogp->get_type() );
		$this->assertEquals( get_year_link( $year ), $ogp->get_url() );
		$this->assertEquals( '', $ogp->get_image() );
		$this->assertEquals( get_bloginfo( 'description' ), $ogp->get_description() );
		$this->assertEquals( get_bloginfo( 'name' ), $ogp->get_site_name() );
		$this->assertEquals( get_locale(), $ogp->get_locale() );
	}

	public function test_month() {
		$newest_post = get_post( $this->post_ids[0] );
		$year  = date( 'Y', strtotime( $newest_post->post_date ) );
		$month = date( 'n', strtotime( $newest_post->post_date ) );
		$this->go_to( get_month_link( $year, $month ) );
		$ogp = new \Inc2734\WP_OGP\OGP();
		$ogp_month = new Inc2734\WP_OGP\App\Controller\Month();
		$this->assertEquals( $ogp_month->get_title(), $ogp->get_title() );
		$this->assertEquals( 'blog', $ogp->get_type() );
		$this->assertEquals( get_month_link( $year, $month ), $ogp->get_url() );
		$this->assertEquals( '', $ogp->get_image() );
		$this->assertEquals( get_bloginfo( 'description' ), $ogp->get_description() );
		$this->assertEquals( get_bloginfo( 'name' ), $ogp->get_site_name() );
		$this->assertEquals( get_locale(), $ogp->get_locale() );
	}

	public function test_day() {
		$newest_post = get_post( $this->post_ids[0] );
		$year  = date( 'Y', strtotime( $newest_post->post_date ) );
		$month = date( 'n', strtotime( $newest_post->post_date ) );
		$day   = date( 'j', strtotime( $newest_post->post_date ) );
		$this->go_to( get_day_link( $year, $month, $day ) );
		$ogp = new \Inc2734\WP_OGP\OGP();
		$ogp_day = new Inc2734\WP_OGP\App\Controller\Day();
		$this->assertEquals( $ogp_day->get_title(), $ogp->get_title() );
		$this->assertEquals( 'blog', $ogp->get_type() );
		$this->assertEquals( get_day_link( $year, $month, $day ), $ogp->get_url() );
		$this->assertEquals( '', $ogp->get_image() );
		$this->assertEquals( get_bloginfo( 'description' ), $ogp->get_description() );
		$this->assertEquals( get_bloginfo( 'name' ), $ogp->get_site_name() );
		$this->assertEquals( get_locale(), $ogp->get_locale() );
	}

	public function test_author() {
		$newest_post = get_post( $this->post_ids[0] );
		$author = $newest_post->post_author;
		$this->go_to( get_author_posts_url( $author ) );
		$ogp = new \Inc2734\WP_OGP\OGP();
		$this->assertEquals( get_the_author_meta( 'display_name', $author ), $ogp->get_title() );
		$this->assertEquals( 'profile', $ogp->get_type() );
		$this->assertEquals( get_author_posts_url( $author ), $ogp->get_url() );
		$this->assertEquals( '', $ogp->get_image() );
		$this->assertEquals( get_bloginfo( 'description' ), $ogp->get_description() );
		$this->assertEquals( get_bloginfo( 'name' ), $ogp->get_site_name() );
		$this->assertEquals( get_locale(), $ogp->get_locale() );
	}

	public function test_single() {
		// Post
		$newest_post = get_post( $this->post_ids[0] );
		$categories = get_the_category( $newest_post );
		$this->go_to( get_permalink( $newest_post ) );
		$ogp = new \Inc2734\WP_OGP\OGP();
		$this->assertEquals( get_the_title( $newest_post ), $ogp->get_title() );
		$this->assertEquals( 'article', $ogp->get_type() );
		$this->assertEquals( get_permalink( $newest_post ), $ogp->get_url() );
		$this->assertEquals( '', $ogp->get_image() );
		$this->assertEquals( get_the_excerpt( $newest_post ), $ogp->get_description() );
		$this->assertEquals( get_bloginfo( 'name' ), $ogp->get_site_name() );
		$this->assertEquals( get_locale(), $ogp->get_locale() );

		// Custom post
		$custom_post_type_id = $this->factory->post->create( [ 'post_type' => $this->post_type ] );
		$custom_post = get_post( $custom_post_type_id );
		$this->go_to( get_permalink( $custom_post_type_id ) );
		$ogp = new \Inc2734\WP_OGP\OGP();
		$post_type_object = get_post_type_object( $custom_post->post_type );
		$this->assertEquals( get_the_title( $custom_post_type_id ), $ogp->get_title() );
		$this->assertEquals( 'article', $ogp->get_type() );
		$this->assertEquals( get_permalink( $custom_post_type_id ), $ogp->get_url() );
		$this->assertEquals( '', $ogp->get_image() );
		$this->assertEquals( get_the_excerpt( $custom_post_type_id ), $ogp->get_description() );
		$this->assertEquals( get_bloginfo( 'name' ), $ogp->get_site_name() );
		$this->assertEquals( get_locale(), $ogp->get_locale() );
	}

	public function test_single_has_shortcode() {
		$newest_post = get_post( $this->post_ids[0] );
		$newest_post_id = wp_update_post( [
			'ID' => $newest_post->ID,
			'post_excerpt' => '[gallery]description',
		] );
		$newest_post = get_post( $newest_post_id );
		$this->go_to( get_permalink( $newest_post ) );
		$ogp = new \Inc2734\WP_OGP\OGP();
		$this->assertEquals( 'description', $ogp->get_description() );
	}

	public function test_post_type_archive() {
		// No posts
		$this->go_to( get_post_type_archive_link( $this->post_type ) );
		$this->assertFalse( get_post_type() );
		$ogp = new \Inc2734\WP_OGP\OGP();
		$post_type_object = get_post_type_object( $this->post_type );
		$this->assertEquals( $post_type_object->label, $ogp->get_title() );
		$this->assertEquals( 'blog', $ogp->get_type() );
		$this->assertEquals( get_post_type_archive_link( $this->post_type ), $ogp->get_url() );
		$this->assertEquals( '', $ogp->get_image() );
		$this->assertEquals( get_bloginfo( 'description' ), $ogp->get_description() );
		$this->assertEquals( get_bloginfo( 'name' ), $ogp->get_site_name() );
		$this->assertEquals( get_locale(), $ogp->get_locale() );

		// Has posts
		$custom_post_type_id = $this->factory->post->create( [ 'post_type' => $this->post_type ] );
		$this->go_to( get_post_type_archive_link( $this->post_type ) );
		$this->assertNotFalse( get_post_type() );
		$ogp = new \Inc2734\WP_OGP\OGP();
		$post_type_object = get_post_type_object( $this->post_type );
		$this->assertEquals( $post_type_object->label, $ogp->get_title() );
		$this->assertEquals( 'blog', $ogp->get_type() );
		$this->assertEquals( get_post_type_archive_link( $this->post_type ), $ogp->get_url() );
		$this->assertEquals( '', $ogp->get_image() );
		$this->assertEquals( get_bloginfo( 'description' ), $ogp->get_description() );
		$this->assertEquals( get_bloginfo( 'name' ), $ogp->get_site_name() );
		$this->assertEquals( get_locale(), $ogp->get_locale() );
	}
}
