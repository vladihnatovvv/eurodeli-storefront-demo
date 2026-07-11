<?php
/**
 * Product card for loops.
 *
 * @package EuroDeli_Market
 */

defined('ABSPATH') || exit;

global $product;

if (! $product || ! $product->is_visible()) {
	return;
}

$sku_label = $product->get_sku() ?: eurodeli_get_product_attr($product, 'brand') ?: __('Європейський продукт', 'eurodeli-market');
?>
<article <?php wc_product_class('product-card product-card--shelf', $product); ?>>
	<div class="product-badges">
		<?php if ($product->is_featured()) : ?>
			<span class="product-badge product-badge--top"><?php esc_html_e('Топ продажів', 'eurodeli-market'); ?></span>
		<?php endif; ?>
		<?php echo wp_kses_post(wc_get_sale_flash()); ?>
		<?php if ('new' === $product->get_stock_status()) : ?>
			<span class="product-badge product-badge--new"><?php esc_html_e('Новинка', 'eurodeli-market'); ?></span>
		<?php endif; ?>
	</div>

	<a class="product-image" href="<?php the_permalink(); ?>">
		<?php echo wp_kses_post($product->get_image('woocommerce_thumbnail')); ?>
	</a>

	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	<div class="product-card__sku"><?php echo esc_html($sku_label); ?></div>
	<div class="product-card__price"><?php echo wp_kses_post($product->get_price_html()); ?></div>
	<div class="product-card__actions">
		<?php woocommerce_template_loop_add_to_cart(); ?>
		<button class="product-card__wish" type="button" aria-label="<?php esc_attr_e('В обране', 'eurodeli-market'); ?>">
			<svg class="product-card__wish-icon" viewBox="0 0 24 24" aria-hidden="true">
				<path d="M12 21.35 10.55 20.03C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35Z"></path>
			</svg>
		</button>
	</div>
</article>
