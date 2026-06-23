<?php
if (!defined('ABSPATH')) exit;
get_header(); ?>

<main>
    <section class="not-found">
        <div class="container">

            <div class="not-found__code" aria-hidden="true">
                <span class="not-found__digit">4</span>
                <span class="not-found__digit not-found__digit--accent">0</span>
                <span class="not-found__digit">4</span>
            </div>

            <h1 class="not-found__title">Сторінку не знайдено</h1>

            <p class="not-found__desc">
                Схоже, ця сторінка поїхала не тим маршрутом.<br>
                Поверніться на головну або оберіть один із наших напрямків.
            </p>

            <div class="not-found__btns">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn--primary">На головну</a>
                <a href="<?php echo esc_url(home_url('/services')); ?>" class="btn--outline">Наші послуги</a>
            </div>

        </div>
    </section>
</main>

<?php get_footer(); ?>
