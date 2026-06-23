<?php
if (!defined('ABSPATH')) exit;
/**
 * ACF Block: glc-reviews
 * Поля блоку: items (Relationship → CPT review), section_bg
 * CPT review: post_title (ім'я), review_avatar, review_company,
 *             review_body_type, review_volume, review_text
 * ⚠️ Swiper ініціалізований в main.js — зберігати клас .reviews__swiper
 */
$bg        = get_field('section_bg') ?: 'page';
$items     = get_field('items');
$icons_uri = get_template_directory_uri() . '/assets/img/icons/ui';

if (!$items) {
    glc_block_placeholder('GLC: Відгуки — оберіть відгуки в правій панелі →');
    return;
} ?>

<section class="reviews section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">

        <h2 class="section-title reviews__heading">Нам довіряють:</h2>

        <div class="reviews__slider-wrap">

            <button class="reviews__nav reviews__nav--prev" aria-label="Назад">
                <img src="<?php echo esc_url($icons_uri); ?>/scroll left.svg" alt=""
                     data-active="<?php echo esc_url($icons_uri); ?>/scroll left_active.svg">
            </button>

            <div class="reviews__swiper-wrap">
                <div class="swiper reviews__swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($items as $review) :
                            $avatar    = get_field('review_avatar',    $review->ID);
                            $company   = get_field('review_company',   $review->ID);
                            $body_type = get_field('review_body_type', $review->ID);
                            $volume    = get_field('review_volume',    $review->ID);
                            $text      = get_field('review_text',      $review->ID);
                        ?>
                        <div class="swiper-slide">
                            <article class="review-card">

                                <div class="review-card__author">
                                    <div class="review-card__avatar">
                                        <?php if ($avatar) : ?>
                                            <img src="<?php echo esc_url($avatar); ?>"
                                                 alt="<?php echo esc_attr($review->post_title); ?>"
                                                 width="40" height="40">
                                        <?php else : ?>
                                            <img src="<?php echo esc_url($icons_uri); ?>/reviews-client.svg"
                                                 alt="" width="40" height="40">
                                        <?php endif; ?>
                                    </div>
                                    <div class="review-card__author-info">
                                        <p class="review-card__name"><?php echo esc_html($review->post_title); ?></p>
                                        <p class="review-card__company"><?php echo esc_html($company); ?></p>
                                    </div>
                                </div>

                                <div class="review-card__specs">
                                    <?php if ($body_type) : ?>
                                    <div class="review-card__spec">
                                        <img src="<?php echo esc_url($icons_uri); ?>/reviews-body-type.svg"
                                             alt="" class="review-card__spec-icon">
                                        <div class="review-card__spec-text">
                                            <span class="review-card__spec-label">Тип кузова:</span>
                                            <span class="review-card__spec-value"><?php echo esc_html($body_type); ?></span>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if ($volume) : ?>
                                    <div class="review-card__spec">
                                        <img src="<?php echo esc_url($icons_uri); ?>/reviews-volume.svg"
                                             alt="" class="review-card__spec-icon">
                                        <div class="review-card__spec-text">
                                            <span class="review-card__spec-label">Об'єм:</span>
                                            <span class="review-card__spec-value"><?php echo esc_html($volume); ?></span>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <div class="review-card__body">
                                    <p class="review-card__text"><?php echo esc_html($text); ?></p>
                                </div>

                                <button class="review-card__toggle" aria-label="Розгорнути">
                                    <span class="review-card__toggle-icon"></span>
                                </button>

                            </article>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="swiper-pagination reviews__pagination"></div>
            </div>

            <button class="reviews__nav reviews__nav--next" aria-label="Вперед">
                <img src="<?php echo esc_url($icons_uri); ?>/scrolled right.svg" alt=""
                     data-active="<?php echo esc_url($icons_uri); ?>/scrolled right_active.svg">
            </button>

        </div>
    </div>
</section>
