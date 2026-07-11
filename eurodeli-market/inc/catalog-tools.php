<?php
/**
 * Catalog setup tools and admin helpers.
 *
 * @package EuroDeli_Market
 */

if (! defined('ABSPATH')) {
	exit;
}

function eurodeli_get_catalog_terms_for_tiles(bool $hide_empty = false): array {
	$terms_by_slug = array();
	$slugs = array_keys(eurodeli_catalog_tile_categories());

	foreach ($slugs as $slug) {
		$term = get_term_by('slug', $slug, 'product_cat');
		if ($term instanceof WP_Term) {
			if ($hide_empty && 0 === (int) $term->count) {
				continue;
			}
			$terms_by_slug[] = $term;
		}
	}

	return $terms_by_slug;
}

function eurodeli_seed_catalog_categories(): array {
	$structure = eurodeli_catalog_structure();
	$created = array();
	$errors = array();

	foreach ($structure as $parent_slug => $parent_data) {
		$parent_term = term_exists($parent_slug, 'product_cat');
		if (! $parent_term) {
			$parent_term = wp_insert_term(
				$parent_data['label'],
				'product_cat',
				array(
					'slug'        => $parent_slug,
					'description' => sprintf(__('Головна категорія каталогу: %s', 'eurodeli-market'), $parent_data['label']),
				)
			);
		}

		if (is_wp_error($parent_term)) {
			$errors[] = $parent_data['label'] . ': ' . $parent_term->get_error_message();
			continue;
		}

		$parent_id = is_array($parent_term) ? (int) $parent_term['term_id'] : (int) $parent_term;
		$created[] = $parent_data['label'];

		foreach ($parent_data['children'] as $child_slug => $child_label) {
			$child_term = term_exists($child_slug, 'product_cat');
			if (! $child_term) {
				$child_term = wp_insert_term(
					$child_label,
					'product_cat',
					array(
						'slug'        => $child_slug,
						'parent'      => $parent_id,
						'description' => sprintf(__('Підкатегорія групи %s', 'eurodeli-market'), $parent_data['label']),
					)
				);
			}

			if (is_wp_error($child_term)) {
				$errors[] = $child_label . ': ' . $child_term->get_error_message();
			}
		}
	}

	return array(
		'created' => array_unique($created),
		'errors'  => $errors,
	);
}

function eurodeli_seed_catalog_attributes(): array {
	if (! function_exists('wc_create_attribute')) {
		return array(
			'created' => array(),
			'errors'  => array(__('WooCommerce attributes API недоступний.', 'eurodeli-market')),
		);
	}

	$created = array();
	$errors = array();

	foreach (eurodeli_catalog_attributes() as $taxonomy => $label) {
		$name = wc_attribute_taxonomy_name(str_replace('pa_', '', $taxonomy));
		$exists = taxonomy_exists($taxonomy) || wc_get_attribute_taxonomy_by_name($name);

		if ($exists) {
			$created[] = $label;
			continue;
		}

		$result = wc_create_attribute(
			array(
				'name'         => $label,
				'slug'         => str_replace('pa_', '', $taxonomy),
				'type'         => 'select',
				'order_by'     => 'menu_order',
				'has_archives' => false,
			)
		);

		if (is_wp_error($result)) {
			$errors[] = $label . ': ' . $result->get_error_message();
			continue;
		}

		$created[] = $label;
	}

	delete_transient('wc_attribute_taxonomies');

	return array(
		'created' => array_unique($created),
		'errors'  => $errors,
	);
}

function eurodeli_ensure_product_types_page(): array {
	$template = 'template-product-types.php';
	$page = get_page_by_path('vidy-tovariv');

	if ($page instanceof WP_Post) {
		update_post_meta($page->ID, '_wp_page_template', $template);
		return array(
			'id'      => $page->ID,
			'created' => false,
		);
	}

	$page_id = wp_insert_post(
		array(
			'post_title'   => __('Види товарів', 'eurodeli-market'),
			'post_name'    => 'vidy-tovariv',
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_content' => '',
		)
	);

	if (! is_wp_error($page_id) && $page_id) {
		update_post_meta($page_id, '_wp_page_template', $template);
	}

	return array(
		'id'      => is_wp_error($page_id) ? 0 : (int) $page_id,
		'created' => ! is_wp_error($page_id),
	);
}

function eurodeli_catalog_admin_menu(): void {
	add_theme_page(
		__('Catalog Setup', 'eurodeli-market'),
		__('Catalog Setup', 'eurodeli-market'),
		'manage_options',
		'eurodeli-catalog-setup',
		'eurodeli_render_catalog_setup_page'
	);
}
add_action('admin_menu', 'eurodeli_catalog_admin_menu');

