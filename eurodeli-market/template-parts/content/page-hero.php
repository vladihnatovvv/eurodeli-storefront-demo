<?php
/**
 * Page hero partial.
 *
 * @package EuroDeli_Market
 */

$args        = wp_parse_args($args, array('title' => '', 'description' => '', 'eyebrow' => ''));
$title       = $args['title'];
$description = $args['description'];
$eyebrow     = $args['eyebrow'];

if (! $title) {
	return;
}
?>
<section class="page-hero">
	<div class="container">
		<div class="page-hero__card card">
			<?php if ($eyebrow) : ?>
				<span class="eyebrow"><?php echo esc_html($eyebrow); ?></span>
			<?php endif; ?>
			<h1><?php echo esc_html($title); ?></h1>
			<?php if ($description) : ?>
				<p><?php echo esc_html($description); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>
