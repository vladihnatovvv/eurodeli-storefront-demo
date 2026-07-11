<?php
/**
 * Single post template.
 *
 * @package EuroDeli_Market
 */

get_header();
?>
<main class="site-main">
	<?php
	while (have_posts()) :
		the_post();
		eurodeli_render_page_hero(get_the_title(), get_the_excerpt(), __('Матеріал', 'eurodeli-market'));
		?>
		<section class="section">
			<div class="container page">
				<div class="split__main" style="width:100%;">
					<?php eurodeli_breadcrumbs(); ?>
					<article <?php post_class('content-card card entry-content'); ?>>
						<?php the_content(); ?>
					</article>
				</div>
			</div>
		</section>
	<?php endwhile; ?>
</main>
<?php
get_footer();