function eurodeli_catalog_handle_actions(): void {
	if (! is_admin() || ! current_user_can('manage_options')) {
		return;
	}

	if (! isset($_GET['page']) || 'eurodeli-catalog-setup' !== $_GET['page']) {
		return;
	}

	if (isset($_GET['eurodeli_export']) && 'rozetka-fields' === $_GET['eurodeli_export']) {
		eurodeli_download_rozetka_fields_csv();
	}

	if (empty($_POST['eurodeli_catalog_action']) || ! check_admin_referer('eurodeli_catalog_setup')) {
		return;
	}

	$action = sanitize_key(wp_unslash($_POST['eurodeli_catalog_action']));

	if ('seed_categories' === $action) {
		$result = eurodeli_seed_catalog_categories();
		set_transient('eurodeli_catalog_notice', $result, 60);
	}

	if ('seed_attributes' === $action) {
		$result = eurodeli_seed_catalog_attributes();
		set_transient('eurodeli_catalog_notice', $result, 60);
	}

	if ('create_product_types_page' === $action) {
		$result = eurodeli_ensure_product_types_page();
		set_transient(
			'eurodeli_catalog_notice',
			array(
				'created' => array($result['created'] ? __('Сторінку "Види товарів" створено', 'eurodeli-market') : __('Сторінку "Види товарів" оновлено', 'eurodeli-market')),
				'errors'  => array(),
			),
			60
		);
	}

	wp_safe_redirect(admin_url('themes.php?page=eurodeli-catalog-setup'));
	exit;
}
add_action('admin_init', 'eurodeli_catalog_handle_actions');

function eurodeli_download_rozetka_fields_csv(): void {
	if (! current_user_can('manage_options')) {
		wp_die(esc_html__('Недостатньо прав.', 'eurodeli-market'));
	}

	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=eurodeli-rozetka-import-fields.csv');

	$output = fopen('php://output', 'w');
	fputcsv($output, array('field_key', 'field_label'));

	foreach (eurodeli_rozetka_import_fields() as $key => $label) {
		fputcsv($output, array($key, wp_strip_all_tags($label)));
	}

	fclose($output);
	exit;
}

function eurodeli_render_catalog_setup_page(): void {
	$notice = get_transient('eurodeli_catalog_notice');
	if ($notice) {
		delete_transient('eurodeli_catalog_notice');
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e('EuroDeli Catalog Setup', 'eurodeli-market'); ?></h1>
		<p><?php esc_html_e('Структура каталогу, атрибути та підготовка до імпорту з Rozetka.', 'eurodeli-market'); ?></p>

		<?php if (! empty($notice['created']) || ! empty($notice['errors'])) : ?>
			<div class="notice notice-<?php echo empty($notice['errors']) ? 'success' : 'warning'; ?> is-dismissible">
				<p><strong><?php esc_html_e('Результат дії:', 'eurodeli-market'); ?></strong></p>
				<?php if (! empty($notice['created'])) : ?>
					<ul>
						<?php foreach ((array) $notice['created'] as $message) : ?>
							<li><?php echo esc_html($message); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
				<?php if (! empty($notice['errors'])) : ?>
					<ul>
						<?php foreach ((array) $notice['errors'] as $message) : ?>
							<li><?php echo esc_html($message); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div style="display:grid;grid-template-columns:repeat(2,minmax(320px,1fr));gap:20px;max-width:1200px;">
			<div style="background:#fff;padding:20px;border:1px solid #dcdcde;border-radius:12px;">
				<h2><?php esc_html_e('Швидкі дії', 'eurodeli-market'); ?></h2>
				<form method="post" style="margin-bottom:12px;">
					<?php wp_nonce_field('eurodeli_catalog_setup'); ?>
					<input type="hidden" name="eurodeli_catalog_action" value="seed_categories">
					<button type="submit" class="button button-primary"><?php esc_html_e('Створити категорії каталогу', 'eurodeli-market'); ?></button>
				</form>
				<form method="post" style="margin-bottom:12px;">
					<?php wp_nonce_field('eurodeli_catalog_setup'); ?>
					<input type="hidden" name="eurodeli_catalog_action" value="seed_attributes">
					<button type="submit" class="button button-primary"><?php esc_html_e('Створити WooCommerce attributes', 'eurodeli-market'); ?></button>
				</form>
				<form method="post" style="margin-bottom:12px;">
					<?php wp_nonce_field('eurodeli_catalog_setup'); ?>
					<input type="hidden" name="eurodeli_catalog_action" value="create_product_types_page">
					<button type="submit" class="button"><?php esc_html_e('Створити сторінку "Види товарів"', 'eurodeli-market'); ?></button>
				</form>
				<p><a class="button" href="<?php echo esc_url(admin_url('themes.php?page=eurodeli-catalog-setup&eurodeli_export=rozetka-fields')); ?>"><?php esc_html_e('Завантажити CSV-шаблон полів Rozetka', 'eurodeli-market'); ?></a></p>
			</div>

			<div style="background:#fff;padding:20px;border:1px solid #dcdcde;border-radius:12px;">
				<h2><?php esc_html_e('Великі категорії для сторінки "Види товарів"', 'eurodeli-market'); ?></h2>
				<ol>
					<?php foreach (eurodeli_catalog_tile_categories() as $label) : ?>
						<li><?php echo esc_html($label); ?></li>
					<?php endforeach; ?>
				</ol>
			</div>

			<div style="background:#fff;padding:20px;border:1px solid #dcdcde;border-radius:12px;">
				<h2><?php esc_html_e('WooCommerce attributes', 'eurodeli-market'); ?></h2>
				<ul>
					<?php foreach (eurodeli_catalog_attributes() as $taxonomy => $label) : ?>
						<li><code><?php echo esc_html($taxonomy); ?></code> — <?php echo esc_html($label); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div style="background:#fff;padding:20px;border:1px solid #dcdcde;border-radius:12px;">
				<h2><?php esc_html_e('Обов’язкові поля для імпорту з Rozetka', 'eurodeli-market'); ?></h2>
				<ul>
					<?php foreach (eurodeli_rozetka_import_fields() as $label) : ?>
						<li><?php echo esc_html($label); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
	<?php
}
