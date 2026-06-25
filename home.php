<?php
if (!defined('ABSPATH')) exit;
get_header();
glc_breadcrumbs();
?>

<main>
    <section class="coming-soon">
        <div class="container">
            <div class="coming-soon__icon" aria-hidden="true">
                <span class="coming-soon__gear coming-soon__gear--lg">&#9881;</span>
                <span class="coming-soon__gear coming-soon__gear--sm">&#9881;</span>
            </div>
            <h1 class="coming-soon__title">Блог</h1>
            <p class="coming-soon__desc">
                Ми працюємо над цим розділом.<br>
                Зовсім скоро тут з'явиться корисна інформація.
            </p>
            <div class="coming-soon__btns">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn--primary">На головну</a>
                <a href="<?php echo esc_url(home_url('/contacts')); ?>" class="btn--outline">Зв'язатися з нами</a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
