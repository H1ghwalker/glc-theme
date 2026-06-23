<?php
if (!defined('ABSPATH')) exit;

$bg        = get_field('section_bg') ?: 'dark';
$title     = get_field('section_title');
$image     = get_field('image');
$items     = get_field('items');
$highlight = get_field('highlight_text');

if (!$title && !$image && empty($items) && !$highlight) {
    glc_block_placeholder('GLC: Всі турботи — заповніть поля в правій панелі →');
    return;
}
?>

<section class="care-block section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">
        <div class="care-block__inner">

            <div class="care-block__media">
                <?php if ($image) : ?>
                    <img src="<?php echo esc_url($image['sizes']['large'] ?? $image['url']); ?>"
                         alt="<?php echo esc_attr($image['alt'] ?? ''); ?>"
                         class="care-block__image" loading="lazy">
                <?php else : ?>
                    <div class="care-block__placeholder"></div>
                <?php endif; ?>
            </div>

            <div class="care-block__content">
                <?php if ($title) : ?>
                    <h2 class="section-title care-block__title"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>

                <?php if (!empty($items)) : ?>
                    <ul class="care-block__list">
                        <?php foreach ($items as $item) :
                            $text = $item['text'] ?? '';
                            if (!$text)
                                continue;
                        ?>
                            <li class="care-block__item"><?php echo esc_html($text); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <?php if ($highlight) : ?>
                    <div class="care-block__highlight">
                        <?php echo wp_kses_post(wpautop($highlight)); ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
