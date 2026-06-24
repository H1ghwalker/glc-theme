<?php
if (!defined('ABSPATH')) exit;

define('THEME_VERSION', wp_get_theme()->get('Version'));

// ── Налаштування теми ─────────────────────────────────────
add_action('after_setup_theme', 'theme_setup');
function theme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');

    // Кастомні розміри зображень для слайдерів
    // Контейнер = 1200px → hero рендериться в 1200×390px.
    // Реєструємо з запасом для Retina.
    add_image_size('glc-hero-slide', 1200, 390, true);  // hero-банер (crop)
    add_image_size('glc-card', 600, 400, true);  // картки послуг/авто

    register_nav_menus([
        'main' => __('Main menu', 'wp-lesson'),
        'footer' => 'Footer: Головна навігація',
        'footer-legal' => 'Footer: Юридичні посилання',
    ]);

    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style',
        'navigation-widgets',
    ]);
}

// ── SVG: дозволити завантаження для адміністраторів ───────
add_filter('upload_mimes', function ($mimes) {
    if (current_user_can('manage_options'))
        $mimes['svg'] = 'image/svg+xml';
    return $mimes;
});

add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename) {
    if (str_ends_with($filename, '.svg')) {
        $data['ext'] = 'svg';
        $data['type'] = 'image/svg+xml';
    }
    return $data;
}, 10, 3);

add_filter('wp_handle_upload_prefilter', function ($file) {
    if ($file['type'] !== 'image/svg+xml')
        return $file;

    $content = file_get_contents($file['tmp_name']);
    $clean = glc_sanitize_svg($content);

    if ($clean === false) {
        $file['error'] = 'SVG не пройшов перевірку безпеки.';
        return $file;
    }

    file_put_contents($file['tmp_name'], $clean);
    return $file;
});

function glc_sanitize_svg($content)
{
    libxml_use_internal_errors(true);

    $dom = new DOMDocument();
    if (!$dom->loadXML($content, LIBXML_NONET))
    {
        libxml_clear_errors();
        return false;
    }

    $dangerous_tags = ['script', 'foreignObject', 'iframe', 'embed', 'object', 'applet'];
    foreach ($dangerous_tags as $tag)
    {
        while (($els = $dom->getElementsByTagName($tag)) && $els->length)
        {
            $els->item(0)->parentNode->removeChild($els->item(0));
        }
    }

    $xpath = new DOMXPath($dom);
    foreach ($xpath->query('//*') as $el)
    {
        $to_remove = [];
        for ($i = $el->attributes->length - 1; $i >= 0; $i--)
        {
            $attr = $el->attributes->item($i);
            $name = strtolower($attr->localName);

            if (str_starts_with($name, 'on'))
            {
                $to_remove[] = $attr;
                continue;
            }

            if (in_array($name, ['href', 'xlink:href', 'src', 'data', 'action', 'formaction']))
            {
                $val = preg_replace('/\s+/', '', strtolower($attr->value));
                if (str_starts_with($val, 'javascript:') || str_starts_with($val, 'data:'))
                {
                    $to_remove[] = $attr;
                }
            }
        }
        foreach ($to_remove as $attr)
        {
            $el->removeAttributeNode($attr);
        }
    }

    libxml_clear_errors();
    return $dom->saveXML();
}

// ── Режим обслуговування ──────────────────────────────────
add_action('template_redirect', function() {
    if (!get_option('glc_maintenance_mode'))
        return;
    if (current_user_can('manage_options'))
        return;

    require get_template_directory() . '/maintenance.php';
});

add_action('admin_bar_menu', function($wp_admin_bar) {
    if (!get_option('glc_maintenance_mode'))
        return;

    $wp_admin_bar->add_node([
        'id' => 'glc-maintenance-notice',
        'title' => '🔧 Режим обслуговування',
        'href' => admin_url('admin.php?page=glc-settings'),
        'meta' => ['class' => 'glc-maintenance-bar'],
    ]);
}, 999);

add_action('wp_head', function() {
    if (!get_option('glc_maintenance_mode') || !current_user_can('manage_options'))
        return;
    echo '<style>.glc-maintenance-bar a{background:#d63638!important;color:#fff!important}</style>';
});

add_action('admin_head', function() {
    if (!get_option('glc_maintenance_mode') || !current_user_can('manage_options'))
        return;
    echo '<style>.glc-maintenance-bar a{background:#d63638!important;color:#fff!important}</style>';
});

// ── HTTP-заголовки безпеки ─────────────────────────────────
add_action('send_headers', function () {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
    header('X-XSS-Protection: 0');

    if (is_ssl() && (!defined('WP_DEBUG') || !WP_DEBUG)) {
        header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
    }
});

// ── Підключення файлів ────────────────────────────────────
require_once get_template_directory() . '/inc/connect-script-and-style.php';
require_once get_template_directory() . '/inc/cpt.php';
require_once get_template_directory() . '/inc/glc-settings.php';
require_once get_template_directory() . '/inc/gutenberg.php';
require_once get_template_directory() . '/inc/acf-blocks.php';
require_once get_template_directory() . '/inc/acf-fields.php';
require_once get_template_directory() . '/inc/class-walker-mega-menu.php';

