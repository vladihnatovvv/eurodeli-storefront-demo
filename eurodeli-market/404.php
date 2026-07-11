<?php
/**
 * 404 template.
 *
 * @package EuroDeli_Market
 */

get_header();
?>
<main class="site-main">
	<section class="section section--spacious">
		<div class="container">
			<div class="content-card card" style="text-align:center; padding:56px 32px;">
				<span class="eyebrow"><?php esc_html_e('404', 'eurodeli-market'); ?></span>
				<h1><?php esc_html_e('Сторінку не знайдено', 'eurodeli-market'); ?></h1>
				<p><?php esc_html_e('Можливо, товар уже недоступний або посилання змінилося. Скористайтеся каталогом або поверніться на головну.', 'eurodeli-market'); ?></p>
				<div class="hero-actions" style="justify-content:center;">
					<a class="btn btn--brand" href="<?php echo esc_url(eurodeli_get_shop_url()); ?>"><?php esc_html_e('У каталог', 'eurodeli-market'); ?></a>
					<a class="btn btn--outline" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('На головну', 'eurodeli-market'); ?></a>
				</div>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
