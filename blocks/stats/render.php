<?php
if (!defined('ABSPATH')) exit;
$bg = get_field('section_bg') ?: 'page';
$icons_uri = get_template_directory_uri() . '/assets/img/icons/ui';
$stats_raw = get_field('items');
$stats = is_array($stats_raw) ? $stats_raw : [];

if (empty($stats)) {
    glc_block_placeholder('GLC: Статистика — заповніть поля в правій панелі →');
    return;
} ?>

<section class="stats section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">
        <div class="stats__grid">
            <?php foreach ($stats as $item): ?>
                <div class="stats__item">
                    <p class="stats__label-top"><?php echo esc_html($item['label_top']); ?></p>
                    <p class="stats__number"><?php echo esc_html($item['number']); ?></p>
                    <p class="stats__label-bottom">
                        <img src="<?php echo esc_url($icons_uri . '/lets-icons_check-fill.svg'); ?>" alt="" class="stats__check-icon">
                        <?php echo esc_html($item['label_bottom']); ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>