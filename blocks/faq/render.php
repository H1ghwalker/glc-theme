<?php
if (!defined('ABSPATH')) exit;

$title = get_field('faq_title');
$items = get_field('faq_items');
$bg = get_field('section_bg') ?: 'page';

if (!$items)
{
    glc_block_placeholder('GLC: FAQ — заповніть питання/відповіді в правій панелі →');
    return;
}
?>

<section class="faq-section section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">
        <?php if ($title) : ?>
            <h2 class="section__title"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>

        <div class="svc-accordion">
            <?php foreach ($items as $i => $item) : ?>
            <div class="svc-accordion__item<?php echo esc_attr($i === 0 ? ' is-open' : ''); ?>">
                <button class="svc-accordion__head" type="button">
                    <span class="svc-accordion__title"><?php echo esc_html($item['question']); ?></span>
                    <span class="svc-accordion__icon"></span>
                </button>
                <div class="svc-accordion__body">
                    <div class="svc-accordion__body-inner">
                        <div class="svc-accordion__desc"><?php echo wp_kses_post($item['answer']); ?></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
