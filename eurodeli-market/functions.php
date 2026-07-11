<?php
/**
 * Theme bootstrap.
 *
 * @package EuroDeli_Market
 */

if (! defined('EURODELI_THEME_VERSION')) {
	define('EURODELI_THEME_VERSION', '1.0.0');
}

$eurodeli_includes = array(
	'/inc/theme-setup.php',
	'/inc/theme-data.php',
	'/inc/catalog-architecture.php',
	'/inc/catalog-tools.php',
	'/inc/template-tags.php',
	'/inc/woocommerce.php',
);

foreach ($eurodeli_includes as $eurodeli_file) {
	$eurodeli_path = get_template_directory() . $eurodeli_file;
	if (file_exists($eurodeli_path)) {
		require_once $eurodeli_path;
	}
}
