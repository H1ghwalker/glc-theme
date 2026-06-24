<?php
if (!defined('ABSPATH')) exit;
/**
 * Сторінка глобальних налаштувань GLC в адмінці
 */

add_action('admin_menu', function() {
    add_menu_page(
        'Налаштування GLC',
        'GLC Налаштування',
        'manage_options',
        'glc-settings',
        'glc_settings_page',
        'dashicons-admin-settings',
        2
    );
});

function glc_settings_image_field($label, $name)
{
    $value = get_option($name);
    ?>
    <tr>
        <th><?php echo esc_html($label); ?></th>
        <td>
            <div class="glc-media-field">
                <input type="url" name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($name); ?>" value="<?php echo esc_url($value); ?>" class="regular-text">
                <button type="button" class="button glc-media-btn" data-target="<?php echo esc_attr($name); ?>">Завантажити / вибрати</button>
                <div class="glc-media-preview">
                    <?php if ($value): ?>
                        <img src="<?php echo esc_url($value); ?>" alt="">
                    <?php endif; ?>
                </div>
            </div>
        </td>
    </tr>
    <?php
}

add_action('admin_enqueue_scripts', function ($hook) {
    if ($hook !== 'toplevel_page_glc-settings')
        return;

    wp_enqueue_media();

    wp_add_inline_style('common', '
        .glc-media-field { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
        .glc-media-preview img { max-width: 80px; max-height: 80px; display: block; border: 1px solid #ddd; }
        #glc-socials-table { max-width: 850px; margin-top: 8px; }
        #glc-socials-table td { vertical-align: middle; padding: 6px 8px; }
        #glc-socials-table .glc-icon-preview { width: 20px; height: 20px; vertical-align: middle; margin-left: 4px; }
        #glc-popups-table { max-width: 980px; margin-top: 8px; }
        #glc-popups-table td { vertical-align: top; padding: 6px 8px; }
        #glc-popups-table input { width: 100%; }
    ');

    wp_add_inline_script('jquery-core', "
        jQuery(function ($) {
            // ── Медіа-бібліотека для image полів ──
            $('.glc-media-btn').on('click', function (e) {
                e.preventDefault();
                var button = $(this);
                var input = $('#' + button.data('target'));
                var frame = wp.media({ title: 'Виберіть картинку', multiple: false, library: { type: 'image' } });
                frame.on('select', function () {
                    var attachment = frame.state().get('selection').first().toJSON();
                    input.val(attachment.url);
                    button.siblings('.glc-media-preview').empty().append($('<img>').attr('src', attachment.url));
                });
                frame.open();
            });

            // ── Соцмережі: додати рядок ──
            $('#glc-social-add').on('click', function () {
                var idx = $('#glc-socials-table tbody tr').length;
                var row = '<tr class=\"glc-social-row\">' +
                    '<td><input type=\"text\" name=\"glc_socials[' + idx + '][name]\" style=\"width:100%\"></td>' +
                    '<td><input type=\"url\" name=\"glc_socials[' + idx + '][url]\" style=\"width:100%\"></td>' +
                    '<td><input type=\"hidden\" name=\"glc_socials[' + idx + '][icon]\" class=\"glc-icon-val\"><button type=\"button\" class=\"button glc-icon-btn\">Вибрати</button></td>' +
                    '<td><input type=\"hidden\" name=\"glc_socials[' + idx + '][icon_active]\" class=\"glc-icon-val\"><button type=\"button\" class=\"button glc-icon-btn\">Вибрати</button></td>' +
                    '<td><button type=\"button\" class=\"button glc-social-remove\">✕</button></td>' +
                    '</tr>';
                $('#glc-socials-table tbody').append(row);
            });

            // ── Соцмережі: видалити рядок ──
            $(document).on('click', '.glc-social-remove', function () {
                $(this).closest('tr').remove();
            });

            // ── Соцмережі: вибір іконки ──
            $(document).on('click', '.glc-icon-btn', function (e) {
                e.preventDefault();
                var btn = $(this);
                var input = btn.siblings('.glc-icon-val');
                var frame = wp.media({ title: 'Виберіть іконку', multiple: false, library: { type: 'image' } });
                frame.on('select', function () {
                    var url = frame.state().get('selection').first().toJSON().url;
                    input.val(url);
                    btn.siblings('.glc-icon-preview').remove();
                    btn.after($('<img>').attr('src', url).addClass('glc-icon-preview'));
                });
                frame.open();
            });

            $('#glc-popup-add').on('click', function () {
                var idx = $('#glc-popups-table tbody tr').length;
                var row = '<tr class=\"glc-popup-row\">' +
                    '<td><input type=\"text\" name=\"glc_form_popups[' + idx + '][popup_id]\" placeholder=\"glc-request-popup\"></td>' +
                    '<td><input type=\"text\" name=\"glc_form_popups[' + idx + '][title]\" placeholder=\"Заявка на перевезення\"></td>' +
                    '<td><input type=\"text\" name=\"glc_form_popups[' + idx + '][shortcode]\" placeholder=\"[fluentform id=&quot;3&quot;]\"></td>' +
                    '<td><button type=\"button\" class=\"button glc-popup-remove\">×</button></td>' +
                    '</tr>';
                $('#glc-popups-table tbody').append(row);
            });

            $(document).on('click', '.glc-popup-remove', function () {
                $(this).closest('tr').remove();
            });
        });
    ");
});

function glc_settings_page() { ?>
    <div class="wrap">
    <h1>Налаштування сайту GLC</h1>
    <?php settings_errors(); ?>
    <form method="post" action="options.php">
        <?php settings_fields('glc_settings_group'); ?>

        <?php if (get_option('glc_maintenance_mode')): ?>
            <div class="notice notice-warning" style="margin:15px 0;padding:12px 16px">
                <strong>⚠ Режим обслуговування увімкнено.</strong> Відвідувачі бачать заглушку замість сайту. Адміністратори бачать сайт як зазвичай.
            </div>
        <?php endif; ?>

        <h2>Режим обслуговування</h2>
        <table class="form-table">
            <tr><th>Увімкнути</th><td>
                <label>
                    <input type="checkbox" name="glc_maintenance_mode" value="1" <?php checked(get_option('glc_maintenance_mode'), 1); ?>>
                    Показувати сторінку «Сайт на обслуговуванні» для відвідувачів
                </label>
            </td></tr>
        </table>

        <h2>Контакти</h2>
        <table class="form-table">
            <tr><th>Email</th><td>
                <input type="email" name="glc_email" value="<?php echo esc_attr(get_option('glc_email')); ?>" class="regular-text">
            </td></tr>
            <tr><th>Телефон 1</th><td>
                <input type="text" name="glc_phone_1" value="<?php echo esc_attr(get_option('glc_phone_1')); ?>" class="regular-text">
            </td></tr>
            <tr><th>Телефон 2</th><td>
                <input type="text" name="glc_phone_2" value="<?php echo esc_attr(get_option('glc_phone_2')); ?>" class="regular-text">
            </td></tr>
        </table>

        <h2>CTA-кнопка хедера</h2>
        <table class="form-table">
            <tr><th>Текст кнопки</th><td>
                <input type="text" name="glc_cta_text" value="<?php echo esc_attr(get_option('glc_cta_text', 'Заявка на перевезення')); ?>" class="regular-text">
            </td></tr>
            <tr><th>Посилання</th><td>
                <input type="text" name="glc_cta_link" value="<?php echo esc_attr(get_option('glc_cta_link', '/contacts')); ?>" class="regular-text">
                <p class="description">Шлях сторінки, наприклад: /contacts</p>
            </td></tr>
        </table>

        <h2>Соціальні мережі</h2>
        <p class="description">Якщо URL порожній — іконка не відображається на сайті. Іконка (hover) — необов'язкова.</p>
        <table class="widefat" id="glc-socials-table">
            <thead>
                <tr>
                    <th style="width:150px">Назва</th>
                    <th style="width:280px">URL</th>
                    <th style="width:160px">Іконка</th>
                    <th style="width:160px">Іконка (hover)</th>
                    <th style="width:40px"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $socials = get_option('glc_socials', []);
                if (!is_array($socials)) $socials = [];
                foreach ($socials as $i => $social):
                ?>
                <tr class="glc-social-row">
                    <td><input type="text" name="glc_socials[<?php echo (int) $i; ?>][name]" value="<?php echo esc_attr($social['name'] ?? ''); ?>" style="width:100%"></td>
                    <td><input type="url" name="glc_socials[<?php echo (int) $i; ?>][url]" value="<?php echo esc_url($social['url'] ?? ''); ?>" style="width:100%"></td>
                    <td>
                        <input type="hidden" name="glc_socials[<?php echo (int) $i; ?>][icon]" value="<?php echo esc_url($social['icon'] ?? ''); ?>" class="glc-icon-val">
                        <button type="button" class="button glc-icon-btn">Вибрати</button>
                        <?php if (!empty($social['icon'])): ?><img src="<?php echo esc_url($social['icon']); ?>" class="glc-icon-preview"><?php endif; ?>
                    </td>
                    <td>
                        <input type="hidden" name="glc_socials[<?php echo (int) $i; ?>][icon_active]" value="<?php echo esc_url($social['icon_active'] ?? ''); ?>" class="glc-icon-val">
                        <button type="button" class="button glc-icon-btn">Вибрати</button>
                        <?php if (!empty($social['icon_active'])): ?><img src="<?php echo esc_url($social['icon_active']); ?>" class="glc-icon-preview"><?php endif; ?>
                    </td>
                    <td><button type="button" class="button glc-social-remove">✕</button></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p><button type="button" class="button" id="glc-social-add">+ Додати соцмережу</button></p>

        <h2>Popup-форми</h2>
        <p class="description">Додайте Fluent Forms shortcode для popup. Кнопки можуть відкривати його через <code>#popup-id</code> або ACF action <code>Popup</code> зі значенням <code>popup-id</code>.</p>
        <table class="widefat" id="glc-popups-table">
            <thead>
                <tr>
                    <th style="width:220px">Popup ID</th>
                    <th style="width:260px">Заголовок</th>
                    <th>Fluent Forms shortcode</th>
                    <th style="width:40px"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $form_popups = get_option('glc_form_popups', []);
                if (!is_array($form_popups)) $form_popups = [];
                foreach ($form_popups as $i => $popup):
                ?>
                <tr class="glc-popup-row">
                    <td><input type="text" name="glc_form_popups[<?php echo (int) $i; ?>][popup_id]" value="<?php echo esc_attr($popup['popup_id'] ?? ''); ?>" placeholder="glc-request-popup"></td>
                    <td><input type="text" name="glc_form_popups[<?php echo (int) $i; ?>][title]" value="<?php echo esc_attr($popup['title'] ?? ''); ?>" placeholder="Заявка на перевезення"></td>
                    <td><input type="text" name="glc_form_popups[<?php echo (int) $i; ?>][shortcode]" value="<?php echo esc_attr($popup['shortcode'] ?? ''); ?>" placeholder='[fluentform id="3"]'></td>
                    <td><button type="button" class="button glc-popup-remove">×</button></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p><button type="button" class="button" id="glc-popup-add">+ Додати popup-форму</button></p>

        <h2>Логотип</h2>
        <table class="form-table">
            <?php glc_settings_image_field('Логотип', 'glc_logo'); ?>
        </table>

        <h2>Мега-меню "Послуги" — картинки праворуч</h2>
        <p class="description">Однакові для всіх категорій мега-меню. Якщо поле порожнє — використовується картинка-заглушка з теми.</p>
        <table class="form-table">
            <?php
            glc_settings_image_field('Картинка 1', 'glc_megamenu_image_1');
            glc_settings_image_field('Картинка 2', 'glc_megamenu_image_2');
            glc_settings_image_field('Картинка 3', 'glc_megamenu_image_3');
            glc_settings_image_field('Картинка 4', 'glc_megamenu_image_4');
            ?>
        </table>

        <h2>Аналітика та маркетинг</h2>
        <p class="description">Вкажіть тільки ID контейнера Google Tag Manager. Код GTM генерується темою автоматично.</p>
        <table class="form-table">
            <tr><th>Google Tag Manager ID</th><td>
                <?php if (isset($_GET['settings-updated']) && get_settings_errors('glc_gtm_id')): ?>
                    <p style="color:#b32d2e;margin:0 0 8px;font-weight:600">Google Tag Manager ID не збережено. Використовуйте формат GTM-XXXXXXX.</p>
                <?php endif; ?>
                <input type="text" name="glc_gtm_id" value="<?php echo esc_attr(get_option('glc_gtm_id')); ?>" class="regular-text" placeholder="GTM-XXXXXXX">
                <p class="description">Формат: GTM-XXXXXXX.</p>
            </td></tr>
        </table>

        <?php submit_button('Зберегти налаштування'); ?>
    </form>
    </div>
<?php }

// Санітизація масиву соцмереж
function glc_sanitize_socials($value)
{
    if (!is_array($value))
        return [];

    $clean = [];
    foreach ($value as $item) {
        if (empty($item['url']))
            continue;
        $clean[] = [
            'name' => sanitize_text_field($item['name'] ?? ''),
            'url' => esc_url_raw($item['url']),
            'icon' => esc_url_raw($item['icon'] ?? ''),
            'icon_active' => esc_url_raw($item['icon_active'] ?? ''),
        ];
    }
    return $clean;
}

function glc_sanitize_gtm_id($value)
{
    $value = strtoupper(trim(sanitize_text_field($value)));

    if ($value === '')
        return '';

    if (!preg_match('/^GTM-[A-Z0-9]+$/', $value)) {
        add_settings_error(
            'glc_gtm_id',
            'glc_gtm_id_invalid',
            'Google Tag Manager ID не збережено. Використовуйте формат GTM-XXXXXXX.',
            'error'
        );
        return get_option('glc_gtm_id', '');
    }

    return $value;
}

function glc_sanitize_form_popups($value)
{
    if (!is_array($value))
        return [];

    $clean = [];
    $used_ids = [];

    foreach ($value as $item) {
        $popup_id = sanitize_key($item['popup_id'] ?? '');
        $shortcode = trim(wp_unslash($item['shortcode'] ?? ''));

        if (!$popup_id || !$shortcode || isset($used_ids[$popup_id]))
            continue;

        if (!preg_match('/^\[fluentform\s+id=["\']?\d+["\']?\]$/', $shortcode))
            continue;

        $used_ids[$popup_id] = true;
        $clean[] = [
            'popup_id' => $popup_id,
            'title' => sanitize_text_field($item['title'] ?? ''),
            'shortcode' => $shortcode,
        ];
    }

    return $clean;
}

function glc_render_form_popups()
{
    $popups = get_option('glc_form_popups', []);
    if (empty($popups) || !is_array($popups))
        return;

    foreach ($popups as $popup) {
        if (empty($popup['popup_id']) || empty($popup['shortcode']))
            continue;
        ?>
        <div class="glc-modal" id="<?php echo esc_attr($popup['popup_id']); ?>" role="dialog" aria-modal="true" aria-hidden="true" hidden>
            <div class="glc-modal__backdrop" data-popup-close></div>
            <div class="glc-modal__dialog" role="document">
                <button type="button" class="glc-modal__close" data-popup-close aria-label="Закрити">×</button>
                <?php if (!empty($popup['title'])) : ?>
                    <h2 class="glc-modal__title"><?php echo esc_html($popup['title']); ?></h2>
                <?php endif; ?>
                <div class="glc-modal__form">
                    <?php echo do_shortcode($popup['shortcode']); ?>
                </div>
            </div>
        </div>
        <?php
    }
}

add_action('admin_init', function() {
    register_setting('glc_settings_group', 'glc_maintenance_mode',   ['sanitize_callback' => 'absint']);
    register_setting('glc_settings_group', 'glc_email',             ['sanitize_callback' => 'sanitize_email']);
    register_setting('glc_settings_group', 'glc_phone_1',           ['sanitize_callback' => 'sanitize_text_field']);
    register_setting('glc_settings_group', 'glc_phone_2',           ['sanitize_callback' => 'sanitize_text_field']);
    register_setting('glc_settings_group', 'glc_cta_text',          ['sanitize_callback' => 'sanitize_text_field']);
    register_setting('glc_settings_group', 'glc_cta_link',          ['sanitize_callback' => 'sanitize_text_field']);
    register_setting('glc_settings_group', 'glc_socials',           ['sanitize_callback' => 'glc_sanitize_socials']);
    register_setting('glc_settings_group', 'glc_form_popups',       ['sanitize_callback' => 'glc_sanitize_form_popups']);
    register_setting('glc_settings_group', 'glc_logo',              ['sanitize_callback' => 'esc_url_raw']);
    register_setting('glc_settings_group', 'glc_gtm_id',            ['sanitize_callback' => 'glc_sanitize_gtm_id']);
    register_setting('glc_settings_group', 'glc_megamenu_image_1',  ['sanitize_callback' => 'esc_url_raw']);
    register_setting('glc_settings_group', 'glc_megamenu_image_2',  ['sanitize_callback' => 'esc_url_raw']);
    register_setting('glc_settings_group', 'glc_megamenu_image_3',  ['sanitize_callback' => 'esc_url_raw']);
    register_setting('glc_settings_group', 'glc_megamenu_image_4',  ['sanitize_callback' => 'esc_url_raw']);
});

add_action('admin_init', function() {
    if (get_option('glc_socials_migrated'))
        return;

    $icons_uri = get_template_directory_uri() . '/assets/img/icons/ui';
    $socials = [];

    $old = [
        ['option' => 'glc_facebook',  'name' => 'Facebook',  'icon' => 'facebook'],
        ['option' => 'glc_instagram', 'name' => 'Instagram', 'icon' => 'instagram'],
        ['option' => 'glc_linkedin',  'name' => 'LinkedIn',  'icon' => 'linkedin'],
    ];

    foreach ($old as $s) {
        $url = get_option($s['option']);
        if ($url) {
            $socials[] = [
                'name' => $s['name'],
                'url' => $url,
                'icon' => $icons_uri . '/' . $s['icon'] . '.svg',
                'icon_active' => $icons_uri . '/' . $s['icon'] . '_active.svg',
            ];
        }
    }

    if (!empty($socials))
        update_option('glc_socials', $socials);

    update_option('glc_socials_migrated', true);
});

add_action('wp_head', function() {
    $gtm_id = get_option('glc_gtm_id');
    if (!$gtm_id || !preg_match('/^GTM-[A-Z0-9]+$/', $gtm_id))
        return;

    ?>
    <!-- Google Tag Manager -->
    <script>
    (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id=<?php echo esc_js($gtm_id); ?>'+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','<?php echo esc_js($gtm_id); ?>');
    </script>
    <!-- End Google Tag Manager -->
    <?php
});

function glc_megamenu_images()
{
    $defaults = [
        get_template_directory_uri() . '/assets/img/bus.png',
        get_template_directory_uri() . '/assets/img/plane.png',
        get_template_directory_uri() . '/assets/img/cargo-1.png',
        get_template_directory_uri() . '/assets/img/world-map.png',
    ];

    $html = '<div class="mega-menu__images">';
    for ($i = 1; $i <= 4; $i++) {
        $src = get_option('glc_megamenu_image_' . $i) ?: $defaults[$i - 1];
        $html .= '<img src="' . esc_url($src) . '" alt="" class="mega-menu__image">';
    }
    $html .= '</div>';

    return $html;
}

function glc_megamenu_all_link($all_link)
{
    $icon_url = get_template_directory_uri() . '/assets/img/icons/ui/ion_arrow-redo.svg';

    return '<a href="' . esc_url($all_link) . '" class="btn--outline mega-menu__all-link">'
        . '<img src="' . esc_url($icon_url) . '" alt="" class="btn__icon">Всі послуги GLC</a>';
}

function glc_megamenu_footer_active($active_title = '', $active_link = '#')
{
    return '<div class="mega-menu__footer-active">'
        . '<span class="mega-menu__active-title">' . esc_html($active_title) . '</span>'
        . '<a href="' . esc_url($active_link) . '" class="btn--outline mega-menu__detail-btn">Детальніше</a>'
        . '</div>';
}
