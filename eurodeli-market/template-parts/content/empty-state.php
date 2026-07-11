<?php
/**
 * Empty state partial.
 *
 * @package EuroDeli_Market
 */

$args = wp_parse_args(
	$args,
	array(
		'title'       => __('Нічого не знайдено', 'eurodeli-market'),
		'description' => __('Спробуйте перейти в каталог або змінити фільтри.', 'eurodeli-market'),
	)
);
?>
<div class="empty-card">
	<h3><?php echo esc_html($args['title']); ?></h3>
	<p><?php echo esc_html($args['description']); ?></p>
	<a class="btn btn--brand" href="<?php echo esc_url(eurodeli_get_shop_url()); ?>"><?php esc_html_e('У каталог', 'eurodeli-market'); ?></a>
</div>
