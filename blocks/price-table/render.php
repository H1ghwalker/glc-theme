<?php
if (!defined('ABSPATH')) exit;

$bg            = get_field('section_bg') ?: 'page';
$section_title = get_field('section_title');
$col_1         = get_field('col_1_label') ?: 'Маршрут';
$col_2         = get_field('col_2_label') ?: 'Ціна 1';
$col_3         = get_field('col_3_label') ?: 'Ціна 2';
$rows          = get_field('rows');

if (empty($rows)) : ?>
    <div style="padding:40px;text-align:center;background:#f5f5f5;border:2px dashed #ccc">
        <p style="color:#999">GLC: Прайс — заповніть рядки таблиці в правій панелі &rarr;</p>
    </div>
<?php return; endif; ?>

<section class="price-table section section--bg-<?php echo esc_attr($bg); ?>">
    <div class="container">

        <?php if ($section_title) : ?>
            <h2 class="section-title price-table__heading"><?php echo esc_html($section_title); ?></h2>
        <?php endif; ?>

        <div class="price-table__wrap">
            <table>
                <thead>
                    <tr>
                        <th><?php echo esc_html($col_1); ?></th>
                        <th><?php echo esc_html($col_2); ?></th>
                        <th><?php echo esc_html($col_3); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <td data-label="<?php echo esc_attr($col_1); ?>"><?php echo esc_html($row['cell_1']); ?></td>
                            <td data-label="<?php echo esc_attr($col_2); ?>"><?php echo esc_html($row['cell_2']); ?></td>
                            <td data-label="<?php echo esc_attr($col_3); ?>"><?php echo esc_html($row['cell_3']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</section>
