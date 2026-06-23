<?php
if (!defined('ABSPATH')) exit;
$title_top    = get_field('hero_title_top');
$title_before = get_field('hero_title_before');
$title_after  = get_field('hero_title_after');
$subtitle     = get_field('hero_subtitle');
$slides       = get_field('slides');
$bg           = get_field('section_bg') ?: 'white';
$icons_uri    = get_template_directory_uri() . '/assets/img/icons/ui';
$arrow_badge  = $icons_uri . '/arrow-banner-hero.svg';

$glc_hero_focus_value = static function ($value) {
    $value = trim((string) $value);

    if ($value === '') {
        return '';
    }

    return preg_match('/^[a-z0-9.%\s-]+$/i', $value) ? $value : '';
};

if (!$slides) {
    glc_block_placeholder('GLC: Головний слайдер — заповніть слайди в правій панелі →');
    return;
} ?>

<section class="hero section--bg-<?php echo esc_attr($bg); ?>">

    <div class="container">
        <div class="hero__content">
            <h1 class="hero__title">
                <span class="hero__title-top"><?php echo esc_html($title_top); ?></span>
                <span class="hero__title-line">
                    <span><?php echo esc_html($title_before); ?></span>
                    <span class="hero__arrow-badge" aria-hidden="true">
                        <img src="<?php echo esc_url($arrow_badge); ?>" alt="">
                    </span>
                    <span><?php echo esc_html($title_after); ?></span>
                </span>
            </h1>
            <?php if ($subtitle) : ?>
            <p class="hero__subtitle"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
        </div>
    </div>

    <div class="hero__slider">
        <div class="swiper hero__swiper">
            <div class="swiper-wrapper">
                <?php foreach ($slides as $slide) :
                    $img     = $slide['slide_image'];
                    $img_url = $img ? ($img['sizes']['glc-hero-slide'] ?? $img['url']) : get_template_directory_uri() . '/assets/img/hero/banners.png';
                    $img_alt = $img ? $img['alt'] : '';
                    $focus_desktop = $glc_hero_focus_value($slide['slide_focus_desktop'] ?? '');
                    $focus_mobile  = $glc_hero_focus_value($slide['slide_focus_mobile'] ?? '');
                    $img_style     = '';

                    if ($focus_desktop !== '') {
                        $img_style .= '--hero-img-position:' . $focus_desktop . ';';
                    }

                    if ($focus_mobile !== '') {
                        $img_style .= '--hero-img-position-mobile:' . $focus_mobile . ';';
                    }
                ?>
                <div class="swiper-slide">
                    <div class="container">
                        <div class="hero__media">
                            <img src="<?php echo esc_url($img_url); ?>"
                                 alt="<?php echo esc_attr($img_alt); ?>"
                                 class="hero__img"<?php if ($img_style) : ?>
                                 style="<?php echo esc_attr($img_style); ?>"<?php endif; ?>>
                            <div class="hero__gradient"></div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="swiper-pagination hero__pagination"></div>
        </div>

        <button class="hero__nav hero__nav--prev" aria-label="Назад">
            <img src="<?php echo esc_url($icons_uri . '/scroll left.svg'); ?>" alt=""
                 data-active="<?php echo esc_attr($icons_uri . '/scroll left_active.svg'); ?>">
        </button>
        <button class="hero__nav hero__nav--next" aria-label="Вперед">
            <img src="<?php echo esc_url($icons_uri . '/scrolled right.svg'); ?>" alt=""
                 data-active="<?php echo esc_attr($icons_uri . '/scrolled right_active.svg'); ?>">
        </button>
    </div>

</section>
