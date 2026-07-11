<?php
/**
 * Product shelf section.
 *
 * @package EuroDeli_Market
 */

$args = wp_parse_args(
	$args,
	array(
		'title'        => '',
		'description'  => '',
		'query'        => null,
		'slider_name'  => 'shelf',
		'view_all_url' => '',
	)
);

if (empty($args['query']) || ! $args['query'] instanceof WP_Query || ! $args['query']->have_posts()) {
	return;
}
?>
<section class="section">
	<div class="container">
		<div class="section-head section-head--slider">
			<div>
				<h2><?php echo esc_html($args['title']); ?></h2>
				<p><?php echo esc_html($args['description']); ?></p>
			</div>
			<div class="slider-actions">
				<?php if ($args['view_all_url']) : ?>
					<a class="btn btn--outline" href="<?php echo esc_url($args['view_all_url']); ?>"><?php esc_html_e('Переглянути всі', 'eurodeli-market'); ?></a>
				<?php endif; ?>
				<button class="slider-arrow" type="button" data-slider-prev="<?php echo esc_attr($args['slider_name']); ?>" aria-label="<?php esc_attr_e('Попередні товари', 'eurodeli-market'); ?>">‹</button>
				<button class="slider-arrow" type="button" data-slider-next="<?php echo esc_attr($args['slider_name']); ?>" aria-label="<?php esc_attr_e('Наступні товари', 'eurodeli-market'); ?>">›</button>
			</div>
		</div>
		<div class="products-slider-wrap">
			<div class="products-slider products-slider--shelf" data-slider-track="<?php echo esc_attr($args['slider_name']); ?>">
				<?php
				while ($args['query']->have_posts()) :
					$args['query']->the_post();
					wc_get_template_part('content', 'product');
				endwhile;
				?>
			</div>
		</div>
	</div>
</section>
