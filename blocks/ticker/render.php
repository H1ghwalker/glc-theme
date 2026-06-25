<?php
if (!defined('ABSPATH')) exit;
$rows = get_field('items') ?: [];
$items = array_column($rows, 'text');
$bg = get_field('section_bg') ?: 'page';

if (empty($items)) {
    $items = [
        'Вантажоперевезення по Україні',
        'Міжнародні вантажоперевезення',
        'Митно-брокерські послуги',
        'Оренда спецтехніки',
        'Негабаритні перевезення',
        'Страхування',
    ];
}

$track = array_merge($items, $items, $items, $items, $items, $items);
?>

<div class="ticker-wrap section--bg-<?php echo esc_attr($bg); ?>">

    <div class="ticker__band ticker__band--1">
        <div class="ticker__track ticker__track--fwd">
            <?php foreach ($track as $item) : ?>
                <span class="ticker__item"><?php echo esc_html($item); ?></span><span class="ticker__sep">+</span>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="ticker__band ticker__band--2">
        <div class="ticker__track ticker__track--rev">
            <?php foreach ($track as $item) : ?>
                <span class="ticker__item"><?php echo esc_html($item); ?></span><span class="ticker__sep">+</span>
            <?php endforeach; ?>
        </div>
    </div>

</div>
