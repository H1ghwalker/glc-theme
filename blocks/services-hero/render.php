<?php
if (!defined('ABSPATH')) exit;
$hero_title = get_field('hero_title');
$hero_desc  = get_field('hero_desc');
$slides     = get_field('slides');
$bg         = get_field('section_bg') ?: 'white';
$icons_uri  = get_template_directory_uri() . '/assets/img/icons/ui';

if (!$slides) {
    glc_block_placeholder('GLC: Слайдер послуг — заповніть слайди в правій панелі →');
    return;
}
?>

<section class="services-hero section section--bg-<?php echo esc_attr($bg); ?>">

    <div class="container">
        <h1 class="services-hero__title"><?php echo esc_html($hero_title); ?></h1>
        <?php if ($hero_desc) : ?>
        <p class="services-hero__desc"><?php echo esc_html($hero_desc); ?></p>
        <?php endif; ?>
    </div>

    <div class="services-hero__slider">
        <div class="swiper services-hero__swiper">
            <div class="swiper-wrapper">
                <?php foreach ($slides as $slide) :
                    $img     = $slide['slide_image'];
                    $img_url = $img ? ($img['sizes']['glc-hero-slide'] ?? $img['url']) : get_template_directory_uri() . '/assets/img/hero/banners.png';
                    $img_alt = $img ? $img['alt'] : '';
                ?>
                <div class="swiper-slide">
                    <div class="container">
                        <div class="services-hero__media">
                            <img src="<?php echo esc_url($img_url); ?>"
                                 alt="<?php echo esc_attr($img_alt); ?>"
                                 class="services-hero__img">
                            <div class="services-hero__gradient"></div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination services-hero__pagination"></div>
        </div>

        <button class="services-hero__nav services-hero__nav--prev" aria-label="Назад">
            <img src="<?php echo esc_url($icons_uri . '/scroll left.svg'); ?>" alt=""
                 data-active="<?php echo esc_attr($icons_uri . '/scroll left_active.svg'); ?>">
        </button>
        <button class="services-hero__nav services-hero__nav--next" aria-label="Вперед">
            <img src="<?php echo esc_url($icons_uri . '/scrolled right.svg'); ?>" alt=""
                 data-active="<?php echo esc_attr($icons_uri . '/scrolled right_active.svg'); ?>">
        </button>
    </div>

</section>
