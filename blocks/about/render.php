<?php
if (!defined('ABSPATH')) exit;
$bg                     = get_field('section_bg') ?: 'page';
$about_title            = get_field('about_title');
$about_desc             = get_field('about_desc');
$about_quote            = get_field('about_quote');
$about_btn_outline_text   = get_field('about_btn_outline_text');
$about_btn_outline_action = get_field('about_btn_outline_action') ?: 'link';
$about_btn_outline_value  = get_field('about_btn_outline_value');
$about_btn_primary_text   = get_field('about_btn_primary_text');
$about_btn_primary_action = get_field('about_btn_primary_action') ?: 'link';
$about_btn_primary_value  = get_field('about_btn_primary_value');
$about_image            = get_field('about_image'); // Return Format: URL

if (!$about_title && !$about_image) {
    glc_block_placeholder('GLC: Про компанію — заповніть поля в правій панелі →');
    return;
} ?>

<section class="about section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">
        <div class="about__inner">

            <div class="about__content">

                <h2 class="about__title"><?php echo esc_html($about_title); ?></h2>

                <div class="about__desc">
                    <?php echo wp_kses_post($about_desc); ?>
                </div>

                <blockquote class="about__quote">
                    <?php echo esc_html($about_quote); ?>
                </blockquote>

                <div class="about__actions">
                    <?php if ($about_btn_outline_text) glc_action_btn($about_btn_outline_text, $about_btn_outline_action, $about_btn_outline_value, 'btn--outline'); ?>
                    <?php if ($about_btn_primary_text) glc_action_btn($about_btn_primary_text, $about_btn_primary_action, $about_btn_primary_value, 'btn--primary'); ?>
                </div>

            </div>

            <div class="about__media">
                <img src="<?php echo esc_url($about_image); ?>" alt="" class="about__img">
            </div>

        </div>
    </div>
</section>
