<?php
if (!defined('ABSPATH')) exit;
/**
 * Custom Post Types
 */

function glc_register_cpt_office()
{
    register_post_type('office', [
        'labels' => [
            'name' => 'Офіси',
            'singular_name' => 'Офіс',
            'add_new_item' => 'Додати офіс',
            'edit_item' => 'Редагувати офіс',
            'all_items' => 'Всі офіси',
        ],
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'supports' => ['title', 'page-attributes'],
        'menu_icon' => 'dashicons-location',
    ]);
}
add_action('init', 'glc_register_cpt_office');

function glc_register_cpt_review()
{
    register_post_type('review', [
        'labels' => [
            'name'          => 'Відгуки',
            'singular_name' => 'Відгук',
            'add_new_item'  => 'Додати відгук',
            'edit_item'     => 'Редагувати відгук',
        ],
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => true,
        'supports'     => ['title', 'page-attributes'],
        'menu_icon'    => 'dashicons-format-quote',
        'rewrite'      => false,
    ]);
}
add_action('init', 'glc_register_cpt_review');
