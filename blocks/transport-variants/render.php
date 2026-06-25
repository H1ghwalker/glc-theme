<?php
if (!defined('ABSPATH')) exit;

$bg            = get_field('section_bg') ?: 'page';
$section_title = get_field('section_title');
$items         = get_field('items');

if (empty($items)) {
    glc_block_placeholder('GLC: Варіанти перевезення — заповніть поля в правій панелі →');
    return;
}
?>

<section class="transport-variants section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">

        <?php if ($section_title) : ?>
            <h2 class="section-title transport-variants__title"><?php echo esc_html($section_title); ?></h2>
        <?php endif; ?>

        <div class="transport-variants__grid">
            <?php foreach ($items as $item) :
                $image      = $item['image'] ?? null;
                $title      = $item['title'] ?? '';
                $desc       = $item['description'] ?? '';
                $btn_text   = $item['btn_text'] ?? '';
                $btn_action = $item['btn_action'] ?? 'link';
                $btn_value  = $item['btn_value'] ?? '#';
            ?>
                <div class="transport-variants__card">
                    <?php if ($image) : ?>
                        <img src="<?php echo esc_url($image['sizes']['glc-card'] ?? $image['url']); ?>"
                             alt="<?php echo esc_attr($image['alt'] ?? $title); ?>"
                             class="transport-variants__image"
                             width="600" height="400" loading="lazy">
                    <?php endif; ?>

                    <div class="transport-variants__body">
                        <?php if ($title) : ?>
                            <h3 class="transport-variants__name"><?php echo esc_html($title); ?></h3>
                        <?php endif; ?>

                        <?php if ($desc) : ?>
                            <p class="transport-variants__desc"><?php echo esc_html($desc); ?></p>
                        <?php endif; ?>

                        <?php if ($btn_text) :
                            glc_action_btn($btn_text, $btn_action, $btn_value, 'btn--primary');
                        endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
