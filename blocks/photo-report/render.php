<?php
if (!defined('ABSPATH')) exit;

$bg            = get_field('section_bg') ?: 'page';
$section_title = get_field('section_title');
$items         = get_field('items');
$icons_uri     = get_template_directory_uri() . '/assets/img/icons/ui';

$format_meta_value = static function ($value, $suffix, $has_suffix_pattern)
{
    $value = trim((string) $value);

    if ($value === '')
        return '';

    if (preg_match($has_suffix_pattern, $value))
        return $value;

    return $value . ' ' . $suffix;
};

if (empty($items)) : ?>
    <div style="padding:40px;text-align:center;background:#f5f5f5;border:2px dashed #ccc">
        <p style="color:#999">GLC: Фотозвіт — заповніть поля в правій панелі &rarr;</p>
    </div>
<?php return; endif; ?>

<section class="photo-report section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">

        <?php if ($section_title) : ?>
            <h2 class="section-title photo-report__heading"><?php echo esc_html($section_title); ?></h2>
        <?php endif; ?>

        <div class="photo-report__slider-wrap">

            <button class="photo-report__nav photo-report__nav--prev" aria-label="Назад">
                <img src="<?php echo esc_url($icons_uri . '/scroll left.svg'); ?>"
                     alt="" class="photo-report__nav-icon"
                     data-active="<?php echo esc_attr($icons_uri . '/scroll left_active.svg'); ?>">
            </button>

            <div class="swiper photo-report__swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($items as $item) :
                        $image      = $item['image'] ?? null;
                        $route      = $item['route'] ?? '';
                        $count      = $format_meta_value($item['vehicles_count'] ?? '', 'авто', '/авто/ui');
                        $duration   = $format_meta_value($item['duration'] ?? '', 'день', '/день|дня|дні|днів/ui');
                        $btn_text   = $item['btn_text'] ?? 'Замовити';
                        $btn_action = $item['btn_action'] ?? 'link';
                        $btn_value  = $item['btn_value'] ?? '#';
                    ?>
                    <div class="swiper-slide">
                        <article class="report-card">

                            <div class="report-card__img-wrap">
                                <?php if ($image) : ?>
                                    <img src="<?php echo esc_url($image['sizes']['glc-card'] ?? $image['url']); ?>"
                                         alt="<?php echo esc_attr($image['alt'] ?? $route); ?>"
                                         class="report-card__img" loading="lazy">
                                <?php else : ?>
                                    <div class="report-card__img-placeholder"></div>
                                <?php endif; ?>
                            </div>

                            <div class="report-card__body">
                                <?php if ($route) : ?>
                                    <button type="button" class="report-card__route"><?php echo esc_html($route); ?></button>
                                <?php endif; ?>

                                <div class="report-card__meta">
                                    <?php if ($count) : ?>
                                        <span class="report-card__meta-item">
                                            <img src="<?php echo esc_url($icons_uri . '/truck_fotozvit.svg'); ?>" alt="" width="24" height="24">
                                            <?php echo esc_html($count); ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if ($duration) : ?>
                                        <span class="report-card__meta-item">
                                            <img src="<?php echo esc_url($icons_uri . '/calendar.svg'); ?>" alt="" width="24" height="24">
                                            <?php echo esc_html($duration); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <?php if ($btn_text) :
                                    glc_action_btn($btn_text, $btn_action, $btn_value, 'btn--outline report-card__btn');
                                endif; ?>
                            </div>

                        </article>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="swiper-pagination photo-report__pagination"></div>
            </div>

            <button class="photo-report__nav photo-report__nav--next" aria-label="Вперед">
                <img src="<?php echo esc_url($icons_uri . '/scrolled right.svg'); ?>"
                     alt="" class="photo-report__nav-icon"
                     data-active="<?php echo esc_attr($icons_uri . '/scrolled right_active.svg'); ?>">
            </button>

        </div>
    </div>
</section>
