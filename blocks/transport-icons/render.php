<?php
if (!defined('ABSPATH')) exit;
$bg = get_field('section_bg') ?: 'page';

$items = [
    ['icon' => 'auto',     'text' => get_field('text_auto')    ?: ''],
    ['icon' => 'air',      'text' => get_field('text_air')     ?: ''],
    ['icon' => 'sea',      'text' => get_field('text_sea')     ?: ''],
    ['icon' => 'railway',  'text' => get_field('text_railway') ?: ''],
]; ?>

<section class="features section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">
        <div class="features__grid">
            <?php foreach ( $items as $item ) :
                $icon_slug = $item['icon'];
                $icon_path = get_template_directory() . '/assets/img/icons/transport/' . $icon_slug . '.svg';
            ?>
            <div class="features__item">
                <?php if ( $icon_slug && file_exists( $icon_path ) ) : ?>
                <div class="features__icon-wrap">
                    <?php echo glc_sanitize_svg(file_get_contents($icon_path)); ?>
                </div>
                <?php endif; ?>
                <p class="features__text"><?php echo esc_html( $item['text'] ); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
