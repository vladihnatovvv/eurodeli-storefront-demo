<?php
/**
 * Catalog architecture blueprint for WooCommerce and Rozetka import.
 *
 * @package EuroDeli_Market
 */

if (! defined('ABSPATH')) {
	exit;
}

function eurodeli_catalog_structure(): array {
	return array(
		'kava-ta-garyachi-napoyi' => array(
			'label' => __('Кава та гарячі напої', 'eurodeli-market'),
			'children' => array(
				'kava-v-zernah' => __('Кава в зернах', 'eurodeli-market'),
				'kava-melena' => __('Кава мелена', 'eurodeli-market'),
				'kava-rozchynna' => __('Кава розчинна', 'eurodeli-market'),
				'kakao' => __('Какао', 'eurodeli-market'),
				'kapuchyno-ta-garyachyj-shokolad' => __('Капучино та гарячий шоколад', 'eurodeli-market'),
			),
		),
		'chaj' => array(
			'label' => __('Чай', 'eurodeli-market'),
			'children' => array(
				'chornyj-chaj' => __('Чорний чай', 'eurodeli-market'),
				'zelenyj-chaj' => __('Зелений чай', 'eurodeli-market'),
				'fruktovyj-ta-travyanyj-chaj' => __('Фруктовий та трав’яний чай', 'eurodeli-market'),
				'chaj-u-paketah' => __('Чай у пакетах', 'eurodeli-market'),
			),
		),
		'solodoshchi' => array(
			'label' => __('Солодощі', 'eurodeli-market'),
			'children' => array(
				'shokolad-i-batonchyky' => __('Шоколад і шоколадні батончики', 'eurodeli-market'),
				'cukerky-ta-drazhe' => __('Цукерки та драже', 'eurodeli-market'),
				'zhelejni-cukerky' => __('Желейні цукерки', 'eurodeli-market'),
				'zhujky' => __('Жуйки', 'eurodeli-market'),
				'podarunkovi-cukerky' => __('Подарункові цукерки', 'eurodeli-market'),
				'dubajski-solodoshchi' => __('Дубайські солодощі', 'eurodeli-market'),
				'solodki-namazky' => __('Солодкі намазки', 'eurodeli-market'),
			),
		),
		'pechyvo-ta-vafli' => array(
			'label' => __('Печиво та вафлі', 'eurodeli-market'),
			'children' => array(
				'pechyvo' => __('Печиво', 'eurodeli-market'),
				'vafli' => __('Вафлі', 'eurodeli-market'),
				'keksy-ta-biskvity' => __('Кекси та бісквіти', 'eurodeli-market'),
				'suhi-snidanky' => __('Сухі сніданки', 'eurodeli-market'),
			),
		),
		'bakaliya' => array(
			'label' => __('Бакалія', 'eurodeli-market'),
			'children' => array(
				'makarony' => __('Макарони', 'eurodeli-market'),
				'krupy-ris-kuskus' => __('Крупи, рис, кус-кус', 'eurodeli-market'),
				'olija' => __('Олія', 'eurodeli-market'),
				'olivky' => __('Оливки', 'eurodeli-market'),
				'pashtety' => __('Паштети', 'eurodeli-market'),
				'hlibobulochni-vyroby' => __('Хлібобулочні вироби', 'eurodeli-market'),
			),
		),
		'sousy-ta-prypravy' => array(
			'label' => __('Соуси та приправи', 'eurodeli-market'),
			'children' => array(
				'sousy' => __('Соуси', 'eurodeli-market'),
				'prypravy' => __('Приправи', 'eurodeli-market'),
				'syrni-namazky' => __('Сирні намазки', 'eurodeli-market'),
			),
		),
		'konservy-ta-zakusky' => array(
			'label' => __('Консерви та закуски', 'eurodeli-market'),
			'children' => array(
				'konservovani-ovochi-ta-frukty' => __('Консервовані овочі та фрукти', 'eurodeli-market'),
				'moreprodukty-ta-konservy' => __('Морепродукти та консерви', 'eurodeli-market'),
				'sneky' => __('Снеки', 'eurodeli-market'),
				'gorihy-ta-suhofrukty' => __('Горіхи та сухофрукти', 'eurodeli-market'),
			),
		),
		'molochni-produkty-ta-syry' => array(
			'label' => __('Молочні продукти та сири', 'eurodeli-market'),
			'children' => array(
				'molochni-produkty' => __('Молочні продукти', 'eurodeli-market'),
				'syry' => __('Сири', 'eurodeli-market'),
				'syrni-namazky' => __('Сирні намазки', 'eurodeli-market'),
				'myasni-delikatesy' => __('М’ясні делікатеси', 'eurodeli-market'),
			),
		),
		'napoyi' => array(
			'label' => __('Напої', 'eurodeli-market'),
			'children' => array(
				'bezalkogolni-napoyi' => __('Безалкогольні напої', 'eurodeli-market'),
				'alkogolni-napoyi' => __('Алкогольні напої', 'eurodeli-market'),
			),
		),
		'aziyski-tovary' => array(
			'label' => __('Азійські товари', 'eurodeli-market'),
			'children' => array(
				'lokshyna-ta-ris' => __('Локшина та рис', 'eurodeli-market'),
				'aziyski-sousy' => __('Азійські соуси', 'eurodeli-market'),
				'aziyski-sneky-ta-solodoshchi' => __('Азійські снеки та солодощі', 'eurodeli-market'),
			),
		),
		'pobutova-himiya' => array(
			'label' => __('Побутова хімія', 'eurodeli-market'),
			'children' => array(
				'doglyad-za-kuhneyu' => __('Догляд за кухнею', 'eurodeli-market'),
				'prannya' => __('Прання', 'eurodeli-market'),
				'prybyrannya' => __('Прибирання', 'eurodeli-market'),
				'doglyad-za-tilom' => __('Догляд за тілом', 'eurodeli-market'),
			),
		),
		'podarunky-ta-dobirky' => array(
			'label' => __('Подарунки та добірки', 'eurodeli-market'),
			'children' => array(
				'podarunkovi-nabory' => __('Подарункові набори', 'eurodeli-market'),
				'podarunkovi-cukerky' => __('Подарункові цукерки', 'eurodeli-market'),
				'upakovannya-tovaru' => __('Упакування товару', 'eurodeli-market'),
			),
		),
		'sezonni-tovary' => array(
			'label' => __('Сезонні товари', 'eurodeli-market'),
			'children' => array(
				'velykodni-tovary' => __('Великодні товари', 'eurodeli-market'),
				'novorichni-tovary' => __('Новорічні товари', 'eurodeli-market'),
			),
		),
	);
}

