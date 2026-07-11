<?php
/**
 * Category showcase section.
 *
 * @package EuroDeli_Market
 */
?>
<section class="section">
	<div class="container">
		<div class="section-head section-head--slider">
			<div>
				<h2><?php esc_html_e('Популярні категорії', 'eurodeli-market'); ?></h2>
				<p><?php esc_html_e('Зручний швидкий вхід у головні групи товарів для першого екрану каталогу.', 'eurodeli-market'); ?></p>
			</div>
			<div class="slider-actions">
				<a class="btn btn--outline" href="<?php echo esc_url(eurodeli_get_shop_url()); ?>"><?php esc_html_e('Увесь каталог', 'eurodeli-market'); ?></a>
				<button class="slider-arrow" type="button" data-slider-prev="categories" aria-label="<?php esc_attr_e('Попередні категорії', 'eurodeli-market'); ?>">‹</button>
				<button class="slider-arrow" type="button" data-slider-next="categories" aria-label="<?php esc_attr_e('Наступні категорії', 'eurodeli-market'); ?>">›</button>
			</div>
		</div>
		<div class="categories-slider-wrap">
			<div class="categories-slider" data-slider-track="categories">
				<?php
				$terms = eurodeli_get_catalog_terms_for_tiles(true);

				if (! empty($terms) && ! is_wp_error($terms)) :
					foreach ($terms as $term) :
						$thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
						$image_url    = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'woocommerce_thumbnail') : eurodeli_get_asset_uri('assets/images/product-cookies.jpg');
						?>
						<a class="category-showcase card" href="<?php echo esc_url(get_term_link($term)); ?>">
							<div class="category-showcase__media">
								<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($term->name); ?>">
								<span class="category-showcase__pill"><?php echo esc_html($term->name); ?></span>
							</div>
							<div class="category-showcase__caption"><?php echo esc_html($term->description ?: __('Добірка популярних товарів категорії.', 'eurodeli-market')); ?></div>
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
	</div>
</section>
