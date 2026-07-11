<?php
/**
 * Checkout template override.
 *
 * @package EuroDeli_Market
 */

defined('ABSPATH') || exit;
?>
<section class="page-hero">
	<div class="container">
		<div class="page-hero__card card">
			<span class="eyebrow"><?php esc_html_e('Checkout', 'eurodeli-market'); ?></span>
			<h1><?php esc_html_e('Оформлення замовлення', 'eurodeli-market'); ?></h1>
			<p><?php esc_html_e('Мінімум зайвих кроків: контакти, доставка, оплата і підтвердження замовлення в одному чистому інтерфейсі.', 'eurodeli-market'); ?></p>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<form name="checkout" method="post" class="checkout woocommerce-checkout cart-layout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
			<div class="content-card card">
				<?php if ($checkout->get_checkout_fields()) : ?>
					<?php do_action('woocommerce_checkout_before_customer_details'); ?>
					<div class="checkout-columns">
						<div class="checkout-column">
							<?php do_action('woocommerce_checkout_billing'); ?>
							<?php do_action('woocommerce_checkout_shipping'); ?>
						</div>
					</div>
					<?php do_action('woocommerce_checkout_after_customer_details'); ?>
				<?php endif; ?>
			</div>
			<aside class="cart-summary card checkout-summary">
				<h3><?php esc_html_e('Ваше замовлення', 'eurodeli-market'); ?></h3>
				<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>
				<div id="order_review" class="woocommerce-checkout-review-order">
					<?php do_action('woocommerce_checkout_order_review'); ?>
				</div>
			</aside>
		</form>
	</div>
</section>
