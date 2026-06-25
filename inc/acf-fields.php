<?php
if (!defined('ABSPATH')) exit;

add_action('acf/init', 'glc_register_block_field_groups');
function glc_register_block_field_groups()
{
    if (!function_exists('acf_add_local_field_group'))
        return;

    acf_add_local_field_group([
        'key' => 'group_glc_services_map',
        'title' => 'GLC Block: Карта маршрутів',
        'fields' => [
            ['key' => 'field_smap_title', 'label' => 'Заголовок', 'name' => 'map_title', 'type' => 'text', 'required' => 1],
            ['key' => 'field_smap_btn1_text', 'label' => 'Кнопка 1: текст', 'name' => 'map_btn_1_text', 'type' => 'text'],
            [
                'key' => 'field_smap_btn1_action',
                'label' => 'Кнопка 1: дія',
                'name' => 'map_btn_1_action',
                'type' => 'select',
                'choices' => ['link' => 'Посилання', 'popup' => 'Popup', 'phone' => 'Телефон', 'scroll' => 'Скрол'],
                'default_value' => 'link',
                'return_format' => 'value',
            ],
            ['key' => 'field_smap_btn1_value', 'label' => 'Кнопка 1: значення (URL / id / телефон)', 'name' => 'map_btn_1_value', 'type' => 'text'],
            ['key' => 'field_smap_btn2_text', 'label' => 'Кнопка 2: текст', 'name' => 'map_btn_2_text', 'type' => 'text'],
            [
                'key' => 'field_smap_btn2_action',
                'label' => 'Кнопка 2: дія',
                'name' => 'map_btn_2_action',
                'type' => 'select',
                'choices' => ['link' => 'Посилання', 'popup' => 'Popup', 'phone' => 'Телефон', 'scroll' => 'Скрол'],
                'default_value' => 'link',
                'return_format' => 'value',
            ],
            ['key' => 'field_smap_btn2_value', 'label' => 'Кнопка 2: значення (URL / id / телефон)', 'name' => 'map_btn_2_value', 'type' => 'text'],
            ['key' => 'field_smap_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-services-map']]],
    ]);

    acf_add_local_field_group([
        'key' => 'group_glc_services_hero',
        'title' => 'GLC Block: Слайдер послуг',
        'fields' => [
            ['key' => 'field_shero_title', 'label' => 'Заголовок', 'name' => 'hero_title', 'type' => 'text', 'required' => 1],
            ['key' => 'field_shero_desc', 'label' => 'Опис', 'name' => 'hero_desc', 'type' => 'textarea', 'required' => 1],
            [
                'key'          => 'field_shero_slides',
                'label'        => 'Слайди',
                'name'         => 'slides',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => 'Додати слайд',
                'min'          => 1,
                'required'     => 1,
                'sub_fields'   => [
                    [
                        'key'           => 'field_shero_image',
                        'label'         => 'Фото',
                        'name'          => 'slide_image',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'medium',
                        'instructions'  => 'Мін. 1200×390px',
                    ],
                ],
            ],
            ['key' => 'field_shero_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'white', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-services-hero']]],
    ]);

    acf_add_local_field_group([
        'key'    => 'group_glc_routes',
        'title'  => 'GLC Block: Маршрути',
        'fields' => [
            [
                'key'           => 'field_routes_style',
                'label'         => 'Стиль',
                'name'          => 'style',
                'type'          => 'select',
                'choices'       => ['tabs' => 'Таби (рядок по центру)', 'tags' => 'Теги (сітка з лінією)'],
                'default_value' => 'tabs',
                'return_format' => 'value',
            ],
            [
                'key'          => 'field_routes_items',
                'label'        => 'Маршрути',
                'name'         => 'items',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => 'Додати маршрут',
                'sub_fields'   => [
                    ['key' => 'field_routes_title', 'label' => 'Назва', 'name' => 'route_title', 'type' => 'text', 'required' => 1],
                    ['key' => 'field_routes_link',  'label' => 'Посилання', 'name' => 'route_link', 'type' => 'url'],
                ],
            ],
            ['key' => 'field_routes_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'white', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-routes']]],
    ]);

    acf_add_local_field_group([
        'key' => 'group_glc_cargo_types',
        'title' => 'GLC Block: Види вантажів',
        'fields' => [
            ['key' => 'field_cargo_sec_title', 'label' => 'Заголовок секції', 'name' => 'section_title', 'type' => 'text'],
            ['key' => 'field_cargo_sec_desc', 'label' => 'Опис секції', 'name' => 'section_desc', 'type' => 'textarea', 'rows' => 3],
            [
                'key' => 'field_cargo_items',
                'label' => 'Елементи',
                'name' => 'items',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Додати вид вантажу',
                'required' => 1,
                'sub_fields' => [
                    ['key' => 'field_cargo_item_title', 'label' => 'Назва', 'name' => 'title', 'type' => 'text', 'required' => 1],
                    ['key' => 'field_cargo_item_desc', 'label' => 'Опис', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3],
                    ['key' => 'field_cargo_item_btn_text', 'label' => 'Текст кнопки', 'name' => 'btn_text', 'type' => 'text', 'default_value' => 'Детальніше'],
                    [
                        'key' => 'field_cargo_item_btn_action',
                        'label' => 'Дія кнопки',
                        'name' => 'btn_action',
                        'type' => 'select',
                        'choices' => ['link' => 'Посилання', 'popup' => 'Popup', 'phone' => 'Телефон', 'scroll' => 'Скрол'],
                        'default_value' => 'link',
                        'return_format' => 'value',
                    ],
                    ['key' => 'field_cargo_item_btn_value', 'label' => 'Значення (URL / id / телефон)', 'name' => 'btn_value', 'type' => 'text'],
                    [
                        'key' => 'field_cargo_item_image',
                        'label' => 'Зображення',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
                    ],
                ],
            ],
            ['key' => 'field_cargo_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-cargo-types']]],
    ]);

    acf_add_local_field_group([
        'key' => 'group_glc_cargo_slider',
        'title' => 'GLC Block: Види вантажів (слайдер)',
        'fields' => [
            ['key' => 'field_cslider_sec_title', 'label' => 'Заголовок секції', 'name' => 'section_title', 'type' => 'text'],
            ['key' => 'field_cslider_sec_desc', 'label' => 'Опис секції', 'name' => 'section_desc', 'type' => 'textarea', 'rows' => 3],
            [
                'key' => 'field_cslider_items',
                'label' => 'Елементи',
                'name' => 'items',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Додати вид вантажу',
                'required' => 1,
                'sub_fields' => [
                    ['key' => 'field_cslider_item_title', 'label' => 'Назва', 'name' => 'title', 'type' => 'text', 'required' => 1],
                    ['key' => 'field_cslider_item_desc', 'label' => 'Опис', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3],
                    ['key' => 'field_cslider_item_btn_text', 'label' => 'Текст кнопки', 'name' => 'btn_text', 'type' => 'text', 'default_value' => 'Детальніше'],
                    [
                        'key' => 'field_cslider_item_btn_action',
                        'label' => 'Дія кнопки',
                        'name' => 'btn_action',
                        'type' => 'select',
                        'choices' => ['link' => 'Посилання', 'popup' => 'Popup', 'phone' => 'Телефон', 'scroll' => 'Скрол'],
                        'default_value' => 'link',
                        'return_format' => 'value',
                    ],
                    ['key' => 'field_cslider_item_btn_value', 'label' => 'Значення (URL / id / телефон)', 'name' => 'btn_value', 'type' => 'text'],
                    [
                        'key' => 'field_cslider_item_image',
                        'label' => 'Зображення',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
                        'instructions' => 'Рекомендовано горизонтальне фото близько 345x158px',
                    ],
                ],
            ],
            ['key' => 'field_cslider_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-cargo-slider']]],
    ]);

    acf_add_local_field_group([
        'key' => 'group_glc_service_types',
        'title' => 'GLC Block: Типи послуг',
        'fields' => [
            ['key' => 'field_stype_services_title', 'label' => 'Лівий заголовок: види послуг', 'name' => 'services_title', 'type' => 'text', 'default_value' => 'Види послуг перевезення'],
            ['key' => 'field_stype_tariffs_title', 'label' => 'Лівий заголовок: тарифи', 'name' => 'tariffs_title', 'type' => 'text', 'default_value' => 'Тарифи транспортних послуг'],
            [
                'key' => 'field_stype_transport',
                'label' => 'Пункти акордеону',
                'name' => 'transport_types',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Додати пункт',
                'required' => 1,
                'sub_fields' => [
                    ['key' => 'field_stype_t_title', 'label' => 'Назва', 'name' => 'title', 'type' => 'text', 'required' => 1],
                    ['key' => 'field_stype_t_desc', 'label' => 'Опис', 'name' => 'desc', 'type' => 'textarea', 'rows' => 4],
                    ['key' => 'field_stype_t_btn_text', 'label' => 'Текст кнопки', 'name' => 'btn_text', 'type' => 'text', 'default_value' => 'Детальніше'],
                    [
                        'key' => 'field_stype_t_btn_action',
                        'label' => 'Дія кнопки',
                        'name' => 'btn_action',
                        'type' => 'select',
                        'choices' => ['link' => 'Посилання', 'popup' => 'Popup', 'phone' => 'Телефон', 'scroll' => 'Скрол'],
                        'default_value' => 'link',
                        'return_format' => 'value',
                    ],
                    ['key' => 'field_stype_t_btn_value', 'label' => 'Значення кнопки (URL / id / телефон)', 'name' => 'btn_value', 'type' => 'text'],
                ],
            ],
            ['key' => 'field_stype_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-service-types']]],
    ]);
    acf_add_local_field_group([
        'key'    => 'group_cpt_review',
        'title'  => 'Відгук',
        'fields' => [
            [
                'key'           => 'field_review_avatar',
                'label'         => 'Аватар',
                'name'          => 'review_avatar',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'thumbnail',
                'instructions'  => 'Необов\'язково. Якщо не вказано — стандартна іконка.',
            ],
            ['key' => 'field_review_company',   'label' => 'Компанія',     'name' => 'review_company',   'type' => 'text'],
            ['key' => 'field_review_body_type', 'label' => 'Тип кузова',   'name' => 'review_body_type', 'type' => 'text'],
            ['key' => 'field_review_volume',    'label' => 'Об\'єм',       'name' => 'review_volume',    'type' => 'text'],
            ['key' => 'field_review_text',      'label' => 'Текст відгуку','name' => 'review_text',      'type' => 'textarea', 'rows' => 4, 'required' => 1],
        ],
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'review']]],
    ]);

    acf_add_local_field_group([
        'key'    => 'group_glc_reviews',
        'title'  => 'GLC Block: Відгуки',
        'fields' => [
            [
                'key'           => 'field_reviews_items',
                'label'         => 'Відгуки',
                'name'          => 'items',
                'type'          => 'relationship',
                'post_type'     => ['review'],
                'filters'       => ['search'],
                'return_format' => 'object',
                'min'           => 1,
                'required'      => 1,
            ],
            ['key' => 'field_reviews_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-reviews']]],
    ]);

    acf_add_local_field_group([
        'key' => 'group_glc_page_hero',
        'title' => 'GLC Block: Hero сторінки',
        'fields' => [
            ['key' => 'field_phero_title', 'label' => 'Заголовок', 'name' => 'hero_title', 'type' => 'text', 'required' => 1],
            ['key' => 'field_phero_desc', 'label' => 'Опис', 'name' => 'hero_desc', 'type' => 'textarea'],
            ['key' => 'field_phero_btn1_text', 'label' => 'Кнопка 1: текст', 'name' => 'hero_btn_1_text', 'type' => 'text'],
            [
                'key' => 'field_phero_btn1_action',
                'label' => 'Кнопка 1: дія',
                'name' => 'hero_btn_1_action',
                'type' => 'select',
                'choices' => ['link' => 'Посилання', 'popup' => 'Popup', 'phone' => 'Телефон', 'scroll' => 'Скрол'],
                'default_value' => 'link',
                'return_format' => 'value',
            ],
            ['key' => 'field_phero_btn1_value', 'label' => 'Кнопка 1: значення (URL / id / телефон)', 'name' => 'hero_btn_1_value', 'type' => 'text'],
            ['key' => 'field_phero_btn2_text', 'label' => 'Кнопка 2: текст', 'name' => 'hero_btn_2_text', 'type' => 'text'],
            [
                'key' => 'field_phero_btn2_action',
                'label' => 'Кнопка 2: дія',
                'name' => 'hero_btn_2_action',
                'type' => 'select',
                'choices' => ['link' => 'Посилання', 'popup' => 'Popup', 'phone' => 'Телефон', 'scroll' => 'Скрол'],
                'default_value' => 'link',
                'return_format' => 'value',
            ],
            ['key' => 'field_phero_btn2_value', 'label' => 'Кнопка 2: значення (URL / id / телефон)', 'name' => 'hero_btn_2_value', 'type' => 'text'],
            [
                'key' => 'field_phero_image',
                'label' => 'Зображення',
                'name' => 'hero_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'instructions' => 'Мін. 800×600px',
            ],
            ['key' => 'field_phero_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-page-hero']]],
    ]);

    acf_add_local_field_group([
        'key' => 'group_glc_page_hero_accent',
        'title' => 'GLC Block: Hero сторінки з акцентом',
        'fields' => [
            ['key' => 'field_phero_accent_title', 'label' => 'Заголовок', 'name' => 'hero_title', 'type' => 'text', 'required' => 1],
            ['key' => 'field_phero_accent_desc', 'label' => 'Опис', 'name' => 'hero_desc', 'type' => 'textarea'],
            ['key' => 'field_phero_accent_text', 'label' => 'Акцентний текст', 'name' => 'hero_accent_text', 'type' => 'textarea', 'rows' => 5],
            ['key' => 'field_phero_accent_btn1_text', 'label' => 'Кнопка 1: текст', 'name' => 'hero_btn_1_text', 'type' => 'text'],
            [
                'key' => 'field_phero_accent_btn1_action',
                'label' => 'Кнопка 1: дія',
                'name' => 'hero_btn_1_action',
                'type' => 'select',
                'choices' => ['link' => 'Посилання', 'popup' => 'Popup', 'phone' => 'Телефон', 'scroll' => 'Скрол'],
                'default_value' => 'link',
                'return_format' => 'value',
            ],
            ['key' => 'field_phero_accent_btn1_value', 'label' => 'Кнопка 1: значення (URL / id / телефон)', 'name' => 'hero_btn_1_value', 'type' => 'text'],
            ['key' => 'field_phero_accent_btn2_text', 'label' => 'Кнопка 2: текст', 'name' => 'hero_btn_2_text', 'type' => 'text'],
            [
                'key' => 'field_phero_accent_btn2_action',
                'label' => 'Кнопка 2: дія',
                'name' => 'hero_btn_2_action',
                'type' => 'select',
                'choices' => ['link' => 'Посилання', 'popup' => 'Popup', 'phone' => 'Телефон', 'scroll' => 'Скрол'],
                'default_value' => 'link',
                'return_format' => 'value',
            ],
            ['key' => 'field_phero_accent_btn2_value', 'label' => 'Кнопка 2: значення (URL / id / телефон)', 'name' => 'hero_btn_2_value', 'type' => 'text'],
            [
                'key' => 'field_phero_accent_image',
                'label' => 'Зображення',
                'name' => 'hero_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'instructions' => 'Мін. 800×600px',
            ],
            ['key' => 'field_phero_accent_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-page-hero-accent']]],
    ]);

    acf_add_local_field_group([
        'key' => 'group_glc_media_text',
        'title' => 'GLC Block: Фото + текст',
        'fields' => [
            [
                'key' => 'field_mtext_image',
                'label' => 'Зображення',
                'name' => 'media_text_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'instructions' => 'Рекомендовано вертикальне фото 360x440px',
            ],
            ['key' => 'field_mtext_title', 'label' => 'Заголовок', 'name' => 'media_text_title', 'type' => 'text'],
            ['key' => 'field_mtext_highlight', 'label' => 'Акцентний текст', 'name' => 'media_text_highlight', 'type' => 'textarea', 'rows' => 5],
            [
                'key' => 'field_mtext_body',
                'label' => 'Текст справа',
                'name' => 'media_text_body',
                'type' => 'textarea',
                'rows' => 6,
            ],
            [
                'key' => 'field_mtext_bottom',
                'label' => 'Текст знизу',
                'name' => 'media_text_bottom',
                'type' => 'textarea',
                'rows' => 7,
            ],
            ['key' => 'field_mtext_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-media-text']]],
    ]);

    acf_add_local_field_group([
        'key' => 'group_glc_steps',
        'title' => 'GLC Block: Етапи',
        'fields' => [
            ['key' => 'field_steps_title', 'label' => 'Заголовок секції', 'name' => 'section_title', 'type' => 'text'],
            [
                'key' => 'field_steps_items',
                'label' => 'Кроки',
                'name' => 'items',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Додати крок',
                'required' => 1,
                'sub_fields' => [
                    [
                        'key' => 'field_steps_icon',
                        'label' => 'Іконка',
                        'name' => 'icon',
                        'type' => 'select',
                        'choices' => [
                            '1' => 'Іконка 1',
                            '2' => 'Іконка 2',
                            '3' => 'Іконка 3',
                            '4' => 'Іконка 4',
                            '5' => 'Іконка 5',
                        ],
                        'default_value' => '1',
                        'return_format' => 'value',
                    ],
                    ['key' => 'field_steps_item_title', 'label' => 'Назва кроку', 'name' => 'title', 'type' => 'text', 'required' => 1],
                    ['key' => 'field_steps_item_description', 'label' => 'Опис кроку', 'name' => 'description', 'type' => 'textarea', 'rows' => 2, 'new_lines' => 'br'],
                ],
            ],
            ['key' => 'field_steps_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-steps']]],
    ]);

    acf_add_local_field_group([
        'key' => 'group_glc_features',
        'title' => 'GLC Block: Переваги / іконки',
        'fields' => [
            ['key' => 'field_feat_text_rental',      'label' => 'Текст: Оренда авто',              'name' => 'text_rental',      'type' => 'text'],
            ['key' => 'field_feat_text_financial',  'label' => 'Текст: Фінансові зобов\'язання', 'name' => 'text_financial',  'type' => 'text'],
            ['key' => 'field_feat_text_multimodal',  'label' => 'Текст: Мультимодальні',           'name' => 'text_multimodal',  'type' => 'text'],
            ['key' => 'field_feat_text_heavy',       'label' => 'Текст: Важкі вантажі',           'name' => 'text_heavy',       'type' => 'text'],
            ['key' => 'field_features_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-features']]],
    ]);

    acf_add_local_field_group([
        'key'    => 'group_glc_express_cta',
        'title'  => 'GLC Block: Експрес CTA',
        'fields' => [
            ['key' => 'field_ecta_title',      'label' => 'Заголовок',     'name' => 'cta_title',      'type' => 'text',   'default_value' => 'ЕКСПРЕС РОЗРАХУНОК ВАРТОСТІ'],
            ['key' => 'field_ecta_desc',       'label' => 'Опис',          'name' => 'cta_desc',       'type' => 'text',   'default_value' => 'Заповніть основні параметри перевезення і наш менеджер зателефонує Вам протягом 10 хв., щоб уточнити деталі та розрахувати вартість перевезення'],
            ['key' => 'field_ecta_btn_text',   'label' => 'Текст кнопки',  'name' => 'cta_btn_text',   'type' => 'text',   'default_value' => 'Розрахувати вартість'],
            [
                'key'           => 'field_ecta_btn_action',
                'label'         => 'Дія кнопки',
                'name'          => 'cta_btn_action',
                'type'          => 'select',
                'choices'       => ['link' => 'Посилання', 'popup' => 'Popup', 'phone' => 'Телефон', 'scroll' => 'Скрол'],
                'default_value' => 'link',
                'return_format' => 'value',
            ],
            ['key' => 'field_ecta_btn_value',  'label' => 'Значення (URL / id / телефон)', 'name' => 'cta_btn_value', 'type' => 'text'],
            ['key' => 'field_ecta_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-express-cta']]],
    ]);

    acf_add_local_field_group([
        'key' => 'group_glc_transport_icons',
        'title' => 'GLC Block: Транспорт / іконки',
        'fields' => [
            ['key' => 'field_ti_text_auto',     'label' => 'Текст: Авто',       'name' => 'text_auto',     'type' => 'text'],
            ['key' => 'field_ti_text_air',      'label' => 'Текст: Авіа',       'name' => 'text_air',      'type' => 'text'],
            ['key' => 'field_ti_text_sea',      'label' => 'Текст: Море',       'name' => 'text_sea',      'type' => 'text'],
            ['key' => 'field_ti_text_railway',  'label' => 'Текст: Залізниця',  'name' => 'text_railway',  'type' => 'text'],
            ['key' => 'field_ti_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-transport-icons']]],
    ]);

    acf_add_local_field_group([
        'key'    => 'group_glc_price_table',
        'title'  => 'GLC Block: Прайс-таблиця',
        'fields' => [
            ['key' => 'field_ptable_title', 'label' => 'Заголовок', 'name' => 'section_title', 'type' => 'text', 'default_value' => 'Прайс'],
            ['key' => 'field_ptable_col1', 'label' => 'Колонка 1 (заголовок)', 'name' => 'col_1_label', 'type' => 'text', 'default_value' => 'Маршрут'],
            ['key' => 'field_ptable_col2', 'label' => 'Колонка 2 (заголовок)', 'name' => 'col_2_label', 'type' => 'text', 'default_value' => 'Попутно (лафета)'],
            ['key' => 'field_ptable_col3', 'label' => 'Колонка 3 (заголовок)', 'name' => 'col_3_label', 'type' => 'text', 'default_value' => 'Попутно (автовоз)'],
            [
                'key'          => 'field_ptable_rows',
                'label'        => 'Рядки',
                'name'         => 'rows',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => 'Додати рядок',
                'required'     => 1,
                'sub_fields'   => [
                    ['key' => 'field_ptable_cell1', 'label' => 'Маршрут', 'name' => 'cell_1', 'type' => 'text', 'required' => 1],
                    ['key' => 'field_ptable_cell2', 'label' => 'Ціна 1', 'name' => 'cell_2', 'type' => 'text'],
                    ['key' => 'field_ptable_cell3', 'label' => 'Ціна 2', 'name' => 'cell_3', 'type' => 'text'],
                ],
            ],
            ['key' => 'field_ptable_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-price-table']]],
    ]);

    acf_add_local_field_group([
        'key'    => 'group_glc_photo_report',
        'title'  => 'GLC Block: Фотозвіт перевезень',
        'fields' => [
            ['key' => 'field_preport_title', 'label' => 'Заголовок', 'name' => 'section_title', 'type' => 'text', 'default_value' => 'Фотозвіт із виконаних перевезень'],
            [
                'key'          => 'field_preport_items',
                'label'        => 'Перевезення',
                'name'         => 'items',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Додати перевезення',
                'required'     => 1,
                'sub_fields'   => [
                    [
                        'key'           => 'field_preport_image',
                        'label'         => 'Фото',
                        'name'          => 'image',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'medium',
                    ],
                    ['key' => 'field_preport_route', 'label' => 'Маршрут', 'name' => 'route', 'type' => 'text', 'required' => 1, 'instructions' => 'напр. «Київ - Харків»'],
                    ['key' => 'field_preport_count', 'label' => 'Кількість авто', 'name' => 'vehicles_count', 'type' => 'text', 'instructions' => 'напр. «8 авто»'],
                    ['key' => 'field_preport_duration', 'label' => 'Тривалість', 'name' => 'duration', 'type' => 'text', 'instructions' => 'напр. «1 день»'],
                    ['key' => 'field_preport_btn_text', 'label' => 'Текст кнопки', 'name' => 'btn_text', 'type' => 'text', 'default_value' => 'Замовити'],
                    [
                        'key'           => 'field_preport_btn_action',
                        'label'         => 'Дія кнопки',
                        'name'          => 'btn_action',
                        'type'          => 'select',
                        'choices'       => ['link' => 'Посилання', 'popup' => 'Popup', 'phone' => 'Телефон', 'scroll' => 'Скрол'],
                        'default_value' => 'link',
                        'return_format' => 'value',
                    ],
                    ['key' => 'field_preport_btn_value', 'label' => 'Значення (URL / id / телефон)', 'name' => 'btn_value', 'type' => 'text'],
                ],
            ],
            ['key' => 'field_preport_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-photo-report']]],
    ]);

    acf_add_local_field_group([
        'key'    => 'group_glc_service_list',
        'title'  => 'GLC Block: Список послуг',
        'fields' => [
            ['key' => 'field_slist_title', 'label' => 'Заголовок', 'name' => 'section_title', 'type' => 'text'],
            ['key' => 'field_slist_desc', 'label' => 'Опис', 'name' => 'section_desc', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_slist_btn_text', 'label' => 'Текст кнопки', 'name' => 'btn_text', 'type' => 'text'],
            [
                'key'           => 'field_slist_btn_action',
                'label'         => 'Дія кнопки',
                'name'          => 'btn_action',
                'type'          => 'select',
                'choices'       => ['link' => 'Посилання', 'popup' => 'Popup', 'phone' => 'Телефон', 'scroll' => 'Скрол'],
                'default_value' => 'link',
                'return_format' => 'value',
            ],
            ['key' => 'field_slist_btn_value', 'label' => 'Значення (URL / id / телефон)', 'name' => 'btn_value', 'type' => 'text'],
            [
                'key'          => 'field_slist_items',
                'label'        => 'Послуги',
                'name'         => 'items',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Додати послугу',
                'required'     => 1,
                'sub_fields'   => [
                    [
                        'key'           => 'field_slist_image',
                        'label'         => 'Фото',
                        'name'          => 'image',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'medium',
                        'instructions'  => 'Рекомендовано горизонтальне фото близько 415x233px',
                    ],
                    [
                        'key'           => 'field_slist_icon',
                        'label'         => 'Іконка',
                        'name'          => 'icon',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'thumbnail',
                        'instructions'  => 'SVG або PNG іконка',
                    ],
                    ['key' => 'field_slist_item_title', 'label' => 'Назва', 'name' => 'title', 'type' => 'text', 'required' => 1],
                    ['key' => 'field_slist_item_desc', 'label' => 'Опис', 'name' => 'description', 'type' => 'textarea', 'rows' => 3],
                    ['key' => 'field_slist_item_btn_text', 'label' => 'Кнопка: текст', 'name' => 'btn_text', 'type' => 'text', 'default_value' => 'Детальніше'],
                    [
                        'key'           => 'field_slist_item_btn_action',
                        'label'         => 'Кнопка: дія',
                        'name'          => 'btn_action',
                        'type'          => 'select',
                        'choices'       => ['link' => 'Посилання', 'popup' => 'Popup', 'phone' => 'Телефон', 'scroll' => 'Скрол'],
                        'default_value' => 'link',
                        'return_format' => 'value',
                    ],
                    ['key' => 'field_slist_item_btn_value', 'label' => 'Кнопка: значення', 'name' => 'btn_value', 'type' => 'text'],
                ],
            ],
            ['key' => 'field_slist_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка', 'dark' => 'Темний'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-service-list']]],
    ]);

    acf_add_local_field_group([
        'key'    => 'group_glc_service_cards',
        'title'  => 'GLC Block: Картки послуг',
        'fields' => [
            ['key' => 'field_scards_title', 'label' => 'Заголовок', 'name' => 'section_title', 'type' => 'text'],
            ['key' => 'field_scards_desc', 'label' => 'Опис', 'name' => 'section_desc', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_scards_btn_text', 'label' => 'Текст кнопки', 'name' => 'btn_text', 'type' => 'text'],
            [
                'key'           => 'field_scards_btn_action',
                'label'         => 'Дія кнопки',
                'name'          => 'btn_action',
                'type'          => 'select',
                'choices'       => ['link' => 'Посилання', 'popup' => 'Popup', 'phone' => 'Телефон', 'scroll' => 'Скрол'],
                'default_value' => 'link',
                'return_format' => 'value',
            ],
            ['key' => 'field_scards_btn_value', 'label' => 'Значення (URL / id / телефон)', 'name' => 'btn_value', 'type' => 'text'],
            [
                'key'          => 'field_scards_items',
                'label'        => 'Послуги',
                'name'         => 'items',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Додати послугу',
                'required'     => 1,
                'sub_fields'   => [
                    [
                        'key'           => 'field_scards_icon',
                        'label'         => 'Іконка',
                        'name'          => 'icon',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'thumbnail',
                        'instructions'  => 'SVG або PNG іконка',
                    ],
                    ['key' => 'field_scards_item_title', 'label' => 'Назва', 'name' => 'title', 'type' => 'text', 'required' => 1],
                    ['key' => 'field_scards_item_desc', 'label' => 'Опис', 'name' => 'description', 'type' => 'textarea', 'rows' => 3],
                ],
            ],
            ['key' => 'field_scards_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка', 'dark' => 'Темний'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-service-cards']]],
    ]);

    acf_add_local_field_group([
        'key'    => 'group_glc_care',
        'title'  => 'GLC Block: Всі турботи',
        'fields' => [
            ['key' => 'field_care_title', 'label' => 'Заголовок', 'name' => 'section_title', 'type' => 'text', 'default_value' => 'Всі турботи беремо на себе'],
            [
                'key'           => 'field_care_image',
                'label'         => 'Зображення',
                'name'          => 'image',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
            ],
            [
                'key'          => 'field_care_items',
                'label'        => 'Пункти списку',
                'name'         => 'items',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Додати пункт',
                'sub_fields'   => [
                    ['key' => 'field_care_item_text', 'label' => 'Текст', 'name' => 'text', 'type' => 'textarea', 'rows' => 2, 'required' => 1],
                ],
            ],
            [
                'key'           => 'field_care_highlight',
                'label'         => 'Виділений текст',
                'name'          => 'highlight_text',
                'type'          => 'textarea',
                'rows'          => 4,
                'new_lines'     => 'br',
                'default_value' => 'Ми надаємо послуги під ключ незалежно від їхнього ступеня складності. Ми з рівним успіхом організуємо доставку хоч на сусідню вулицю, хоч на інший кінець світу.',
            ],
            [
                'key'           => 'field_care_bg',
                'label'         => 'Фон секції',
                'name'          => 'section_bg',
                'type'          => 'select',
                'choices'       => ['dark' => 'Темний', 'page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'],
                'default_value' => 'dark',
                'return_format' => 'value',
            ],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-care']]],
    ]);

    acf_add_local_field_group([
        'key'    => 'group_glc_transport_variants',
        'title'  => 'GLC Block: Варіанти перевезення',
        'fields' => [
            ['key' => 'field_tvar_title', 'label' => 'Заголовок секції', 'name' => 'section_title', 'type' => 'text', 'default_value' => 'Варіанти перевезення'],
            [
                'key'          => 'field_tvar_items',
                'label'        => 'Картки',
                'name'         => 'items',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Додати варіант',
                'required'     => 1,
                'sub_fields'   => [
                    [
                        'key'           => 'field_tvar_image',
                        'label'         => 'Зображення',
                        'name'          => 'image',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'medium',
                    ],
                    ['key' => 'field_tvar_item_title', 'label' => 'Назва', 'name' => 'title', 'type' => 'text', 'required' => 1],
                    ['key' => 'field_tvar_item_desc', 'label' => 'Опис', 'name' => 'description', 'type' => 'textarea', 'rows' => 3],
                    ['key' => 'field_tvar_btn_text', 'label' => 'Текст кнопки', 'name' => 'btn_text', 'type' => 'text', 'default_value' => 'Розрахувати вартість'],
                    [
                        'key'           => 'field_tvar_btn_action',
                        'label'         => 'Дія кнопки',
                        'name'          => 'btn_action',
                        'type'          => 'select',
                        'choices'       => ['link' => 'Посилання', 'popup' => 'Popup', 'phone' => 'Телефон', 'scroll' => 'Скрол'],
                        'default_value' => 'link',
                        'return_format' => 'value',
                    ],
                    ['key' => 'field_tvar_btn_value', 'label' => 'Значення (URL / id / телефон)', 'name' => 'btn_value', 'type' => 'text'],
                ],
            ],
            ['key' => 'field_tvar_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-transport-variants']]],
    ]);

    acf_add_local_field_group([
        'key'    => 'group_glc_benefits_slider',
        'title'  => 'GLC Block: Слайдер переваг',
        'fields' => [
            ['key' => 'field_bslider_title', 'label' => 'Заголовок секції', 'name' => 'section_title', 'type' => 'text', 'default_value' => 'Переваги:'],
            [
                'key'          => 'field_bslider_items',
                'label'        => 'Слайди',
                'name'         => 'items',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Додати слайд',
                'required'     => 1,
                'sub_fields'   => [
                    [
                        'key'           => 'field_bslider_image',
                        'label'         => 'Зображення',
                        'name'          => 'image',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'medium',
                    ],
                    ['key' => 'field_bslider_item_title', 'label' => 'Заголовок', 'name' => 'title', 'type' => 'text', 'required' => 1],
                    [
                        'key'       => 'field_bslider_item_desc',
                        'label'     => 'Опис',
                        'name'      => 'description',
                        'type'      => 'textarea',
                        'rows'      => 7,
                        'new_lines' => 'br',
                    ],
                ],
            ],
            ['key' => 'field_bslider_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-benefits-slider']]],
    ]);

    acf_add_local_field_group([
        'key'    => 'group_glc_faq',
        'title'  => 'GLC Block: FAQ',
        'fields' => [
            ['key' => 'field_faq_title', 'label' => 'Заголовок', 'name' => 'faq_title', 'type' => 'text', 'default_value' => 'Питання які задають найчастіше'],
            [
                'key'          => 'field_faq_items',
                'label'        => 'Питання / відповіді',
                'name'         => 'faq_items',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Додати питання',
                'required'     => 1,
                'sub_fields'   => [
                    ['key' => 'field_faq_question', 'label' => 'Питання', 'name' => 'question', 'type' => 'text', 'required' => 1],
                    ['key' => 'field_faq_answer', 'label' => 'Відповідь', 'name' => 'answer', 'type' => 'wysiwyg', 'tabs' => 'all', 'toolbar' => 'basic', 'media_upload' => 0],
                ],
            ],
            ['key' => 'field_faq_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-faq']]],
    ]);

    acf_add_local_field_group([
        'key' => 'group_glc_int_experience',
        'title' => 'GLC Block: Наш досвід (карта)',
        'fields' => [
            ['key' => 'field_intexp_title', 'label' => 'Заголовок', 'name' => 'title', 'type' => 'text', 'required' => 1],
            ['key' => 'field_intexp_desc', 'label' => 'Опис', 'name' => 'desc', 'type' => 'textarea'],
            [
                'key' => 'field_intexp_map_image',
                'label' => 'Зображення карти',
                'name' => 'map_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'instructions' => 'Зображення карти/глобуса. Мін. 600×600px. В майбутньому буде замінено на 3D глобус.',
            ],
            [
                'key' => 'field_intexp_route_groups',
                'label' => 'Групи маршрутів',
                'name' => 'route_groups',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Додати групу маршрутів',
                'sub_fields' => [
                    ['key' => 'field_intexp_group_title', 'label' => 'Назва групи', 'name' => 'group_title', 'type' => 'text'],
                    [
                        'key' => 'field_intexp_routes',
                        'label' => 'Маршрути',
                        'name' => 'routes',
                        'type' => 'repeater',
                        'layout' => 'table',
                        'button_label' => 'Додати маршрут',
                        'sub_fields' => [
                            ['key' => 'field_intexp_route_title', 'label' => 'Маршрут', 'name' => 'route_title', 'type' => 'text'],
                            ['key' => 'field_intexp_route_link', 'label' => 'Посилання', 'name' => 'route_link', 'type' => 'url'],
                        ],
                    ],
                ],
            ],
            ['key' => 'field_intexp_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-int-experience']]],
    ]);

    acf_add_local_field_group([
        'key' => 'group_glc_transport_types',
        'title' => 'GLC Block: Види транспорту',
        'fields' => [
            ['key' => 'field_tt_title', 'label' => 'Заголовок секції', 'name' => 'section_title', 'type' => 'text'],
            [
                'key' => 'field_tt_items',
                'label' => 'Елементи',
                'name' => 'items',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Додати тип транспорту',
                'required' => 1,
                'sub_fields' => [
                    [
                        'key' => 'field_tt_image',
                        'label' => 'Фото',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                        'instructions' => 'Мін. 600×400px',
                    ],
                    ['key' => 'field_tt_item_title', 'label' => 'Назва', 'name' => 'title', 'type' => 'text', 'required' => 1],
                    ['key' => 'field_tt_item_desc', 'label' => 'Опис', 'name' => 'desc', 'type' => 'textarea'],
                    ['key' => 'field_tt_item_btn_text', 'label' => 'Текст кнопки', 'name' => 'btn_text', 'type' => 'text', 'default_value' => 'Детальніше про послугу'],
                    [
                        'key' => 'field_tt_item_btn_action',
                        'label' => 'Дія кнопки',
                        'name' => 'btn_action',
                        'type' => 'select',
                        'choices' => ['link' => 'Посилання', 'popup' => 'Popup', 'phone' => 'Телефон', 'scroll' => 'Скрол'],
                        'default_value' => 'link',
                        'return_format' => 'value',
                    ],
                    ['key' => 'field_tt_item_btn_value', 'label' => 'Значення (URL / id / телефон)', 'name' => 'btn_value', 'type' => 'text'],
                ],
            ],
            ['key' => 'field_tt_cta_btn_text',   'label' => 'CTA: Текст кнопки',                'name' => 'cta_btn_text',   'type' => 'text'],
            [
                'key'           => 'field_tt_cta_btn_action',
                'label'         => 'CTA: Дія кнопки',
                'name'          => 'cta_btn_action',
                'type'          => 'select',
                'choices'       => ['link' => 'Посилання', 'popup' => 'Popup', 'phone' => 'Телефон', 'scroll' => 'Скрол'],
                'default_value' => 'link',
                'return_format' => 'value',
            ],
            ['key' => 'field_tt_cta_btn_value', 'label' => 'CTA: Значення (URL / id / телефон)', 'name' => 'cta_btn_value',  'type' => 'text'],
            ['key' => 'field_tt_cta_text',      'label' => 'CTA: Текст під кнопкою',             'name' => 'cta_text',       'type' => 'text'],
            ['key' => 'field_tt_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-transport-types']]],
    ]);

    acf_add_local_field_group([
        'key'    => 'group_glc_truck_types',
        'title'  => 'GLC Block: Типи вантажних автомобілів',
        'fields' => [
            ['key' => 'field_truck_types_title', 'label' => 'Заголовок секції', 'name' => 'section_title', 'type' => 'text'],
            [
                'key'          => 'field_truck_types_items',
                'label'        => 'Картки',
                'name'         => 'items',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Додати авто',
                'required'     => 1,
                'sub_fields'   => [
                    [
                        'key'           => 'field_truck_types_image',
                        'label'         => 'Фото',
                        'name'          => 'image',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'medium',
                        'instructions'  => 'Рекомендовано горизонтальне фото близько 580x234px',
                    ],
                    ['key' => 'field_truck_types_item_title', 'label' => 'Назва', 'name' => 'title', 'type' => 'text', 'required' => 1],
                    ['key' => 'field_truck_types_item_desc', 'label' => 'Опис', 'name' => 'description', 'type' => 'textarea', 'rows' => 6],
                    ['key' => 'field_truck_types_btn_text', 'label' => 'Кнопка: текст', 'name' => 'btn_text', 'type' => 'text', 'default_value' => 'Замовити авто'],
                    [
                        'key'           => 'field_truck_types_btn_action',
                        'label'         => 'Кнопка: дія',
                        'name'          => 'btn_action',
                        'type'          => 'select',
                        'choices'       => ['link' => 'Посилання', 'popup' => 'Popup', 'phone' => 'Телефон', 'scroll' => 'Скрол'],
                        'default_value' => 'link',
                        'return_format' => 'value',
                    ],
                    ['key' => 'field_truck_types_btn_value', 'label' => 'Кнопка: значення', 'name' => 'btn_value', 'type' => 'text'],
                ],
            ],
            ['key' => 'field_truck_types_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-truck-types']]],
    ]);

    acf_add_local_field_group([
        'key'    => 'group_glc_home_hero',
        'title'  => 'GLC Block: Головний слайдер',
        'fields' => [
            ['key' => 'field_hhero_title_top',    'label' => 'Рядок 1',                 'name' => 'hero_title_top',    'type' => 'text', 'instructions' => 'Перший рядок заголовку (напр. «ПОВНИЙ КОМПЛЕКС ПОСЛУГ»)'],
            ['key' => 'field_hhero_title_before', 'label' => 'Рядок 2 (до стрілки)',    'name' => 'hero_title_before', 'type' => 'text', 'instructions' => 'Текст перед → (напр. «У СФЕРІ»)'],
            ['key' => 'field_hhero_title_after',  'label' => 'Рядок 2 (після стрілки)', 'name' => 'hero_title_after',  'type' => 'text', 'instructions' => 'Текст після → (напр. «ВАНТАЖОПЕРЕВЕЗЕНЬ»)'],
            ['key' => 'field_hhero_subtitle',     'label' => 'Підзаголовок',             'name' => 'hero_subtitle',     'type' => 'text'],
            [
                'key'          => 'field_hhero_slides',
                'label'        => 'Слайди (картинки)',
                'name'         => 'slides',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => 'Додати слайд',
                'min'          => 1,
                'max'          => 5,
                'required'     => 1,
                'sub_fields'   => [
                    [
                        'key'           => 'field_hhero_image',
                        'label'         => 'Фото',
                        'name'          => 'slide_image',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'medium',
                        'instructions'  => 'Фонове фото слайду',
                        'wrapper'       => ['width' => '40'],
                    ],
                    [
                        'key'           => 'field_hhero_focus_desktop',
                        'label'         => 'Фокус (десктоп)',
                        'name'          => 'slide_focus_desktop',
                        'type'          => 'text',
                        'instructions'  => 'Яка частина фото буде видима на десктопі. Приклади: center center (по центру), left center (ліворуч), right top (правий верх), 60% center.',
                        'placeholder'   => 'center center',
                        'wrapper'       => ['width' => '30'],
                    ],
                    [
                        'key'           => 'field_hhero_focus_mobile',
                        'label'         => 'Фокус (мобільний)',
                        'name'          => 'slide_focus_mobile',
                        'type'          => 'text',
                        'instructions'  => 'Яка частина фото буде видима на мобільному. Якщо порожньо — використовується десктопне значення.',
                        'placeholder'   => 'center center',
                        'wrapper'       => ['width' => '30'],
                    ],
                ],
            ],
            ['key' => 'field_hhero_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'white', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-home-hero']]],
    ]);

    acf_add_local_field_group([
        'key'    => 'group_glc_vehicles',
        'title'  => 'GLC Block: Транспорт',
        'fields' => [
            ['key' => 'field_veh_heading', 'label' => 'Заголовок секції', 'name' => 'section_heading', 'type' => 'text', 'default_value' => 'Види транспорту в GLC:', 'instructions' => 'Слово GLC виділяється жирним автоматично'],
            ['key' => 'field_veh_label_body',    'label' => 'Лейбл: тип кузова',   'name' => 'label_body_type',  'type' => 'text', 'default_value' => 'Тип кузова:',              'instructions' => 'Назва характеристики на картці'],
            ['key' => 'field_veh_label_dims',    'label' => 'Лейбл: Д/Ш/В',        'name' => 'label_dimensions', 'type' => 'text', 'default_value' => 'Д/Ш/В:'],
            ['key' => 'field_veh_label_volume',  'label' => 'Лейбл: об\'єм',       'name' => 'label_volume',     'type' => 'text', 'default_value' => 'Об\'єм:'],
            ['key' => 'field_veh_label_pallets', 'label' => 'Лейбл: палетомісця',   'name' => 'label_pallets',    'type' => 'text', 'default_value' => 'Кількість палетомісць:'],
            ['key' => 'field_veh_label_extra',   'label' => 'Лейбл: доп.опції',     'name' => 'label_additional', 'type' => 'text', 'default_value' => 'Доп.опції:'],
            [
                'key'          => 'field_veh_items',
                'label'        => 'Транспорт',
                'name'         => 'items',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Додати транспорт',
                'required'     => 1,
                'sub_fields'   => [
                    ['key' => 'field_vitem_title',   'label' => 'Назва',                 'name' => 'vehicle_title',   'type' => 'text', 'required' => 1],
                    ['key' => 'field_vitem_price',   'label' => 'Ціна',                  'name' => 'vehicle_price',   'type' => 'text', 'instructions' => 'напр. «від 10 грн/км»'],
                    [
                        'key'           => 'field_vitem_image',
                        'label'         => 'Фото',
                        'name'          => 'vehicle_image',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'thumbnail',
                    ],
                    ['key' => 'field_vitem_btn',     'label' => 'Текст кнопки',          'name' => 'vehicle_btn',     'type' => 'text', 'default_value' => 'Замовити авто'],
                    [
                        'key'           => 'field_vitem_btn_action',
                        'label'         => 'Дія кнопки',
                        'name'          => 'vehicle_btn_action',
                        'type'          => 'select',
                        'choices'       => ['link' => 'Посилання', 'popup' => 'Popup', 'phone' => 'Телефон', 'scroll' => 'Скрол'],
                        'default_value' => 'link',
                        'return_format' => 'value',
                    ],
                    ['key' => 'field_vitem_btn_value', 'label' => 'Значення (URL / id / телефон)', 'name' => 'vehicle_btn_value', 'type' => 'text'],
                    ['key' => 'field_vitem_body',    'label' => 'Тип кузова',            'name' => 'spec_body_type',  'type' => 'text'],
                    ['key' => 'field_vitem_dims',    'label' => 'Д/Ш/В',                'name' => 'spec_dimensions', 'type' => 'text'],
                    ['key' => 'field_vitem_vol',     'label' => 'Об\'єм',               'name' => 'spec_volume',     'type' => 'text'],
                    ['key' => 'field_vitem_pallets', 'label' => 'Кількість палетомісць', 'name' => 'spec_pallets',    'type' => 'text'],
                    ['key' => 'field_vitem_extra',   'label' => 'Доп.опції',             'name' => 'spec_additional', 'type' => 'text'],
                ],
            ],
            ['key' => 'field_veh_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-vehicles']]],
    ]);

    acf_add_local_field_group([
        'key'    => 'group_glc_ticker',
        'title'  => 'GLC Block: Бігуча стрічка',
        'fields' => [
            [
                'key'          => 'field_ticker_items',
                'label'        => 'Елементи стрічки',
                'name'         => 'items',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => 'Додати елемент',
                'instructions' => 'Якщо порожньо — показується стандартний набір послуг',
                'sub_fields'   => [
                    ['key' => 'field_ticker_text', 'label' => 'Текст', 'name' => 'text', 'type' => 'text', 'required' => 1],
                ],
            ],
            ['key' => 'field_ticker_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-ticker']]],
    ]);

    acf_add_local_field_group([
        'key' => 'group_glc_seo_text',
        'title' => 'GLC Block: SEO текст',
        'fields' => [
            [
                'key' => 'field_seo_text_content',
                'label' => 'Текст',
                'name' => 'seo_text',
                'type' => 'wysiwyg',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'required' => 1,
                'instructions' => 'SEO текст для сторінки. Підтримує форматування.',
            ],
            [
                'key' => 'field_seo_preview_length',
                'label' => 'Кількість символів до кнопки "Читати далі"',
                'name' => 'preview_length',
                'type' => 'number',
                'default_value' => 300,
                'min' => 100,
                'max' => 1000,
                'instructions' => 'Скільки символів показувати до кнопки "Читати далі"',
            ],
            ['key' => 'field_seo_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-seo-text']]],
    ]);
    acf_add_local_field_group([
        'key' => 'group_glc_seo_text_title',
        'title' => 'GLC Block: SEO текст з заголовком',
        'fields' => [
            ['key' => 'field_seo_title_heading', 'label' => 'Заголовок', 'name' => 'section_title', 'type' => 'text', 'default_value' => 'Заголовок...'],
            [
                'key' => 'field_seo_title_content',
                'label' => 'Текст',
                'name' => 'seo_text',
                'type' => 'wysiwyg',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'required' => 1,
            ],
            [
                'key' => 'field_seo_title_preview_length',
                'label' => 'Кількість символів до кнопки "Читати далі"',
                'name' => 'preview_length',
                'type' => 'number',
                'default_value' => 300,
                'min' => 100,
                'max' => 1000,
            ],
            ['key' => 'field_seo_title_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-seo-text-title']]],
    ]);

    acf_add_local_field_group([
        'key'    => 'group_glc_about',
        'title'  => 'GLC Block: Про компанію',
        'fields' => [
            ['key' => 'field_about_title', 'label' => 'Заголовок', 'name' => 'about_title', 'type' => 'text'],
            [
                'key'          => 'field_about_desc',
                'label'        => 'Основний текст',
                'name'         => 'about_desc',
                'type'         => 'wysiwyg',
                'toolbar'      => 'basic',
                'media_upload' => 0,
            ],
            ['key' => 'field_about_quote', 'label' => 'Цитата (виділена)', 'name' => 'about_quote', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_about_btn_outline_text', 'label' => 'Кнопка 1 — текст', 'name' => 'about_btn_outline_text', 'type' => 'text'],
            [
                'key' => 'field_about_btn_outline_action',
                'label' => 'Кнопка 1 — дія',
                'name' => 'about_btn_outline_action',
                'type' => 'select',
                'choices' => ['link' => 'Посилання', 'popup' => 'Popup', 'phone' => 'Телефон', 'scroll' => 'Скрол'],
                'default_value' => 'link',
                'return_format' => 'value',
            ],
            ['key' => 'field_about_btn_outline_value', 'label' => 'Кнопка 1 — значення (URL / id / телефон)', 'name' => 'about_btn_outline_value', 'type' => 'text'],
            ['key' => 'field_about_btn_primary_text', 'label' => 'Кнопка 2 — текст', 'name' => 'about_btn_primary_text', 'type' => 'text'],
            [
                'key' => 'field_about_btn_primary_action',
                'label' => 'Кнопка 2 — дія',
                'name' => 'about_btn_primary_action',
                'type' => 'select',
                'choices' => ['link' => 'Посилання', 'popup' => 'Popup', 'phone' => 'Телефон', 'scroll' => 'Скрол'],
                'default_value' => 'link',
                'return_format' => 'value',
            ],
            ['key' => 'field_about_btn_primary_value', 'label' => 'Кнопка 2 — значення (URL / id / телефон)', 'name' => 'about_btn_primary_value', 'type' => 'text'],
            [
                'key'           => 'field_about_image',
                'label'         => 'Зображення',
                'name'          => 'about_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
            ],
            ['key' => 'field_about_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-about']]],
    ]);

    acf_add_local_field_group([
        'key'    => 'group_glc_stats',
        'title'  => 'GLC Block: Статистика',
        'fields' => [
            [
                'key'        => 'field_stats_items',
                'label'      => 'Показники',
                'name'       => 'items',
                'type'       => 'repeater',
                'min'        => 1,
                'layout'     => 'table',
                'sub_fields' => [
                    ['key' => 'field_stats_label_top',    'label' => 'Підпис зверху',  'name' => 'label_top',    'type' => 'text'],
                    ['key' => 'field_stats_number',       'label' => 'Число',           'name' => 'number',       'type' => 'text'],
                    ['key' => 'field_stats_label_bottom', 'label' => 'Підпис знизу',   'name' => 'label_bottom', 'type' => 'text'],
                ],
            ],
            ['key' => 'field_stats_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-stats']]],
    ]);

    acf_add_local_field_group([
        'key'    => 'group_glc_page_coming_soon',
        'title'  => 'Налаштування сторінки',
        'fields' => [
            [
                'key'          => 'field_page_coming_soon',
                'label'        => 'Розділ в розробці',
                'name'         => 'page_coming_soon',
                'type'         => 'true_false',
                'ui'           => 1,
                'instructions' => 'Увімкніть, щоб замість контенту показувати заглушку «Розділ в розробці».',
            ],
        ],
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'page']]],
        'position' => 'side',
    ]);

    acf_add_local_field_group([
        'key'    => 'group_glc_offices_bg',
        'title'  => 'GLC Block: Офіси — фон',
        'fields' => [
            ['key' => 'field_offices_bg', 'label' => 'Фон секції', 'name' => 'section_bg', 'type' => 'select', 'choices' => ['page' => 'Основний', 'white' => 'Білий', 'light' => 'Підложка'], 'default_value' => 'page', 'return_format' => 'value'],
        ],
        'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/glc-offices']]],
    ]);

}
