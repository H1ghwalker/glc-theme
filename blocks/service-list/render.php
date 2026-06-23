<?php
if (!defined('ABSPATH')) exit;

$bg            = get_field('section_bg') ?: 'page';
$section_title = get_field('section_title');
$section_desc  = get_field('section_desc');
$btn_text      = get_field('btn_text');
$btn_action    = get_field('btn_action') ?: 'link';
$btn_value     = get_field('btn_value') ?: '#';
$items         = get_field('items');

if (empty($items)) : ?>
    <div style="padding:40px;text-align:center;background:#f5f5f5;border:2px dashed #ccc">
        <p style="color:#999">GLC: Список послуг — заповніть поля в правій панелі &rarr;</p>
    </div>
<?php return; endif; ?>

<section class="service-list section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">
        <?php if ($section_title) : ?>
            <h2 class="service-list__title"><?php echo esc_html($section_title); ?></h2>
        <?php endif; ?>

        <?php if ($section_desc) : ?>
            <p class="service-list__desc"><?php echo esc_html($section_desc); ?></p>
        <?php endif; ?>

        <div class="service-list__cards">
            <?php foreach ($items as $item) :
                $image      = $item['image'] ?? ($item['icon'] ?? null);
                $title      = $item['title'] ?? '';
                $desc       = $item['description'] ?? '';
                $item_btn   = ($item['btn_text'] ?? $btn_text) ?: 'Детальніше';
                $item_action = $item['btn_action'] ?? $btn_action;
                $item_value  = $item['btn_value'] ?? $btn_value;
            ?>
                <article class="service-list__card">
                    <div class="service-list__media">
                        <?php if (!empty($image['url'])) : ?>
                            <img src="<?php echo esc_url($image['sizes']['large'] ?? $image['url']); ?>"
                                 alt="<?php echo esc_attr($image['alt'] ?? $title); ?>"
                                 class="service-list__image"
                                 loading="lazy">
                        <?php endif; ?>
                    </div>

                    <div class="service-list__body">
                        <?php if ($title) : ?>
                            <h3 class="service-list__card-title"><?php echo esc_html($title); ?></h3>
                        <?php endif; ?>

                        <?php if ($desc) : ?>
                            <p class="service-list__card-desc"><?php echo esc_html($desc); ?></p>
                        <?php endif; ?>

                        <?php if ($item_btn) :
                            glc_action_btn($item_btn, $item_action, $item_value, 'btn--outline service-list__card-btn');
                        endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
