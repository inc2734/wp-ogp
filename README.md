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
add_action( 'wp_head', function() {
  // When Using composer auto loader
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
} );
```
