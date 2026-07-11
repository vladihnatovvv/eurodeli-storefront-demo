<?php
/**
 * Product search form.
 *
 * @package EuroDeli_Market
 */

defined('ABSPATH') || exit;
?>
<form role="search" method="get" class="woocommerce-product-search search-form" action="<?php echo esc_url(home_url('/')); ?>">
	<label class="screen-reader-text" for="woocommerce-product-search-field"><?php esc_html_e('Пошук товарів', 'eurodeli-market'); ?></label>
	<input type="search" id="woocommerce-product-search-field" class="search-field" placeholder="<?php echo esc_attr__('Пошук товарів, брендів, категорій', 'eurodeli-market'); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s">
	<input type="hidden" name="post_type" value="product">
	<button class="search-submit" type="button" aria-label="<?php esc_attr_e('Шукати', 'eurodeli-market'); ?>">
		<svg viewBox="0 0 24 24" aria-hidden="true">
			<circle cx="11" cy="11" r="6.5"></circle>
			<path d="M16 16 21 21"></path>
		</svg>
	</button>
</form>