require_once get_template_directory() . '/inc/breadcrumbs.php';

// ── ACF: валідація розмірів зображень для hero-слайдів ───
// Мінімум 1200×390px — менше буде розтягнутим і нечітким.
add_filter('acf/validate_value/type=image', 'glc_validate_hero_image', 10, 4);
function glc_validate_hero_image($valid, $value, $field, $input)
{
    if (!$valid || empty($value))
        return $valid;

    $hero_fields = ['services_hero_slide_1', 'services_hero_slide_2', 'services_hero_slide_3'];
    if (!in_array($field['name'], $hero_fields))
        return $valid;

    $meta = wp_get_attachment_metadata($value);
    if (empty($meta))
        return $valid;

    $min_w = 1200;
    $min_h = 390;

    if ($meta['width'] < $min_w || $meta['height'] < $min_h) {
        return sprintf(
            'Зображення %d×%dpx — замале. Мінімальний розмір для банеру: %d×%dpx.',
            $meta['width'],
            $meta['height'],
            $min_w,
            $min_h
        );
    }

    return $valid;
}

// ── Кнопка з вибором дії (link / popup / phone / scroll) ──
function glc_action_btn($title = 'Кнопка', $action = 'link', $value = '#', $class = 'btn--primary')
{
    switch ($action) {
        case 'phone':
            printf(
                '<a href="tel:%s" class="%s">%s</a>',
                esc_attr($value),
                esc_attr($class),
                esc_html($title)
            );
            break;
        case 'popup':
            printf(
                '<button type="button" class="%s" data-popup="%s">%s</button>',
                esc_attr($class),
                esc_attr($value),
                esc_html($title)
            );
            break;
        case 'scroll':
            printf(
                '<a href="#%s" class="%s">%s</a>',
                esc_attr(ltrim($value, '#')),
                esc_attr($class),
                esc_html($title)
            );
            break;
        default: // link
            printf(
                '<a href="%s" class="%s">%s</a>',
                esc_url($value),
                esc_attr($class),
                esc_html($title)
            );
    }
}

// ── Форматування українського номера телефону ─────────────
// Вхід: будь-який формат (+380XXXXXXXXX, 0XXXXXXXXX тощо)
// Вихід: +38(0XX)XXX-XX-XX
function glc_format_phone($raw)
{
    $digits = preg_replace('/\D/', '', $raw);
    if (strlen($digits) === 12 && substr($digits, 0, 2) === '38')
        $digits = substr($digits, 2);
    if (strlen($digits) === 10)
        return '+38(' . substr($digits, 0, 3) . ')' . substr($digits, 3, 3) . '-' . substr($digits, 6, 2) . '-' . substr($digits, 8, 2);
    return $raw;
}

// ── Виведення соцмереж (хедер + футер) ───────────────────
function glc_render_socials($link_class = 'header__social-link', $icon_class = 'social-icon', $icon_size = 25)
{
    $socials = get_option('glc_socials', []);
    if (empty($socials) || !is_array($socials))
        return;

    foreach ($socials as $social):
        if (empty($social['url']) || empty($social['icon']))
            continue;
        ?>
        <a href="<?php echo esc_url($social['url']); ?>" class="<?php echo esc_attr($link_class); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr($social['name'] ?? ''); ?>">
            <img src="<?php echo esc_url($social['icon']); ?>" alt="" width="<?php echo (int) $icon_size; ?>" height="<?php echo (int) $icon_size; ?>" class="<?php echo esc_attr($icon_class); ?> <?php echo esc_attr($icon_class . '--normal'); ?>">
            <?php if (!empty($social['icon_active'])): ?>
                <img src="<?php echo esc_url($social['icon_active']); ?>" alt="" width="<?php echo (int) $icon_size; ?>" height="<?php echo (int) $icon_size; ?>" class="<?php echo esc_attr($icon_class); ?> <?php echo esc_attr($icon_class . '--active'); ?>">
            <?php endif; ?>
        </a>
    <?php
    endforeach;
}

// ── Заглушка пустого стану блоку в редакторі ─────────────
function glc_block_placeholder(string $hint): void
{
    echo '<div style="padding:40px;text-align:center;background:#f5f5f5;border:2px dashed #ccc">
        <p style="color:#999">' . esc_html($hint) . '</p>
    </div>';
}

// ── Глобальна функція кнопки ──────────────────────────────
function glc_btn($title = 'Кнопка', $link = '#', $class = 'btn--primary', $icon = false)
{
    $icon_html = '';
    if ($icon) {
        $icon_url = get_template_directory_uri() . '/assets/img/icons/ui/ion_arrow-redo.svg';
        $icon_html = '<img src="' . esc_url($icon_url) . '" alt="" class="btn__icon">';
    }

    printf(
        '<a href="%s" class="%s">%s%s</a>',
        esc_url($link),
        esc_attr($class),
        $icon_html,
        esc_html($title)
    );
}
