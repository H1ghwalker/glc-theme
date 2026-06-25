<?php
if (!defined('ABSPATH')) exit;
/**
 * ACF Block: glc-page-hero
 * Універсальний hero для внутрішніх сторінок.
 * Поля: hero_title, hero_desc, hero_btn_1_*, hero_btn_2_*, hero_image
 */
$bg          = get_field('section_bg') ?: 'page';
$hero_title  = get_field( 'hero_title' );
$hero_desc   = get_field( 'hero_desc' );
$btn_1_text   = get_field( 'hero_btn_1_text' );
$btn_1_action = get_field( 'hero_btn_1_action' ) ?: 'link';
$btn_1_value  = get_field( 'hero_btn_1_value' );
$btn_2_text   = get_field( 'hero_btn_2_text' );
$btn_2_action = get_field( 'hero_btn_2_action' ) ?: 'link';
$btn_2_value  = get_field( 'hero_btn_2_value' );
$hero_image  = get_field( 'hero_image' );

if (!$hero_title) {
    glc_block_placeholder('GLC: Hero сторінки — заповніть поля в правій панелі →');
    return;
} ?>

<section class="page-hero section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">
        <div class="page-hero__inner">

            <div class="page-hero__content">
                <h1 class="page-hero__title"><?php echo esc_html( $hero_title ); ?></h1>

                <?php if ( $hero_desc ) : ?>
                    <p class="page-hero__desc"><?php echo esc_html( $hero_desc ); ?></p>
                <?php endif; ?>

                <?php if ( $btn_1_text || $btn_2_text ) : ?>
                <div class="page-hero__btns">
                    <?php if ( $btn_1_text ) glc_action_btn( $btn_1_text, $btn_1_action, $btn_1_value, 'btn--primary' ); ?>
                    <?php if ( $btn_2_text ) glc_action_btn( $btn_2_text, $btn_2_action, $btn_2_value, 'btn--outline' ); ?>
                </div>
                <?php endif; ?>
            </div>

            <?php if ( ! empty( $hero_image['url'] ) ) : ?>
            <div class="page-hero__media">
                <img src="<?php echo esc_url( $hero_image['sizes']['glc-page-hero'] ?? $hero_image['url'] ); ?>"
                     alt="<?php echo esc_attr( $hero_image['alt'] ?: $hero_title ); ?>"
                     class="page-hero__img">
            </div>
            <?php endif; ?>

        </div>
    </div>
</section>
