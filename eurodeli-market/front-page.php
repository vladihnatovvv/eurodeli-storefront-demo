<?php
/**
 * Front page template.
 *
 * @package EuroDeli_Market
 */

get_header();
?>
<main class="site-main">
	<section class="container hero">
		<aside class="hero__sidebar">
			<div class="sidebar-card">
				<h3><?php esc_html_e('Категорії', 'eurodeli-market'); ?></h3>
				<div class="category-list">
					<?php
					$terms = get_terms(
						array(
							'taxonomy'   => 'product_cat',
							'hide_empty' => true,
							'number'     => 8,
						)
					);

					if (! empty($terms) && ! is_wp_error($terms)) :
						foreach ($terms as $term) :
							?>
							<a class="category-link" href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo esc_html($term->name); ?></a>
							<?php
						endforeach;
					else :
						foreach (eurodeli_default_categories() as $category) :
							?>
							<a class="category-link" href="<?php echo esc_url(eurodeli_get_shop_url()); ?>"><?php echo esc_html($category['title']); ?></a>
							<?php
						endforeach;
					endif;
					?>
				</div>
			</div>
		</aside>

		<section class="hero-banner hero-banner--photo">
			<span class="eyebrow"><?php esc_html_e('Добірка європейських смаків для щоденних покупок', 'eurodeli-market'); ?></span>
			<h1><?php esc_html_e('Європейські продукти харчування з доставкою по Україні', 'eurodeli-market'); ?></h1>
			<p><?php esc_html_e('Солодощі, кава, паста, соуси, снеки та подарункові набори з Польщі, Італії, Німеччини та інших країн Європи — у зручному grocery-format магазині.', 'eurodeli-market'); ?></p>
			<div class="hero-actions">
				<a class="btn btn--light" href="<?php echo esc_url(eurodeli_get_shop_url()); ?>"><?php esc_html_e('Перейти в каталог', 'eurodeli-market'); ?></a>
				<a class="btn btn--outline" href="<?php echo esc_url(home_url('/sale/')); ?>"><?php esc_html_e('Подивитися акції', 'eurodeli-market'); ?></a>
			</div>
			<div class="stats" style="margin-top: 28px;">
				<span class="pill"><?php esc_html_e('250+ позицій', 'eurodeli-market'); ?></span>
				<span class="pill"><?php esc_html_e('Популярні бренди ЄС', 'eurodeli-market'); ?></span>
				<span class="pill"><?php esc_html_e('Відправка щодня', 'eurodeli-market'); ?></span>
			</div>
		</section>
	</section>

	<?php get_template_part('template-parts/store/category-tiles'); ?>

	<?php
	eurodeli_render_product_shelf(
		__('Хіти продажів', 'eurodeli-market'),
		__('Популярні товари, які найчастіше додають у кошик.', 'eurodeli-market'),
		array(
			'meta_key' => 'total_sales',
			'orderby'  => 'meta_value_num',
		),
		'hits',
		eurodeli_get_shop_url()
	);

	if (function_exists('wc_get_product_ids_on_sale')) {
		eurodeli_render_product_shelf(
			__('Акційні товари', 'eurodeli-market'),
			__('Позиції зі знижками та спеціальними пропозиціями.', 'eurodeli-market'),
			array(
				'post__in' => wc_get_product_ids_on_sale(),
			),
			'sale-shelf',
			home_url('/sale/')
		);
	}

	eurodeli_render_product_shelf(
		__('Новинки каталогу', 'eurodeli-market'),
		__('Свіжі поставки та нові позиції для асортименту магазину.', 'eurodeli-market'),
		array(
			'orderby' => 'date',
			'order'   => 'DESC',
		),
		'new-shelf',
		home_url('/new/')
	);
	?>

	<?php get_template_part('template-parts/store/info-blocks'); ?>
</main>
<?php
get_footer();
