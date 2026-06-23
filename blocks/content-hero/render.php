<?php
if (!defined('ABSPATH')) exit;

$bg           = get_field('section_bg') ?: 'page';
$title        = get_field('content_hero_title');
$intro        = get_field('content_hero_intro');
$highlight    = get_field('content_hero_highlight');
$btn_1_text   = get_field('content_hero_btn_1_text');
$btn_1_action = get_field('content_hero_btn_1_action') ?: 'link';
$btn_1_value  = get_field('content_hero_btn_1_value') ?: '#';
$btn_2_text   = get_field('content_hero_btn_2_text');
$btn_2_action = get_field('content_hero_btn_2_action') ?: 'link';
$btn_2_value  = get_field('content_hero_btn_2_value') ?: '#';
$bottom_text  = get_field('content_hero_bottom_text');
$image        = get_field('content_hero_image');

if (!$title) {
    glc_block_placeholder('GLC: Hero з текстом і фото - заповніть заголовок у правій панелі ->');
    return;
}
?>

<section class="content-hero section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">
        <div class="content-hero__grid">
            <div class="content-hero__content">
                <h1 class="content-hero__title"><?php echo esc_html($title); ?></h1>

                <?php if ($intro) : ?>
                    <div class="content-hero__intro">
                        <?php echo wp_kses_post($intro); ?>
                    </div>
                <?php endif; ?>

                <?php if ($highlight) : ?>
                    <div class="content-hero__highlight">
                        <?php echo wp_kses_post(wpautop($highlight)); ?>
                    </div>
                <?php endif; ?>

                <?php if ($btn_1_text || $btn_2_text) : ?>
                    <div class="content-hero__actions">
                        <?php if ($btn_1_text) :
                            glc_action_btn($btn_1_text, $btn_1_action, $btn_1_value, 'btn--primary content-hero__btn');
                        endif; ?>

                        <?php if ($btn_2_text) :
                            glc_action_btn($btn_2_text, $btn_2_action, $btn_2_value, 'btn--primary content-hero__btn');
                        endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (!empty($image['url'])) : ?>
                <div class="content-hero__media">
                    <img src="<?php echo esc_url($image['sizes']['large'] ?? $image['url']); ?>"
                         alt="<?php echo esc_attr($image['alt'] ?: $title); ?>"
                         class="content-hero__image"
                         width="420" height="520">
                </div>
            <?php endif; ?>
        </div>

        <?php if ($bottom_text) : ?>
            <div class="content-hero__bottom">
                <?php echo wp_kses_post($bottom_text); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
