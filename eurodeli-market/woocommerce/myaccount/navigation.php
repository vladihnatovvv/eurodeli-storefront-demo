<?php
/**
 * My account navigation override.
 *
 * @package EuroDeli_Market
 */

defined('ABSPATH') || exit;
?>
<nav class="woocommerce-MyAccount-navigation sidebar-card">
	<h3><?php esc_html_e('Навігація', 'eurodeli-market'); ?></h3>
	<div class="category-list">
		<?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
			<a class="category-link<?php echo wc_is_current_account_menu_item($endpoint) ? ' is-active' : ''; ?>" href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>">
				<?php echo esc_html($label); ?>
			</a>
		<?php endforeach; ?>
	</div>
</nav>
