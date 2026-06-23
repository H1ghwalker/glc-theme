<?php
if (!defined('ABSPATH')) exit;
get_header();
glc_breadcrumbs();
?>

<main>
    <?php
    while ( have_posts() ) :
        the_post();

        if (function_exists('get_field') && get_field('page_coming_soon')): ?>
            <section class="coming-soon">
                <div class="container">
                    <div class="coming-soon__icon" aria-hidden="true">
                        <span class="coming-soon__gear coming-soon__gear--lg">&#9881;</span>
                        <span class="coming-soon__gear coming-soon__gear--sm">&#9881;</span>
                    </div>
                    <h1 class="coming-soon__title"><?php the_title(); ?></h1>
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
        <?php else: ?>
            <div class="page-content">
                <?php the_content(); ?>
            </div>
        <?php endif;

    endwhile;
    ?>
</main>

<?php get_footer(); ?>
