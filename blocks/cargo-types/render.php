<?php
if (!defined('ABSPATH')) exit;
/**
 * ACF Block: glc-cargo-types
 * Поля: section_title (text), section_desc (textarea),
 *       items (Repeater) → title, desc, link, image (Image, Array)
 */
$bg = get_field('section_bg') ?: 'page';
$section_title = get_field( 'section_title' );
$section_desc = get_field( 'section_desc' );
$items = get_field( 'items' );

if (!$items) {
    glc_block_placeholder('GLC: Види вантажів — додайте елементи в правій панелі →');
    return;
} ?>

<section class="cargo-types section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">

        <div class="cargo-types__header">
            <h2 class="section-title cargo-types__title">
                <?php echo esc_html( $section_title ?: 'Види вантажів:' ); ?>
            </h2>
            <?php if ( $section_desc ) : ?>
                <p class="cargo-types__desc"><?php echo esc_html( $section_desc ); ?></p>
            <?php endif; ?>
        </div>

        <div class="cargo-types__grid">
            <?php foreach ( $items as $cargo ) :
                $image = $cargo['image'];
            ?>
            <article class="cargo-card">

                <div class="cargo-card__img-wrap">
                    <?php if ( ! empty( $image['url'] ) ) : ?>
                        <img src="<?php echo esc_url( $image['sizes']['glc-card'] ?? $image['url'] ); ?>"
                             alt="<?php echo esc_attr( $image['alt'] ?: $cargo['title'] ); ?>"
                             class="cargo-card__img">
                    <?php else : ?>
                        <div class="cargo-card__img-placeholder"></div>
                    <?php endif; ?>
                </div>

                <div class="cargo-card__body">
                    <h3 class="cargo-card__title"><?php echo esc_html( $cargo['title'] ); ?></h3>
                    <p class="cargo-card__desc"><?php echo esc_html( $cargo['desc'] ); ?></p>
                    <?php
                    $c_btn_text = $cargo['btn_text'] ?: 'Детальніше';
                    $c_btn_action = $cargo['btn_action'] ?: 'link';
                    $c_btn_value = $cargo['btn_value'] ?: '';
                    if ($c_btn_text) glc_action_btn($c_btn_text, $c_btn_action, $c_btn_value, 'btn--outline cargo-card__btn');
                    ?>
                </div>

            </article>
            <?php endforeach; ?>
        </div>

    </div>
</section>
