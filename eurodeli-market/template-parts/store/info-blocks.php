<?php
/**
 * Info blocks and FAQ.
 *
 * @package EuroDeli_Market
 */
?>
<section class="section">
	<div class="container">
		<div class="grid grid--info">
			<?php foreach (eurodeli_benefits() as $benefit) : ?>
				<article class="info-card">
					<h3><?php echo esc_html($benefit['title']); ?></h3>
					<p><?php echo esc_html($benefit['text']); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section section--faq">
	<div class="container">
		<div class="section-head">
			<div>
				<h2><?php esc_html_e('Питання та відповіді', 'eurodeli-market'); ?></h2>
				<p><?php esc_html_e('Ключова інформація про доставку, великі замовлення та умови покупки.', 'eurodeli-market'); ?></p>
			</div>
		</div>
		<div class="faq">
			<?php foreach (eurodeli_faq_items() as $index => $faq) : ?>
				<details class="faq-item" <?php echo 0 === $index ? 'open' : ''; ?>>
					<summary>
						<span><?php echo esc_html($faq['question']); ?></span>
						<span class="faq-item__icon">+</span>
					</summary>
					<div class="faq-item__body">
						<p><?php echo esc_html($faq['answer']); ?></p>
					</div>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>
