<?php
/**
 * Product category template.
 *
 * @package EuroDeli_Market
 */

defined('ABSPATH') || exit;

$term        = get_queried_object();
$description = $term && ! empty($term->description) ? wp_strip_all_tags($term->description) : __('Добірка товарів категорії в єдиному grocery-стилі.', 'eurodeli-market');

get_header('shop');
?>
<main class="site-main">
	<?php eurodeli_render_page_hero(single_term_title('', false), $description, __('Категорія товарів', 'eurodeli-market')); ?>
	<section class="container page">
		<aside class="split__side">
			<?php if (is_active_sidebar('shop-filters')) : ?>
				<?php dynamic_sidebar('shop-filters'); ?>
			<?php endif; ?>
		</aside>

		<div class="split__main">
			<?php eurodeli_breadcrumbs(); ?>
			<div class="content-card card">
				<?php do_action('woocommerce_before_shop_loop'); ?>
				<div class="filter-bar">
					<div class="tag-row">
						<span class="nav-badge"><?php printf(esc_html__('Усього: %d товарів', 'eurodeli-market'), (int) wc_get_loop_prop('total')); ?></span>
						<span class="nav-badge"><?php esc_html_e('Сортування: популярні', 'eurodeli-market'); ?></span>
					</div>
					<?php woocommerce_catalog_ordering(); ?>
				</div>

				<?php if (woocommerce_product_loop()) : ?>
					<div class="grid grid--products shop-grid">
						<?php while (have_posts()) : the_post(); ?>
							<?php wc_get_template_part('content', 'product'); ?>
						<?php endwhile; ?>
					</div>
					<?php woocommerce_pagination(); ?>
				<?php else : ?>
					<?php do_action('woocommerce_no_products_found'); ?>
					<?php get_template_part('template-parts/content/empty-state', null, array('title' => __('Категорія поки порожня', 'eurodeli-market'))); ?>
				<?php endif; ?>
			</div>
		</div>
	</section>
</main>
<?php
get_footer('shop');
