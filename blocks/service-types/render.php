<?php
if (!defined('ABSPATH')) exit;
/**
 * ACF Block: glc-service-types
 * Поля: transport_types (Repeater) → icon (Image, Array), title, desc, link
 *       tariffs (Repeater)         → weight, price
 *       tariffs_note (text), tariffs_btn_link (url)
 *
 * ⚠️ JS для tabs і accordion в main.js — зберігати класи:
 *    .svc-sidebar__item[data-tab], .svc-panel[data-panel],
 *    .svc-accordion__item, .svc-accordion__head, .svc-accordion__body
 */
$bg               = get_field('section_bg') ?: 'page';
$transport_types  = get_field( 'transport_types' );
$tariffs          = get_field( 'tariffs' );

if (!$transport_types && !$tariffs) {
    glc_block_placeholder('GLC: Типи послуг + тарифи — заповніть поля в правій панелі →');
    return;
}

$tariffs_note     = get_field( 'tariffs_note' );
$tariffs_btn_text = get_field( 'tariffs_btn_text' );
$tariffs_btn_link = get_field( 'tariffs_btn_link' );

// Перша активна панель
$first_panel = $transport_types ? 'types' : 'tariffs';
?>

<section class="svc-section section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">
        <div class="svc-section__inner">

            <!-- Ліва бічна панель (tabs) -->
            <aside class="svc-sidebar">
                <?php if ( $transport_types ) : ?>
                <button class="svc-sidebar__item<?php echo $first_panel === 'types' ? ' is-active' : ''; ?>"
                        data-tab="types" type="button">
                    Види послуг перевезення
                </button>
                <?php endif; ?>
                <?php if ( $tariffs ) : ?>
                <button class="svc-sidebar__item<?php echo $first_panel === 'tariffs' ? ' is-active' : ''; ?>"
                        data-tab="tariffs" type="button">
                    Тарифи транспортних послуг
                </button>
                <?php endif; ?>
            </aside>

            <!-- Права контентна зона -->
            <div class="svc-content">

                <!-- Панель: Типи послуг (accordion) -->
                <?php if ( $transport_types ) : ?>
                <div class="svc-panel<?php echo $first_panel === 'types' ? ' is-active' : ''; ?>" data-panel="types">
                    <div class="svc-accordion">
                        <?php foreach ( $transport_types as $i => $type ) : ?>
                        <div class="svc-accordion__item<?php echo $i === 0 ? ' is-open' : ''; ?>">
                            <button class="svc-accordion__head" type="button">
                                <span class="svc-accordion__title"><?php echo esc_html( $type['title'] ); ?></span>
                                <span class="svc-accordion__icon"></span>
                            </button>
                            <div class="svc-accordion__body">
                                <p class="svc-accordion__desc"><?php echo esc_html( $type['desc'] ); ?></p>
                                <?php glc_btn($type['btn_text'] ?: 'Детальніше', $type['link'] ?: '#', 'btn--outline'); ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Панель: Тарифи -->
                <?php if ( $tariffs ) : ?>
                <div class="svc-panel<?php echo $first_panel === 'tariffs' ? ' is-active' : ''; ?>" data-panel="tariffs">
                    <table class="svc-tariffs">
                        <thead>
                            <tr>
                                <th class="svc-tariffs__th">Вантажопідйомність</th>
                                <th class="svc-tariffs__th">Вартість</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ( $tariffs as $row ) : ?>
                            <tr class="svc-tariffs__row">
                                <td class="svc-tariffs__td"><?php echo esc_html( $row['weight'] ); ?></td>
                                <td class="svc-tariffs__td svc-tariffs__td--price"><?php echo esc_html( $row['price'] ); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php if ( $tariffs_note ) : ?>
                        <p class="svc-tariffs__note"><?php echo esc_html( $tariffs_note ); ?></p>
                    <?php endif; ?>
                    <?php if ( $tariffs_btn_link ) : ?>
                        <?php glc_btn($tariffs_btn_text ?: 'Отримати розрахунок', $tariffs_btn_link, 'btn--primary'); ?>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

            </div><!-- /.svc-content -->

        </div><!-- /.svc-section__inner -->
    </div>
</section>
