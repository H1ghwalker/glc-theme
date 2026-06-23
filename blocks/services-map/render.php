<?php
if (!defined('ABSPATH')) exit;
/**
 * ACF Block: glc-services-map
 * Поля: map_title (text),
 *       map_btn_1_text, map_btn_1_link,
 *       map_btn_2_text, map_btn_2_link
 */
$bg         = get_field('section_bg') ?: 'page';
$map_title  = get_field('map_title');
$btn_1_text = get_field('map_btn_1_text');
$btn_1_link = get_field('map_btn_1_link');
$btn_2_text = get_field('map_btn_2_text');
$btn_2_link = get_field('map_btn_2_link');

if (!$map_title) {
    glc_block_placeholder('GLC: Карта маршрутів — заповніть поля в правій панелі →');
    return;
}

$img_uri = get_template_directory_uri() . '/assets/img';
?>

<section class="svc-map section section--bg-<?php echo esc_attr($bg); ?>">

    <div class="container">
        <h2 class="section-title svc-map__title"><?php echo esc_html( $map_title ); ?></h2>
    </div>

    <div class="svc-map__img-wrap">
        <?php if ( file_exists( get_template_directory() . '/assets/img/world-map.png' ) ) : ?>
            <img src="<?php echo esc_url( $img_uri ); ?>/world-map.png"
                 alt="Карта маршрутів GLC"
                 class="svc-map__img">
        <?php else : ?>
            <div class="svc-map__img-placeholder"></div>
        <?php endif; ?>
    </div>

    <div class="container">
        <div class="svc-map__btns">
            <?php if ($btn_1_text && $btn_1_link) glc_btn($btn_1_text, $btn_1_link, 'btn--primary'); ?>
            <?php if ($btn_2_text && $btn_2_link) glc_btn($btn_2_text, $btn_2_link, 'btn--primary'); ?>
        </div>
    </div>

</section>
