<?php
/**
 * Template helpers.
 *
 * @package EuroDeli_Market
 */

if (! defined('ABSPATH')) {
	exit;
}

function eurodeli_get_asset_uri(string $path): string {
	return trailingslashit(get_template_directory_uri()) . ltrim($path, '/');
}

function eurodeli_render_page_hero(string $title, string $description = '', string $eyebrow = ''): void {
	get_template_part(
		'template-parts/content/page-hero',
		null,
		array(
			'title'       => $title,
			'description' => $description,
			'eyebrow'     => $eyebrow,
		)
	);
}

function eurodeli_breadcrumbs(): void {
	if (function_exists('woocommerce_breadcrumb') && (is_woocommerce() || is_cart() || is_checkout() || is_account_page())) {
		echo '<div class="breadcrumbs">';
		woocommerce_breadcrumb(
			array(
				'delimiter'   => '<span>/</span>',
				'wrap_before' => '',
				'wrap_after'  => '',
				'before'      => '',
				'after'       => '',
				'home'        => __('Головна', 'eurodeli-market'),
			)
		);
		echo '</div>';
		return;
	}

	if (! is_front_page()) {
		echo '<div class="breadcrumbs">';
		printf('<a href="%s">%s</a>', esc_url(home_url('/')), esc_html__('Головна', 'eurodeli-market'));
		echo '<span>/</span>';
		echo '<span>' . esc_html(get_the_title()) . '</span>';
		echo '</div>';
	}
}

function eurodeli_menu_fallback(array $items): void {
	foreach ($items as $item) {
		printf(
			'<a class="nav-link" href="%1$s">%2$s</a>',
			esc_url($item['url']),
			esc_html($item['label'])
		);
	}
}

function eurodeli_get_account_url(): string {
	return function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : wp_login_url();
}

function eurodeli_get_shop_url(): string {
	return function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/');
}

function eurodeli_shop_query(array $args = array()): WP_Query {
	$defaults = array(
		'post_type'      => 'product',
		'posts_per_page' => 8,
		'post_status'    => 'publish',
	);

	return new WP_Query(wp_parse_args($args, $defaults));
}

function eurodeli_render_product_shelf(string $title, string $description, array $query_args, string $slider_name, string $view_all_url = ''): void {
	$query = eurodeli_shop_query($query_args);

	get_template_part(
		'template-parts/store/shelf-section',
		null,
		array(
			'title'        => $title,
			'description'  => $description,
			'query'        => $query,
			'slider_name'  => $slider_name,
			'view_all_url' => $view_all_url,
		)
	);

	wp_reset_postdata();
}

function eurodeli_get_product_term_name(WC_Product $product, string $taxonomy): string {
	$terms = get_the_terms($product->get_id(), $taxonomy);
	if (is_wp_error($terms) || empty($terms)) {
		return '';
	}

	return (string) $terms[0]->name;
}

function eurodeli_get_product_attr(WC_Product $product, string $attribute): string {
	$value = $product->get_attribute($attribute);
	return is_string($value) ? trim($value) : '';
}