function eurodeli_catalog_attributes(): array {
	return array(
		'pa_brand' => __('Бренд', 'eurodeli-market'),
		'pa_country' => __('Країна виробництва', 'eurodeli-market'),
		'pa_product_type' => __('Тип товару', 'eurodeli-market'),
		'pa_weight' => __('Вага', 'eurodeli-market'),
		'pa_volume' => __('Об’єм', 'eurodeli-market'),
		'pa_packaging' => __('Фасування', 'eurodeli-market'),
		'pa_taste' => __('Смак', 'eurodeli-market'),
		'pa_features' => __('Особливості', 'eurodeli-market'),
		'pa_diet' => __('Дієтичні особливості', 'eurodeli-market'),
	);
}

function eurodeli_catalog_collections(): array {
	return array(
		'weekly-sale' => __('Акції тижня', 'eurodeli-market'),
		'new' => __('Новинки', 'eurodeli-market'),
		'hit' => __('Хіти', 'eurodeli-market'),
		'own-import' => __('Власний імпорт', 'eurodeli-market'),
		'sugar-free' => __('Без цукру', 'eurodeli-market'),
		'seasonal' => __('Сезонні добірки', 'eurodeli-market'),
	);
}

function eurodeli_catalog_tile_categories(): array {
	$structure = eurodeli_catalog_structure();
	$slugs = array(
		'kava-ta-garyachi-napoyi',
		'chaj',
		'solodoshchi',
		'pechyvo-ta-vafli',
		'bakaliya',
		'sousy-ta-prypravy',
		'konservy-ta-zakusky',
		'molochni-produkty-ta-syry',
		'napoyi',
		'aziyski-tovary',
		'pobutova-himiya',
		'podarunky-ta-dobirky',
	);

	$tiles = array();
	foreach ($slugs as $slug) {
		if (isset($structure[$slug])) {
			$tiles[$slug] = $structure[$slug]['label'];
		}
	}

	return $tiles;
}

function eurodeli_rozetka_import_fields(): array {
	return array(
		'name' => __('Назва товару', 'eurodeli-market'),
		'category' => __('Головна категорія', 'eurodeli-market'),
		'subcategory' => __('Підкатегорія', 'eurodeli-market'),
		'brand' => __('Бренд', 'eurodeli-market'),
		'country' => __('Країна виробництва', 'eurodeli-market'),
		'weight' => __('Вага', 'eurodeli-market'),
		'volume' => __('Об’єм', 'eurodeli-market'),
		'packaging' => __('Фасування', 'eurodeli-market'),
		'sku' => __('Артикул / SKU', 'eurodeli-market'),
		'regular_price' => __('Ціна', 'eurodeli-market'),
		'sale_price' => __('Акційна ціна', 'eurodeli-market'),
		'images' => __('Фото', 'eurodeli-market'),
		'description' => __('Опис', 'eurodeli-market'),
		'attributes' => __('Характеристики', 'eurodeli-market'),
		'stock_status' => __('Наявність', 'eurodeli-market'),
		'collections' => __('Позначки Акція / Новинка / Хіт', 'eurodeli-market'),
	);
}

function eurodeli_rozetka_required_client_data(): array {
	return array(
		__('Експорт товарів з Rozetka у CSV / Excel / XML / YML', 'eurodeli-market'),
		__('Список брендів', 'eurodeli-market'),
		__('Список країн виробництва', 'eurodeli-market'),
		__('Вага / об’єм / фасування для кожного товару', 'eurodeli-market'),
		__('Актуальні ціни та акційні ціни', 'eurodeli-market'),
		__('Залишки або статус наявності', 'eurodeli-market'),
		__('Фото товарів у хорошій якості', 'eurodeli-market'),
		__('Артикули / SKU', 'eurodeli-market'),
		__('Позначення товарів як акційних / новинок / хітів', 'eurodeli-market'),
		__('Список великих категорій для сторінки "Види товарів"', 'eurodeli-market'),
	);
}
