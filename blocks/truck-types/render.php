<?php
if (!defined('ABSPATH')) exit;

$bg            = get_field('section_bg') ?: 'page';
$section_title = get_field('section_title');
$items         = get_field('items');

if (empty($items)) {
    glc_block_placeholder('GLC: Типи вантажних автомобілів - додайте картки у правій панелі ->');
    return;
}
?>

<section class="truck-types section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">
        <?php if ($section_title) : ?>
            <h2 class="truck-types__title"><?php echo esc_html($section_title); ?></h2>
        <?php endif; ?>

        <div class="truck-types__grid">
            <?php foreach ($items as $item) :
                $image      = $item['image'] ?? null;
                $title      = $item['title'] ?? '';
                $desc       = $item['description'] ?? '';
                $btn_text   = $item['btn_text'] ?? '';
                $btn_action = $item['btn_action'] ?? 'link';
                $btn_value  = $item['btn_value'] ?? '#';
            ?>
                <article class="truck-types__card">
                    <div class="truck-types__media">
                        <?php if (!empty($image['url'])) : ?>
                            <img src="<?php echo esc_url($image['sizes']['large'] ?? $image['url']); ?>"
                                 alt="<?php echo esc_attr($image['alt'] ?: $title); ?>"
                                 class="truck-types__image"
                                 loading="lazy">
                        <?php endif; ?>
                    </div>

                    <div class="truck-types__body">
                        <?php if ($title) : ?>
                            <h3 class="truck-types__name"><?php echo esc_html($title); ?></h3>
                        <?php endif; ?>

                        <?php if ($desc) : ?>
                            <p class="truck-types__desc"><?php echo esc_html($desc); ?></p>
                        <?php endif; ?>

                        <?php if ($btn_text) : ?>
                            <div class="truck-types__action">
                                <?php glc_action_btn($btn_text, $btn_action, $btn_value, 'btn--primary truck-types__btn'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
