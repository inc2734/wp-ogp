# WP OGP

[![Build Status](https://travis-ci.org/inc2734/wp-ogp.svg?branch=master)](https://travis-ci.org/inc2734/wp-ogp)
[![Latest Stable Version](https://poser.pugx.org/inc2734/wp-ogp/v/stable)](https://packagist.org/packages/inc2734/wp-ogp)
[![License](https://poser.pugx.org/inc2734/wp-ogp/license)](https://packagist.org/packages/inc2734/wp-ogp)

## Install
```
$ composer require inc2734/wp-ogp
```

## How to use
```
<?php
add_action(
	'wp_head',
	function() {
		$ogp = new \Inc2734\WP_OGP\Bootsrap();
		?>
		<meta property="og:title" content="<?php echo esc_attr( $ogp->get_title() ); ?>">
		<meta property="og:type" content="<?php echo esc_attr( $ogp->get_type() ); ?>">
		<meta property="og:url" content="<?php echo esc_attr( $ogp->get_url() ); ?>">
		<meta property="og:image" content="<?php echo esc_attr( $ogp->get_image() ); ?>">
		<meta property="og:site_name" content="<?php echo esc_attr( $ogp->get_site_name() ); ?>">
		<meta property="og:description" content="<?php echo esc_attr( $ogp->get_description() ); ?>">
		<meta property="og:locale" content="<?php echo esc_attr( $ogp->get_locale() ); ?>">
		<?php
	}
);
```

## Filter hooks

### inc2734_wp_ogp_title
```
/**
 * Customize og:title
 *
 * @param string $title
 * @return string
 */
add_filter(
	'inc2734_wp_ogp_title',
	function( $title ) {
		return $title;
	}
);
```

### inc2734_wp_ogp_type
```
/**
 * Customize og:type
 *
 * @param string $type
 * @return string
 */
add_filter(
	'inc2734_wp_ogp_type',
	function( $type ) {
		return $type;
	}
);
```

### inc2734_wp_ogp_url
```
/**
 * Customize og:url
 *
 * @param string $url
 * @return string
 */
add_filter(
	'inc2734_wp_ogp_url',
	function( $url ) {
		return $url;
	}
);
```

### inc2734_wp_ogp_image
```
/**
 * Customize og:image
 *
 * @param string $image
 * @return string
 */
add_filter(
	'inc2734_wp_ogp_image',
	function( $image ) {
		return $image;
	}
);
```

### inc2734_wp_ogp_description
```
/**
 * Customize og:description
 *
 * @param string $description
 * @return string
 */
add_filter(
	'inc2734_wp_ogp_description',
	function( $description ) {
		return $description;
	}
);
```

### inc2734_wp_ogp_site_name
```
/**
 * Customize og:site_name
 *
 * @param string $site_name
 * @return string
 */
add_filter(
	'inc2734_wp_ogp_site_name',
	function( $site_name ) {
		return $site_name;
	}
);
```

### inc2734_wp_ogp_locale
```
/**
 * Customize og:locale
 *
 * @param string $locale
 * @return string
 */
add_filter(
	'inc2734_wp_ogp_locale',
	function( locale ) {
		return $locale;
	}
);
```

### inc2734_wp_ogp_app_id
```
/**
 * Customize fb:app_id
 *
 * @param string $app_id
 * @return string
 */
add_filter(
	'inc2734_wp_ogp_app_id',
	function( $app_id ) {
		return $app_id;
	}
);
```
