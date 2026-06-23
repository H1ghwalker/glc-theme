<?php
if (!defined('ABSPATH')) exit;
/**
 * Gutenberg: стилі редактора та категорії блоків
 */

// Превью блоків
add_action('enqueue_block_editor_assets', function () {
    $css_dir = get_template_directory() . '/assets/css';
    $css_uri = get_template_directory_uri() . '/assets/css';

    wp_enqueue_style('glc-editor-base', $css_uri . '/base.css', [], filemtime($css_dir . '/base.css'));
    wp_enqueue_style('glc-editor-blocks', $css_uri . '/blocks.css', ['glc-editor-base'], filemtime($css_dir . '/blocks.css'));
    wp_enqueue_style('glc-editor-forms', $css_uri . '/forms.css', ['glc-editor-blocks'], filemtime($css_dir . '/forms.css'));
});

// Кастомні категорії блоків GLC
add_filter('block_categories_all', function($categories) {
    return array_merge([
        ['slug' => 'glc-common',        'title' => 'GLC: Загальні блоки'],
        ['slug' => 'glc-services',      'title' => 'GLC: Послуги'],
        ['slug' => 'glc-international', 'title' => 'GLC: Міжнародні перевезення'],
    ], $categories);
}, 10, 2);
