<?php
/**
 * Main index template.
 *
 * @package EuroDeli_Market
 */

get_header();
?>
<main class="site-main">
	<?php eurodeli_render_page_hero(get_the_archive_title() ?: get_bloginfo('name'), get_bloginfo('description'), __('Інформаційний блок', 'eurodeli-market')); ?>
	<section class="section">
		<div class="container page">
			<div class="split__main" style="width:100%;">
				<?php eurodeli_breadcrumbs(); ?>
				<div class="content-card card">
					<?php if (have_posts()) : ?>
						<div class="grid grid--articles">
							<?php
							while (have_posts()) :
								the_post();
								?>
								<article <?php post_class('article-card'); ?>>
									<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									<p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 26)); ?></p>
									<a class="btn btn--outline" href="<?php the_permalink(); ?>"><?php esc_html_e('Читати далі', 'eurodeli-market'); ?></a>
								</article>
							<?php endwhile; ?>
						</div>
						<?php the_posts_pagination(); ?>
					<?php else : ?>
						<?php get_template_part('template-parts/content/empty-state', null, array('title' => __('Нічого не знайдено', 'eurodeli-market'))); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
