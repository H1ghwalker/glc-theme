<?php
if (!defined('ABSPATH')) exit;
/**
 * ACF Block: glc-steps
 * Поля: section_title (text),
 *       items (Repeater) → icon (select 1-4), title (text)
 * SVG іконки: assets/img/icons/steps/{n}_step.svg (inline)
 */
$bg            = get_field('section_bg') ?: 'page';
$section_title = get_field( 'section_title' );
$items         = get_field( 'items' );

if (!$items) {
    glc_block_placeholder('GLC: Етапи — додайте кроки в правій панелі →');
    return;
}

$nums = ['01', '02', '03', '04', '05', '06'];
?>

<section class="steps section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">

        <h2 class="section-title steps__heading">
            <?php echo esc_html( $section_title ?: 'Етапи надання послуг:' ); ?>
        </h2>

        <div class="steps__grid">
            <?php foreach ( $items as $i => $item ) :
                $allowed_icons = ['1', '2', '3', '4'];
                $icon_num  = in_array($item['icon'], $allowed_icons, true) ? $item['icon'] : '1';
                $icon_path = get_template_directory() . '/assets/img/icons/steps/' . $icon_num . '_step.svg';
            ?>
            <div class="steps__item">

                <div class="steps__circle-wrap">
                    <div class="steps__circle">
                        <?php if ( file_exists( $icon_path ) ) include $icon_path; ?>
                    </div>
                    <span class="steps__num"><?php echo esc_html($nums[ $i ] ?? '0' . ( $i + 1 )); ?></span>
                </div>

                <p class="steps__title"><?php echo esc_html( $item['title'] ); ?></p>

            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
