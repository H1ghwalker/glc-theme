<?php
if (!defined('ABSPATH')) exit;
/**
 * ACF Block: glc-routes
 * Поля: style (select: tabs|tags), items (Repeater: route_title, route_link)
 * tabs — рядок табів по центру (#F5F6FB)
 * tags — сітка тегів з синьою лівою лінією
 */
$style = get_field('style') ?: 'tabs';
$items = get_field('items');
$bg = get_field('section_bg') ?: 'white';

if (!$items) {
    glc_block_placeholder('GLC: Маршрути — додайте маршрути в правій панелі →');
    return;
} ?>

<div class="glc-routes glc-routes--<?php echo esc_attr($style); ?> section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">
        <div class="glc-routes__list">
            <?php foreach ($items as $item) :
                $title = $item['route_title'];
                $link = $item['route_link'] ?: '#';
            ?>
            <a href="<?php echo esc_url($link); ?>" class="glc-routes__item">
                <?php echo esc_html($title); ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
