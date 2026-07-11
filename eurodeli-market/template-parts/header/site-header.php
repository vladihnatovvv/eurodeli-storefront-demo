<?php
/**
 * Site header partial.
 *
 * @package EuroDeli_Market
 */

$account_url = eurodeli_get_account_url();
$shop_url    = eurodeli_get_shop_url();
$cart_url    = function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/');
$cart_count  = function_exists('WC') && WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
$fallback_primary = array(
	array('url' => home_url('/'), 'label' => __('Головна', 'eurodeli-market')),
	array('url' => $shop_url, 'label' => __('Каталог', 'eurodeli-market')),
	array('url' => home_url('/sale/'), 'label' => __('Акції', 'eurodeli-market')),
	array('url' => home_url('/new/'), 'label' => __('Новинки', 'eurodeli-market')),
	array('url' => home_url('/delivery/'), 'label' => __('Доставка й оплата', 'eurodeli-market')),
	array('url' => home_url('/contacts/'), 'label' => __('Контакти', 'eurodeli-market')),
);
?>
<div class="topbar">
	<div class="container topbar__inner">
		<div class="topbar__meta">
			<span><?php esc_html_e('Доставка по Україні', 'eurodeli-market'); ?></span>
			<span><?php esc_html_e('Самовивіз у Києві', 'eurodeli-market'); ?></span>
			<span><?php esc_html_e('Пн-Нд: 09:00–20:00', 'eurodeli-market'); ?></span>
		</div>
		<div class="topbar__links">
			<a href="<?php echo esc_url(home_url('/sale/')); ?>"><?php esc_html_e('Акції', 'eurodeli-market'); ?></a>
			<a href="<?php echo esc_url(home_url('/new/')); ?>"><?php esc_html_e('Новинки', 'eurodeli-market'); ?></a>
			<a href="<?php echo esc_url($account_url); ?>"><?php esc_html_e('Кабінет', 'eurodeli-market'); ?></a>
			<a href="<?php echo esc_url(home_url('/contacts/')); ?>"><?php esc_html_e('Зворотний зв’язок', 'eurodeli-market'); ?></a>
			<a href="tel:+380980000000">+38 (098) 000-00-00</a>
		</div>
	</div>
</div>

<header class="site-header">
	<div class="container header__inner header__inner--reference">
		<a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php esc_attr_e('На головну', 'eurodeli-market'); ?>">
			<?php if (has_custom_logo()) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<div class="brand__title"><?php bloginfo('name'); ?></div>
				<div class="brand__subtitle"><?php bloginfo('description'); ?></div>
			<?php endif; ?>
		</a>

		<a class="catalog-button" href="<?php echo esc_url($shop_url); ?>" aria-label="<?php esc_attr_e('Відкрити каталог товарів', 'eurodeli-market'); ?>">
			<svg viewBox="0 0 24 24" aria-hidden="true">
				<rect x="3" y="4" width="7" height="7" rx="1.5"></rect>
				<rect x="14" y="4" width="7" height="7" rx="1.5"></rect>
				<rect x="3" y="13" width="7" height="7" rx="1.5"></rect>
				<rect x="14" y="13" width="7" height="7" rx="1.5"></rect>
			</svg>
			<span><?php esc_html_e('Каталог', 'eurodeli-market'); ?></span>
		</a>

		<div class="search search--retail">
			<?php if (function_exists('get_product_search_form')) : ?>
				<?php get_product_search_form(); ?>
			<?php else : ?>
				<?php get_search_form(); ?>
			<?php endif; ?>
		</div>

		<div class="header__actions">
			<a class="icon-chip" href="<?php echo esc_url(home_url('/sale/')); ?>" aria-label="<?php esc_attr_e('Акції', 'eurodeli-market'); ?>">
				<svg viewBox="0 0 24 24" aria-hidden="true">
					<path d="M19 5 5 19"></path>
					<circle cx="7" cy="7" r="2.2"></circle>
					<circle cx="17" cy="17" r="2.2"></circle>
				</svg>
			</a>
			<a class="icon-chip" href="<?php echo esc_url($account_url); ?>" aria-label="<?php esc_attr_e('Кабінет', 'eurodeli-market'); ?>">
				<svg viewBox="0 0 24 24" aria-hidden="true">
					<path d="M20 21A8 8 0 0 0 4 21"></path>
					<circle cx="12" cy="8" r="4"></circle>
				</svg>
			</a>
			<a class="icon-chip" href="<?php echo esc_url(home_url('/favorites/')); ?>" aria-label="<?php esc_attr_e('Обране', 'eurodeli-market'); ?>">
				<svg viewBox="0 0 24 24" aria-hidden="true">
					<path d="M12 21.35 10.55 20.03C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35Z"></path>
				</svg>
			</a>
			<a class="icon-chip icon-chip--cart" href="<?php echo esc_url($cart_url); ?>" aria-label="<?php esc_attr_e('Кошик', 'eurodeli-market'); ?>">
				<svg viewBox="0 0 24 24" aria-hidden="true">
					<path d="M3 5H5L7.2 14.2C7.31 14.66 7.81 15 8.32 15H18.4C18.87 15 19.29 14.72 19.47 14.3L21.6 9.3C21.88 8.64 21.39 7.9 20.66 7.9H8.1"></path>
					<circle cx="9.2" cy="19" r="1.6"></circle>
					<circle cx="17.2" cy="19" r="1.6"></circle>
				</svg>
				<span class="cart-count" data-cart-count><?php echo esc_html($cart_count); ?></span>
			</a>
		</div>

		<button class="menu-toggle" type="button" data-menu-toggle aria-expanded="false" aria-controls="site-primary-nav"><?php esc_html_e('Меню', 'eurodeli-market'); ?></button>
	</div>

	<nav class="main-nav" id="site-primary-nav" data-main-nav>
		<div class="container main-nav__inner">
			<?php
			if (has_nav_menu('primary')) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'menu menu--primary',
						'items_wrap'     => '%3$s',
						'fallback_cb'    => false,
						'link_before'    => '',
						'link_after'     => '',
					)
				);
			} else {
				eurodeli_menu_fallback($fallback_primary);
			}
			?>
		</div>
	</nav>
</header>
