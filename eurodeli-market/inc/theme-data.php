<?php
/**
 * Theme data helpers.
 *
 * @package EuroDeli_Market
 */

if (! defined('ABSPATH')) {
	exit;
}

function eurodeli_default_categories(): array {
	$structure = eurodeli_catalog_structure();
	$images = array(
		'kava-ta-garyachi-napoyi' => 'assets/images/product-coffee-good.jpg',
		'chaj' => 'assets/images/product-tea.jpg',
		'solodoshchi' => 'assets/images/product-chocolate.jpg',
		'pechyvo-ta-vafli' => 'assets/images/product-cookies.jpg',
		'bakaliya' => 'assets/images/product-pasta-good.jpg',
		'sousy-ta-prypravy' => 'assets/images/product-sauce.jpg',
		'konservy-ta-zakusky' => 'assets/images/aisle.jpg',
		'molochni-produkty-ta-syry' => 'assets/images/product-cheese.jpg',
		'napoyi' => 'assets/images/product-coffee.jpg',
		'aziyski-tovary' => 'assets/images/product-gift.jpg',
		'pobutova-himiya' => 'assets/images/aisle.jpg',
		'podarunky-ta-dobirky' => 'assets/images/product-gift.jpg',
	);

	$items = array();
	foreach (eurodeli_catalog_tile_categories() as $slug => $label) {
		$items[] = array(
			'title'       => $label,
			'description' => isset($structure[$slug]['children']) ? implode(', ', array_values($structure[$slug]['children'])) : '',
			'image'       => $images[$slug] ?? 'assets/images/aisle.jpg',
			'slug'        => $slug,
		);
	}

	return $items;
}

function eurodeli_benefits(): array {
	return array(
		array(
			'title' => __('Оригінальні товари ЄС', 'eurodeli-market'),
			'text'  => __('Добірка продуктів з Польщі, Італії, Німеччини та інших країн Європи.', 'eurodeli-market'),
		),
		array(
			'title' => __('Швидка доставка', 'eurodeli-market'),
			'text'  => __('Відправляємо замовлення щодня, працюємо з Новою поштою та самовивозом.', 'eurodeli-market'),
		),
		array(
			'title' => __('Зручна оплата', 'eurodeli-market'),
			'text'  => __('Післяплата, онлайн-оплата та зрозумілий checkout без зайвих кроків.', 'eurodeli-market'),
		),
		array(
			'title' => __('Постійні акції', 'eurodeli-market'),
			'text'  => __('Хіти продажів, товари тижня та акційні добірки з сильними CTA.', 'eurodeli-market'),
		),
	);
}

function eurodeli_faq_items(): array {
	return array(
		array(
			'question' => __('Як працює доставка по Україні?', 'eurodeli-market'),
			'answer'   => __('Доставка здійснюється щодня по Україні через Нову пошту. У великих містах можна підключити самовивіз або курʼєрську доставку.', 'eurodeli-market'),
		),
		array(
			'question' => __('Чи можна оформити велике або корпоративне замовлення?', 'eurodeli-market'),
			'answer'   => __('Так, тема передбачає швидкий контактний сценарій для b2b або гуртових клієнтів через форму та окремий CTA.', 'eurodeli-market'),
		),
		array(
			'question' => __('Чи можна повернути товар?', 'eurodeli-market'),
			'answer'   => __('Повернення та обмін відбуваються відповідно до законодавства України та правил для харчових категорій.', 'eurodeli-market'),
		),
	);
}
