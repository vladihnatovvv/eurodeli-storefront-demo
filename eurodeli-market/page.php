<?php
/**
 * Generic page template.
 *
 * @package EuroDeli_Market
 */

get_header();
?>
<main class="site-main">
	<?php eurodeli_render_page_hero(get_the_title(), has_excerpt() ? get_the_excerpt() : '', __('Інформаційна сторінка', 'eurodeli-market')); ?>
	<section class="section">
		<div class="container page">
			<div class="split__main" style="width:100%;">
				<?php eurodeli_breadcrumbs(); ?>
				<div class="content-card card entry-content">
					<?php
					while (have_posts()) :
						the_post();
						the_content();
					endwhile;
					?>
				</div>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
