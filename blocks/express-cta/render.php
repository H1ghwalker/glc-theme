<?php
if (!defined('ABSPATH')) exit;
$bg         = get_field('section_bg') ?: 'page';
$title      = get_field('cta_title')      ?: 'ЕКСПРЕС РОЗРАХУНОК ВАРТОСТІ';
$desc       = get_field('cta_desc')       ?: '';
$btn_text   = get_field('cta_btn_text')   ?: 'Розрахувати вартість';
$btn_action = get_field('cta_btn_action') ?: 'link';
$btn_value  = get_field('cta_btn_value')  ?: '#';
$uri        = get_template_directory_uri();

$words     = explode(' ', $title);
$top_line  = implode(' ', array_slice($words, 0, 2));
$bot_line  = implode(' ', array_slice($words, 2)); ?>

<section class="express-cta section--bg-<?php echo esc_attr($bg); ?>">
    <div class="express-cta__inner">

        <img src="<?php echo esc_url($uri); ?>/assets/img/plane.png"
             alt="" class="express-cta__plane">

        <div class="express-cta__body">
            <div class="express-cta__content">
                <h2 class="express-cta__title express-cta__title--top">
                    <?php echo esc_html($top_line); ?>
                </h2>
                <div class="express-cta__title-row">
                    <h2 class="express-cta__title express-cta__title--bottom">
                        <?php echo esc_html($bot_line); ?>
                    </h2>
                    <?php glc_action_btn($btn_text, $btn_action, $btn_value, 'btn--primary'); ?>
                </div>
            </div>
            <?php if ($desc) : ?>
            <p class="express-cta__desc"><?php echo esc_html($desc); ?></p>
            <?php endif; ?>
        </div>

        <img src="<?php echo esc_url($uri); ?>/assets/img/bus.png"
             alt="" class="express-cta__bus">

    </div>
</section>
