<?php if (!defined('ABSPATH')) exit; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="header">

    <div class="header__row header__row--top">
        <div class="container">
            <div class="header__top-inner">

                <div class="header__socials">
                    <?php glc_render_socials(); ?>
                </div>

            </div>
        </div>
    </div>

    <div class="header__row header__row--middle">
        <div class="container">
            <div class="header__middle-inner">

                <a href="<?php echo esc_url(home_url('/')); ?>" class="header__logo">
                    <?php
                    $custom_logo_id = get_theme_mod('custom_logo');
                    if ($custom_logo_id):
                        echo wp_get_attachment_image($custom_logo_id, 'full', false, ['class' => 'header__logo-img']);
                    else: ?>
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/logo/logo.svg"
                             alt="<?php bloginfo('name'); ?>" class="header__logo-img">
                    <?php endif; ?>
                </a>

                <div class="header__contacts">
                    <?php $glc_email = sanitize_email(get_option('glc_email', 'info@glc.in.ua')); ?>
                    <a href="mailto:<?php echo esc_attr($glc_email); ?>" class="header__contact">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/icons/ui/email-arrow.svg"
                             alt="" width="45" height="45" class="header__contact-icon">
                        <span><?php echo esc_html($glc_email); ?></span>
                    </a>
                    <div class="header__phones">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/icons/ui/phone-number.svg"
                             alt="" width="45" height="45" class="header__contact-icon">
                        <?php
                        $phone_1 = get_option('glc_phone_1', '+380443902733');
                        $phone_2 = get_option('glc_phone_2', '+380674896011');
                        ?>
                        <a href="tel:<?php echo esc_attr(preg_replace('/\D/', '', $phone_1)); ?>" class="header__phone">
                            <?php echo esc_html(glc_format_phone($phone_1)); ?>
                        </a>
                        <a href="tel:<?php echo esc_attr(preg_replace('/\D/', '', $phone_2)); ?>" class="header__phone">
                            <?php echo esc_html(glc_format_phone($phone_2)); ?>
                        </a>
                    </div>
                </div>

                <div class="header__actions">
                    <?php
                    $cta_text = get_option('glc_cta_text', 'Заявка на перевезення');
                    $cta_link = trim((string) get_option('glc_cta_link', ''));
                    $cta_popup_id = '';

                    if ($cta_link && !str_starts_with($cta_link, '/') && !preg_match('#^https?://#', $cta_link))
                        $cta_popup_id = sanitize_key(ltrim($cta_link, '#'));

                    if (!$cta_popup_id) {
                        $form_popups = get_option('glc_form_popups', []);
                        if (is_array($form_popups) && !empty($form_popups[0]['popup_id']))
                            $cta_popup_id = sanitize_key($form_popups[0]['popup_id']);
                    }

                    if (!$cta_popup_id)
                        $cta_popup_id = 'glc-request';
                    ?>
                    <button type="button" class="btn--primary header__cta" data-popup="<?php echo esc_attr($cta_popup_id); ?>"><?php echo esc_html($cta_text); ?></button>
                </div>

                <button class="header__burger" aria-label="Меню">
                    <span></span><span></span><span></span>
                </button>

            </div>
        </div>
    </div>

    <div class="header__row header__row--nav">
        <div class="container">
            <?php wp_nav_menu([
                'theme_location' => 'main',
                'container' => false,
                'menu_class' => 'header__menu',
                'fallback_cb' => false,
                'walker' => new Walker_Mega_Menu(),
            ]); ?>
        </div>
    </div>


</header>
