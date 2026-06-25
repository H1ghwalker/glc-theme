<?php
if (!defined('ABSPATH')) exit;
/**
 * ACF Block: glc-steps
 * Поля: section_title (text),
 *       items (Repeater) → icon (select 1-4), title (text), description (textarea)
 * SVG іконки: assets/img/icons/steps/* (inline)
 */
$bg = get_field('section_bg') ?: 'page';
$section_title = get_field( 'section_title' );
$items = get_field( 'items' );

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
                $allowed_icons = ['1', '2', '3', '4', '5'];
                $icon_num = in_array($item['icon'], $allowed_icons, true) ? $item['icon'] : '1';
                $icon_files = [
                    '1' => '1_step.svg',
                    '2' => '2_step.svg',
                    '3' => '3_step.svg',
                    '4' => '4_step.svg',
                    '5' => '5-step.svg',
                ];
                $icon_path = get_template_directory() . '/assets/img/icons/steps/' . $icon_files[$icon_num];
                $has_description = !empty($item['description']);
                $circle_class = 'steps__circle' . ($icon_num === '5' ? ' steps__circle--bare' : '');
            ?>
            <div class="steps__item<?php echo esc_attr($has_description ? ' has-desc' : ''); ?>">

                <div class="steps__circle-wrap">
                    <div class="<?php echo esc_attr($circle_class); ?>">
                        <?php if ( file_exists( $icon_path ) ) echo glc_sanitize_svg(file_get_contents($icon_path)); ?>
                    </div>
                    <span class="steps__num"><?php echo esc_html($nums[ $i ] ?? '0' . ( $i + 1 )); ?></span>
                </div>

                <p class="steps__title"><?php echo esc_html( $item['title'] ); ?></p>
                <?php if ($has_description) : ?>
                    <p class="steps__desc"><?php echo wp_kses_post($item['description']); ?></p>
                <?php endif; ?>

            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
