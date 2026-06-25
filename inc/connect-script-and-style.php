<?php
if (!defined('ABSPATH')) exit;

/**
 * Enque scripts and styles.
 */
function theme_styles()
{
    $css_dir = get_template_directory() . '/assets/css';
    $css_uri = get_template_directory_uri() . '/assets/css';

    // Swiper CSS (локально)
    wp_enqueue_style('swiper', $css_uri . '/vendor/swiper-bundle.min.css', [], '11');

    wp_enqueue_style('glc-base', $css_uri . '/base.css', ['swiper'], filemtime($css_dir . '/base.css'));
    wp_enqueue_style('glc-header', $css_uri . '/header.css', ['glc-base'], filemtime($css_dir . '/header.css'));
    wp_enqueue_style('glc-footer', $css_uri . '/footer.css', ['glc-header'], filemtime($css_dir . '/footer.css'));
    wp_enqueue_style('glc-blocks', $css_uri . '/blocks.css', ['glc-footer'], filemtime($css_dir . '/blocks.css'));
    wp_enqueue_style('glc-forms', $css_uri . '/forms.css', ['glc-blocks'], filemtime($css_dir . '/forms.css'));
}
add_action('wp_enqueue_scripts', 'theme_styles');

function theme_scripts()
{
    $script_path = get_template_directory() . '/assets/js/main.js';

    // Swiper JS (локально)
    wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/js/vendor/swiper-bundle.min.js', [], '11', true);

    // Основний JS
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', ['swiper'], filemtime($script_path), true);
}
add_action('wp_enqueue_scripts', 'theme_scripts');
