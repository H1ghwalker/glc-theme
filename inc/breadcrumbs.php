<?php
if (!defined('ABSPATH')) exit;

function glc_breadcrumbs()
{
    if (is_front_page())
        return;

    $items = [];

    $icon_url = get_template_directory_uri() . '/assets/img/icons/ui/breadcrumb.svg';
    $items[] = '<a href="' . esc_url(home_url('/')) . '" class="breadcrumbs__link breadcrumbs__home" aria-label="Головна">'
        . '<img src="' . esc_url($icon_url) . '" alt="" width="19" height="19">'
        . '</a>';

    if (is_page()) {
        $ancestors = array_reverse(get_post_ancestors(get_the_ID()));
        foreach ($ancestors as $ancestor_id) {
            $items[] = '<a href="' . esc_url(get_permalink($ancestor_id)) . '" class="breadcrumbs__link">'
                . esc_html(get_the_title($ancestor_id)) . '</a>';
        }
        $items[] = '<span class="breadcrumbs__current" aria-current="page">' . esc_html(get_the_title()) . '</span>';
    } elseif (is_single()) {
        $categories = get_the_category();
        if (!empty($categories)) {
            $cat = $categories[0];
            $items[] = '<a href="' . esc_url(get_category_link($cat->term_id)) . '" class="breadcrumbs__link">'
                . esc_html($cat->name) . '</a>';
        }
        $items[] = '<span class="breadcrumbs__current" aria-current="page">' . esc_html(get_the_title()) . '</span>';
    } elseif (is_category()) {
        $items[] = '<span class="breadcrumbs__current" aria-current="page">' . esc_html(single_cat_title('', false)) . '</span>';
    } elseif (is_search()) {
        $items[] = '<span class="breadcrumbs__current" aria-current="page">Пошук: ' . esc_html(get_search_query()) . '</span>';
    } elseif (is_404()) {
        $items[] = '<span class="breadcrumbs__current" aria-current="page">404</span>';
    }

    if (count($items) < 2)
        return;

    $separator = '<span class="breadcrumbs__sep" aria-hidden="true">/</span>';

    echo '<nav class="breadcrumbs" aria-label="Хлібні крихти"><div class="container">'
        . implode($separator, $items)
        . '</div></nav>';
}
