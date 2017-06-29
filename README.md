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
// When Using composer auto loader
// $ogp = new Inc2734\WP_OGP\OGP();

// When not Using composer auto loader
include_once( get_theme_file_path( '/vendor/inc2734/wp-ogp/src/wp-ogp.php' ) );
$ogp = new Inc2734_WP_OGP();
```
