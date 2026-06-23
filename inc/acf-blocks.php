<?php
if (!defined('ABSPATH')) exit;
/**
 * ACF Blocks — реєстрація блоків для Gutenberg
 * Рендер через blocks/назва/render.php
 */

add_action('acf/init', 'glc_register_acf_blocks');
function glc_register_acf_blocks()
{
    if (!function_exists('acf_register_block_type'))
        return;

    // ── GLC: Загальні блоки ───────────────────────────

    acf_register_block_type([
        'name'            => 'glc-about',
        'title'           => 'GLC: Про компанію',
        'render_template' => get_template_directory() . '/blocks/about/render.php',
        'category'        => 'glc-common',
        'icon'            => 'info',
        'keywords'        => ['about', 'про компанію', 'glc'],
        'mode'            => 'preview',
        'post_types'      => ['page'],
        'supports'        => ['align' => false],
        'example'         => [],
    ]);

    acf_register_block_type([
        'name' => 'glc-stats',
        'title' => 'GLC: Статистика',
        'render_template' => get_template_directory() . '/blocks/stats/render.php',
        'category' => 'glc-common',
        'icon' => 'chart-bar',
        'keywords' => ['stats', 'статистика', 'glc'],
        'mode' => 'preview',
        'supports' => ['align' => false],
        'example' => [],
    ]);

    acf_register_block_type([
        'name' => 'glc-reviews',
        'title' => 'GLC: Відгуки',
        'render_template' => get_template_directory() . '/blocks/reviews/render.php',
        'category' => 'glc-common',
        'icon' => 'format-quote',
        'keywords' => ['reviews', 'відгуки', 'glc'],
        'mode' => 'preview',
        'post_types' => ['page'],
        'supports' => ['align' => false],
        'example' => [],
    ]);

    // ── 🚛 GLC: Послуги ──────────────────────────────────

    acf_register_block_type([
        'name' => 'glc-services-hero',
        'title' => 'GLC: Слайдер послуг',
        'render_template' => get_template_directory() . '/blocks/services-hero/render.php',
        'category' => 'glc-services',
        'icon' => 'slides',
        'keywords' => ['hero', 'slider', 'послуги', 'glc'],
        'mode' => 'preview',
        'post_types' => ['page'],
        'supports' => ['align' => false],
        'example' => [],
    ]);

    acf_register_block_type([
        'name' => 'glc-services-map',
        'title' => 'GLC: Карта маршрутів',
        'render_template' => get_template_directory() . '/blocks/services-map/render.php',
        'category' => 'glc-services',
        'icon' => 'location',
        'keywords' => ['map', 'маршрути', 'карта', 'glc'],
        'mode' => 'preview',
        'post_types' => ['page'],
        'supports' => ['align' => false],
        'example' => [],
    ]);

    acf_register_block_type([
        'name' => 'glc-service-types',
        'title' => 'GLC: Типи послуг + тарифи',
        'render_template' => get_template_directory() . '/blocks/service-types/render.php',
        'category' => 'glc-services',
        'icon' => 'list-view',
        'keywords' => ['services', 'tariffs', 'послуги', 'тарифи', 'glc'],
        'mode' => 'preview',
        'post_types' => ['page'],
        'supports' => ['align' => false],
        'example' => [],
    ]);

    acf_register_block_type([
        'name' => 'glc-cargo-types',
        'title' => 'GLC: Види вантажів',
        'render_template' => get_template_directory() . '/blocks/cargo-types/render.php',
        'category' => 'glc-services',
        'icon' => 'archive',
        'keywords' => ['cargo', 'вантажі', 'glc'],
        'mode' => 'preview',
        'post_types' => ['page'],
        'supports' => ['align' => false],
        'example' => [],
    ]);

    acf_register_block_type([
        'name' => 'glc-cargo-slider',
        'title' => 'GLC: Види вантажів (слайдер)',
        'render_template' => get_template_directory() . '/blocks/cargo-slider/render.php',
        'category' => 'glc-services',
        'icon' => 'slides',
        'keywords' => ['cargo', 'slider', 'вантажі', 'glc'],
        'mode' => 'preview',
        'post_types' => ['page'],
        'supports' => ['align' => false],
        'example' => [],
    ]);

    acf_register_block_type([
        'name' => 'glc-transport-types',
        'title' => 'GLC: Види транспорту',
        'render_template' => get_template_directory() . '/blocks/transport-types/render.php',
        'category' => 'glc-services',
        'icon' => 'car',
        'keywords' => ['transport', 'транспорт', 'види', 'glc'],
        'mode' => 'preview',
        'post_types' => ['page'],
        'supports' => ['align' => false],
        'example' => [],
    ]);

    // ── GLC: Загальні блоки (додаткові) ──────────────

    acf_register_block_type([
        'name' => 'glc-page-hero',
        'title' => 'GLC: Hero сторінки',
        'render_template' => get_template_directory() . '/blocks/page-hero/render.php',
        'category' => 'glc-common',
        'icon' => 'cover-image',
        'keywords' => ['hero', 'banner', 'заголовок', 'glc'],
        'mode' => 'preview',
        'post_types' => ['page'],
        'supports' => ['align' => false],
        'example' => [],
    ]);

    acf_register_block_type([
        'name' => 'glc-content-hero',
        'title' => 'GLC: Hero з текстом і фото',
        'render_template' => get_template_directory() . '/blocks/content-hero/render.php',
        'category' => 'glc-common',
        'icon' => 'cover-image',
        'keywords' => ['hero', 'content', 'photo', 'glc'],
        'mode' => 'preview',
        'post_types' => ['page'],
        'supports' => ['align' => false],
        'example' => [],
    ]);

    acf_register_block_type([
        'name' => 'glc-media-text',
        'title' => 'GLC: Фото + текст',
        'render_template' => get_template_directory() . '/blocks/media-text/render.php',
        'category' => 'glc-common',
        'icon' => 'align-pull-left',
        'keywords' => ['media', 'text', 'photo', 'glc'],
        'mode' => 'preview',
        'post_types' => ['page'],
        'supports' => ['align' => false],
        'example' => [],
    ]);

    acf_register_block_type([
        'name' => 'glc-steps',
        'title' => 'GLC: Етапи',
        'render_template' => get_template_directory() . '/blocks/steps/render.php',
        'category' => 'glc-common',
        'icon' => 'list-view',
        'keywords' => ['steps', 'етапи', 'кроки', 'glc'],
        'mode' => 'preview',
        'post_types' => ['page'],
        'supports' => ['align' => false],
        'example' => [],
    ]);

    acf_register_block_type([
        'name' => 'glc-features',
        'title' => 'GLC: Переваги / іконки',
        'render_template' => get_template_directory() . '/blocks/features/render.php',
        'category' => 'glc-common',
        'icon' => 'star-filled',
        'keywords' => ['features', 'переваги', 'іконки', 'glc'],
        'mode' => 'preview',
        'post_types' => ['page'],
        'supports' => ['align' => false],
        'example' => [],
    ]);

    acf_register_block_type([
        'name' => 'glc-transport-icons',
        'title' => 'GLC: Транспорт / іконки',
        'render_template' => get_template_directory() . '/blocks/transport-icons/render.php',
        'category' => 'glc-common',
        'icon' => 'car',
        'keywords' => ['transport', 'транспорт', 'іконки', 'glc'],
        'mode' => 'preview',
        'post_types' => ['page'],
        'supports' => ['align' => false],
        'example' => [],
    ]);

    acf_register_block_type([
        'name' => 'glc-express-cta',
        'title' => 'GLC: Експрес CTA',
        'render_template' => get_template_directory() . '/blocks/express-cta/render.php',
        'category' => 'glc-common',
        'icon' => 'megaphone',
        'keywords' => ['cta', 'експрес', 'розрахунок', 'glc'],
        'mode' => 'preview',
        'post_types' => ['page'],
        'supports' => ['align' => false],
        'example' => [],
    ]);

    acf_register_block_type([
        'name' => 'glc-seo-text',
        'title' => 'GLC: SEO текст',
        'render_template' => get_template_directory() . '/blocks/seo-text/render.php',
        'category' => 'glc-common',
        'icon' => 'text',
        'mode' => 'preview',
        'post_types' => ['page'],
        'supports' => ['align' => false],
        'keywords' => ['seo', 'текст', 'glc'],
        'example' => [],
    ]);

    // ── GLC: Головна сторінка ────────────────────────

    acf_register_block_type([
        'name'            => 'glc-home-hero',
        'title'           => 'GLC: Головний слайдер',
        'render_template' => get_template_directory() . '/blocks/home-hero/render.php',
        'category'        => 'glc-common',
        'icon'            => 'slides',
        'mode'            => 'preview',
        'post_types'      => ['page'],
        'supports'        => ['align' => false],
        'keywords'        => ['hero', 'slider', 'головна', 'glc'],
        'example'         => [],
    ]);

    acf_register_block_type([
        'name'            => 'glc-vehicles',
        'title'           => 'GLC: Транспорт',
        'render_template' => get_template_directory() . '/blocks/vehicles/render.php',
        'category'        => 'glc-common',
        'icon'            => 'car',
        'mode'            => 'preview',
        'post_types'      => ['page'],
        'supports'        => ['align' => false],
        'keywords'        => ['vehicles', 'транспорт', 'автомобілі', 'glc'],
        'example'         => [],
    ]);

    acf_register_block_type([
        'name'            => 'glc-routes',
        'title'           => 'GLC: Маршрути',
        'render_template' => get_template_directory() . '/blocks/routes/render.php',
        'category'        => 'glc-common',
        'icon'            => 'location-alt',
        'mode'            => 'preview',
        'post_types'      => ['page'],
        'supports'        => ['align' => false],
        'keywords'        => ['routes', 'маршрути', 'glc'],
        'example'         => [],
    ]);

    acf_register_block_type([
        'name'            => 'glc-ticker',
        'title'           => 'GLC: Бігуча стрічка',
        'render_template' => get_template_directory() . '/blocks/ticker/render.php',
        'category'        => 'glc-common',
        'icon'            => 'minus',
        'mode'            => 'preview',
        'post_types'      => ['page'],
        'supports'        => ['align' => false],
        'keywords'        => ['ticker', 'стрічка', 'glc'],
        'example'         => [],
    ]);

    acf_register_block_type([
        'name'            => 'glc-offices',
        'title'           => 'GLC: Офіси',
        'render_template' => get_template_directory() . '/blocks/offices/render.php',
        'category'        => 'glc-common',
        'icon'            => 'location',
        'mode'            => 'preview',
        'post_types'      => ['page'],
        'supports'        => ['align' => false],
        'keywords'        => ['offices', 'офіси', 'glc'],
        'example'         => [],
    ]);

    acf_register_block_type([
        'name'            => 'glc-price-table',
        'title'           => 'GLC: Прайс-таблиця',
        'render_template' => get_template_directory() . '/blocks/price-table/render.php',
        'category'        => 'glc-common',
        'icon'            => 'editor-table',
        'mode'            => 'preview',
        'post_types'      => ['page'],
        'supports'        => ['align' => false],
        'keywords'        => ['price', 'прайс', 'таблиця', 'glc'],
        'example'         => [],
    ]);

    acf_register_block_type([
        'name'            => 'glc-photo-report',
        'title'           => 'GLC: Фотозвіт перевезень',
        'render_template' => get_template_directory() . '/blocks/photo-report/render.php',
        'category'        => 'glc-common',
        'icon'            => 'camera',
        'mode'            => 'preview',
        'post_types'      => ['page'],
        'supports'        => ['align' => false],
        'keywords'        => ['photo', 'фотозвіт', 'перевезення', 'glc'],
        'example'         => [],
    ]);

    acf_register_block_type([
        'name'            => 'glc-service-list',
        'title'           => 'GLC: Список послуг',
        'render_template' => get_template_directory() . '/blocks/service-list/render.php',
        'category'        => 'glc-common',
        'icon'            => 'grid-view',
        'mode'            => 'preview',
        'post_types'      => ['page'],
        'supports'        => ['align' => false],
        'keywords'        => ['services', 'послуги', 'список', 'glc'],
        'example'         => [],
    ]);

    acf_register_block_type([
        'name'            => 'glc-care',
        'title'           => 'GLC: Всі турботи',
        'render_template' => get_template_directory() . '/blocks/care/render.php',
        'category'        => 'glc-common',
        'icon'            => 'shield',
        'mode'            => 'preview',
        'post_types'      => ['page'],
        'supports'        => ['align' => false],
        'keywords'        => ['care', 'турботи', 'супровід', 'glc'],
        'example'         => [],
    ]);

    acf_register_block_type([
        'name'            => 'glc-transport-variants',
        'title'           => 'GLC: Варіанти перевезення',
        'render_template' => get_template_directory() . '/blocks/transport-variants/render.php',
        'category'        => 'glc-common',
        'icon'            => 'car',
        'mode'            => 'preview',
        'post_types'      => ['page'],
        'supports'        => ['align' => false],
        'keywords'        => ['transport', 'варіанти', 'перевезення', 'glc'],
        'example'         => [],
    ]);

    acf_register_block_type([
        'name'            => 'glc-truck-types',
        'title'           => 'GLC: Типи вантажних автомобілів',
        'render_template' => get_template_directory() . '/blocks/truck-types/render.php',
        'category'        => 'glc-common',
        'icon'            => 'car',
        'mode'            => 'preview',
        'post_types'      => ['page'],
        'supports'        => ['align' => false],
        'keywords'        => ['truck', 'vehicles', 'вантажні автомобілі', 'glc'],
        'example'         => [],
    ]);

    acf_register_block_type([
        'name'            => 'glc-faq',
        'title'           => 'GLC: FAQ (акордеон)',
        'render_template' => get_template_directory() . '/blocks/faq/render.php',
        'category'        => 'glc-common',
        'icon'            => 'editor-help',
        'mode'            => 'preview',
        'post_types'      => ['page'],
        'supports'        => ['align' => false],
        'keywords'        => ['faq', 'питання', 'акордеон', 'glc'],
        'example'         => [],
    ]);

    // ── GLC: Міжнародні перевезення ──────────────────

    acf_register_block_type([
        'name' => 'glc-int-experience',
        'title' => 'GLC: Наш досвід (карта)',
        'render_template' => get_template_directory() . '/blocks/int-experience/render.php',
        'category' => 'glc-international',
        'icon' => 'admin-site-alt3',
        'keywords' => ['experience', 'досвід', 'карта', 'маршрути', 'glc'],
        'mode' => 'preview',
        'post_types' => ['page'],
        'supports' => ['align' => false],
        'example' => [],
    ]);
}
