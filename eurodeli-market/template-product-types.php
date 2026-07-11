<?php
/**
 * Template Name: Product Types
 *
 * @package EuroDeli_Market
 */

get_header();
?>
<main class="site-main">
	<?php
	eurodeli_render_page_hero(
		get_the_title() ?: __('Види товарів', 'eurodeli-market'),
		__('Швидка навігація по великих групах товарів каталогу.', 'eurodeli-market'),
		__('Каталог товарів', 'eurodeli-market')
	);
	?>
	<section class="section">
		<div class="container">
			<div class="grid grid--categories">
				<?php
				$terms = eurodeli_get_catalog_terms_for_tiles(false);

				if (! empty($terms)) :
					foreach ($terms as $term) :
						$thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
						$image_url    = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'woocommerce_thumbnail') : eurodeli_get_asset_uri('assets/images/aisle.jpg');
						?>
						<a class="category-showcase card" href="<?php echo esc_url(get_term_link($term)); ?>">
							<div class="category-showcase__media">
								<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($term->name); ?>">
								<span class="category-showcase__pill"><?php echo esc_html($term->name); ?></span>
							</div>
							<div class="category-showcase__caption">
								<?php echo esc_html($term->description ?: __('Перейти до категорії товарів.', 'eurodeli-market')); ?>
							</div>
						</a>
						<?php
					endforeach;
				else :
					foreach (eurodeli_default_categories() as $category) :
						?>
						<a class="category-showcase card" href="<?php echo esc_url(eurodeli_get_shop_url()); ?>">
							<div class="category-showcase__media">
								<img src="<?php echo esc_url(eurodeli_get_asset_uri($category['image'])); ?>" alt="<?php echo esc_attr($category['title']); ?>">
								<span class="category-showcase__pill"><?php echo esc_html($category['title']); ?></span>
							</div>
							<div class="category-showcase__caption"><?php echo esc_html($category['description']); ?></div>
						</a>
						<?php
					endforeach;
				endif;
				?>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
