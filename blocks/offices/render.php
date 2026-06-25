<?php
if (!defined('ABSPATH')) exit;
$bg        = get_field('section_bg') ?: 'page';
$icons_uri = get_template_directory_uri() . '/assets/img/icons/ui';

$offices = get_posts([
    'post_type'      => 'office',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

if (!$offices) {
    glc_block_placeholder('GLC: Офіси — додайте записи типу "Офіси" в адмінці →');
    return;
} ?>

<section class="offices section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">

        <?php foreach ($offices as $index => $office) :
            $phone   = get_field('office_phone', $office->ID);
            $email   = get_field('office_email', $office->ID);
            $address = get_field('office_address', $office->ID);
            $map_src_raw = get_field('office_map_src', $office->ID);
            $map_src = '';
            if ($map_src_raw && preg_match('#^https://(www\.)?(google\.(com|com?\.[a-z]{2})|maps\.google\.)/#i', $map_src_raw))
                $map_src = $map_src_raw;
            $reverse = ($index % 2 !== 0);
        ?>
        <div class="office-card <?php echo esc_attr($reverse ? 'office-card--reverse' : ''); ?>">

            <div class="office-card__map">
                <iframe
                    src="<?php echo esc_url($map_src); ?>"
                    class="office-card__iframe"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="<?php echo esc_attr($office->post_title); ?>">
                </iframe>
            </div>

            <div class="office-card__info">
                <h3 class="office-card__title"><?php echo esc_html($office->post_title); ?></h3>

                <ul class="office-card__contacts">

                    <li class="office-card__contact">
                        <img src="<?php echo esc_url($icons_uri . '/phone-number.svg'); ?>"
                             alt="" class="office-card__contact-icon">
                        <a href="tel:<?php echo esc_attr(preg_replace('/\D/', '', $phone)); ?>"
                           class="office-card__contact-text">
                            <?php echo esc_html($phone); ?>
                        </a>
                    </li>

                    <li class="office-card__contact">
                        <img src="<?php echo esc_url($icons_uri . '/email-arrow.svg'); ?>"
                             alt="" class="office-card__contact-icon">
                        <a href="mailto:<?php echo esc_attr($email); ?>"
                           class="office-card__contact-text">
                            <?php echo esc_html($email); ?>
                        </a>
                    </li>

                    <li class="office-card__contact">
                        <img src="<?php echo esc_url($icons_uri . '/geo-location.svg'); ?>"
                             alt="" class="office-card__contact-icon">
                        <span class="office-card__contact-text">
                            <?php echo esc_html($address); ?>
                        </span>
                    </li>

                </ul>
            </div>

        </div>
        <?php endforeach; ?>

    </div>
</section>
