<?php
/**
 * Cart template override.
 *
 * @package EuroDeli_Market
 */

defined('ABSPATH') || exit;
?>
<section class="page-hero">
	<div class="container">
		<div class="page-hero__card card">
			<span class="eyebrow"><?php esc_html_e('Оформлення замовлення', 'eurodeli-market'); ?></span>
			<h1><?php esc_html_e('Ваш кошик', 'eurodeli-market'); ?></h1>
			<p><?php esc_html_e('Перевірте вибрані товари, змініть кількість або приберіть зайві позиції перед оформленням.', 'eurodeli-market'); ?></p>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<?php do_action('woocommerce_before_cart'); ?>
		<form class="woocommerce-cart-form cart-layout" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
			<div class="cart-items">
				<?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) : ?>
					<?php
					$product        = $cart_item['data'];
					$product_id     = $cart_item['product_id'];
					$product_name   = $product ? $product->get_name() : '';
					$product_link   = $product && $product->is_visible() ? $product->get_permalink($cart_item) : '';
					$thumbnail      = $product ? $product->get_image('woocommerce_thumbnail') : '';
					$product_price  = WC()->cart->get_product_price($product);
					$product_total  = WC()->cart->get_product_subtotal($product, $cart_item['quantity']);
					?>
					<article class="cart-item card">
						<div class="cart-item__media">
							<?php echo wp_kses_post($thumbnail); ?>
						</div>
						<div class="cart-item__body">
							<h3>
								<?php if ($product_link) : ?>
									<a href="<?php echo esc_url($product_link); ?>"><?php echo esc_html($product_name); ?></a>
								<?php else : ?>
									<?php echo esc_html($product_name); ?>
								<?php endif; ?>
							</h3>
							<p><?php echo esc_html(wp_trim_words($product ? $product->get_short_description() : '', 20)); ?></p>
							<div class="cart-item__meta">
								<strong><?php echo wp_kses_post($product_price); ?></strong>
								<div class="cart-controls">
									<?php
									echo woocommerce_quantity_input(
										array(
											'input_name'  => "cart[{$cart_item_key}][qty]",
											'input_value' => $cart_item['quantity'],
											'max_value'   => $product ? $product->get_max_purchase_quantity() : 0,
											'min_value'   => 0,
										),
										$product,
										false
									);
									?>
								</div>
								<strong><?php echo wp_kses_post($product_total); ?></strong>
								<a class="remove-btn" href="<?php echo esc_url(wc_get_cart_remove_url($cart_item_key)); ?>"><?php esc_html_e('Видалити', 'eurodeli-market'); ?></a>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
			</div>

			<aside class="cart-summary card">
				<h3><?php esc_html_e('Ваше замовлення', 'eurodeli-market'); ?></h3>
				<div class="cart-summary__row"><span><?php esc_html_e('Товарів', 'eurodeli-market'); ?></span><strong><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></strong></div>
				<div class="cart-summary__row"><span><?php esc_html_e('До сплати', 'eurodeli-market'); ?></span><strong><?php wc_cart_totals_order_total_html(); ?></strong></div>
				<?php if (wc_coupons_enabled()) : ?>
					<div class="coupon cart-coupon">
						<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e('Промокод', 'eurodeli-market'); ?>">
						<button type="submit" class="btn btn--outline" name="apply_coupon" value="<?php esc_attr_e('Застосувати', 'eurodeli-market'); ?>"><?php esc_html_e('Застосувати', 'eurodeli-market'); ?></button>
					</div>
				<?php endif; ?>
				<button type="submit" class="btn btn--outline" name="update_cart" value="<?php esc_attr_e('Оновити кошик', 'eurodeli-market'); ?>"><?php esc_html_e('Оновити кошик', 'eurodeli-market'); ?></button>
				<a class="btn btn--brand" href="<?php echo esc_url(wc_get_checkout_url()); ?>"><?php esc_html_e('Оформити замовлення', 'eurodeli-market'); ?></a>
				<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
			</aside>
		</form>
		<?php do_action('woocommerce_after_cart'); ?>
	</div>
</section>
