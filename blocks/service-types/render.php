<?php
if (!defined('ABSPATH')) exit;

$bg             = get_field('section_bg') ?: 'page';
$services_title = get_field('services_title') ?: 'Види послуг перевезення';
$tariffs_title  = get_field('tariffs_title') ?: 'Тарифи транспортних послуг';
$items          = get_field('transport_types');

if (empty($items)) {
    glc_block_placeholder('GLC: Типи послуг — заповніть пункти акордеону в правій панелі →');
    return;
}
?>

<section class="svc-section section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">
        <div class="svc-section__inner">

            <aside class="svc-sidebar" aria-label="Розділи послуг">
                <div class="svc-sidebar__item is-active">
                    <?php echo esc_html($services_title); ?>
                </div>
                <div class="svc-sidebar__item">
                    <?php echo esc_html($tariffs_title); ?>
                </div>
            </aside>

            <div class="svc-content">
                <div class="svc-accordion">
                    <?php foreach ($items as $i => $type) :
                        $title      = $type['title'] ?? '';
                        $desc       = $type['desc'] ?? '';
                        $btn_text   = $type['btn_text'] ?? 'Детальніше';
                        $btn_action = $type['btn_action'] ?? 'link';
                        $btn_value  = $type['btn_value'] ?? ($type['link'] ?? '#');
                    ?>
                        <div class="svc-accordion__item<?php echo esc_attr($i === 0 ? ' is-open' : ''); ?>">
                            <button class="svc-accordion__head" type="button">
                                <span class="svc-accordion__title"><?php echo esc_html($title); ?></span>
                                <span class="svc-accordion__icon" aria-hidden="true"></span>
                            </button>
                            <div class="svc-accordion__body">
                                <div class="svc-accordion__body-inner">
                                    <?php if ($desc) : ?>
                                        <p class="svc-accordion__desc"><?php echo esc_html($desc); ?></p>
                                    <?php endif; ?>

                                    <?php if ($btn_text) :
                                        glc_action_btn($btn_text, $btn_action, $btn_value, 'btn--outline svc-accordion__btn');
                                    endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
</section>
