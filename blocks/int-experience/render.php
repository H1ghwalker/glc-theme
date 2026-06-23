<?php
if (!defined('ABSPATH')) exit;
/**
 * ACF Block: glc-int-experience
 * Секція "Наш досвід" — карта + текст + групи маршрутів.
 * Поля: title, desc, map_image (Image/Array),
 *       route_groups (Repeater) → group_title, routes (Repeater) → route_title, route_link
 */
$bg           = get_field('section_bg') ?: 'page';
$title        = get_field( 'title' );
$desc         = get_field( 'desc' );
$map_image    = get_field( 'map_image' );
$route_groups = get_field( 'route_groups' );

if (!$title && !$map_image) {
    glc_block_placeholder('GLC: Наш досвід (карта) — заповніть поля в правій панелі →');
    return;
} ?>

<section class="int-experience section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">
        <div class="int-experience__inner">

            <!-- Ліва колонка: карта -->
            <?php if ( ! empty( $map_image['url'] ) ) : ?>
            <div class="int-experience__map">
                <img src="<?php echo esc_url( $map_image['sizes']['medium_large'] ?? $map_image['url'] ); ?>"
                     alt="Карта маршрутів GLC"
                     class="int-experience__map-img">
            </div>
            <?php endif; ?>

            <!-- Права колонка: контент -->
            <div class="int-experience__content">

                <?php if ( $title ) : ?>
                    <h2 class="section-title int-experience__title"><?php echo esc_html( $title ); ?></h2>
                <?php endif; ?>

                <?php if ( $desc ) : ?>
                    <p class="int-experience__desc"><?php echo esc_html( $desc ); ?></p>
                <?php endif; ?>

                <?php if ( $route_groups ) : ?>
                <div class="int-experience__route-groups">
                    <?php foreach ( $route_groups as $group ) :
                        $routes = $group['routes'] ?? [];
                    ?>
                    <div class="int-experience__group">
                        <h3 class="int-experience__group-title">
                            <?php echo esc_html( $group['group_title'] ); ?>
                        </h3>
                        <?php if ( $routes ) : ?>
                        <ul class="int-experience__route-list">
                            <?php foreach ( $routes as $route ) : ?>
                            <li>
                                <a href="<?php echo esc_url( $route['route_link'] ?: '#' ); ?>"
                                   class="int-experience__route">
                                    <?php echo esc_html( $route['route_title'] ); ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

            </div>

        </div>
    </div>
</section>
