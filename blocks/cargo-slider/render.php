<?php
if (!defined('ABSPATH')) exit;

$bg = get_field('section_bg') ?: 'page';
$section_title = get_field('section_title');
$section_desc = get_field('section_desc');
$items = get_field('items');
$icons_uri = get_template_directory_uri() . '/assets/img/icons/ui';

if (empty($items)) {
    glc_block_placeholder('GLC: Види вантажів (слайдер) - додайте елементи у правій панелі ->');
    return;
}
?>

<section class="cargo-slider section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">
        <div class="cargo-slider__header">
            <?php if ($section_title) : ?>
                <h2 class="cargo-slider__title"><?php echo esc_html($section_title); ?></h2>
            <?php endif; ?>

            <?php if ($section_desc) : ?>
                <p class="cargo-slider__desc"><?php echo esc_html($section_desc); ?></p>
            <?php endif; ?>
        </div>

        <div class="cargo-slider__wrap">
            <button class="cargo-slider__nav cargo-slider__nav--prev" type="button" aria-label="Назад">
                <img src="<?php echo esc_url($icons_uri . '/scroll left.svg'); ?>" alt=""
                     data-active="<?php echo esc_attr($icons_uri . '/scroll left_active.svg'); ?>">
            </button>

            <div class="swiper cargo-slider__swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($items as $cargo) :
                        $image = $cargo['image'] ?? null;
                        $title = $cargo['title'] ?? '';
                        $desc = $cargo['desc'] ?? '';
                        $btn_text = $cargo['btn_text'] ?? 'Детальніше';
                        $btn_action = $cargo['btn_action'] ?? 'link';
                        $btn_value = $cargo['btn_value'] ?? '';
                    ?>
                        <div class="swiper-slide">
                            <article class="cargo-slider-card">
                                <div class="cargo-slider-card__img-wrap">
                                    <?php if (!empty($image['url'])) : ?>
                                        <img src="<?php echo esc_url($image['sizes']['glc-card'] ?? $image['url']); ?>"
                                             alt="<?php echo esc_attr($image['alt'] ?: $title); ?>"
                                             class="cargo-slider-card__img"
                                             loading="lazy">
                                    <?php endif; ?>
                                </div>

                                <div class="cargo-slider-card__body">
                                    <?php if ($title) : ?>
                                        <h3 class="cargo-slider-card__title"><?php echo esc_html($title); ?></h3>
                                    <?php endif; ?>

                                    <?php if ($desc) : ?>
                                        <p class="cargo-slider-card__desc"><?php echo esc_html($desc); ?></p>
                                    <?php endif; ?>

                                    <?php if ($btn_text) glc_action_btn($btn_text, $btn_action, $btn_value, 'btn--outline cargo-slider-card__btn'); ?>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="swiper-pagination cargo-slider__pagination"></div>
            </div>

            <button class="cargo-slider__nav cargo-slider__nav--next" type="button" aria-label="Вперед">
                <img src="<?php echo esc_url($icons_uri . '/scrolled right.svg'); ?>" alt=""
                     data-active="<?php echo esc_attr($icons_uri . '/scrolled right_active.svg'); ?>">
            </button>
        </div>
    </div>
</section>
