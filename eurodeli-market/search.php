<?php
/**
 * Search template.
 *
 * @package EuroDeli_Market
 */

get_header();
?>
<main class="site-main">
	<?php
	eurodeli_render_page_hero(
		sprintf(__('Результати пошуку: %s', 'eurodeli-market'), get_search_query()),
		__('Пошукова сторінка показує товари, сторінки та записи в єдиній retail-системі.', 'eurodeli-market'),
		__('Пошук', 'eurodeli-market')
	);
	?>
	<section class="section">
		<div class="container page">
			<div class="split__main" style="width:100%;">
				<?php eurodeli_breadcrumbs(); ?>
				<div class="content-card card">
					<?php if (have_posts()) : ?>
						<div class="grid grid--products">
							<?php
							while (have_posts()) :
								the_post();
								if ('product' === get_post_type() && function_exists('wc_get_template_part')) {
									wc_get_template_part('content', 'product');
								} else {
									?>
									<article <?php post_class('article-card'); ?>>
										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 18)); ?></p>
									</article>
									<?php
								}
							endwhile;
							?>
						</div>
						<?php the_posts_pagination(); ?>
					<?php else : ?>
						<?php get_template_part('template-parts/content/empty-state', null, array('title' => __('Нічого не знайдено', 'eurodeli-market'), 'description' => __('Спробуйте інший запит або перейдіть до каталогу.', 'eurodeli-market'))); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
