<?php
/**
 * Theme setup and assets.
 *
 * @package EuroDeli_Market
 */

if (! defined('ABSPATH')) {
	exit;
}

function eurodeli_theme_setup(): void {
	load_theme_textdomain('eurodeli-market', get_template_directory() . '/languages');

	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('custom-logo');
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 600,
			'single_image_width'    => 900,
			'product_grid'          => array(
				'default_rows'    => 2,
				'min_rows'        => 1,
				'max_rows'        => 4,
				'default_columns' => 4,
				'min_columns'     => 2,
				'max_columns'     => 5,
			),
		)
	);
	add_theme_support('wc-product-gallery-slider');
	add_theme_support('wc-product-gallery-zoom');
	add_theme_support('wc-product-gallery-lightbox');

	register_nav_menus(
		array(
			'topbar'       => __('Top bar menu', 'eurodeli-market'),
			'primary'      => __('Primary menu', 'eurodeli-market'),
			'footer_about' => __('Footer about menu', 'eurodeli-market'),
			'footer_shop'  => __('Footer shop menu', 'eurodeli-market'),
		)
	);
}
add_action('after_setup_theme', 'eurodeli_theme_setup');

function eurodeli_content_width(): void {
	$GLOBALS['content_width'] = 1440;
}
add_action('after_setup_theme', 'eurodeli_content_width', 0);

function eurodeli_register_sidebars(): void {
	register_sidebar(
		array(
			'name'          => __('Shop filters', 'eurodeli-market'),
			'id'            => 'shop-filters',
			'description'   => __('Widgets in this area are shown in the WooCommerce shop sidebar.', 'eurodeli-market'),
			'before_widget' => '<section id="%1$s" class="widget sidebar-card %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __('Footer contacts', 'eurodeli-market'),
			'id'            => 'footer-contacts',
			'description'   => __('Footer contacts column.', 'eurodeli-market'),
			'before_widget' => '<section id="%1$s" class="widget footer-card %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action('widgets_init', 'eurodeli_register_sidebars');

function eurodeli_enqueue_assets(): void {
	wp_enqueue_style(
		'eurodeli-market-style',
		get_stylesheet_uri(),
		array(),
		EURODELI_THEME_VERSION
	);

	wp_enqueue_script(
		'eurodeli-market-theme',
		get_template_directory_uri() . '/assets/js/theme.js',
		array(),
		EURODELI_THEME_VERSION,
		true
	);

	wp_localize_script(
		'eurodeli-market-theme',
		'eurodeliTheme',
		array(
			'cartUrl'       => function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/'),
			'shopUrl'       => function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/'),
			'homeUrl'       => home_url('/'),
			'currencyLabel' => function_exists('get_woocommerce_currency_symbol') ? get_woocommerce_currency_symbol() : 'грн',
		)
	);
}
add_action('wp_enqueue_scripts', 'eurodeli_enqueue_assets');

function eurodeli_register_page_templates(array $templates): array {
	$templates['front-page.php'] = __('Storefront Homepage', 'eurodeli-market');
	return $templates;
}
add_filter('theme_page_templates', 'eurodeli_register_page_templates');
