<?php
if (!defined('ABSPATH')) exit;
$bg        = get_field('section_bg') ?: 'page';
$icons_uri = get_template_directory_uri() . '/assets/img/icons/ui';
$heading   = get_field('section_heading');
$items     = get_field('items');

if (!$items) {
    glc_block_placeholder('GLC: Транспорт — заповніть елементи в правій панелі →');
    return;
}

$specs_meta = [
    ['field' => 'spec_body_type',  'icon' => 'Body-type.svg',         'label' => 'Тип кузова:'],
    ['field' => 'spec_dimensions', 'icon' => 'dimensions.svg',         'label' => 'Д/Ш/В:'],
    ['field' => 'spec_volume',     'icon' => 'volume.svg',             'label' => 'Об\'єм:'],
    ['field' => 'spec_pallets',    'icon' => 'number-seats.svg',       'label' => 'Кількість палетомісць:'],
    ['field' => 'spec_additional', 'icon' => 'additional-options.svg', 'label' => 'Доп.опції:'],
];
?>

<section class="vehicles section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">

        <h2 class="section-title vehicles__heading">
            <?php echo wp_kses(str_replace('GLC', '<strong>GLC</strong>', esc_html($heading ?: 'Види транспорту в GLC:')), ['strong' => []]); ?>
        </h2>

        <div class="vehicles__slider-wrap">

            <button class="vehicles__nav vehicles__nav--prev" aria-label="Назад">
                <img src="<?php echo esc_url($icons_uri . '/scroll left.svg'); ?>"
                     alt="" class="vehicles__nav-icon"
                     data-active="<?php echo esc_attr($icons_uri . '/scroll left_active.svg'); ?>">
            </button>

            <div class="swiper vehicles__swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($items as $v) :
                        $img = $v['vehicle_image'];
                    ?>
                    <div class="swiper-slide">
                        <article class="vehicle-card">

                            <div class="vehicle-card__img-wrap">
                                <?php if ($img) : ?>
                                    <img src="<?php echo esc_url($img['sizes']['glc-card'] ?? $img['url']); ?>"
                                         alt="<?php echo esc_attr($img['alt']); ?>"
                                         class="vehicle-card__img">
                                <?php else : ?>
                                    <div class="vehicle-card__img-placeholder"></div>
                                <?php endif; ?>
                                <span class="vehicle-card__price"><?php echo esc_html($v['vehicle_price']); ?></span>
                            </div>

                            <div class="vehicle-card__body">
                                <h3 class="vehicle-card__title"><?php echo esc_html($v['vehicle_title']); ?></h3>

                                <ul class="vehicle-card__specs">
                                    <?php foreach ($specs_meta as $spec) :
                                        $val = $v[$spec['field']] ?? '';
                                        if (!$val) continue;
                                    ?>
                                    <li class="vehicle-card__spec">
                                        <img src="<?php echo esc_url($icons_uri . '/' . $spec['icon']); ?>"
                                             alt="" class="vehicle-card__spec-icon">
                                        <span class="vehicle-card__spec-label"><?php echo esc_html($spec['label']); ?></span>
                                        <span class="vehicle-card__spec-value"><?php echo esc_html($val); ?></span>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>

                                <?php
                                $btn_label = esc_html($v['vehicle_btn'] ?: 'Замовити авто');
                                $btn_link  = $v['vehicle_link'] ?? '';
                                if ($btn_link) : ?>
                                <a href="<?php echo esc_url($btn_link); ?>"
                                   class="btn--primary vehicle-card__btn">
                                    <?php echo $btn_label; ?>
                                </a>
                                <?php else : ?>
                                <span class="btn--primary vehicle-card__btn">
                                    <?php echo $btn_label; ?>
                                </span>
                                <?php endif; ?>
                            </div>

                        </article>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="swiper-pagination vehicles__pagination"></div>
            </div>

            <button class="vehicles__nav vehicles__nav--next" aria-label="Вперед">
                <img src="<?php echo esc_url($icons_uri . '/scrolled right.svg'); ?>"
                     alt="" class="vehicles__nav-icon"
                     data-active="<?php echo esc_attr($icons_uri . '/scrolled right_active.svg'); ?>">
            </button>

        </div>
    </div>
</section>
