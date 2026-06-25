<?php
if (!defined('ABSPATH')) exit;

$bg = get_field('section_bg') ?: 'page';
$services_title = get_field('services_title') ?: 'Види послуг перевезення';
$tariffs_title = get_field('tariffs_title') ?: 'Тарифи транспортних послуг';
$items = get_field('transport_types');
$tariffs = get_field('tariff_types');

if (empty($items) && empty($tariffs)) {
    glc_block_placeholder('GLC: Типи послуг — заповніть пункти акордеону в правій панелі →');
    return;
}
?>

<section class="svc-section section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">
        <div class="svc-section__inner">

            <aside class="svc-sidebar" aria-label="Розділи послуг">
                <?php if (!empty($items)) : ?>
                <button class="svc-sidebar__item is-active" type="button" data-tab="services">
                    <?php echo esc_html($services_title); ?>
                </button>
                <?php endif; ?>
                <?php if (!empty($tariffs)) : ?>
                <button class="svc-sidebar__item<?php echo empty($items) ? ' is-active' : ''; ?>" type="button" data-tab="tariffs">
                    <?php echo esc_html($tariffs_title); ?>
                </button>
                <?php endif; ?>
            </aside>

            <div class="svc-content">
                <?php if (!empty($items)) : ?>
                <div class="svc-accordion svc-tab-panel" data-panel="services">
                    <?php foreach ($items as $i => $type) :
                        $title = $type['title'] ?? '';
                        $desc = $type['desc'] ?? '';
                        $btn_text = $type['btn_text'] ?? 'Детальніше';
                        $btn_action = $type['btn_action'] ?? 'link';
                        $btn_value = $type['btn_value'] ?? '#';
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
                <?php endif; ?>

                <?php if (!empty($tariffs)) : ?>
                <div class="svc-accordion svc-tab-panel" data-panel="tariffs" style="<?php echo !empty($items) ? 'display:none' : ''; ?>">
                    <?php foreach ($tariffs as $i => $type) :
                        $title = $type['title'] ?? '';
                        $desc = $type['desc'] ?? '';
                        $btn_text = $type['btn_text'] ?? 'Детальніше';
                        $btn_action = $type['btn_action'] ?? 'link';
                        $btn_value = $type['btn_value'] ?? '#';
                    ?>
                        <div class="svc-accordion__item<?php echo esc_attr($i === 0 && empty($items) ? ' is-open' : ''); ?>">
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
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
