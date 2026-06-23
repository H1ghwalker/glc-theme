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
        <p style="color:#999">GLC: Картки послуг - заповніть поля в правій панелі &rarr;</p>
    </div>
<?php return; endif; ?>

<section class="service-cards section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">
        <div class="service-cards__layout">

            <div class="service-cards__sidebar">
                <?php if ($section_title) : ?>
                    <h2 class="service-cards__title"><?php echo esc_html($section_title); ?></h2>
                <?php endif; ?>

                <?php if ($section_desc) : ?>
                    <p class="service-cards__desc"><?php echo esc_html($section_desc); ?></p>
                <?php endif; ?>

                <?php if ($btn_text) :
                    glc_action_btn($btn_text, $btn_action, $btn_value, 'btn--primary service-cards__btn');
                endif; ?>
            </div>

            <div class="service-cards__grid">
                <?php foreach ($items as $item) :
                    $icon  = $item['icon'] ?? null;
                    $title = $item['title'] ?? '';
                    $desc  = $item['description'] ?? '';
                ?>
                    <article class="service-cards__card">
                        <div class="service-cards__card-header">
                            <span class="service-cards__icon-wrap" aria-hidden="true">
                                <?php if (!empty($icon['url'])) : ?>
                                    <img src="<?php echo esc_url($icon['url']); ?>"
                                         alt=""
                                         class="service-cards__icon"
                                         width="70"
                                         height="70"
                                         loading="lazy">
                                <?php endif; ?>
                            </span>

                            <?php if ($title) : ?>
                                <h3 class="service-cards__card-title"><?php echo esc_html($title); ?></h3>
                            <?php endif; ?>
                        </div>

                        <?php if ($desc) : ?>
                            <p class="service-cards__card-desc"><?php echo esc_html($desc); ?></p>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>
