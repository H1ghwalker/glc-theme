<?php
if (!defined('ABSPATH')) exit;
/**
 * ACF Block: glc-page-hero-accent
 * Duplicate of page hero with an additional accent text field.
 */
$bg = get_field('section_bg') ?: 'page';
$hero_title = get_field('hero_title');
$hero_desc = get_field('hero_desc');
$hero_accent_text = get_field('hero_accent_text');
$btn_1_text = get_field('hero_btn_1_text');
$btn_1_action = get_field('hero_btn_1_action') ?: 'link';
$btn_1_value = get_field('hero_btn_1_value');
$btn_2_text = get_field('hero_btn_2_text');
$btn_2_action = get_field('hero_btn_2_action') ?: 'link';
$btn_2_value = get_field('hero_btn_2_value');
$hero_image = get_field('hero_image');

if (!$hero_title) {
    glc_block_placeholder('GLC: Hero сторінки з акцентом - заповніть поля в правій панелі ->');
    return;
} ?>

<section class="page-hero-accent section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">
        <div class="page-hero-accent__inner">

            <div class="page-hero-accent__content">
                <h1 class="page-hero-accent__title"><?php echo esc_html($hero_title); ?></h1>

                <?php if ($hero_desc) : ?>
                    <p class="page-hero-accent__desc"><?php echo esc_html($hero_desc); ?></p>
                <?php endif; ?>

                <?php if ($hero_accent_text) : ?>
                    <div class="page-hero-accent__accent">
                        <?php echo wp_kses_post(wpautop($hero_accent_text)); ?>
                    </div>
                <?php endif; ?>

                <?php if ($btn_1_text || $btn_2_text) : ?>
                    <div class="page-hero-accent__btns">
                        <?php if ($btn_1_text) glc_action_btn($btn_1_text, $btn_1_action, $btn_1_value, 'btn--primary'); ?>
                        <?php if ($btn_2_text) glc_action_btn($btn_2_text, $btn_2_action, $btn_2_value, 'btn--primary'); ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (!empty($hero_image['url'])) : ?>
                <div class="page-hero-accent__media">
                    <img src="<?php echo esc_url($hero_image['sizes']['medium_large'] ?? $hero_image['url']); ?>"
                         alt="<?php echo esc_attr($hero_image['alt'] ?: $hero_title); ?>"
                         class="page-hero-accent__img">
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
