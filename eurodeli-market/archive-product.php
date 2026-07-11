<?php
/**
 * Product archive template.
 *
 * @package EuroDeli_Market
 */

defined('ABSPATH') || exit;

get_header('shop');
?>
<main class="site-main">
	<?php
	eurodeli_render_page_hero(
		wp_strip_all_tags(woocommerce_page_title(false)),
		__('Повний каталог європейських продуктів: солодощі, паста, кава, соуси, снеки, делікатеси та подарункові набори.', 'eurodeli-market'),
		__('Каталог товарів', 'eurodeli-market')
	);
	?>
	<section class="container page">
		<aside class="split__side">
			<?php if (is_active_sidebar('shop-filters')) : ?>
				<?php dynamic_sidebar('shop-filters'); ?>
			<?php else : ?>
				<div class="sidebar-card">
					<h3><?php esc_html_e('Фільтри', 'eurodeli-market'); ?></h3>
					<div class="category-list">
						<a class="category-link" href="<?php echo esc_url(add_query_arg('orderby', 'popularity')); ?>"><?php esc_html_e('Популярні', 'eurodeli-market'); ?></a>
						<a class="category-link" href="<?php echo esc_url(add_query_arg('orderby', 'price')); ?>"><?php esc_html_e('Ціна за зростанням', 'eurodeli-market'); ?></a>
						<a class="category-link" href="<?php echo esc_url(add_query_arg('orderby', 'date')); ?>"><?php esc_html_e('Новинки', 'eurodeli-market'); ?></a>
						<a class="category-link" href="<?php echo esc_url(home_url('/sale/')); ?>"><?php esc_html_e('Акційні товари', 'eurodeli-market'); ?></a>
					</div>
				</div>
			<?php endif; ?>
		</aside>

		<div class="split__main">
			<?php eurodeli_breadcrumbs(); ?>
			<div class="content-card card">
				<?php do_action('woocommerce_before_shop_loop'); ?>
				<div class="filter-bar">
					<div class="tag-row">
						<span class="nav-badge"><?php printf(esc_html__('Усього: %d товарів', 'eurodeli-market'), (int) wc_get_loop_prop('total')); ?></span>
						<?php woocommerce_result_count(); ?>
					</div>
					<?php woocommerce_catalog_ordering(); ?>
				</div>

				<?php if (woocommerce_product_loop()) : ?>
					<div class="grid grid--products shop-grid">
						<?php
						while (have_posts()) :
							the_post();
							wc_get_template_part('content', 'product');
						endwhile;
						?>
					</div>
					<?php woocommerce_pagination(); ?>
				<?php else : ?>
					<?php do_action('woocommerce_no_products_found'); ?>
					<?php get_template_part('template-parts/content/empty-state', null, array('title' => __('У цій категорії поки немає товарів', 'eurodeli-market'))); ?>
				<?php endif; ?>
			</div>
		</div>
	</section>
</main>
<?php
get_footer('shop');
