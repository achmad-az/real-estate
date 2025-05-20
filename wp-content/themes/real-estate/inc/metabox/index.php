<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$gns_includes = [
	'class-programs-block.php',
	'class-programs-2-block.php',
	'class-offer-block.php',
	'class-services-block.php',
	'class-hero-title-block.php',
	'class-team-block.php',
	'class-blog-block.php',
	'class-theme-option.php',
];

foreach ( $gns_includes as $file ) {
	require_once get_template_directory() . '/inc/metabox/' . $file;
}