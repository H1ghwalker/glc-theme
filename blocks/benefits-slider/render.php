<?php
if (!defined('ABSPATH')) exit;

$bg            = get_field('section_bg') ?: 'page';
$section_title = get_field('section_title');
$items         = get_field('items');
$icons_uri     = get_template_directory_uri() . '/assets/img/icons/ui';

if (empty($items)) {
    glc_block_placeholder('GLC: Слайдер переваг — заповніть поля в правій панелі →');
    return;
}
?>

<section class="benefits-slider section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">

        <?php if ($section_title) : ?>
            <h2 class="section-title benefits-slider__heading"><?php echo esc_html($section_title); ?></h2>
        <?php endif; ?>

        <div class="benefits-slider__wrap">

            <button class="benefits-slider__nav benefits-slider__nav--prev" aria-label="Назад">
                <img src="<?php echo esc_url($icons_uri . '/scroll left.svg'); ?>"
                     alt="" class="benefits-slider__nav-icon"
                     data-active="<?php echo esc_attr($icons_uri . '/scroll left_active.svg'); ?>">
            </button>

            <div class="swiper benefits-slider__swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($items as $item) :
                        $image = $item['image'] ?? null;
                        $title = $item['title'] ?? '';
                        $desc  = $item['description'] ?? '';
                    ?>
                        <div class="swiper-slide">
                            <article class="benefit-slide">
                                <div class="benefit-slide__media">
                                    <?php if ($image) : ?>
                                        <img src="<?php echo esc_url($image['sizes']['glc-card'] ?? $image['url']); ?>"
                                             alt="<?php echo esc_attr($image['alt'] ?? $title); ?>"
                                             class="benefit-slide__image"
                                             width="600" height="400" loading="lazy">
                                    <?php endif; ?>
                                </div>

                                <div class="benefit-slide__body">
                                    <?php if ($title) : ?>
                                        <h3 class="benefit-slide__title"><?php echo esc_html($title); ?></h3>
                                    <?php endif; ?>

                                    <?php if ($desc) : ?>
                                        <div class="benefit-slide__text"><?php echo wp_kses_post($desc); ?></div>
                                    <?php endif; ?>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="swiper-pagination benefits-slider__pagination"></div>
            </div>

            <button class="benefits-slider__nav benefits-slider__nav--next" aria-label="Вперед">
                <img src="<?php echo esc_url($icons_uri . '/scrolled right.svg'); ?>"
                     alt="" class="benefits-slider__nav-icon"
                     data-active="<?php echo esc_attr($icons_uri . '/scrolled right_active.svg'); ?>">
            </button>

        </div>
    </div>
</section>
