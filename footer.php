<?php
if (!defined('ABSPATH')) exit;
?>

<footer class="footer">

    <!-- Кнопка "вгору" -->
    <div class="footer__top-wrap">
        <button class="footer__scroll-top" id="scrollTopBtn" aria-label="Вгору">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/icons/ui/scroll-top.svg" alt="">
        </button>
    </div>

    <!-- Рядок 1: Лого + Навігація + Соцмережі -->
    <div class="footer__main">
        <div class="container">
            <div class="footer__main-inner">

                <!-- Лого -->
                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer__logo">
                    <?php
                    $custom_logo_id = get_theme_mod('custom_logo');
                    if ($custom_logo_id):
                        echo wp_get_attachment_image($custom_logo_id, 'full', false, ['class' => 'footer__logo-img']);
                    else: ?>
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/logo/logo.svg"
                            alt="<?php bloginfo('name'); ?>" class="footer__logo-img">
                    <?php endif; ?>
                </a>

                <!-- Навігація -->
                <?php if (has_nav_menu('footer')): ?>
                    <?php wp_nav_menu([
                        'theme_location' => 'footer',
                        'container' => 'nav',
                        'container_class' => 'footer__nav',
                        'menu_class' => 'menu',
                        'fallback_cb' => false,
                        'depth' => 1,
                    ]); ?>
                <?php elseif (current_user_can('manage_options')): ?>
                    <p style="color:#999;font-size:12px">
                        ⚠️ Меню "Footer: Головна навігація" не призначено.
                        <a href="<?php echo esc_url(admin_url('nav-menus.php')); ?>">Налаштувати →</a>
                    </p>
                <?php endif; ?>

                <!-- Соцмережі -->
                <div class="footer__socials">
                    <?php glc_render_socials('footer__social', 'footer__social-icon'); ?>
                </div>

            </div>
        </div>
    </div>

    <!-- Рядок 2: Категорії (сірий фон) -->
    <div class="footer__cats">
        <div class="container">
            <div class="footer__cats-grid">
                <?php
                $glc_main_menu = wp_get_nav_menu_items(
                    get_nav_menu_locations()['main'] ?? 0
                );
                $glc_cats = [];

                if ($glc_main_menu) {
                    $glc_services_item = null;
                    foreach ($glc_main_menu as $glc_item) {
                        if (
                            $glc_item->menu_item_parent == 0 &&
                            mb_strtolower($glc_item->title) === 'послуги'
                        ) {
                            $glc_services_item = $glc_item;
                            break;
                        }
                    }
                    if ($glc_services_item) {
                        $glc_cats = array_filter(
                            $glc_main_menu,
                            fn($i) => $i->menu_item_parent == $glc_services_item->ID
                        );
                    }
                }
                ?>

                <?php if (!empty($glc_cats)): ?>
                    <ul class="menu">
                        <?php foreach ($glc_cats as $glc_cat): ?>
                            <li class="menu-item">
                                <a href="<?php echo esc_url($glc_cat->url); ?>">
                                    <?php echo esc_html($glc_cat->title); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php elseif (current_user_can('manage_options')): ?>
                    <p style="color:#999;font-size:12px">
                        ⚠️ Не знайдено пункт "Послуги" в головному меню або він без підпунктів.
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Рядок 3: Юридичні посилання -->
    <div class="footer__legal">
        <div class="container">
            <div class="footer__legal-inner">
                <?php if (has_nav_menu('footer-legal')): ?>
                    <?php wp_nav_menu([
                        'theme_location' => 'footer-legal',
                        'container' => false,
                        'menu_class' => 'menu',
                        'fallback_cb' => false,
                        'depth' => 1,
                    ]); ?>
                <?php elseif (current_user_can('manage_options')): ?>
                    <p style="color:#999;font-size:12px">
                        ⚠️ Меню "Footer: Юридичні посилання" не призначено.
                        <a href="<?php echo esc_url(admin_url('nav-menus.php')); ?>">Налаштувати →</a>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>

</footer>

<?php glc_render_form_popups(); ?>

<?php wp_footer(); ?>
</body>

</html>
