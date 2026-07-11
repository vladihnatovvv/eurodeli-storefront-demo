<?php
/**
 * My account template override.
 *
 * @package EuroDeli_Market
 */

defined('ABSPATH') || exit;
?>
<section class="page-hero">
	<div class="container">
		<div class="page-hero__card card">
			<span class="eyebrow"><?php esc_html_e('Кабінет покупця', 'eurodeli-market'); ?></span>
			<h1><?php esc_html_e('Мій акаунт', 'eurodeli-market'); ?></h1>
			<p><?php esc_html_e('Замовлення, адреси, облікові дані та персональні дії оформлені в єдиному стилі теми.', 'eurodeli-market'); ?></p>
		</div>
	</div>
</section>

<section class="section">
	<div class="container page account-page">
		<aside class="split__side">
			<?php wc_get_template('myaccount/navigation.php'); ?>
		</aside>
		<div class="split__main">
			<div class="content-card card">
				<?php do_action('woocommerce_account_content'); ?>
			</div>
		</div>
	</div>
</section>
