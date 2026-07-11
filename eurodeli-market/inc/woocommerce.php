<?php
/**
 * WooCommerce integration.
 *
 * @package EuroDeli_Market
 */

if (! defined('ABSPATH')) {
	exit;
}

function eurodeli_wc_setup(): void {
	remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	add_action('woocommerce_before_main_content', 'eurodeli_wc_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'eurodeli_wc_wrapper_end', 10);

	remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
}
add_action('wp', 'eurodeli_wc_setup');

function eurodeli_wc_wrapper_start(): void {
	echo '<main class="site-main"><div class="container">';
}

function eurodeli_wc_wrapper_end(): void {
	echo '</div></main>';
}

function eurodeli_loop_columns(): int {
	return wp_is_mobile() ? 2 : 4;
}
add_filter('loop_shop_columns', 'eurodeli_loop_columns');

function eurodeli_products_per_page(int $count): int {
	return 12;
}
add_filter('loop_shop_per_page', 'eurodeli_products_per_page', 20);

function eurodeli_sale_badge(string $html, WC_Post $post, WC_Product $product): string {
	if (! $product->is_on_sale()) {
		return $html;
	}

	$percentage = 0;
	if ($product->get_regular_price() && $product->get_sale_price()) {
		$percentage = round((($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100);
	}

	$label = $percentage > 0 ? '-' . $percentage . '%' : __('Акція', 'eurodeli-market');
	return '<span class="product-badge product-badge--sale">' . esc_html($label) . '</span>';
}
add_filter('woocommerce_sale_flash', 'eurodeli_sale_badge', 10, 3);

function eurodeli_related_products_args(array $args): array {
	$args['posts_per_page'] = 4;
	$args['columns']        = 4;
	return $args;
}
add_filter('woocommerce_output_related_products_args', 'eurodeli_related_products_args');

function eurodeli_cart_link_fragment(array $fragments): array {
	ob_start();
	?>
	<span class="cart-count" data-cart-count><?php echo esc_html(WC()->cart ? WC()->cart->get_cart_contents_count() : 0); ?></span>
	<?php
	$fragments['[data-cart-count]'] = ob_get_clean();
	return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'eurodeli_cart_link_fragment');
