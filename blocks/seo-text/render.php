<?php
if (!defined('ABSPATH')) exit;
$bg   = get_field('section_bg') ?: 'page';
$text = get_field('seo_text');
$preview_length = get_field('preview_length') ?: 300;

if (!$text) {
    glc_block_placeholder('GLC: SEO текст — заповніть поле в правій панелі →');
    return;
}

// Обрізаємо текст для прев'ю (без розриву слів)
$stripped = strip_tags($text);
$is_long  = mb_strlen($stripped) > $preview_length;
$preview  = $is_long
    ? mb_substr($stripped, 0, mb_strrpos(mb_substr($stripped, 0, $preview_length), ' '))
    : $text;
?>

<section class="seo-text section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">
        <div class="seo-text__inner">

            <div class="seo-text__preview" id="seo-preview-<?php echo esc_attr($block['id']); ?>">
                <?php echo wp_kses_post($preview); ?>
                <?php if ($is_long) : ?>
                    <span class="seo-text__fade"></span>
                <?php endif; ?>
            </div>

            <?php if ($is_long) : ?>
                <div class="seo-text__full" id="seo-full-<?php echo esc_attr($block['id']); ?>"
                     style="display:none">
                    <?php echo wp_kses_post($text); ?>
                </div>
                <button class="seo-text__toggle"
                        data-preview="seo-preview-<?php echo esc_attr($block['id']); ?>"
                        data-full="seo-full-<?php echo esc_attr($block['id']); ?>">
                    Читати далі
                </button>
            <?php endif; ?>

        </div>
    </div>
</section>
