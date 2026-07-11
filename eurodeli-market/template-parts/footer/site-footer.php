<?php
/**
 * Site footer partial.
 *
 * @package EuroDeli_Market
 */

$shop_url = eurodeli_get_shop_url();
?>
<footer class="footer">
	<div class="container footer__top">
		<div class="footer__brand footer-card footer-card--brand">
			<div class="footer-mark">
				<div class="footer-mark__crest">ED</div>
				<div>
					<div class="footer-mark__title"><?php bloginfo('name'); ?></div>
					<div class="footer-mark__subtitle"><?php bloginfo('description'); ?></div>
				</div>
			</div>
			<p><?php esc_html_e('Інтернет-магазин європейських продуктів із щільним grocery-каталогом, сильними акціями, зручним кошиком і готовою WooCommerce-структурою для запуску.', 'eurodeli-market'); ?></p>
			<div class="footer-payments">
				<span class="pill"><?php esc_html_e('Visa / Mastercard', 'eurodeli-market'); ?></span>
				<span class="pill"><?php esc_html_e('Післяплата', 'eurodeli-market'); ?></span>
				<span class="pill"><?php esc_html_e('Відправка щодня', 'eurodeli-market'); ?></span>
			</div>
		</div>

		<div class="footer__cols">
			<div class="footer-card">
				<h3><?php esc_html_e('Контакти', 'eurodeli-market'); ?></h3>
				<div class="footer-links footer-links--stack">
					<a href="tel:+380980000000">+38 (098) 000-00-00</a>
					<a href="mailto:hello@eurodeli.ua">hello@eurodeli.ua</a>
					<span><?php esc_html_e('м. Київ, Україна', 'eurodeli-market'); ?></span>
					<span><?php esc_html_e('Пн-Пт: 09:00-20:00', 'eurodeli-market'); ?></span>
					<span><?php esc_html_e('Сб: 10:00-18:00', 'eurodeli-market'); ?></span>
					<span><?php esc_html_e('Нд: 10:00-16:00', 'eurodeli-market'); ?></span>
				</div>
			</div>

			<div class="footer-card">
				<h3><?php esc_html_e('Про магазин', 'eurodeli-market'); ?></h3>
				<div class="footer-links footer-links--stack">
					<?php
					if (has_nav_menu('footer_about')) {
						wp_nav_menu(
							array(
								'theme_location' => 'footer_about',
								'container'      => false,
								'items_wrap'     => '%3$s',
								'fallback_cb'    => false,
							)
						);
					} else {
						?>
						<a href="<?php echo esc_url(home_url('/about/')); ?>"><?php esc_html_e('Про нас', 'eurodeli-market'); ?></a>
						<a href="<?php echo esc_url(home_url('/delivery/')); ?>"><?php esc_html_e('Доставка й оплата', 'eurodeli-market'); ?></a>
						<a href="<?php echo esc_url(home_url('/returns/')); ?>"><?php esc_html_e('Обмін / повернення', 'eurodeli-market'); ?></a>
						<a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>"><?php esc_html_e('Політика конфіденційності', 'eurodeli-market'); ?></a>
						<?php
					}
					?>
				</div>
			</div>

			<div class="footer-card">
				<h3><?php esc_html_e('Каталог товарів', 'eurodeli-market'); ?></h3>
				<div class="footer-links footer-links--stack">
					<a href="<?php echo esc_url($shop_url); ?>"><?php esc_html_e('Солодощі та шоколад', 'eurodeli-market'); ?></a>
					<a href="<?php echo esc_url($shop_url); ?>"><?php esc_html_e('Кава та чай', 'eurodeli-market'); ?></a>
					<a href="<?php echo esc_url($shop_url); ?>"><?php esc_html_e('Паста та бакалія', 'eurodeli-market'); ?></a>
					<a href="<?php echo esc_url($shop_url); ?>"><?php esc_html_e('Соуси та спеції', 'eurodeli-market'); ?></a>
					<a href="<?php echo esc_url($shop_url); ?>"><?php esc_html_e('Дивитися весь каталог', 'eurodeli-market'); ?></a>
				</div>
			</div>
		</div>
	</div>

	<div class="container footer__bottom">
		<span>© <?php echo esc_html(date_i18n('Y')); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('Усі права захищені.', 'eurodeli-market'); ?></span>
		<div class="socials">
			<a class="pill" href="#"><?php esc_html_e('Instagram', 'eurodeli-market'); ?></a>
			<a class="pill" href="#"><?php esc_html_e('Facebook', 'eurodeli-market'); ?></a>
			<a class="pill" href="#"><?php esc_html_e('Telegram', 'eurodeli-market'); ?></a>
		</div>
	</div>
</footer>
