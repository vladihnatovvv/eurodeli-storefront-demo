<?php
/**
 * Single product template.
 *
 * @package EuroDeli_Market
 */

defined('ABSPATH') || exit;

get_header('shop');

while (have_posts()) :
	the_post();
	global $product;

	if (! $product instanceof WC_Product) {
		continue;
	}

	$brand   = eurodeli_get_product_attr($product, 'brand');
	$country = eurodeli_get_product_attr($product, 'country');
	$sku     = $product->get_sku();
	?>
	<main class="site-main">
		<section class="container page">
			<div class="split__main" style="width:100%;">
				<?php eurodeli_breadcrumbs(); ?>
				<div class="product-layout card">
					<div class="product-gallery">
						<div class="product-gallery__main">
							<?php echo wp_kses_post($product->get_image('large', array('data-product-main-image' => true))); ?>
						</div>
						<div class="product-gallery__thumbs">
							<?php
							$attachment_ids = $product->get_gallery_image_ids();
							array_unshift($attachment_ids, $product->get_image_id());
							foreach (array_unique(array_filter($attachment_ids)) as $attachment_id) :
								$thumb = wp_get_attachment_image_url($attachment_id, 'woocommerce_thumbnail');
								$full  = wp_get_attachment_image_url($attachment_id, 'large');
								?>
								<div data-product-thumb data-full="<?php echo esc_url($full); ?>" data-alt="<?php echo esc_attr(get_the_title()); ?>">
									<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
								</div>
							<?php endforeach; ?>
						</div>
					</div>

					<div class="product-meta">
						<div class="tag-row">
							<?php if ($product->is_on_sale()) : ?>
								<span class="tag tag--sale"><?php esc_html_e('Акція', 'eurodeli-market'); ?></span>
							<?php endif; ?>
							<span class="tag"><?php echo $product->is_in_stock() ? esc_html__('В наявності', 'eurodeli-market') : esc_html__('Немає в наявності', 'eurodeli-market'); ?></span>
							<?php if ($country) : ?>
								<span class="tag"><?php echo esc_html($country); ?></span>
							<?php endif; ?>
						</div>
						<h1 class="single-product-title"><?php the_title(); ?></h1>
						<div class="product-summary-copy"><?php echo wp_kses_post(wpautop($product->get_short_description())); ?></div>
						<div class="rating">
							<?php if ($sku) : ?>
								<span class="pill"><?php echo esc_html__('Артикул:', 'eurodeli-market') . ' ' . esc_html($sku); ?></span>
							<?php endif; ?>
							<?php if ($brand) : ?>
								<span class="pill"><?php echo esc_html($brand); ?></span>
							<?php endif; ?>
						</div>
						<div class="product-purchase">
							<?php woocommerce_template_single_price(); ?>
							<div class="cta-row">
								<?php woocommerce_template_single_add_to_cart(); ?>
								<a class="btn btn--outline" href="<?php echo esc_url(home_url('/contacts/')); ?>"><?php esc_html_e('Купити в 1 клік', 'eurodeli-market'); ?></a>
							</div>
						</div>
						<div class="spec-list">
							<?php if ($country) : ?><div><span><?php esc_html_e('Країна', 'eurodeli-market'); ?></span><strong><?php echo esc_html($country); ?></strong></div><?php endif; ?>
							<?php if ($brand) : ?><div><span><?php esc_html_e('Бренд', 'eurodeli-market'); ?></span><strong><?php echo esc_html($brand); ?></strong></div><?php endif; ?>
							<?php if ($sku) : ?><div><span><?php esc_html_e('SKU', 'eurodeli-market'); ?></span><strong><?php echo esc_html($sku); ?></strong></div><?php endif; ?>
							<div><span><?php esc_html_e('Статус', 'eurodeli-market'); ?></span><strong><?php echo $product->is_in_stock() ? esc_html__('В наявності', 'eurodeli-market') : esc_html__('Немає в наявності', 'eurodeli-market'); ?></strong></div>
						</div>
					</div>
				</div>

				<section class="section">
					<div class="product-description content-card card">
						<h3><?php esc_html_e('Опис товару', 'eurodeli-market'); ?></h3>
						<?php the_content(); ?>
					</div>
				</section>

				<section class="section">
					<div class="grid grid--info">
						<article class="info-card"><h3><?php esc_html_e('Оригінальна продукція', 'eurodeli-market'); ?></h3><p><?php esc_html_e('Працюємо з перевіреними європейськими брендами та постачальниками.', 'eurodeli-market'); ?></p></article>
						<article class="info-card"><h3><?php esc_html_e('Швидка доставка', 'eurodeli-market'); ?></h3><p><?php esc_html_e('Відправляємо замовлення щодня, щоб покупець швидко отримав товар.', 'eurodeli-market'); ?></p></article>
						<article class="info-card"><h3><?php esc_html_e('Безпечна оплата', 'eurodeli-market'); ?></h3><p><?php esc_html_e('Оплата онлайн або післяплата, без зайвих кроків у checkout.', 'eurodeli-market'); ?></p></article>
					</div>
				</section>

				<section class="section">
					<div class="section-head">
						<div>
							<h2><?php esc_html_e('Схожі товари', 'eurodeli-market'); ?></h2>
							<p><?php esc_html_e('Товарний блок для допродажу.', 'eurodeli-market'); ?></p>
						</div>
					</div>
					<?php woocommerce_output_related_products(); ?>
				</section>
			</div>
		</section>
	</main>
<?php endwhile; ?>
<?php
get_footer('shop');
