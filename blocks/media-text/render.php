<?php
if (!defined('ABSPATH')) exit;

$bg          = get_field('section_bg') ?: 'page';

$media_text_field = static function (array $selectors) {
    foreach ($selectors as $selector) {
        $value = get_field($selector);

        if ($value !== null && $value !== false && $value !== '') {
            return $value;
        }
    }

    return '';
};

$media_text_content = static function ($value) {
    $value = trim((string) $value);

    if ($value === '') {
        return '';
    }

    return wp_kses_post(wpautop($value));
};

$image       = $media_text_field(['media_text_image', 'field_mtext_image']);
$title       = $media_text_field(['media_text_title', 'field_mtext_title']);
$highlight   = $media_text_field(['media_text_highlight', 'field_mtext_highlight']);
$body_text   = $media_text_field(['media_text_body', 'field_mtext_body', 'media_text_right', 'right_text', 'body_text']);
$bottom_text = $media_text_field(['media_text_bottom', 'field_mtext_bottom', 'media_text_text_bottom', 'text_bottom', 'bottom_text']);

if (!$title && empty($image['url']) && !$highlight && !$body_text && !$bottom_text) {
    glc_block_placeholder('GLC: Фото + текст - заповніть поля у правій панелі ->');
    return;
}

$highlight_html   = $media_text_content($highlight);
$body_text_html   = $media_text_content($body_text);
$bottom_text_html = $media_text_content($bottom_text);
?>

<section class="media-text section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">
        <div class="media-text__grid">
            <?php if (!empty($image['url'])) : ?>
                <div class="media-text__media">
                    <img src="<?php echo esc_url($image['sizes']['large'] ?? $image['url']); ?>"
                         alt="<?php echo esc_attr($image['alt'] ?: $title); ?>"
                         class="media-text__image"
                         loading="lazy">
                </div>
            <?php endif; ?>

            <div class="media-text__content">
                <?php if ($title) : ?>
                    <h2 class="media-text__title"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>

                <?php if ($highlight_html) : ?>
                    <div class="media-text__highlight">
                        <?php echo $highlight_html; ?>
                    </div>
                <?php endif; ?>

                <?php if ($body_text_html) : ?>
                    <div class="media-text__body">
                        <?php echo $body_text_html; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if ($bottom_text_html) : ?>
            <div class="media-text__bottom">
                <?php echo $bottom_text_html; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
