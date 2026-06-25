<?php
if (!defined('ABSPATH')) exit;
/**
 * ACF Block: glc-transport-types
 * 5 карток типів транспорту з фото.
 * Поля: section_title (text),
 *       items (Repeater) → image (Image/Array), title, desc, link
 */
$bg             = get_field('section_bg') ?: 'page';
$section_title  = get_field('section_title');
$items          = get_field('items');
$cta_btn_text   = get_field('cta_btn_text');
$cta_btn_action = get_field('cta_btn_action') ?: 'link';
$cta_btn_value  = get_field('cta_btn_value');
$cta_text       = get_field('cta_text');

if (!$items) {
    glc_block_placeholder('GLC: Види транспорту — додайте елементи в правій панелі →');
    return;
} ?>

<section class="transport-types section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">

        <?php if ( $section_title ) : ?>
            <h2 class="section-title transport-types__title"><?php echo esc_html( $section_title ); ?></h2>
        <?php endif; ?>

        <div class="transport-types__grid">
            <?php foreach ( $items as $item ) :
                $image = $item['image'];
            ?>
            <article class="transport-card">

                <div class="transport-card__img-wrap">
                    <?php if ( ! empty( $image['url'] ) ) : ?>
                        <img src="<?php echo esc_url( $image['sizes']['glc-card'] ?? $image['url'] ); ?>"
                             alt="<?php echo esc_attr( $image['alt'] ?: $item['title'] ); ?>"
                             class="transport-card__img">
                    <?php else : ?>
                        <div class="transport-card__img-placeholder"></div>
                    <?php endif; ?>
                </div>

                <div class="transport-card__body">
                    <h3 class="transport-card__title"><?php echo esc_html( $item['title'] ); ?></h3>
                    <?php if ( $item['desc'] ) : ?>
                        <p class="transport-card__desc"><?php echo esc_html( $item['desc'] ); ?></p>
                    <?php endif; ?>
                    <?php
                    $i_btn_text   = $item['btn_text'] ?? 'Детальніше про послугу';
                    $i_btn_action = $item['btn_action'] ?? 'link';
                    $i_btn_value  = $item['btn_value'] ?? '';
                    if ($i_btn_text) glc_action_btn($i_btn_text, $i_btn_action, $i_btn_value, 'btn--outline');
                    ?>
                </div>

            </article>
            <?php endforeach; ?>

            <?php if ($cta_btn_text) : ?>
            <div class="transport-card transport-card--cta">
                <?php glc_action_btn($cta_btn_text, $cta_btn_action, $cta_btn_value, 'btn--primary'); ?>
                <?php if ($cta_text) : ?>
                <p class="transport-card__cta-text"><?php echo esc_html($cta_text); ?></p>
                <?php endif; ?>
            </div>
            <?php endif; ?>

        </div>

    </div>
</section>
